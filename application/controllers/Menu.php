<?php

/**
 * Controlador del inicio 
 * @author sistemaweb21. 
 * Fecha Creación 10/05/2016
 * Fecha de Actualización 10/05/2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('menumodel'));
    }// fin construct


    public function index($mensaje = null, $clase = null) {

    	$menu    = $this->menumodel->show_menu();
        $mensaje = null;
        $clase   = null;
        if($mensaje)
        {
            $mensaje = base64_decode($mensaje);
        }

        if($clase)
        {
            $clase = base64_decode($clase);
        }

    	$this->load->view('dashboard/header');
        $this->load->view('dashboard/menu',['menu' => $menu]);
    	$this->load->view('menu/index',['menu' => $menu, 'mensaje' => $mensaje, 'clase' => $clase]);
    	$this->load->view('dashboard/footer');
        $this->load->view('menu/scripts');

    }

    public function create()
    {
        $ruta = base_url().'index.php/menu/store';

        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('menu/form',['ruta' => $ruta,'register' => null]);
        $this->load->view('dashboard/footer');
         $this->load->view('menu/scripts');
    }

    public function store()
    {
        $_POST['createdat'] = date('Y-m-d H:i:s');
        $_POST['updatedat']  = date('Y-m-d H:i:s');

        if($this->menumodel->crear_modulo($_POST))
        {
            
            redirect('menu/','refresh');
        }
        else
        {  
            
            redirect('menu/','refresh');
        }
    }

    public function edit($id)
    {
        $register = $this->menumodel->findRegisterById($id);

        $ruta = base_url().'index.php/menu/update/'.$id;
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('menu/form', ['register' => $register,'ruta' => $ruta]);
        $this->load->view('dashboard/footer');
        $this->load->view('menu/scripts');

    }

    public function update($id)
    {
        $_POST['updatedat'] = date('Y-m-d H:i:s');
        if($this->menumodel->actualizar_registro($id,$_POST))
        {
            redirect('menu/','refresh');
        }
        else
        {
            redirect('menu/','refresh');
        }
    }

    public function destroy($id)
    {
        if($this->menumodel->destroy($id))
        {
            redirect('menu/','refresh');
        }
        else
        {
            redirect('menu/','refresh');
        }
    }


     public function actualizar(){
    //armar session completa      
       $menu    = $this->menumodel->show_menu();

       $html_menu = '<div id="sidebar" class="sidebar responsive ace-save-state">
        <ul class="nav nav-list">';  

       $aux_tipo = 0;
        foreach ($menu as $row) 
       { 

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

          if ($row->id_tipo == 1){ 
          if ($row->id_tipo == $aux_tipo){

         $html_menu .= '</li>
             <li class="">
              <a href="'.$ruta_link.'" '.$classe.' >
              <i '.$icono_classe.'></i>
              <span class="menu-text">'.$row->nombre.'
              </span>
              <b '.$classe_flecha.'></b>
            </a>
            <b class="arrow"></b>';

            } else { 

            if ($aux_tipo <> 0) { 
            $html_menu .= '</li></ul>';
            }

            $html_menu .= ' <li class="">
              <a href="'.$ruta_link.'" '.$classe.' >
              <i '.$icono_classe.'></i>
              <span class="menu-text">'.$row->nombre.'
              </span>
              <b '.$classe_flecha.'></b>
            </a>
          <b class="arrow"></b>';

           } }

          if ($row->id_tipo == 2){ 
          if ($row->id_tipo == $aux_tipo){

          $html_menu .= ' </li></ul>
             <ul class="submenu">
         <li class="">
             <a href="'.$ruta_link.'" '.$classe.' >
              <i class="menu-icon fa fa-caret-right"></i>
              <span class="menu-text">'.$row->nombre.'
              </span>
               <b '.$classe_flecha.'></b>
            </a>
            <b class="arrow"></b>';  

            } else {

            $html_menu .= '<ul class="submenu">
        <li class="">
               <a href="'.$ruta_link.'" '.$classe.' >
              <i class="menu-icon fa fa-caret-right"></i>
              <span class="menu-text">'.$row->nombre.'
              </span>
               <b '.$classe_flecha.'></b>
            </a>
            <b class="arrow"></b>';  
           } 
         } 

         if ($row->id_tipo == 3){ 

         $html_menu .= '<ul class="submenu">
         <li class="">
              <a href="'.$ruta_link.'" '.$classe.' >
              <i class="menu-icon fa fa-caret-right"></i>
               <span class="menu-text">'.$row->nombre.'
              </span>
               <b '.$classe_flecha.'></b>
            </a>
          
            <b class="arrow"></b>
          </li></ul> ';

        }
        $aux_tipo = $row->id_tipo;
    } //en foreach

     if ($aux_tipo == 1)
      {
        $html_menu .= '</ul> </li>';  
      }else {
        $html_menu .= '</ul></li>';
      }
      $html_menu .= '</ul> </div>';

       $menu_data = array(
         'menu_usuario' => $html_menu,
      );
      $this->session->set_userdata($menu_data);

       $this->index();  
    }

   
}