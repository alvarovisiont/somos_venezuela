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

        $datos['data'] = $this->escritoriomodel->dashboard_data();
        $datos['totales'] = $this->escritoriomodel->totales_estado();
        

    	$this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');

        switch ($permiso) {
            case '4':


            case '2':
                $this->load->view('escritorio/index', $datos);
            break;
            
            default:
                
            break;
        }
        $this->load->view('dashboard/footer');
        $this->load->view('escritorio/scripts');
    }

    public function municipio($municipio = null)
    {
        $municipio = $municipio ? base64_decode($municipio) : $this->session->userdata('municipio');

        $datos = [];
        $datos['municipio'] = $municipio;
        $datos['data'] = $this->escritoriomodel->datos_municipio($municipio);
        $datos['totales'] = $this->escritoriomodel->totales_municipio($municipio);



        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('escritorio/municipio', $datos);
        $this->load->view('dashboard/footer');
        $this->load->view('escritorio/scripts');
    }

    public function parroquia($municipio = null,$parroquia = null)
    {
        
        $municipio = $municipio ? base64_decode($municipio) : $this->session->userdata('municipio');

        $parroquia = $parroquia ? base64_decode($parroquia) : $this->session->userdata('parroquia');

        $datos = [];
        $datos['data'] = $this->escritoriomodel->datos_parroquia($municipio,$parroquia);
        $datos['totales'] = $this->escritoriomodel->totales_parroquia($municipio,$parroquia);
        $datos['municipio'] = base64_encode($municipio);


        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('escritorio/parroquia', $datos);
        $this->load->view('dashboard/footer');
        $this->load->view('escritorio/scripts');


    }

    public function centro_medico($id = null)
    {

        $id = $id ? base64_decode($id) : $this->session->userdata('id_usuario');

        $datos['data'] = $this->escritoriomodel->centros_medicos($id);
        $datos['totales'] = $this->escritoriomodel->totales_centro_medico($id);
        
        $datos['estructura'] = $this->escritoriomodel->centro_medico_estructura($id);

        $datos['municipio'] = base64_encode($datos['data'][0]->muni);
        $datos['parroquia'] = base64_encode($datos['data'][0]->parro);
        $datos['centro'] = $id;
        


        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('escritorio/centro_medico', $datos);
        $this->load->view('dashboard/footer');
        $this->load->view('escritorio/scripts');
    }

    public function registradores()
    {
        $datos['data'] = $this->escritoriomodel->datos_censo();
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('escritorio/registradores', $datos);
        $this->load->view('dashboard/footer');
        $this->load->view('escritorio/scripts');
    }

    public function medicos()
    {
        $datos['data'] = $this->escritoriomodel->datos_verificados();
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('escritorio/medico', $datos);
        $this->load->view('dashboard/footer');
        $this->load->view('escritorio/scripts');
    }
   
}