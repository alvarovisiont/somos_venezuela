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
       
       $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

    	$key = $type === 'usuario' ? 'acceso.id_usuario' : 'acceso.id_perfil';
    	$valor = $id;

      $sql = "SELECT acceso.*,
              
              CASE  
              
              WHEN menu.id_tipo = 3 THEN 
                (SELECT menu1.nombre from menu as menu1 where id = (SELECT menu2.id_padre from menu as menu2 where id = menu.id_padre)
                )
              WHEN menu.id_tipo = 2 THEN
                (SELECT menu1.nombre from menu as menu1 where menu1.id = menu.id_padre)
              ELSE
                menu.nombre
              END AS modulo,

              CASE  
              
              WHEN menu.id_tipo = 3 THEN 
                (SELECT menu1.nombre from menu as menu1 where menu1.id = menu.id_padre)
              WHEN menu.id_tipo = 2 THEN
                menu.nombre
              ELSE
                ''
              END  as area,

              CASE  
              
              WHEN menu.id_tipo = 3 THEN 
                menu.nombre
              WHEN menu.id_tipo = 2 THEN
                ''
              ELSE
                ''
              END  as sub_area

              from acceso_accion as acceso 
              INNER JOIN menu ON menu.id = acceso.id_modulo
              WHERE $key = $valor";
      
      return $db_admin->query($sql)->result();

      $db_admin->close();
    }

    public function modificar_permiso($data)
    {
      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

    	$key = $data['type'] === 'perfiles' ? 'id_perfil' : 'id_usuario';
    	$valor = $data['id'];

    	$array_where  = ['id_modulo' => $data['datos'][0], $key => $valor];
    	$array_update = [$data['datos'][1] => $data['datos'][2]];

    	$db_admin->where($array_where);
    	$db_admin->update('acceso_accion',$array_update);
      $db_admin->close();
    }

    public function all_access($id_modulo)
    {
      
      $tipo = $this->session->userdata('id_permiso') === '1' ? 1 : 2;

      $key = $tipo === 1 ? 'id_usuario' : 'id_perfil';
      $valor = $tipo === 1 ? $this->session->userdata('id_usuario') : $this->session->userdata('id_permiso');

      $this->db->where(['id_modulo' => $id_modulo, $key => $valor]);
      return $this->db->get('acceso_accion')->row();
      $this->db->close();
    }
}