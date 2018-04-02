<?php

/**
 * Controlador del inicio 
 * @author sistemaweb21. 
 * Fecha Creación 10/05/2016
 * Fecha de Actualización 10/05/2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Censo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('censomodel'));
    }// fin construct


// ================================ | VIVIENDA | ============================================= //

    public function index($id = null,$centro = null) 
    {   
        $id_busqueda = $id ? base64_decode($id) : $this->session->userdata('id_usuario');
        
        $datos = [];

        $datos['data'] = $this->censomodel->ver_viviendas($id_busqueda);
        $datos['registrador'] = $id_busqueda;
        $datos['centro'] = $centro;

        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('censo/index',$datos);
        $this->load->view('dashboard/footer');
        $this->load->view('censo/scripts');
    }

    public function store_vivienda()
    {
        $this->censomodel->store_vivienda($this->input->post());
        
        $this->session->set_flashdata('type', 'success');
        $this->session->set_flashdata('message', 'Vivienda Registrada con Éxito');

        redirect('censo/','refresh');
    }

    public function vivienda_delete($id)
    {
        $id = base64_decode($id);

        $this->censomodel->destroy_vivienda($id);

        $this->session->set_flashdata('type', 'success');
        $this->session->set_flashdata('message', 'Vivienda eliminada con éxito');

        redirect('censo/','refresh');

    }

// ================================ | JEFE FAMILIAR | ============================================= //

    public function jefe($id)
    {
        $id = base64_decode($id);
        

        $datos = [];
        $datos['data'] = $this->censomodel->buscar_jefes($id);
        $datos['vivienda'] = $id;
        $datos['total_viviendas'] = $this->censomodel->total_viviendas();

        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('censo/jefes_ver',$datos);
        $this->load->view('dashboard/footer');
        $this->load->view('censo/scripts');
    }

    public function create_jefe($id)
    {
        $id = base64_decode($id);
        $datos = [];
        $datos['vivienda'] = $id;
        $datos['edit'] = false;
        $datos['ruta'] = base_url().'index.php/censo/store_jefe';

        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('censo/form_jefe',$datos);
        $this->load->view('dashboard/footer');
        $this->load->view('censo/scripts');
    }

    public function store_jefe()
    {
        unset($_POST['pensionado_check']);
        unset($_POST['id_registro']);
        

        $_POST['fecha_nac'] = date('Y-m-d',strtotime($_POST['fecha_nac']));

        $this->censomodel->store_censo($this->input->post());
        
        redirect('censo/jefe/'.base64_encode($this->input->post('id_vivienda')),'refresh');
    }

    public function edit_jefe($id)
    {
        $id = base64_decode($id);

        $datos = [];

        $datos['jefe'] = $this->censomodel->edit_censo($id);
        $datos['vivienda'] = $datos['jefe']->id_vivienda;
        $datos['edit'] = true;
        $datos['ruta'] = base_url().'index.php/censo/update_jefe';

        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('censo/form_jefe',$datos);
        $this->load->view('dashboard/footer');
        $this->load->view('censo/scripts');
    }

    public function update_jefe()
    {
        unset($_POST['pensionado_check']);

        $_POST['fecha_nac'] = date('Y-m-d', strtotime($_POST['fecha_nac']) );

        $this->censomodel->update_censo($this->input->post());

        $this->session->set_flashdata('type', 'success');
        $this->session->set_flashdata('message', 'Jefe Modificado con Éxito');

        redirect('censo/jefe/'.base64_encode($this->input->post('id_vivienda')),'refresh');
    }

    public function jefe_delete($id,$vivienda)
    {
        $id = base64_decode($id);

        $this->censomodel->destroy_censo($id);

        $this->session->set_flashdata('type', 'success');
        $this->session->set_flashdata('message', 'Jefe eliminado con éxito');

        redirect('censo/jefe/'.$vivienda,'refresh');
    }

// ================================ | CARGA FAMILIAR | ============================================= //

    public function carga_familiar($id,$vivienda)
    {
        $id = base64_decode($id);
        

        $datos = [];
        $datos['data'] = $this->censomodel->buscar_carga($id);
        $datos['jefe'] = $id;
        $datos['vivienda'] = $vivienda;

        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('censo/carga',$datos);
        $this->load->view('dashboard/footer');
        $this->load->view('censo/scripts');
    }

    public function create_carga($id,$vivienda)
    {
        $id = base64_decode($id);
        $vivienda = base64_decode($vivienda);

        $datos = [];
        $datos['vivienda'] = $vivienda;
        $datos['id_padre'] = $id;
        $datos['edit'] = false;
        $datos['ruta'] = base_url().'index.php/censo/store_carga';
        $datos['parentescos'] = $this->censomodel->buscar_parentesco();

        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('censo/form_carga',$datos);
        $this->load->view('dashboard/footer');
        $this->load->view('censo/scripts');
    }

    public function store_carga()
    {
        unset($_POST['pensionado_check']);
        unset($_POST['id_registro']);
        

        $_POST['fecha_nac'] = date('Y-m-d',strtotime($_POST['fecha_nac']));

        $this->censomodel->store_censo($this->input->post());

        $this->session->set_flashdata('type', 'success');
        $this->session->set_flashdata('message', 'Carga Familiar registrada con Éxito');

        redirect('censo/carga_familiar/'.base64_encode($this->input->post('id_padre')).'/'.base64_encode($this->input->post('id_vivienda')) ,'refresh');
    }
    
    public function edit_carga($id)
    {
        $id = base64_decode($id);

        $datos = [];

        $datos['carga'] = $this->censomodel->edit_censo($id);
        $datos['vivienda'] = $datos['carga']->id_vivienda;
        $datos['id_padre'] = $datos['carga']->id_padre;
        $datos['edit'] = true;
        $datos['ruta'] = base_url().'index.php/censo/update_carga';
        $datos['parentescos'] = $this->censomodel->buscar_parentesco();

        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('censo/form_carga',$datos);
        $this->load->view('dashboard/footer');
        $this->load->view('censo/scripts');
    }
    
    public function update_carga()
    {
        unset($_POST['pensionado_check']);

        $_POST['fecha_nac'] = date('Y-m-d',strtotime($_POST['fecha_nac']));

        $this->censomodel->update_censo($this->input->post());

        $this->session->set_flashdata('type', 'success');
        $this->session->set_flashdata('message', 'Carga Familiar Modificada con Éxito');

        redirect('censo/carga_familiar/'.base64_encode($this->input->post('id_padre')).'/'.base64_encode($this->input->post('id_vivienda')) ,'refresh');
    }

    public function carga_delete($id,$jefe,$vivienda)
    {
        $id = base64_decode($id);

        $this->censomodel->destroy_censo($id);

        $this->session->set_flashdata('type', 'success');
        $this->session->set_flashdata('message', 'Carga Familiar eliminada con éxito');

        redirect('censo/carga_familiar/'.$jefe.'/'.$vivienda,'refresh');
    }

// ================================ | CONSULTAR CENSO | ============================================= //

    public function buscar_persona()
    {
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('censo/buscar_persona');
        $this->load->view('dashboard/footer');
        $this->load->view('censo/scripts_search');
    }

    public function buscar_familia()
    {
        $ced = $this->input->get('cedula');
        $type = $this->input->get('tipo');

        $result = $this->censomodel->buscar_familia($ced,$type);

        echo json_encode($result);
    }

    public function censados_modal_centro_medico()
    {
        $centro = $this->input->get('centro');

        echo json_encode($this->censomodel->censados_modal($centro));

        
    }

// ================================ | ESTRUCTURA CENTRO MEDICO | ============================================= //

    public function store_estructura()
    {
        if($this->censomodel->store_estructura($this->input->post()))
        {
            echo json_encode(['r' => true]);
        }
        else
        {
            echo json_encode(['r' => false]);
        }
    }

    public function edit_estructura()
    {
        $this->censomodel->edit_estructura($this->input->post());

        redirect('dashboard/centro_medico/'.base64_encode($this->input->post('id_centro')),'refresh');
    }

    public function estructura_delete($id,$centro)
    {
        $this->censomodel->delete_estructura($id);

        redirect('dashboard/centro_medico/'.base64_encode($centro),'refresh');
    }


}