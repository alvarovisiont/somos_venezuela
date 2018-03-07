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
        $this->load->model(array('menu'));
    }// fin construct


    public function index($mensaje = null, $clase = null) {

    	$menu    = $this->menu->show_menu();
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
        $this->load->view('dashboard/menu');
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
    }

    public function store()
    {
        $_POST['createdat'] = date('Y-m-d H:i:s');
        $_POST['updatedat']  = date('Y-m-d H:i:s');

        if($this->menu->crear_modulo($_POST))
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
        $register = $this->menu->findRegisterById($id);

        $ruta = base_url().'index.php/menu/update/'.$id;
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('menu/form', ['register' => $register,'ruta' => $ruta]);
        $this->load->view('dashboard/footer');

    }

    public function update($id)
    {
        $_POST['updatedat'] = date('Y-m-d H:i:s');
        if($this->menu->actualizar_registro($id,$_POST))
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
        if($this->menu->destroy($id))
        {
            redirect('menu/','refresh');
        }
        else
        {
            redirect('menu/','refresh');
        }
    }
}