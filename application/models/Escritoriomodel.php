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
              (
                SELECT count(*) from usuario where usuario.id_permiso = 7 and usuario.id_municipio = m.id_municipio
              )
              as centro_medico,
              (
                SELECT count(ui.*) as total from  usuario as u
                INNER JOIN usuario_info as ui ON u.id = ui.id_centro
                WHERE (u.id_municipio = m.id_municipio and u.id_permiso = 7)
                and (ui.id_usuario IN (SELECT id from usuario where id_permiso = 8))
              )
              as medicos,

              (
                 SELECT count(ui.*) as total from  usuario as u
                INNER JOIN usuario_info as ui ON u.id = ui.id_centro
                WHERE (u.id_municipio = m.id_municipio and u.id_permiso = 7)
                and (ui.id_usuario IN (SELECT id from usuario where id_permiso = 9))
              )
              as registradores,

              (
                SELECT count(*) from censo 
                INNER JOIN usuario as u ON u.id = censo.id_registrador
                where u.id_municipio = m.id_municipio
              )
              as censados

              from municipio as m where id_estado = 17";
        
        return $this->db->query($sql)->result();

        $this->db->close();

    }

    public function totales_estado()
    {
      $sql = "SELECT COUNT(*) as censados, 
              (SELECT COUNT(*) from usuario where id_permiso = 7) 
              as centros_medicos,
              (SELECT COUNT(*) from usuario where id_permiso = 8) 
              as medicos,
              (SELECT COUNT(*) from usuario where id_permiso = 9) 
              as registradores
              from censo";
      return $this->db->query($sql)->row();
      $this->db->close();
    }

    public function datos_municipio($municipio)
    {
      $sql = "SELECT p.nombre, p.id_parroquia, 
               (
                SELECT count(*) from usuario as u 
                where u.id_permiso = 7 and (u.id_municipio = p.id_municipio and u.id_parroquia = p.id_parroquia ) 
               )
                as centro_medico,
              (
                SELECT count(ui.*) as total from  usuario as u
                INNER JOIN usuario_info as ui ON u.id = ui.id_centro
                WHERE (u.id_municipio = $municipio and u.id_parroquia = p.id_parroquia) and ( u.id_permiso = 7)
                and (ui.id_usuario IN (SELECT id from usuario where id_permiso = 8))
              )
              as medicos,

              (
                 SELECT count(ui.*) as total from  usuario as u
                INNER JOIN usuario_info as ui ON u.id = ui.id_centro
                WHERE (u.id_municipio = $municipio and u.id_parroquia = p.id_parroquia) and ( u.id_permiso = 7)
                and (ui.id_usuario IN (SELECT id from usuario where id_permiso = 9))
              )
              as registradores,
              (
                SELECT count(*) from censo 
                INNER JOIN usuario as u ON u.id = censo.id_registrador
                where u.id_municipio = p.id_municipio and u.id_parroquia = p.id_parroquia
              )
                as censados
             from parroquia as p where p.id_estado = 17 and p.id_municipio = $municipio";

      return $this->db->query($sql)->result();

      $this->db->close();
    }

    public function totales_municipio($municipio)
    {
      $sql = "SELECT COUNT(*) as censados, 
              
              (
                SELECT COUNT(*) from usuario as u1 where u1.id_permiso = 7 and u1.id_municipio = $municipio
              ) 
              as centros_medicos,

              (
                SELECT count(ui.*) as total from  usuario as u
                INNER JOIN usuario_info as ui ON u.id = ui.id_centro
                WHERE (u.id_municipio = $municipio and u.id_permiso = 7)
                and (ui.id_usuario IN (SELECT id from usuario where id_permiso = 8))
              )
              as medicos,

              (
                 SELECT count(ui.*) as total from  usuario as u
                INNER JOIN usuario_info as ui ON u.id = ui.id_centro
                WHERE (u.id_municipio = $municipio and u.id_permiso = 7)
                and (ui.id_usuario IN (SELECT id from usuario where id_permiso = 9))
              )
              as registradores

              from censo
              INNER JOIN usuario as u ON u.id = censo.id_registrador
              WHERE u.id_municipio = $municipio";

      return $this->db->query($sql)->row();
      $this->db->close();
    }

    public function datos_parroquia($municipio,$parroquia)
    {
      $sql = "SELECT ui.nombre, u.id, u.id_municipio, u.id_parroquia,
              
              (
                SELECT count(*) from censo 
                where censo.id_registrador = u.id
              )
              as censados,
              (
                SELECT count(ui.*) as total from  usuario_info as ui
                WHERE (u.id = ui.id_centro)
                and (ui.id_usuario IN (SELECT id from usuario where id_permiso = 8))
              )
              as medicos,

              (
                 SELECT count(ui.*) as total from  usuario_info as ui
                WHERE (u.id = ui.id_centro)
                and (ui.id_usuario IN (SELECT id from usuario where id_permiso = 9))
              )
              as registradores

              from usuario u
              INNER JOIN usuario_info as ui ON ui.id_usuario = u.id
              WHERE u.id_municipio = $municipio and u.id_parroquia = $parroquia and u.id_permiso = 7";

      return $this->db->query($sql)->result();
      $this->db->close();
    }

    public function totales_parroquia($municipio,$parroquia)
    {
      $sql = "SELECT COUNT(*) as censados,
              (
                SELECT count(ui.*) as total from  usuario as u
                INNER JOIN usuario_info as ui ON u.id = ui.id_centro
                WHERE (u.id_municipio = $municipio and u.id_parroquia = $parroquia) and (u.id_permiso = 7)
                and (ui.id_usuario IN (SELECT id from usuario where id_permiso = 8))
              )
              as medicos,

              (
                 SELECT count(ui.*) as total from  usuario as u
                INNER JOIN usuario_info as ui ON u.id = ui.id_centro
                WHERE (u.id_municipio = $municipio and u.id_parroquia = $parroquia) and (u.id_permiso = 7)
                and (ui.id_usuario IN (SELECT id from usuario where id_permiso = 9))
              )
              as registradores

              from censo
              INNER JOIN usuario as u ON u.id = censo.id_registrador
              WHERE u.id_municipio = $municipio and u.id_parroquia = $parroquia";

      return $this->db->query($sql)->row();
      $this->db->close();
    }

    public function centros_medicos($id)
    {
      $sql = "SELECT ui.nombre, u.id,

              (SELECT id_parroquia from usuario where id = $id)
              as parro,

              (SELECT id_municipio from usuario where id = $id)
              as muni,

              CASE 
                WHEN u.id_permiso = 8 THEN 'Medico'
                WHEN u.id_permiso = 9 THEN 'Registrador'
              END as tipo,

              CASE 
                WHEN u.id_permiso = 8 THEN 
                  (SELECT count(*) from censo where id_registrador = u.id)
                WHEN u.id_permiso = 9 THEN
                  (SELECT count(*) from censo where id_registrador = u.id)
              END as contados


              from usuario_info as ui 
              INNER JOIN usuario as u ON u.id = ui.id_usuario
              where ui.id_centro = $id";
      return $this->db->query($sql)->result();
      $this->db->close();

    }

    public function totales_centro_medico($id)
    {
      $sql = "SELECT COUNT(*) as censados
              from censo
              INNER JOIN usuario_info as ui ON ui.id_usuario = censo.id_registrador
              INNER JOIN usuario as u ON ui.id_centro = u.id
              WHERE u.id = $id";
      return $this->db->query($sql)->row();
      $this->db->close();
    }

    public function centro_medico_estructura($id)
    {
      $this->db->where('id_centro',$id);
      return $this->db->get('estructura')->result();
      $this->db->close();
    }
}

?>    