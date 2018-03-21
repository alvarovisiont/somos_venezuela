<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Verificarmodel extends CI_Model {

	public function verificados_total()
	{
		$centro_medico = $this->session->userdata('centro_medico');
		 
		$sql = "SELECT count(censo.*) as total from censo as  c
				INNER JOIN usuario as u ON u.id = c.id_registrador
				INNER JOIN usuario_info as ui ON ui.id_usuario = u.id
				where ui.id_centro_medico = $centro_medico and c.verificacion = true";

		return $this->db->query($sql)->row();
		$this->db->close();
	}	

	public function no_verificados()
	{
		$centro_medico = $this->session->userdata('centro_medico');
		 
		$sql = "SELECT count(censo.*) as total from censo as  c
				INNER JOIN usuario as u ON u.id = c.id_registrador
				INNER JOIN usuario_info as ui ON ui.id_usuario = u.id
				where ui.id_centro_medico = $centro_medico and censo.verificacion = false and c.condicion NOT NULL";

		return $this->db->query($sql)->row();
		$this->db->close();	
	}

}

/* End of file Verificarmodel.php */
/* Location: ./application/models/Verificarmodel.php */