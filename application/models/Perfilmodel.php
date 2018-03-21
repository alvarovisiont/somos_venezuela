<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Perfilmodel extends CI_Model {

	public function __construct()
    {
      //parent::__construct();
      //Codeigniter : Write Less Do More
      //Revisar  
      $this->load->model(array('menumodel'));
    }

    public function show_perfil()
    {
      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

    	$db_admin->select('*');
      $db_admin->order_by('nombre');
    	return $db_admin->get('perfil')->result();
      $db_admin->close();
    }


      public function show_perfil_id($para1 = null, $para2 = null)
    {
      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

      $db_admin->select('*');

      $db_admin->where('id', $para1);
      if ($para2 <> null){
        $db_admin->where('id', $para2);        
      }

      $db_admin->order_by('nombre');
      return $db_admin->get('perfil')->result();
      $db_admin->close();
    }

    public function count_perfil()
    {
      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);
      return $db_admin->count_all('perfil');
      $db_admin->close();
    }

    public function show_perfil_by_selection($manual)
    {
      /* ============================================================================================
                    BUSCA LOS PERFILES DE ACUERDO A LA SELECCIÓN DEL TIPO DE PERFIL
         ============================================================================================ */
      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

      if($manual)
      {
        $db_admin->where('sistema',true);
      }
      else
      {
        $db_admin->where('sistema',false); 
      }

      return $db_admin->get('perfil')->result();

      $db_admin->close();

    }

    public function show_module_by_perfil($perfil)
    {
      /* ============================================================================================
                    BUSCA LOS MÓDULOS DE ACUERDO A LA SELECCIÓN DEL PERFIL
         ============================================================================================ */

      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

      $db_admin->where('id_perfil',$perfil);

      return  $db_admin->get('acceso')->result();

      $db_admin->close();
    }


    public function crear_perfil($datos)
    {
      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

      if($db_admin->insert('perfil',$datos))
      {
        return true;
      }
      else
      {
        return false;
      }

      $db_admin->close();

    }
}