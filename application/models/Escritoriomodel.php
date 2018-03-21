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

    public function dashboard_data()
    {
        
          
      $sql = "SELECT m.nombre, m.id_municipio, 
              (SELECT count(*) from usuario where usuario.id_permiso = 7 and usuario.id_municipio = m.id_municipio)
              as centro_medico,
              (SELECT count(*) from censo 
              INNER JOIN usuario as u ON u.id = censo.id_registrador
              where u.id_municipio = m.id_municipio)
              as censados
              from municipio as m";
          
        return $this->db->query($sql)->result();

        $this->db->close();

    }

    public function totales_estado()
    {
      $sql = "SELECT COUNT(*) as censados, 
              (SELECT COUNT(*) from usuario where id_permiso = 7) 
              as centros_medicos
              from censo";
      return $this->db->query($sql)->row();
      $this->db->close();
    }

    public function datos_municipio($municipio)
    {
      $sql = "SELECT p.nombre, p.id_parroquia, 
               (SELECT count(*) from usuario as u where u.id_permiso = 7 and (u.id_municipio = p.id_municipio and u.id_parroquia = p.id_parroquia ) )
                as centro_medico,
                (SELECT count(*) from censo 
                INNER JOIN usuario as u ON u.id = censo.id_registrador
                where u.id_municipio = p.id_municipio and u.id_parroquia = p.id_parroquia)
                as censados
             from parroquia as p where p.id_estado = 17 and p.id_municipio = $municipio";

      return $this->db->query($sql)->result();

      $this->db->close();
    }

    public function totales_municipio($municipio)
    {
      $sql = "SELECT COUNT(*) as censados, 
              (SELECT COUNT(*) from usuario as u1 where u1.id_permiso = 7 and u1.id_municipio = $municipio) 
              as centros_medicos
              from censo
              INNER JOIN usuario as u ON u.id = censo.id_registrador
              WHERE u.id_municipio = $municipio";

      return $this->db->query($sql)->row();
      $this->db->close();
    }

    public function datos_parroquia($municipio,$parroquia)
    {
      $sql = "SELECT ui.nombre, u.id, u.id_municipio, u.id_parroquia,
              
              (SELECT count(*) from censo 
              where censo.id_registrador = u.id)
              as censados
              from usuario u
              INNER JOIN usuario_info as ui ON ui.id_usuario = u.id
              WHERE u.id_municipio = $municipio and u.id_parroquia = $parroquia and u.id_permiso = 7";

      return $this->db->query($sql)->result();
      $this->db->close();
    }

    public function totales_parroquia($municipio,$parroquia)
    {
      $sql = "SELECT COUNT(*) as censados
              from censo
              INNER JOIN usuario as u ON u.id = censo.id_registrador
              WHERE u.id_municipio = $municipio and u.id_parroquia = $parroquia";

      return $this->db->query($sql)->row();
      $this->db->close();
    }
}

?>    