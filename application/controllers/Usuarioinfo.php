<?php

/**
 * Controlador del inicio 
 * @author sistemaweb21. 
 * Fecha Creación 10/05/2016
 * Fecha de Actualización 10/05/2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarioinfo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('usuariomodel'));
    }// fin construct


    public function index($tipo_bd = null) 
    {
    	 switch ($tipo_bd) 
       {
        case null:
          if ($this->session->userdata('bd_activa')){
              $data = array( 'bd_activa' => $this->session->userdata('bd_activa'),
              'tipo_bd' =>  $this->session->userdata('tipo_bd'));
             }else
             {
              $data = array( 'bd_activa' => 'default',
              'tipo_bd' => 1);
             }
             break;
         case 1:
             $data = array( 'bd_activa' => 'default', 'tipo_bd' => $tipo_bd);    
            break;
         case 2:
            $data = array( 'bd_activa' => 'admin21', 'tipo_bd' => $tipo_bd);
            break;
        }// fin switch

        $this->session->set_userdata($data);

        $info = $this->usuariomodel->usuario_info($this->session->userdata('id_usuario'));

        $ruta_avatar = base_url().'assets_sistema/images/avatars/';

        $ruta_img = $info->imagen ? $ruta_avatar.$info->imagen : $ruta_avatar.'avatar3.png';

        $edad = '';

        if(!empty($info->fecha_nacimiento))
        {
            $fecha1 = new DateTime($info->fecha_nacimiento);
            $fecha2 = new DateTime();

            $diff = $fecha1->diff($fecha2);
            $edad = $diff->y;
        }
        else
        {
          $edad = 'Sin Información';
        }
          

        $datos = ['info' => $info,'ruta_img' => $ruta_img,'edad' => $edad];
        
    	  $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('usuario_info/index', $datos);
        $this->load->view('dashboard/footer');
        $this->load->view('usuario_info/scripts');
    }

    public function create()
    {
    	if($this->usuariomodel->guardar_informacion_usuario($_POST))
    	{
    		redirect('usuarioinfo/','refresh');
    	}

    }

    public function uploadImg()
    {
      $config = [];

      $config['upload_path'] = './assets_sistema/images/avatars';
      $config['allowed_types'] = 'jpg|png|jpeg';
      $config['max_size'] = '2048';
      $config['encrypt_name'] = TRUE;
      $config['overwrite'] = TRUE;

       $this->load->library('upload');

       $this->upload->initialize($config);

      if (!$this->upload->do_upload('foto')) {

          $this->data['error'] = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));

          print_r($this->data['error']);
          //error
      } 
      else 
      {

          $upload_data = $this->upload->data();
          
          
          $imagen_nombre = $upload_data['file_name'];

          //resize:

          $config['image_library'] = 'gd2';
          $config['source_image'] = $upload_data['full_path'];
          $config['maintain_ratio'] = TRUE;
          $config['width']     = 256;
          $config['height']   = 256;

          $this->load->library('image_lib', $config); 

          $this->image_lib->resize();

          //add to the DB
          if($this->usuariomodel->uploadImg($this->session->userdata('id_usuario'), $imagen_nombre))
          {
            redirect('usuarioinfo','refresh');
          }
          else
          {
            redirect('usuarioinfo','refresh');
          }

        } // fin guardado imagen
    }
}