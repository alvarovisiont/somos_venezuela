<?php

/**
 * Controlador del inicio 
 * @author sistemaweb21. 
 * Fecha Creación 10/05/2016
 * Fecha de Actualización 10/05/2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Permiso extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('permisomodel','menumodel','perfilmodel','usuariomodel'));
    }// fin construct


    public function dashboard() {

    	$accesos = $this->menumodel->show_menu();
        $total_perfiles = $this->perfilmodel->count_perfil();
        $total_users = $this->usuariomodel->count_users();

        $datos = ['accesos' => $accesos,'total_perfiles' => $total_perfiles, 'total_users' => $total_users];

    	$this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('permission/index',$datos);
        $this->load->view('dashboard/footer');
        $this->load->view('permission/scripts');
    }

    public function buscar_perfiles_ajax()
    {
    	$type = $this->input->get('type') === 'manuales' ? true : false;

    	$result = $this->permisomodel->show_perfil_by_selection($type);

    	echo json_encode($result);
    }

    public function buscar_modulos_ajax()
    {
    	$perfil = $this->input->get('perfil');

    	$result = $this->permisomodel->show_module_by_perfil($perfil);

    	echo json_encode($result);
    }

}