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
      $sql = "
      WITH RECURSIVE modulos(id,nombre,id_padre,id_tipo,link,icono,ruta,con) AS 
      (
        SELECT id, nombre, id_padre, id_tipo, link, icono, ruta, id as con from menu  where id_padre = 0
      ), 
        areas(id,nombre,id_padre,id_tipo,link,icono,ruta,con) AS( 

        SELECT menu.id, menu.nombre, menu.id_padre, menu.id_tipo, menu.link, menu.icono, menu.ruta, modulos.con
        from menu 
        JOIN modulos ON menu.id_padre = modulos.id
      ) 
      ,
      sub_area(id,nombre,id_padre,id_tipo,link,icono,ruta, con) AS (
          
          SELECT menu.id, menu.nombre, menu.id_padre, menu.id_tipo, menu.link, menu.icono, menu.ruta, areas.con
          FROM menu 
          JOIN areas ON menu.id_padre = areas.id
      )

      SELECT * from (SELECT * from modulos UNION SELECT * from areas UNION SELECT * from sub_area)
                    as result ORDER BY con asc, id_tipo asc";

      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);
      return $db_admin->query($sql)->result();


      $db_admin->close();
    }

    public function show_menu_area($area)
    {
      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE); 

       $db_admin->select('*');
       $db_admin->where('id',$area);
       return $db_admin->get('menu')->row();
        
        $db_admin->close();
    }  

    public function show_menu_sub_area($area, $sub_area)
    {
      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

       $db_admin->select('*');
       $db_admin->where('id',$sub_area);
       $db_admin->where('id_padre',$area);
       return $db_admin->get('menu')->row();

       $db_admin->close();
    }  

    public function show_menu_perfil()
    {
       $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE); 
       
      $sql = "
       WITH RECURSIVE modulos(id,nombre,id_padre,id_tipo,link,icono,ruta,con) AS 
      (
        SELECT id, nombre, id_padre, id_tipo, link, icono, ruta, id as con from menu  where id_padre = 0
      ), 
        areas(id,nombre,id_padre,id_tipo,link,icono,ruta,con) AS( 

        SELECT menu.id, menu.nombre, menu.id_padre, menu.id_tipo, menu.link, menu.icono, menu.ruta, modulos.con
        from menu 
        JOIN modulos ON menu.id_padre = modulos.id
      ) 
      ,
      sub_area(id,nombre,id_padre,id_tipo,link,icono,ruta, con) AS (
          
          SELECT menu.id, menu.nombre, menu.id_padre, menu.id_tipo, menu.link, menu.icono, menu.ruta, areas.con
          FROM menu 
          JOIN areas ON menu.id_padre = areas.id
      ) 
      SELECT result.*, a.id_area, a.id_sub_area from 
      (SELECT * from modulos UNION SELECT * FROM areas UNION SELECT * from sub_area) as result 
      inner join acceso as a on result.id = a.id_modulo 
      
      where a.id_perfil =". $this->session->userdata('id_permiso')." and a.visible = true
      ORDER BY result.con asc, result.id_tipo asc ";

      return $db_admin->query($sql)->result();

      $db_admin->close();
    }


     public function crear_modulo($datos)
    {
      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

      if($datos['id_tipo'] === '2')
      {    
        $db_admin->where('id_padre',$datos['id_padre']);
        $db_admin->select_max('session');
        $result = $db_admin->get('menu');

        $result = $result->row(); 
        $datos['session'] = $result->session ? $result->session + 1 : 1;
      }
    
      

      if($db_admin->insert('menu',$datos))
      {
        
        return true;
      }
      else
      {

        return false;
      }

      $db_admin->close();
    }

    public function findRegisterById($id)
    {
      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);
      $db_admin->select('*');
      $db_admin->where('id',$id);
      
       return $db_admin->get('menu')->row();
       $db_admin->close();
    }
  
    public function actualizar_registro($id,$datos)
    {
      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

      $db_admin->where('id',$id);
      if($db_admin->update('menu',$datos))
      {
        return true;
      }
      else
      {
        return false;
      }

      $db_admin->close();
    }

    public function destroy($id)
    {
      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

      $db_admin->where('id_padre',$id);
      $db_admin->select('*');
      $result = $db_admin->get('menu');

      if($result->num_rows() > 0)
      {
        return false;
      }
      else
      {
        $db_admin->where('id',$id);
        $db_admin->delete('menu');

        $db_admin->where('id_modulo',$id);
        $db_admin->delete('acceso_accion');

        $sql = "UPDATE acceso SET id_sub_area = array_remove(id_sub_area, $id), id_area = array_remove(id_area, $id)";
        $db_admin->query($sql);

        $db_admin->where('id_modulo',$id);
        $db_admin->delete('acceso');

        $db_admin->close();

      }
    }
}
?>