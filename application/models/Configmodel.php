<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Configmodel extends CI_Model {

   public function __construct()
    {
      //parent::__construct();
      //Codeigniter : Write Less Do More
      //Revisar 
    }

/*----------------------------------------------------------------------------------------------------*/   

     public function get_by_tipo($id) {
       $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('config');
       
        return $query->row();
    }
/*----------------------------------------------------------------------------------------------------*/   

     public function update_loqueo($id, $datos)
    {
        //Función para modificar los cargos
        $this->db->where('id', $id);
        $this->db->update('config', $datos);
    }

/*----------------------------------------------------------------------------------------------------*/   

    public function session_usuario(){
        $this->db->where('id_usuario', $this->session->userdata('id_usuario'));    
        $query = $this->db->get('usuario_info');     
        
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            //$this->session->set_flashdata('usuario_mensj', 'Los datos introducidos son incorrectos');
            redirect(base_url() . 'index.php/error', 'refresh');
        }
    }//fin de la session_usuario
 /*----------------------------------------------------------------------------------------------------*/   
}

?>    