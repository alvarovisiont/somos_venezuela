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
        SELECT id, nombre, id_padre, id_tipo, link, icono, ruta, id + 1 as con from menu  where id_padre = 0
        UNION ALL 
        SELECT menu.id, menu.nombre, menu.id_padre, menu.id_tipo, menu.link, menu.icono,menu.ruta, tree_table.con from menu JOIN tree_table ON menu.id_padre = tree_table.id where menu.id_tipo = 2 
      ), 
        tree_table_nietos(id,nombre,id_padre,id_tipo,link,icono,ruta,con) AS(
        SELECT menu.id, menu.nombre, menu.id_padre, menu.id_tipo, menu.link, menu.icono, menu.ruta, tree_table.id + 1 as con from menu JOIN tree_table ON tree_table.id = menu.id_padre where menu.id_tipo = 2
        UNION ALL 
        SELECT menu.id, menu.nombre, menu.id_padre, menu.id_tipo, menu.link, menu.icono, menu.ruta, tree_table_nietos.con from menu JOIN tree_table_nietos ON tree_table_nietos.id = menu.id_padre
        where menu.id_tipo = 3
      ) 
      SELECT * from (SELECT * from tree_table UNION SELECT * FROM tree_table_nietos) as result ORDER BY result.con asc, result.id_tipo asc";

    	$result = $this->db->query($sql);

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