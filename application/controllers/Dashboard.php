<?php

/**
 * Controlador del inicio 
 * @author sistemaweb21. 
 * Fecha Creación 10/05/2016
 * Fecha de Actualización 10/05/2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('menumodel','escritoriomodel'));
    }// fin construct


    public function index($tipo_bd = null) {

        
        select_db($tipo_bd);

        $permiso = $this->session->userdata('id_permiso');
        $datos = [];

        if($permiso === '4')
        {
            $datos['municipio'] = $this->escritoriomodel->dashboard_data();
        }

    	$this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');

        switch ($permiso) {
            case '4':
                $this->load->view('escritorio/index');
            break;
            
            default:
                
            break;
        }

        $this->load->view('dashboard/footer');
        $this->load->view('escritorio/scripts');
    }

    
   
}