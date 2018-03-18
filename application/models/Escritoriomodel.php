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
        //$db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

        $db_admin = $this->load->database('admin21', TRUE);
        $sql = '';

        switch ($permiso) {
          case '4':
          
            $sql = "SELECT m.municipio, m.id_municipio from municipios as m where id_estado = 17";
          break;
          
        }

        return $db_admin->query($sql)->result();

        $db_admin->close();

    }
}

?>    