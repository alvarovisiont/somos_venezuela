<?php

/**
 * Controlador del inicio 
 * @author sistemaweb21. 
 * Fecha Creación 10/05/2016
 * Fecha de Actualización 10/05/2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('configmodel', 'menumodel'));
       
    }// fin construct


    public function index() {		
      
      $this->load->view('dashboard/header');
      $this->load->view('dashboard/menu');
      $this->load->view('dashboard/dashboard');
      $this->load->view('dashboard/footer');

    }//fin index

/*------------------------------------------------------------------------------------*/  
    public function plantilla(){

         $row = $this->configmodel->get_by_tipo(1);       

         $this->load->view('dashboard/header');
         $this->load->view('dashboard/menu');
         $this->load->view('dashboard/plantilla_login', ['datos' => $row]);
         $this->load->view('dashboard/footer');
    }

/*------------------------------------------------------------------------------------*/  
     public function a_plantilla()
     {
        // post form dashboard

        $id = $_POST['id'];

        if(empty($_POST['titulo']))
        {
            unset($_POST['titulo']);
        }

        $errores = [];

        foreach ($_FILES as $key => $row) 
        {
          if(!empty($row['name']))
          {
              $ruta = './assets_sistema/images/gallery/complementos_login/';

              $nombre_imagen = upload_image($key,$ruta);

              if(is_array($nombre_imagen))
              {
                $errores[$key] = 'Ha ocurrido un error al tratar de subir el archivo';
                print_r($nombre_imagen);
                exit();
              }
              else
              {
                $_POST[$key] = $nombre_imagen;
              }
              
          }
        }

        $this->session->set_flashdata('type', 'success');
        $this->session->set_flashdata('message', 'Actualización realizada con éxito');

        unset($_POST['id']);

        $this->configmodel->update_loqueo($id, $_POST);     

        redirect('admin/plantilla', 'refresh');        
     }

     public function remove_img()
     {
        $id  = $this->input->post('id');
        $ref = $this->input->post('ref');
        $img = $this->input->post('img');

        $this->configmodel->remove_img($id,$ref,$img);
     }


}
