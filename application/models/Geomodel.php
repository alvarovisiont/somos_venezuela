<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Geomodel extends CI_Model {

	public function __construct()
    {
      //parent::__construct();
      //Codeigniter : Write Less Do More
      //Revisar  
    }

    public function show_estado()
    {
      $db_admin = $this->load->database('default', TRUE);
    	$db_admin->select('*');
      $db_admin->where('activo', true);
    	return $db_admin->get('estado')->result();
      $db_admin->close();
    }

     public function show_municipio()
    {
 
      $db_admin = $this->load->database('default', TRUE);
      $db_admin->select('m.*, u.login as cuenta, u.password_activo as password_activo');
      
      $db_admin->from('municipio as m');
      $db_admin->join('usuario as u','u.id_municipio = m.id_municipio','left');

      $db_admin->where('id_permiso', 5); 

      return $db_admin->get()->result();
      $db_admin->close();
    }


    public function show_parroquia($municipio = null)
    {
      $estado = 17;

      $db_admin = $this->load->database('default', TRUE);

      $db_admin->select('p.*, u.login as cuenta, u.password_activo as password_activo, mu.nombre municipio');

       $db_admin->from('parroquia as p');

      $db_admin->join('usuario as u','u.id_parroquia = p.id_parroquia and p.id_municipio = u.id_municipio');

      $db_admin->join('municipio as mu','mu.id_municipio = p.id_municipio');

      $db_admin->where('p.id_estado', $estado);

      if ($municipio <> null) {
          $db_admin->where('p.id_municipio', $municipio); }
      
       $db_admin->where('u.id_permiso', 6);     
      $db_admin->where('p.activo', true);
      
      return $db_admin->get()->result();
      $db_admin->close();

    }

    public function show_municipio_id($id)
    {
 
      $db_admin = $this->load->database('default', TRUE);
      
      $db_admin->select('m.*');
      $db_admin->from('municipio as m');
      $db_admin->where('id_municipio', $id); 

      return $db_admin->get()->row();
      
      $db_admin->close();
    }

     public function show_parroquia_id($id)
    {
 
      $db_admin = $this->load->database('default', TRUE);
      
      $db_admin->select('p.*');
      $db_admin->from('parroquia as p');
      $db_admin->where('p.id_parroquia', $id); 

      return $db_admin->get()->row();
      
      $db_admin->close();
    }




     public function usuario_user_municipio($id)
    {
      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

      $db_admin->select('u.*');
      $db_admin->from('usuario as u');
      $db_admin->where('u.id_municipio',$id);

      return $db_admin->get()->row();

      $db_admin->close();
      
    } 



     public function show_centro($municipio = null, $parroquia = null)
    {
      $estado = 17;

      $db_admin = $this->load->database('default', TRUE);

      $db_admin->select('u.*, u.login as cuenta, u.password_activo as password_activo, mu.nombre municipio,
        pa.nombre parroquia, uf.nombre nombre_c');

       $db_admin->from('usuario as u');


      $db_admin->join('usuario_info as uf','uf.id_usuario = u.id');

      $db_admin->join('municipio as mu','mu.id_municipio = u.id_municipio');
      $db_admin->join('parroquia as pa','pa.id_parroquia = u.id_parroquia and pa.id_municipio = u.id_municipio');

     

      if ($municipio <> null) {
          $db_admin->where('u.id_municipio', $municipio); }

      if ($parroquia <> null) {
          $db_admin->where('u.id_parroquia', $parroquia); } 

      $db_admin->where('u.id_estado', $estado);

      $db_admin->where('u.id_permiso', 7);             
           
      return $db_admin->get()->result();
      $db_admin->close();

    }


     public function show_parroquia_mun($id)
    {
 
      $db_admin = $this->load->database('default', TRUE);
      
      $db_admin->select('m.*');
      $db_admin->from('parroquia as m');
      $db_admin->where('m.id_municipio', $id); 

      return $db_admin->get()->result();
      
      $db_admin->close();
    }


    //****************************************************************


    public function show_centro_personal($id_centro)
    {

      $db_admin = $this->load->database('default', TRUE);

      $db_admin->select('u.*, u.login as cuenta, 
        u.password_activo as password_activo, uf.cedula cedula, uf.nombre nombre_p,
        uf.apellido apellido_p, p.nombre as tipo');

       $db_admin->from('usuario as u');

      $db_admin->join('usuario_info as uf','uf.id_usuario = u.id');
      $db_admin->join('perfil as p','p.id = u.id_permiso');

      $db_admin->where('uf.id_centro', $id_centro);             
           
      return $db_admin->get()->result();
      $db_admin->close();

    }

  
}