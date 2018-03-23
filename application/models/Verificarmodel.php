<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Verificarmodel extends CI_Model {

	public function no_verificados_total($id = null)
	{
		$centro_medico = $id ? $id : $this->session->userdata('id_centro');
		 
		$sql = "SELECT count(c.*) as total from censo as  c
				INNER JOIN usuario as u ON u.id = c.id_registrador
				INNER JOIN usuario_info as ui ON ui.id_usuario = u.id
				where ui.id_centro = $centro_medico and c.verificado = false and c.condicion <> ''";

		return $this->db->query($sql)->row();
		$this->db->close();
	}	

	public function no_verificados()
	{
    
        $id_centro = $this->session->userdata('id_centro'); 

        $this->db->where("ui.id_centro = $id_centro and c.condicion <> '' and c.verificado = false");
        $this->db->select("c.*, concat(v.direccion,' ',v.piso,'-',v.nro) as vivienda");
        $this->db->join('vivienda as v','v.id = c.id_vivienda');
        $this->db->join('usuario_info as ui','ui.id_usuario = c.id_registrador');
        return $this->db->get('censo as c')->result();
        $this->db->close();
    
	}

	public function verificados($id = null)
	{
    
        $id_centro = $id ? $id : $this->session->userdata('id_centro'); 

        $this->db->where("ui.id_centro = $id_centro and c.condicion <> '' and c.verificado = true");
        $this->db->select("c.*, concat(v.direccion,' ',v.piso,'-',v.nro) as vivienda");
        $this->db->join('vivienda as v','v.id = c.id_vivienda');
        $this->db->join('usuario_info as ui','ui.id_usuario = c.id_registrador');
        return $this->db->get('censo as c')->result();
        $this->db->close();
    
	}

	public function registrar_verificacion($id,$validar,$medico)
	{
	
		$valor = $validar ? $medico : NULL;

		$this->db->where(['id' => $id]);	
		
		if($this->db->update('censo',['id_medico' => $valor, 'verificado' => $validar]))
		{
			$this->db->close();
			return true;
		}
		else
		{
			$this->db->close();
			return false;	
		}
	}

}

/* End of file Verificarmodel.php */
/* Location: ./application/models/Verificarmodel.php */