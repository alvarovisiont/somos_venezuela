<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuariomodel extends CI_Model {

    public function __construct() {
        //parent::__construct();
    }

    public function login_usuario($username, $password) {
        $this->db->where('email', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('usuario');     
        
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {

            $this->session->set_flashdata('usuario_mensj', 'Los datos introducidos son incorrectos');
            redirect(base_url() . 'index.php/login', 'refresh');
        }
    }

    public function count_users()
    {
        return $this->db->count_all('usuario');
    }


    public function show_usuario()
    {
       $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

       $db_admin->select('u.*, p.nombre as permiso');
       $db_admin->from('usuario as u');
       $db_admin->join('perfil as p', 'u.id_permiso = p.id');

      return $db_admin->get()->result();

      $db_admin->close();
    } 

     public function actualizar_registro($id,$datos)
    {
      $this->db->where('id',$id);
      if($this->db->update('usuario',$datos))
      {
        return true;
      }
      else
      {
        return false;
      }
    } 


     public function crear_usuario($datos, $datospersonal)
    {
     $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

    if($db_admin->insert('usuario',$datos))
      {
        $db_admin->where('email', $datos['email']);
        $query = $db_admin->get('usuario');

        $queryresult = $query->row();
        $datospersonal['id_usuario'] = $queryresult->id;

       if($db_admin->insert('usuario_info',$datospersonal))
      {  return true;
      }else
      {  return false; } 
      
      }else
      {
        return false;
      }
      $db_admin->close();
    }

}
