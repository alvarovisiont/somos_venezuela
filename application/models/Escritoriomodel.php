<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Escritoriomodel extends CI_Model {

   public function __construct()
    {
      //parent::__construct();
      //Codeigniter : Write Less Do More
      //Revisar 
    }

    public function dashboard_data($permiso)
    {
        
        $sql = '';

        switch ($permiso) {
          case '2':
            $sql = "SELECT m.nombre, m.id_municipio from municipio as m where m.id_estado = 17";
          break;
          
        }

        return $this->db->query($sql)->result();

        $this->db->close();

    }

    public function datos_municipio($municipio)
    {
      $sql = "SELECT p.id, p.nombre, p.id_parroquia from parroquia as p where p.id_estado = 17 and p.id_municipio = $municipio";

      return $this->db->query($sql)->result();

      $this->db->close();
    }

    public function datos_parroquia($municipio,$parroquia)
    {
      
    }
}

?>    