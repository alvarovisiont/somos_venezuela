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
        $this->load->model(array('menumodel','escritoriomodel','verificarmodel','modalesescritoriomodel'));
    }// fin construct


// ============================= ESTADOS ===========================================

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
        $this->load->view('escritorio/modales_estado');
    }

    public function centros_estados_modal()
    {
        echo json_encode($this->modalesescritoriomodel->centros_estados());
    }

    public function registradores_medicos_estados_modal()
    {
        $permiso = $this->input->get('permiso');
        echo json_encode($this->modalesescritoriomodel->registradores_medicos_estados($permiso));   
    }

    public function censados_estado_modal()
    {
        echo json_encode($this->modalesescritoriomodel->censados_estado());
    }
    

// ============================= MUNICIPIO ===========================================


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
        $this->load->view('escritorio/modales_municipio');
    }

    public function centros_municipio_modal()
    {
        $muni = $this->input->get_post('muni');

        echo json_encode($this->modalesescritoriomodel->centros_municipio($muni));
    }

    public function registradores_medicos_municipio_modal()
    {
        $muni = $this->input->get_post('muni');

        $permiso = $this->input->get('permiso');
        echo json_encode($this->modalesescritoriomodel->registradores_medicos_municipio($permiso,$muni));   
    }

    public function censados_municipio_modal()
    {
        $muni = $this->input->get_post('muni');
        echo json_encode($this->modalesescritoriomodel->censados_municipio($muni));
    }

// ============================= PARROQUIA ===========================================

    public function parroquia($municipio = null,$parroquia = null)
    {
        
        $municipio = $municipio ? base64_decode($municipio) : $this->session->userdata('municipio');

        $parroquia = $parroquia ? base64_decode($parroquia) : $this->session->userdata('parroquia');

        $datos = [];
        $datos['data'] = $this->escritoriomodel->datos_parroquia($municipio,$parroquia);
        $datos['totales'] = $this->escritoriomodel->totales_parroquia($municipio,$parroquia);
        $datos['municipio'] = base64_encode($municipio);
        $datos['parroquia'] = base64_encode($parroquia);


        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('escritorio/parroquia', $datos);
        $this->load->view('dashboard/footer');
        $this->load->view('escritorio/scripts');
        $this->load->view('escritorio/modales_parroquia');


    }

    public function centros_parroquia_modal()
    {
        $muni = $this->input->get_post('muni');
        $parro= $this->input->get('parro');

        echo json_encode($this->modalesescritoriomodel->centros_parroquia($muni,$parro));
    }

    public function registradores_medicos_parroquia_modal()
    {
        $muni = $this->input->get_post('muni');
        $parro= $this->input->get('parro');

        $permiso = $this->input->get('permiso');
        echo json_encode($this->modalesescritoriomodel->registradores_medicos_parroquia($permiso,$muni,$parro));   
    }

    public function censados_parroquia_modal()
    {
        $muni = $this->input->get('muni');
        $parro= $this->input->get('parro');

        echo json_encode($this->modalesescritoriomodel->censados_parroquia($muni,$parro));
    }

// ============================ CENTRO MEDICO ==========================================

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

    public function medicos($id = null,$centro = null)
    {
        $id = $id ? base64_decode($id) : $this->session->userdata('id_usuario');

        $centro = $centro ? base64_decode($centro) : $centro;

        $datos['data'] = $this->escritoriomodel->datos_verificados($id);
        $datos['total'] = $this->verificarmodel->no_verificados_total($centro);
        $datos['centro'] = base64_encode($centro);

        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('escritorio/medico', $datos);
        $this->load->view('dashboard/footer');
        $this->load->view('escritorio/scripts');
    }
   
}