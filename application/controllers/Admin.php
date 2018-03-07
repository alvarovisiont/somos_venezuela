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
        $this->load->model(array('configmodel'));
    }// fin construct


    public function index() {
		
      if (!$this->session->userdata('is_logued_in'))
       {
        redirect('login/', 'refresh');

       }else
       {
         $this->load->view('dashboard/header');
         $this->load->view('dashboard/menu');
         $this->load->view('dashboard/dashboard');
         $this->load->view('dashboard/footer');
		}
    }//fin index

/*------------------------------------------------------------------------------------*/  
    public function plantilla(){

         $row = $this->configmodel->get_by_tipo(1);         
         $data = array(
          'tipo'=>  $row->login,
          'id'=>  $row->id);

         $this->load->view('dashboard/header');
         $this->load->view('dashboard/menu');
         $this->load->view('dashboard/plantilla_login', $data);
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

        if(!empty($_FILES['imagen']['name']))
        {
            $_POST['imagen'] = pg_escape_bytea(file_get_contents($_FILES['imagen']['tmp_name']));
        }

        if(!empty($_FILES['cintillo']['name']))
        {
            $_POST['cintillo'] = pg_escape_bytea(file_get_contents($_FILES['cintillo']['tmp_name']));
        }

        unset($_POST['id']);

        $this->configmodel->update_loqueo($id, $_POST);     

        redirect('admin/plantilla', 'refresh');        
     }


}
