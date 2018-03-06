<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Configmodel extends CI_Model {

   public function __construct()
    {
      //parent::__construct();
      //Codeigniter : Write Less Do More
      //Revisar 
    }

     public function get_by_tipo($id) {
       $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('config');
       
        return $query->row();
    }


     public function update_loqueo($id, $datos)
    {
        //Función para modificar los cargos
        $this->db->where('id', $id);
        $this->db->update('config', $datos);
    }

}

?>    