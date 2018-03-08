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


}
