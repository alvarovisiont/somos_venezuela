<?php
/**
 * Controlador del inicio 
 * @author sistemaweb21. 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
/*---------------------------------------------------------------------*/
    public function __construct() {
         parent::__construct();
         $this->load->model(array('configmodel','usuariomodel'));
    }
/*---------------------------------------------------------------------*/
	public function index(){
		//buscar tipo de logueo

      if (!$this->session->userdata('is_logued_in'))
       {
        redirect('login/', 'refresh');
       }else
       {
         $usuario  = $this->usuariomodel->show_usuario();

         $arr_usuario = $usuario;
         $correo_usuario = array();

         foreach ( $arr_usuario  as $row) 
         array_push($correo_usuario, $row->email);

         $usuario_data = array(
         'arr_usuarios' => $correo_usuario
         );
         $this->session->set_userdata($usuario_data);

         $this->load->view('dashboard/header');
         $this->load->view('dashboard/menu');
         $this->load->view('usuario/index',['usuario' => $usuario]);
         $this->load->view('dashboard/footer');
        }
	
	}// fin index

/*---------------------------------------------------------------------*/

       public function usuario_activo($id,$estatus){

       if (!$this->session->userdata('is_logued_in'))
       {
        redirect('login/', 'refresh');
       }else
       {  

        if ($estatus == 't'){
         $data = array(
                 'usuario_activo' => false);
         }else{
            $data = array(
                 'usuario_activo' => true);
         }

        if($this->usuariomodel->actualizar_registro($id,$data))
        {

            //registro modificado;
             $this->session->set_flashdata('usuario_mensj', 'Cambiado el estatus');
            redirect('usuario/','refresh');
        }
        else
        {
            redirect('usuario/','refresh');
        }



       }

   }





}
