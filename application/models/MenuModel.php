<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menumodel extends CI_Model {

	public function __construct()
    {
      //parent::__construct();
      //Codeigniter : Write Less Do More
      //Revisar 
    }

    public function show_menu()
    {
    	$this->db->select('*');
    	$result = $this->db->get('menu');
      $this->db->order_by('nombre');

    	return $result->result();
    }
}