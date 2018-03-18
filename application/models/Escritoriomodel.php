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

<<<<<<< HEAD
    public function dashboard_data()
=======
    public function dashboard_data($permiso)
>>>>>>> f16efbaae9d5879f22d144213589a6351edc4e38
    {
        //$db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

        $db_admin = $this->load->database('admin21', TRUE);
<<<<<<< HEAD

        $sql = "SELECT m.municipio, m.id_municipio from municipios as m where id_estado = 17";
=======
        $sql = '';

        switch ($permiso) {
          case '4':
          
            $sql = "SELECT m.municipio, m.id_municipio from municipios as m where id_estado = 17";
          break;
          
        }
>>>>>>> f16efbaae9d5879f22d144213589a6351edc4e38

        return $db_admin->query($sql)->result();

        $db_admin->close();

    }
}

?>    