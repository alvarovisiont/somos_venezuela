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
        $this->load->model(array('geomodel', 'usuariomodel'));
    }// fin construct


     //-------------------------------------------------------------------------


     public function index() {
       
         $permiso = $this->session->userdata('id_permiso');

         if ($permiso == 4)
         { $this->municipio(); }

         if ($permiso == 5)
         {
            $usuario = $this->usuariomodel->usuario_user($this->session->userdata('id_usuario')); 
                       $this->parroquia($usuario->id_municipio);
         }

         if ($permiso == 6)
         {
            $usuario = $this->usuariomodel->usuario_user($this->session->userdata('id_usuario')); 
                       $this->centro_medico($usuario->id_municipio, $usuario->id_parroquia);
         }

         if ($permiso == 7)
         {
             $this->centro_personal($this->session->userdata('id_usuario'));
         }

    }

     //-------------------------------------------------------------------------


    public function estado() {
        $estados = $this->geomodel->show_estado(); 
     
        $datos = ['estados' => $estados];

    	$this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('geo/estado',$datos);
        $this->load->view('dashboard/footer');
        $this->load->view('permission/scripts');
    }

     //-------------------------------------------------------------------------


     public function municipio() {
        
        $municipios = $this->geomodel->show_municipio(); 
     
        $datos = ['municipio' => $municipios];

        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('geo/municipio',$datos);
        $this->load->view('dashboard/footer');
        $this->load->view('permission/scripts');
    }

     //-------------------------------------------------------------------------


     public function parroquia($municipio = null) {

        $parroquia = $this->geomodel->show_parroquia($municipio);
        $nombre_municipio = "Todos";
        $id_municipio = null;
        
        if ($municipio <> null)
        {
        $nombre_m = $this->geomodel->show_municipio_id($municipio); 
        $nombre_municipio = $nombre_m->nombre;
        $id_municipio = $municipio;
        }


        $datos = ['parroquia' => $parroquia, 'nombre_municipio' => $nombre_municipio,  'id_municipio' => $id_municipio];

        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('geo/parroquia',$datos);
        $this->load->view('dashboard/footer');
        $this->load->view('permission/scripts');
    }

     //-------------------------------------------------------------------------


     public function centro_medico($municipio = null, $parroquia = null) {

        if ($parroquia == null){

             $nombre_parroquia = "Todas";
        }else
        {    $nombre_p = $this->geomodel->show_parroquia_id($parroquia); 
            $nombre_parroquia = $nombre_p->nombre;
        }

        $centro = $this->geomodel->show_centro($municipio, $parroquia); 
     
        $datos = ['centro' => $centro, 'nombre_parroquia' => $nombre_parroquia];

        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('geo/centro',$datos);
        $this->load->view('dashboard/footer');
        $this->load->view('permission/scripts');
    }

    //-------------------------------------------------------------------------

    public function centro_personal($id_centro = null) {

        if ($id_centro == null){

             $nombre_centro = "Todas";
        }else
        {   
            //consulta
            $nombre_centro = "fulano"; 
        }

        $trabajadores = $this->geomodel->show_centro_personal($id_centro); 

     
        $datos = ['trabajadores' => $trabajadores, 'nombre_centro' => $nombre_centro];

        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('geo/personal',$datos);
        $this->load->view('dashboard/footer');
        $this->load->view('permission/scripts');
    }



}