<?php

/**
 * Controlador del inicio 
 * @author sistemaweb21. 
 * Fecha Creación 10/05/2016
 * Fecha de Actualización 10/05/2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Geo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('geomodel'));
    }// fin construct

    public function estado() {
        $estados = $this->geomodel->show_estado(); 
     
        $datos = ['estados' => $estados];

    	$this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('geo/estado',$datos);
        $this->load->view('dashboard/footer');
        $this->load->view('permission/scripts');
    }

     public function municipio() {
        
        $municipios = $this->geomodel->show_municipio(); 
     
        $datos = ['municipio' => $municipios];

        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('geo/municipio',$datos);
        $this->load->view('dashboard/footer');
        $this->load->view('permission/scripts');
    }

     public function parroquia($municipio = null) {

        $parroquia = $this->geomodel->show_parroquia($municipio); 
        
        $datos = ['parroquia' => $parroquia];

        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('geo/parroquia',$datos);
        $this->load->view('dashboard/footer');
        $this->load->view('permission/scripts');
    }

}