<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accesomodel extends CI_Model {

   public function __construct()
    {
      //parent::__construct();
      //Codeigniter : Write Less Do More
      //Revisar 
    }

    public function traer_accesos($type,$id)
    {
    	$key = $type === 'usuario' ? 'acceso_accion.id_usuario' : 'acceso_accion.id_perfil';
    	$valor = $id;

      $this->db->where($key,$valor);
      $this->db->select('acceso_accion.*,menu.nombre');
      $this->db->from('acceso_accion');
      $this->db->join('menu','menu.id = acceso_accion.id_modulo');
      return $this->db->get()->result();

    }

    public function modificar_permiso($data)
    {
    	$key = $data['type'] === 'perfiles' ? 'id_perfil' : 'id_usuario';
    	$valor = $data['id'];

    	$array_where  = ['id_modulo' => $data['datos'][0], $key => $valor];
    	$array_update = [$data['datos'][1] => $data['datos'][2]];

    	$this->db->where($array_where);
    	$this->db->update('acceso_accion',$array_update);
    }
}