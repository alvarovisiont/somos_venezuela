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

    public function session(){
    //armar session completa      
       $session_user = $this->configmodel->session_usuario(); 
       $usuario_data = array(
         'nombre_usuario' => $session_user->nombre,
         'apellido_usuario' => $session_user->apellido,
         'imagen_personal' => $session_user->imagen,
      );
      $this->session->set_userdata($usuario_data);
    }

     public function session_menu(){
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



    public function index() {		
      if (!$this->session->userdata('is_logued_in'))
       {
        redirect('login/', 'refresh');
       }else
       {
        $data = array( 'bd_activa' => 'default', 'tipo_bd' => $tipo_bd);
        $this->session->set_userdata($data);
        
         $this->session();
         $this->session_menu();
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
