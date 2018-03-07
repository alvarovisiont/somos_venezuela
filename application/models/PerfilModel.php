<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Perfilmodel extends CI_Model {

	public function __construct()
    {
      //parent::__construct();
      //Codeigniter : Write Less Do More
      //Revisar 
    }

    public function show_perfil()
    {
    	$this->db->select('*');
    	$result = $this->db->get('perfil');
      $this->db->order_by('nombre');

    	return $result->result();
    }
}