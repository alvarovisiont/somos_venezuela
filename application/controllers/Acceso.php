<?php

/**
 * Controlador del inicio 
 * @author sistemaweb21. 
 * Fecha Creación 10/05/2016
 * Fecha de Actualización 10/05/2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Acceso extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('permisomodel','perfilmodel','accesomodel','usuariomodel'));
    }// fin construct


    public function index() 
    {
        $total_perfiles = $this->perfilmodel->count_perfil();
        $total_users = $this->usuariomodel->count_users();

        $datos = ['total_perfiles' => $total_perfiles, 'total_users' => $total_users];

    	$this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('acceso_action/index', $datos);
        $this->load->view('dashboard/footer');
        $this->load->view('acceso_action/scripts');
    }
}