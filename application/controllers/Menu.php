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


    public function index() {

    	$menu = $this->menumodel->show_menu();

    	$this->load->view('dashboard/header');
         $this->load->view('dashboard/menu');
    	$this->load->view('menu/index',compact('menu',$menu));
    	$this->load->view('dashboard/footer');

    }
}