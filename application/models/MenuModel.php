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

     public function crear_modulo($datos)
    {
      if($this->db->insert('menu',$datos))
      {
        return true;
      }
      else
      {
        return false;
      }

    }

    public function findRegisterById($id)
    {
      $this->db->select('*');
      $this->db->where('id',$id);
      $result =  $this->db->get('menu');

      return $result->row();

    }

   
    public function actualizar_registro($id,$datos)
    {
      $this->db->where('id',$id);
      if($this->db->update('menu',$datos))
      {
        return true;
      }
      else
      {
        return false;
      }
    }

    public function destroy($id)
    {
      $this->db->where('id_padre',$id);
      $this->db->select('*');
      $result = $this->db->get('menu');

      if($result->num_rows() > 0)
      {
        return false;
      }
      else
      {
        $this->db->where('id',$id);
        $this->db->delete('menu');
        return true;
      }
    }
}