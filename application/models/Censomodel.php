<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Censomodel extends CI_Model {

    public function __construct() {
        //parent::__construct();
    }

// ================================ | VIVIENDAS | ============================================= //

    public function ver_viviendas($id)
    {
        $sql = "SELECT *, (SELECT COUNT(*) from censo where id_vivienda = vivienda.id and id_padre = 0 ) as jefes 
                from vivienda 
                where id_registrador = $id";

    	return $this->db->query($sql)->result();
    	$this->db->close();
    }

    public function store_vivienda($vivienda)
    {
    	$vivienda['createdat'] = date('Y-m-d H:i:s',strtotime('-4 hour'));
    	$vivienda['updatedat'] = date('Y-m-d H:i:s',strtotime('-4 hour'));
    	
    	$this->db->insert('vivienda',$vivienda);
    	$this->db->close();

    }

    public function destroy_vivienda($id)
    {
        $this->db->delete('vivienda',['id' => $id]);
    }

    public function total_viviendas()
    {
        $id = $this->session->userdata('id_usuario');

        $this->db->where('id_registrador',$id);
        return $this->db->count_all_results('vivienda');
        $this->db->close();
    }


// ================================ | JEFE FAMILIAR | ============================================= //

    public function buscar_jefes($id)
    {
        $sql = "SELECT *,
                (SELECT COUNT(censo1.*) from censo as censo1 where censo1.id_padre = censo.id and censo1.id_padre > 0) as carga 
                from censo where id_padre = 0 and id_vivienda = $id";

        return $this->db->query($sql)->result();
        $this->db->close();
    }

    public function store_censo($jefe)
    {
        $sql = "CASE WHEN v.tipo_vivienda = 't' THEN
                concat(v.direccion,' casa: ', v.nro)
                ELSE 
                concat('apartamento: ',v.direccion,' piso: ', v.piso,' nro:', v.nro)
                END as direccion
                ";

        $this->db->where('c.cedula', $jefe['cedula']);
        $this->db->select($sql);
        $this->db->from('censo as c');
        $this->db->join('vivienda as v', 'c.id_vivienda = v.id');
        $result = $this->db->get()->result();

        if(count($result) > 0)
        {
            $this->session->set_flashdata('type', 'danger');
            $this->session->set_flashdata('message', 'Ya existe el registro en la dirección: '.$result[0]->direccion);
            return false;   
        }
        else
        {
            $this->db->insert('censo',$jefe);
            $this->db->close(); 

            $this->session->set_flashdata('type', 'success');
            $this->session->set_flashdata('message', 'Jefe Registrado con Éxito');   
            return true;  
            
            
        }

            
    }

    public function update_censo($jefe)
    {
        $id = $jefe['id_registro'];

        unset($jefe['id_registro']);

        $this->db->where('id',$id);
        $this->db->update('censo',$jefe);
    }

    public function destroy_censo($id)
    {
        $this->db->delete('censo',['id' => $id]);
    }

    public function edit_censo($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('censo')->row();
        $this->db->close();
    }

// ================================ | CARGA FAMILIAR | ============================================= //

    public function buscar_carga($id)
    {
        $this->db->where('id_padre',$id);
        return $this->db->get('censo')->result();
    }

    public function buscar_parentesco()
    {
        $this->db->where('id >',1);
        return $this->db->get('parentesco')->result();
    }


// ================================ | BUSCAR EN CENSO | ============================================= //

    public function buscar_familia($ced,$type)
    {

        $sql = "";

        if($type === '1')
        {
            $sql = "WITH RECURSIVE padre(id,nombre,apellido,cedula,telefono,condicion,nivel,verificado,con,vivienda) AS(
                
                SELECT censo.id,nombre,apellido,cedula,telefono,censo.condicion,'Jefe Familia',censo.verificado, censo.id as con, 

                CASE v.tipo_vivienda WHEN true THEN
                concat('casa: ',v.direccion,'<br/> nª: ',v.nro)
                WHEN false THEN
                concat('apartamento: ',v.direccion,'<br/> piso: ',v.piso,'<br/> nª: ',v.nro)
                END as vivienda

                from censo 
                INNER JOIN vivienda as v ON v.id = censo.id_vivienda
                where cedula = $ced and id_padre = 0
                
                UNION ALL 
                SELECT censo.id,censo.nombre,censo.apellido,censo.cedula,censo.telefono,censo.condicion,'Carga Familiar', censo.verificado, padre.con, '' 
                from censo 
                JOIN padre ON censo.id_padre = padre.id
            ) 
            SELECT * from padre ORDER BY con asc";
        }  
        else
        {
            $sql = "WITH RECURSIVE padre(id,nombre,apellido,cedula,telefono,condicion,nivel,verificado,id_padre,con,vivienda) AS(
                
                SELECT censo.id,nombre,apellido,cedula,telefono,censo.condicion,'Carga Familiar',censo.verificado,id_padre, id_padre as con,
                
                CASE v.tipo_vivienda WHEN true THEN
                concat('casa: ',v.direccion,'<br/> nª: ',v.nro)
                WHEN false THEN
                concat('apartamento: ',v.direccion,'<br/> piso: ',v.piso,'<br/> nª: ',v.nro)
                END as vivienda

                from censo 
                INNER JOIN vivienda as v ON v.id = censo.id_vivienda
                where cedula = $ced and censo.id_padre > 0

                UNION ALL 

                SELECT censo.id,censo.nombre,censo.apellido,censo.cedula,censo.telefono,censo.condicion,
                'Jefe Familia',censo.verificado,censo.id_padre, censo.id as con, ''
                from censo 
                JOIN padre ON censo.id = padre.id_padre
            ) 
            SELECT * from padre";
        }

        return $this->db->query($sql)->result();
        $this->db->close();
    }

    public function censados_modal($centro)
    {
        $sql = "concat(c.nombre,' ',c.apellido) as nombre, ui.nombre as registrador, p.nombre as pefil,
                c.condicion, c.embarazada, c.verificado, c.cedula, c.telefono, 
                CASE v.tipo_vivienda WHEN true THEN
                concat(v.direccion,'<br/> nª: ',v.nro)
                WHEN false THEN
                concat(v.direccion,'<br/> piso: ',v.piso,'<br/> nª: ',v.nro)
                END as vivienda, 
                c.pensionado";

        $this->db->where('ui.id_centro',$centro);
        $this->db->select($sql);
        $this->db->from('censo as c');
        $this->db->join('vivienda as v', 'v.id = c.id_vivienda');
        $this->db->join('usuario_info as ui', 'ui.id_usuario = c.id_registrador');
        $this->db->join('usuario as u', 'u.id = ui.id_usuario');
        $this->db->join('perfil as p', 'p.id = u.id_permiso');
        return $this->db->get()->result();
        $this->db->close();
    }

// ========================= ESTRUCTURAS CENTROS MEDICOS ==========================================

    public function store_estructura($estr)
    {
        $estr['createdat'] = date('Y-m-d',strtotime('-4 hour'));
        $estr['updatedat'] = date('Y-m-d',strtotime('-4 hour'));

        $this->db->where('cedula',$estr['cedula']);
        if($this->db->count_all_results('estructura') > 0)
        {
            return false;
        }
        else
        {
            $this->db->insert('estructura',$estr);
            return true;
        }
    }

    public function edit_estructura($data)
    {
        $id = $data['id_edit'];
        unset($data['id_edit']);

        $this->db->where('id',$id);
        $this->db->update('estructura',$data);
        $this->db->close();

        $this->session->set_flashdata('type', 'success');
        $this->session->set_flashdata('message', 'Integrante editado con éxito');   
    }

    public function delete_estructura($id)
    {
        $this->db->delete('estructura',['id' => $id]);
    }

   

}