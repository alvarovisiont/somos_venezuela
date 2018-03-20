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

        $permiso = $this->session->userdata('id_permiso');
        $datos = [];

        if($permiso === '2')
        {
            $datos['data'] = $this->escritoriomodel->dashboard_data($permiso);
        }

    	$this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');

        switch ($permiso) {
            case '2':
                $this->load->view('escritorio/index', $datos);
            break;
            
            default:
                
            break;
        }

        $this->load->view('dashboard/footer');
        $this->load->view('escritorio/scripts');
    }

    public function municipio($municipio)
    {
        $municipio = base64_decode($municipio);
        $datos = [];
        $datos['municipio'] = $municipio;
        $datos['data'] = $this->escritoriomodel->datos_municipio($municipio);



        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('escritorio/municipio', $datos);
        $this->load->view('dashboard/footer');
        $this->load->view('escritorio/scripts');
    }

    public function parroquia($municipio,$parroquia)
    {
        
        $municipio = base64_decode($municipio); /* decode base 64*/  $parroquia = base64_decode($parroquia);

        $datos = [];
        $datos['data'] = $this->escritoriomodel->datos_parroquia($municipio,$parroquia);

    }

    public function centro_medico($municipio,$parroquia)
    {

    }

    
   
}