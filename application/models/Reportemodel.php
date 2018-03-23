<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportemodel extends CI_Model {

	public function buscar_municipios()
	{
		$this->db->where(['id_estado' => 17]);
		$this->db->select('id_municipio as id,nombre');
		return $this->db->get('municipio')->result();
		$this->db->close();
	}

	public function buscar_parroquias($id)
	{
		$this->db->where(['id_municipio' => $id, 'id_estado' => 17]);
		$this->db->select('id,nombre');
		return $this->db->get('parroquia')->result();
		$this->db->close();
	}	

	public function datos_pdf($where)
	{
		
		$muni = $this->session->userdata('municipio');
		$parro = $this->session->userdata('parroquia');
		$id   = $this->session->userdata('id_usuario');

		switch ($this->session->userdata('id_permiso')) {

			case '5':
				if(!empty($where))
				{
					$where.= " AND (ui.id_centro IN (SELECT id from usuario where id_municipio = $muni))";
				}
				else
				{
					$where = "WHERE ui.id_centro IN (SELECT id from usuario where id_municipio = $muni)";
				}
			break;

			case "6":
				if(!empty($where))
				{
					$where.= " AND (ui.id_centro IN (SELECT id from usuario where id_municipio = $muni and id_parroquia = $parro))";
				}
				else
				{
					$where = "WHERE ui.id_centro IN (SELECT id from usuario where id_municipio = $muni and id_parroquia = $parro)";
				}
			break;

			case "7":
				if(!empty($where))
				{
					$where.= " AND (ui.id_centro IN (SELECT id from usuario where id = $id) )";
				}
				else
				{
					$where = "WHERE ui.id_centro IN (SELECT id from usuario where id = $id)";
				}
			break;

			case "8":
				if(!empty($where))
				{
					$where.= " AND c.id_medico = $id";
				}
				else
				{
					$where = "WHERE c.id_medico = $id";
				}
			break;

			case '9':
				if(!empty($where))
				{
					$where.= " AND u.id = $id";
				}
				else
				{
					$where = "WHERE u.id = $id";
				}
			break;
		}

		
		$sql = "SELECT c.* from censo as c 
				INNER JOIN usuario as u ON u.id = c.id_registrador
				INNER JOIN usuario_info ui ON ui.id_usuario = u.id
				$where";

		return $this->db->query($sql)->result();

		$this->db->close();
	}

}

/* End of file Reportemodel.php */
/* Location: ./application/models/Reportemodel.php */