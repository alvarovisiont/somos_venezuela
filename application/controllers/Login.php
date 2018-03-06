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
         $this->load->model(array('configmodel'));
    }
/*---------------------------------------------------------------------*/
	public function index(){
		//buscar tipo de logueo
		 // $row = $this->configmodel->get_by_tipo(1);
	     // $tipo = $row->login;

	      $tipo = 1;

		  $this->load->view('login/header');
		switch ($tipo) 
		{
		    case 1:
		        $this->load->view('login/login_1');
		        break;
		    case 2:
		        $this->load->view('login/login_2');
		        break;
		    case 3:
		         $this->load->view('login/login_3');
                break;
            case 4:
		         $this->load->view('login/login_4');
                break;
            case 5:
		         $this->load->view('login/login_5');
                break;    
        }// fin switch

        $this->load->view('login/footer');
	}// fin index

/*---------------------------------------------------------------------*/
	public function logueo(){

		 //VERIFICAR
		 $this->session->set_userdata('is_logued_in', TRUE);

		 redirect('admin/', 'refresh');
	}

/*---------------------------------------------------------------------*/

}
