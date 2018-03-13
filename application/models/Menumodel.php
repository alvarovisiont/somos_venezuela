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
      WITH RECURSIVE tree_table(id,nombre,id_padre,id_tipo,link,icono,ruta,con) AS 
      (
        SELECT id, nombre, id_padre, id_tipo, link, icono, ruta, id as con from menu  where id_padre = 0
      ), 
        tree_table_nietos(id,nombre,id_padre,id_tipo,link,icono,ruta,con) AS(
        SELECT menu.id, menu.nombre, menu.id_padre, menu.id_tipo, menu.link, menu.icono, menu.ruta, (tree_table.con + menu.session) as con from menu JOIN tree_table ON tree_table.id = menu.id_padre
        UNION ALL 
        SELECT menu.id, menu.nombre, menu.id_padre, menu.id_tipo, menu.link, menu.icono, menu.ruta, 
        tree_table_nietos.con as con from menu 
        JOIN tree_table_nietos ON tree_table_nietos.id = menu.id_padre
        JOIN tree_table ON tree_table.id = tree_table_nietos.id_padre
      ) 
      SELECT * from (SELECT * from tree_table UNION SELECT * FROM tree_table_nietos) as result ORDER BY result.con asc, result.id_tipo asc ";

            $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);
            $result = $db_admin->query($sql);
        

      return $result->result();
    }

    public function show_menu_area($area)
    {
       $this->db->select('*');
       $this->db->where('id',$area);
       $result =  $this->db->get('menu');
        return $result->row();
    }  

    public function show_menu_sub_area($area, $sub_area)
    {
       $this->db->select('*');
       $this->db->where('id',$sub_area);
       $this->db->where('id_padre',$area);
       $result =  $this->db->get('menu');

       return $result->row();
    }  

    public function show_menu_perfil()
    {
      $sql = "
       WITH RECURSIVE tree_table(id,nombre,id_padre,id_tipo,link,icono,ruta,con) AS 
      (
        SELECT id, nombre, id_padre, id_tipo, link, icono, ruta, id as con from menu  where id_padre = 0
      ), 
        tree_table_nietos(id,nombre,id_padre,id_tipo,link,icono,ruta,con) AS(
        SELECT menu.id, menu.nombre, menu.id_padre, menu.id_tipo, menu.link, menu.icono, menu.ruta, (tree_table.con + menu.session) as con from menu JOIN tree_table ON tree_table.id = menu.id_padre
        UNION ALL 
        SELECT menu.id, menu.nombre, menu.id_padre, menu.id_tipo, menu.link, menu.icono, menu.ruta, 
        tree_table_nietos.con as con from menu 
        JOIN tree_table_nietos ON tree_table_nietos.id = menu.id_padre
        JOIN tree_table ON tree_table.id = tree_table_nietos.id_padre
      ) 
      SELECT result.*, a.id_area, a.id_sub_area from 
      (SELECT * from tree_table UNION SELECT * FROM tree_table_nietos) as result 
      inner join acceso as a on result.id = a.id_modulo 
      
      where a.id_perfil =". $this->session->userdata('id_permiso')." and a.visible = true
      ORDER BY result.con asc, result.id_tipo asc ";

      $result = $this->db->query($sql);

      return $result->result();
    }



     public function crear_modulo($datos)
    {
      
      if($datos['id_tipo'] === '2')
      {
        $this->db->where('id_padre',$datos['id_padre']);
        $this->db->select_max('session');
        $result = $this->db->get('menu');

        $result = $result->row();
        
        $datos['session'] = $result->session ? $result->session + 1 : 1;
      }

      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);
      
      $result = $db_admin->insert('menu',$datos);

      if($result)
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
      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);
      $db_admin->select('*');
      $db_admin->where('id',$id);
      
       return $db_admin->get('menu')->row();
    }
  
    public function actualizar_registro($id,$datos)
    {
      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

      $this->$db_admin->where('id',$id);
      if($this->$db_admin->update('menu',$datos))
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
?>