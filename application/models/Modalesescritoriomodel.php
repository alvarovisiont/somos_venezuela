<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Modalesescritoriomodel extends CI_Model {

	public function centros_estados()
	{
		$sql = "ui.nombre, ui.direccion, 
				(SELECT m.nombre from municipio as m where m.id_estado = 17 and m.id_municipio = u.id_municipio) as municipio,
				(SELECT p.nombre from parroquia as p where p.id_estado = 17 and p.id_municipio = u.id_municipio and p.id_parroquia = u.id_parroquia) as parroquia";

		$this->db->select($sql);
		$this->db->from('usuario_info as ui');
		$this->db->join('usuario as u', 'u.id = ui.id_usuario');
		$this->db->where('u.id_permiso', 7);
		return $this->db->get()->result();
		$this->db->close();
	}

	public function registradores_medicos_estados($permiso)
	{
		$sql = "ui.nombre, ui.direccion, ui.telefono, u.email, 
				(SELECT ui1.nombre from usuario_info as ui1 where ui1.id_usuario = ui.id_centro) as centro";
		$this->db->select($sql);
		$this->db->from('usuario_info as ui');
		$this->db->join('usuario as u', 'u.id = ui.id_usuario');
		$this->db->where('u.id_permiso', $permiso);
		return $this->db->get()->result();
		$this->db->close();	
	}
	
	public function censados_estado()
	{
		$sql = "concat(c.nombre,' ',c.apellido) as nombre, ui.nombre as registrador, p.nombre as pefil,
                c.condicion, c.embarazada, c.verificado, c.cedula, c.telefono, 
                CASE v.tipo_vivienda WHEN true THEN
                concat(v.direccion,'<br/> nª: ',v.nro)
                WHEN false THEN
                concat(v.direccion,'<br/> piso: ',v.piso,'<br/> nª: ',v.nro)
                END as vivienda, 
                c.pensionado";

        $this->db->select($sql);
        $this->db->from('censo as c');
        $this->db->join('vivienda as v', 'v.id = c.id_vivienda');
        $this->db->join('usuario_info as ui', 'ui.id_usuario = c.id_registrador');
        $this->db->join('usuario as u', 'u.id = ui.id_usuario');
        $this->db->join('perfil as p', 'p.id = u.id_permiso');
        return $this->db->get()->result();
        $this->db->close();
	}

// ========================== MUNICIPIO =======================================================

	public function centros_municipio($muni)
	{
		$sql = "ui.nombre, ui.direccion, 
				(SELECT m.nombre from municipio as m where m.id_estado = 17 and m.id_municipio = u.id_municipio) as municipio,
				(SELECT p.nombre from parroquia as p where p.id_estado = 17 and p.id_municipio = u.id_municipio and p.id_parroquia = u.id_parroquia) as parroquia";

		$this->db->select($sql);
		$this->db->from('usuario_info as ui');
		$this->db->join('usuario as u', 'u.id = ui.id_usuario');
		$this->db->where(['u.id_permiso' =>  7, 'u.id_municipio' => $muni]);
		return $this->db->get()->result();
		$this->db->close();
	}

	public function registradores_medicos_municipio($permiso,$muni)
	{
		$sql = "ui.nombre, ui.direccion, ui.telefono, u.email, 
				(SELECT ui1.nombre from usuario_info as ui1 where ui1.id_usuario = ui.id_centro) as centro";
		$where = "u.id_permiso = $permiso and ui.id_centro IN (SELECT id from usuario where id_permiso = 7 and id_municipio = $muni)";

		$this->db->select($sql);
		$this->db->from('usuario_info as ui');
		$this->db->join('usuario as u', 'u.id = ui.id_usuario');
		$this->db->where($where);
		return $this->db->get()->result();
		$this->db->close();	
	}
	
	public function censados_municipio($muni)
	{
		$sql = "concat(c.nombre,' ',c.apellido) as nombre, ui.nombre as registrador, p.nombre as pefil,
                c.condicion, c.embarazada, c.verificado, c.cedula, c.telefono, 
                CASE v.tipo_vivienda WHEN true THEN
                concat(v.direccion,'<br/> nª: ',v.nro)
                WHEN false THEN
                concat(v.direccion,'<br/> piso: ',v.piso,'<br/> nª: ',v.nro)
                END as vivienda, 
                c.pensionado";

        $this->db->select($sql);
        $this->db->from('censo as c');
        $this->db->join('vivienda as v', 'v.id = c.id_vivienda');
        $this->db->join('usuario_info as ui', 'ui.id_usuario = c.id_registrador');
        $this->db->join('usuario as u', 'u.id = ui.id_usuario');
        $this->db->join('perfil as p', 'p.id = u.id_permiso');
        $this->db->where("ui.id_centro IN (SELECT id from usuario where id_permiso = 7 and id_municipio = $muni)");
        return $this->db->get()->result();
        $this->db->close();
	}

// ========================== PARROQUIA =======================================================

	public function centros_parroquia($muni,$parro)
	{
		$sql = "ui.nombre, ui.direccion, 
				(SELECT m.nombre from municipio as m where m.id_estado = 17 and m.id_municipio = u.id_municipio) as municipio,
				(SELECT p.nombre from parroquia as p where p.id_estado = 17 and p.id_municipio = u.id_municipio and p.id_parroquia = u.id_parroquia) as parroquia";

		$this->db->select($sql);
		$this->db->from('usuario_info as ui');
		$this->db->join('usuario as u', 'u.id = ui.id_usuario');
		$this->db->where(['u.id_permiso' =>  7, 'u.id_municipio' => $muni, 'u.id_parroquia' => $parro]);
		return $this->db->get()->result();
		$this->db->close();
	}

	public function registradores_medicos_parroquia($permiso,$muni,$parro)
	{
		$sql = "ui.nombre, ui.direccion, ui.telefono, u.email, 
				(SELECT ui1.nombre from usuario_info as ui1 where ui1.id_usuario = ui.id_centro) as centro";
		$where = "u.id_permiso = $permiso and ui.id_centro IN (SELECT id from usuario where id_permiso = 7 and id_municipio = $muni and id_parroquia = $parro)";

		$this->db->select($sql);
		$this->db->from('usuario_info as ui');
		$this->db->join('usuario as u', 'u.id = ui.id_usuario');
		$this->db->where($where);
		return $this->db->get()->result();
		$this->db->close();	
	}
	
	public function censados_parroquia($muni,$parro)
	{
		$sql = "concat(c.nombre,' ',c.apellido) as nombre, ui.nombre as registrador, p.nombre as pefil,
                c.condicion, c.embarazada, c.verificado, c.cedula, c.telefono, 
                CASE v.tipo_vivienda WHEN true THEN
                concat(v.direccion,'<br/> nª: ',v.nro)
                WHEN false THEN
                concat(v.direccion,'<br/> piso: ',v.piso,'<br/> nª: ',v.nro)
                END as vivienda, 
                c.pensionado";

        $this->db->select($sql);
        $this->db->from('censo as c');
        $this->db->join('vivienda as v', 'v.id = c.id_vivienda');
        $this->db->join('usuario_info as ui', 'ui.id_usuario = c.id_registrador');
        $this->db->join('usuario as u', 'u.id = ui.id_usuario');
        $this->db->join('perfil as p', 'p.id = u.id_permiso');
        $this->db->where("ui.id_centro IN (SELECT id from usuario where id_permiso = 7 and id_municipio = $muni and id_parroquia = $parro)");
        return $this->db->get()->result();
        $this->db->close();
	}

}



/* End of file Modalesescritoriomodel.php */
/* Location: ./application/models/Modalesescritoriomodel.php */

?>