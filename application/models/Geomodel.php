<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Geomodel extends CI_Model {

	public function __construct()
    {
      //parent::__construct();
      //Codeigniter : Write Less Do More
      //Revisar  
    }

    public function show_estado()
    {
      $db_admin = $this->load->database('default', TRUE);
    	$db_admin->select('*');
      $db_admin->where('activo', true);
    	return $db_admin->get('estado')->result();
      $db_admin->close();
    }

     public function show_municipio()
    {
      $id_estado = 17;

      $db_admin = $this->load->database('default', TRUE);
      $db_admin->select('*');
      $db_admin->where('id_estado', $id_estado);
      return $db_admin->get('municipio')->result();
      $db_admin->close();
    }


    public function show_parroquia($municipio = null)
    {
      $estado = 17;

      $db_admin = $this->load->database('default', TRUE);

      $db_admin->select('*');
      $db_admin->where('id_estado', $estado);

      if ($municipio <> null) {
          $db_admin->where('id_municipio', $municipio); }
      
      $db_admin->where('activo', true);
      
      return $db_admin->get('parroquia')->result();
      $db_admin->close();

    }

    public function crear_cuenta_estado()
    {
      
      
    }




  
}