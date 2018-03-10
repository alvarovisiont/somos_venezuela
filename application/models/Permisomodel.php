<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permisomodel extends CI_Model {

	public function __construct()
    {
      //parent::__construct();
      //Codeigniter : Write Less Do More
      //Revisar  
    	//$this->load->model(array('menumodel'));
    }

    public function show_perfil_by_selection($manual)
    {
      /* ============================================================================================
                    BUSCA LOS PERFILES DE ACUERDO A LA SELECCIÓN DEL TIPO DE PERFIL
         ============================================================================================ */

      if($manual)
      {
        $this->db->where('sistema',true);
      }
      else
      {
        $this->db->where('sistema',false); 
      }

      return $this->db->get('perfil')->result();


    }

    public function show_module_by_perfil($perfil)
    {
      /* ============================================================================================
                    BUSCA LOS MÓDULOS DE ACUERDO A LA SELECCIÓN DEL PERFIL
         ============================================================================================ */

      $this->db->where('id_perfil',$perfil);

      return  $this->db->get('acceso')->result();
    }
}