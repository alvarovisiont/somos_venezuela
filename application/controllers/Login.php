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
         $this->load->model(array('configmodel','usuariomodel','menumodel'));
    }
/*---------------------------------------------------------------------*/
	public function index($tipo_bd = null){
        switch ($tipo_bd) 
         {
          case null:
            if ($this->session->userdata('bd_activa')){
                $data = array( 'bd_activa' => $this->session->userdata('bd_activa'));
               }else
               {
                $data = array( 'bd_activa' => 'default', 'tipo_bd' => $tipo_bd);
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
		//buscar tipo de logueo
		 $row = $this->configmodel->get_by_tipo(1);
	     $tipo = $row->login;
       
	     $datos = [
	     	'imagen' => $row->imagen,
	     	'banner' => $row->cintillo,
	     	'titulo' => $row->titulo,
        'logo' => $row->logo,
	     ];

       $this->session->set_userdata(['acceso' => $row->acceso]);

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
                case 6:
             $this->load->view('login/login_6',$datos);
                break;       
        }// fin switch

        $this->load->view('login/footer');
	}// fin index

/*---------------------------------------------------------------------*/
	public function logueo(){

		 //VERIFICAR



		 if ($this->input->post()) 
     {      
        
        $username = $this->session->userdata('acceso') === '1' ? $this->input->post('email') : $this->input->post('username');

        $username = strtoupper($username);

        $password = $this->input->post('pass');
       // $username = $username.$this->input->post('username');

        $check_user = $this->usuariomodel->login_usuario($username, $password);

        if ($check_user) {

           if ($check_user->correo_activo == 'f')
            {
                $this->session->set_flashdata('type','danger');
                $this->session->set_flashdata('message','Debe activar su cuenta '.$username);
                redirect(base_url() . 'index.php/login', 'refresh');
            }
            else
            {

              if ($check_user->usuario_activo == 'f')
              {
                $this->session->set_flashdata('type','danger');
                $this->session->set_flashdata('message','Su usuario esta desactivado temporalmente');
                redirect(base_url() . 'index.php/login', 'refresh');
              }

            }
	      }
        
        $membrete = '';

        switch ($check_user->id_permiso) {
                  case '4':
                    $membrete = 'Estado Sucre';
                  break;

                  case '5':
                    $membrete = 'Municipio '.$check_user->municipio.", Estado Sucre";
                  break;

                  case '6':
                    $membrete = 'Parroquia '.$check_user->parroquia.", Municipio: ".$check_user->municipio;
                  break;

                  case '7':
                    $membrete = 'Centro Médico: '.$check_user->nombre;
                  break;

                  case '8':
                    $membrete = 'Médico : '.$check_user->nombre;
                  break;

                  case '9':
                    $membrete = 'Registrador: '.$check_user->nombre;
                  break;

                  case '2':
                    $membrete = 'Administrador del Sistema';
                  break;
        }	       

       $data = array(
              'is_logued_in' => TRUE,
              'id_usuario' => $check_user->id,
              'id_permiso' => $check_user->id_permiso,
              'bpass' => $check_user->password_activo,
              'membrete' => $membrete,
              'municipio' => $check_user->id_municipio,
              'parroquia' => $check_user->id_parroquia,
              'id_centro' => $check_user->id_centro
          );

          $this->session->set_flashdata('type','success');
          $this->session->set_flashdata('message','Ha iniciado sesión Correctamente');

          $this->session->set_userdata($data);	

          $this->usuariomodel->registro_ultimo_logueo();


          $this->redirect_login();
	   }

  }

  private function redirect_login()
  {
        $data = array( 'bd_activa' => 'default', 'tipo_bd' => 1);
        $this->session->set_userdata($data);

         $this->session();
         $this->session_menu(1);
         
         $mun = base64_encode($this->session->userdata('municipio'));
         $parr= base64_encode($this->session->userdata('parroquia'));
         $id = base64_encode($this->session->userdata('id_usuario'));

         
         switch ($this->session->userdata('id_permiso')) {
            case '2':
              $this->load->view('dashboard/header');
              $this->load->view('dashboard/menu');
              $this->load->view('dashboard/dashboard');
              $this->load->view('dashboard/footer');
            break;
            case '4':
              redirect('dashboard/','refresh');
            break;

            case '5':
              redirect('dashboard/municipio/'.$mun,'refresh');
            break;
            case '6':
              redirect('dashboard/parroquia/'.$mun.'/'.$parr,'refresh');
            break;
            case '7':
              redirect('dashboard/centro_medico/'.$id,'refresh');
            break;

            case '8':
              redirect('dashboard/medicos/','refresh');
            break;

            case '9':
              redirect('dashboard/registradores','refresh');
            break;
         }
  }
/*---------------------------------------------------------------------*/
  public function session($tipo_bd = null){
  //armar session completa     

     $session_user = $this->configmodel->session_usuario(); 
     $usuario_data = array(
       'nombre_usuario' => $session_user->nombre,
       'apellido_usuario' => $session_user->apellido,
       'imagen_personal' => $session_user->imagen
    );

    $this->session->set_userdata($usuario_data);
  }

  public function session_menu($tipo_bd = null){

      
      //armar session completa
        $menu  = $this->menumodel->show_menu_perfil();

        $html_menu = '<div id="sidebar" class="sidebar responsive ace-save-state">
                      <ul class="nav nav-list">';  

       $aux_tipo = 0;
      

       foreach ($menu as $row){

        if ($row->link == "f"){
          $ruta_link = "#";
          $classe = 'class="dropdown-toggle"';
          $classe_flecha = 'class="arrow fa fa-angle-down"';
          $icono_classe = 'class="menu-icon fa '.$row->icono.'"';
        }else
        {
          $ruta_link = base_url().$row->ruta;
          $classe = 'class=""';
          $classe_flecha = 'class=""';
          $icono_classe = 'class="menu-icon fa '.$row->icono.'"';
        }
 /*-----------------------------------------------------------------*/
         $html_menu .= '
             <li class="">
              <a href="'.$ruta_link.'" '.$classe.' >
              <i '.$icono_classe.'></i>
              <span class="menu-text">'.$row->nombre.'
              </span>
              <b '.$classe_flecha.'></b>
            </a>
            <b class="arrow"></b>'; 
         /*-----------------------------------------------------------------*/

         $aux_tipo = 1;

         $areas = explode(',', $row->id_area);
         $sub_areas = explode(',', $row->id_sub_area);

        foreach ($areas as $row_areas)
        {
           $id_area = trim($row_areas, "{}");

        if ($id_area <> null)
        { 
             $area_menu  = $this->menumodel->show_menu_area($id_area);

        if ($area_menu == TRUE) {

              if ($aux_tipo == 1)
              {
                 $html_menu .= '<ul class="submenu">';
                 $aux_tipo = 2;
              }


                if ($area_menu->link == "f"){
                  $ruta_link = "#";
                  $classe = 'class="dropdown-toggle"';
                  $classe_flecha = 'class="arrow fa fa-angle-down"';
                }else
                {
                  $ruta_link = base_url().$area_menu->ruta;
                  $classe = 'class=""';
                  $classe_flecha = 'class=""';
                }    

           
                  $html_menu .= '
                    <li class="">
                     <a href="'.$ruta_link.'" '.$classe.' >
                    <i class="menu-icon fa fa-caret-right"></i>
                    <span class="menu-text">'.$area_menu->nombre.'
                    </span>
                     <b '.$classe_flecha.'></b>
                  </a>
                  <b class="arrow"></b>';  
         

        /*----------------------------------------------------------------*/         
          foreach ($sub_areas as $row_sub_areas)
           {
              $id_sub_area = trim($row_sub_areas, "{}");

              if ($id_sub_area <> null)
              { 
                $sub_menu  = $this->menumodel->show_menu_sub_area($id_area, $id_sub_area);

              if ($sub_menu  == TRUE) 
                {   
                    $ruta_link = base_url().$sub_menu->ruta;
                    $classe = 'class=""';
                    $classe_flecha = 'class=""';

                    $html_menu .= '<ul class="submenu">
                     <li class="">
                          <a href="'.$ruta_link.'" '.$classe.' >
                          <i class="menu-icon fa fa-caret-right"></i>
                           <span class="menu-text">'.$sub_menu->nombre.'
                          </span>
                           <b '.$classe_flecha.'></b>
                        </a>
                      
                        <b class="arrow"></b>
                      </li></ul> ';
                 }  //datos sub area
              } //if null sub area  
           }// en sub area

             $html_menu .= '</li>'; //cierre de la area
          }  
         }
       }//en de area

        if ($aux_tipo == 2)
              {
                 $html_menu .= '</ul>';
              }

        $html_menu .= '</li>';  
    }//en modulo   
  /*-----------------------------------------------------------------*/

       $html_menu .= '</ul> </div>';

       $menu_data = array(
         'menu_usuario' => $html_menu,
      );

      $this->session->set_userdata($menu_data);

  }
  
    public function salir ()
    {
        $this->session->set_userdata('is_logued_in', FALSE);
        $this->session->sess_destroy();
        redirect(base_url() . 'index.php/login', 'refresh');
    }

}
