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
      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

      $db_admin->select('*');
      $db_admin->where('id', $id);
      return $db_admin->get('config')->row();
       
      $db_admin->close();
    }
/*----------------------------------------------------------------------------------------------------*/   

     public function update_loqueo($id, $datos)
    {
        //Función para modificar los cargos
        $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);
        $db_admin->where('id', $id);
        $db_admin->update('config', $datos);

        $db_admin->close();
    }

/*----------------------------------------------------------------------------------------------------*/   

    public function session_usuario(){
        
        $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE); 

        $db_admin->where('id_usuario', $this->session->userdata('id_usuario'));    
        $query = $db_admin->get('usuario_info');     
        
        if ($query->num_rows() == 1) {
            $db_admin->close();
            return $query->row();
        } else {
            //$this->session->set_flashdata('usuario_mensj', 'Los datos introducidos son incorrectos');
            $db_admin->close();
            redirect(base_url() . 'index.php/error', 'refresh');
        }
    }//fin de la session_usuario
 /*----------------------------------------------------------------------------------------------------*/   
}

?>    