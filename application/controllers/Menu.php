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


    public function index($tipo_bd = null) {

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

      
    	$menu = $this->menumodel->show_menu();
    
    	$this->load->view('dashboard/header');
      $this->load->view('dashboard/menu',['menu' => $menu]);
    	$this->load->view('menu/index',['menu' => $menu]);
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
   
}