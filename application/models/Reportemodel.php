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
		$sql = "SELECT * from censo as c 
				INNER JOIN usuario as u ON u.id = c.id_registrador
				$where";

		return $this->db->query($sql)->result();

		$this->db->close();
	}

}

/* End of file Reportemodel.php */
/* Location: ./application/models/Reportemodel.php */