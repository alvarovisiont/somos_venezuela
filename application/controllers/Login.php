<?php
/**
 * Controlador del inicio 
 * @author sistemaweb21. 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
/*---------------------------------------------------------------------*/
    public function __construct() {
         parent::__construct();
         $this->load->model(array('configmodel','usuariomodel'));
    }
/*---------------------------------------------------------------------*/
	public function index(){
		//buscar tipo de logueo
		 $row = $this->configmodel->get_by_tipo(1);
	     $tipo = $row->login;
	     $datos = [
	     	'imagen' => pg_unescape_bytea($row->imagen),
	     	'cintilo' => $row->cintillo,
	     	'titulo' => $row->titulo
	     ];

		  $this->load->view('login/header');
		switch ($tipo) 
		{
		    case 1:
		        $this->load->view('login/login_1',$datos);
		        break;
		    case 2:
		        $this->load->view('login/login_2',$datos);
		        break;
		    case 3:
		         $this->load->view('login/login_3',$datos);
                break;
            case 4:
		         $this->load->view('login/login_4',$datos);
                break;
            case 5:
		         $this->load->view('login/login_5',$datos);
                break;    
        }// fin switch

        $this->load->view('login/footer');
	}// fin index

/*---------------------------------------------------------------------*/
	public function logueo(){

		 //VERIFICAR


		 if ($this->input->post()) {

		 	$username = $this->input->post('email');
            $password = $this->input->post('pass');
           // $username = $username.$this->input->post('username');

            $check_user = $this->usuariomodel->login_usuario($username, $password);

         if ($check_user == TRUE) {

           if ($check_user->correo_activo == 'f')
            {
             $this->session->set_flashdata('usuario_mensj', 'Debe activar su cuenta '.$username);
                             redirect(base_url() . 'index.php/login', 'refresh');
            }else
            {

            if ($check_user->correo_activo == 'f')
            {
             $this->session->set_flashdata('usuario_mensj', 'Su usuario se encuentra desactivado');
                             redirect(base_url() . 'index.php/login', 'refresh');
            }

            }
		 }	
		       

		         $data = array(
                    'is_logued_in' => TRUE,
                    'id_usuario' => $check_user->id,
                    'id_permiso' => $check_user->id_permiso,
                    'bpass' => $check_user->password_activo
                );

                $this->session->set_userdata($data);	
		        redirect('admin', 'refresh');
	}
  }
/*---------------------------------------------------------------------*/
        public function salir ()
        {
            $this->session->set_userdata('is_logued_in', FALSE);
            $this->session->sess_destroy();
            redirect(base_url() . 'index.php/login', 'refresh');
        }


}
