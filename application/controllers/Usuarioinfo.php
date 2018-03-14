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

        $fecha1 = new DateTime($info->fecha_nacimiento);
        $fecha2 = new DateTime();

        $diff = $fecha1->diff($fecha2);

        $datos = ['info' => $info,'ruta_img' => $ruta_img,'edad' => $diff->y];
        
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

    public function remove_img()
    {
      
      $this->usuariomodel->remove_img($this->session->userdata('id_usuario'));
      redirect('usuarioinfo/','refresh');
    }
}