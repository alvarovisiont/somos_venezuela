<?php

/**
 * Controlador del inicio 
 * @author sistemaweb21. 
 * Fecha Creación 10/05/2016
 * Fecha de Actualización 10/05/2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('perfilmodel'));
    }// fin construct


    public function dashboard($tipo_bd = null) {

        $data = '';
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
		
      
         $perfil = $this->perfilmodel->show_perfil(); 

         $this->load->view('dashboard/header');
         $this->load->view('dashboard/menu');
         $this->load->view('perfil/index',compact('perfil',$perfil));
         $this->load->view('dashboard/footer');
    }//fin index

     public function dashboard_table() {
        
      if (!$this->session->userdata('is_logued_in'))
       {
        redirect('login/', 'refresh');
       }else
       {
         $perfil = $this->perfilmodel->show_perfil(); 

         $this->load->view('dashboard/header');
         $this->load->view('dashboard/menu');
         $this->load->view('perfil/index_table',compact('perfil',$perfil));
         $this->load->view('dashboard/footer_table');
         
        }
    }//fin index


    public function store()
    {
        $_POST['createdat'] = date('Y-m-d H:i:s');
        $_POST['updatedat']  = date('Y-m-d H:i:s');

        if($this->perfilmodel->crear_perfil($_POST))
        {
            
            redirect('perfil/dashboard','refresh');
        }
        else
        {  
            
            redirect('perfil/dashboard','refresh');
        }
    }

/*------------------------------------------------------------------------------------/  
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


     public function a_plantilla()
     {
        $id = $_POST['id'];
            unset($_POST['id']);
            $this->configmodel->update_loqueo($id, $_POST);     
        $this->plantilla();         
     }
/*------------------------------------------------------------------------------------*/  

}
