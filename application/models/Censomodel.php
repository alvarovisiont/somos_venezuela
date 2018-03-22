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
        $this->db->insert('censo',$jefe);
        $this->db->close();   
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
            $sql = "WITH RECURSIVE padre(id,nombre,apellido,cedula,telefono,condicion,nivel,con,vivienda) AS(
                
                SELECT censo.id,nombre,apellido,cedula,telefono,censo.condicion,'Jefe Familia', censo.id as con, concat(vivienda.direccion,' ',vivienda.nro) as vivienda
                from censo 
                INNER JOIN vivienda ON vivienda.id = censo.id_vivienda
                where cedula = $ced and id_padre = 0
                
                UNION ALL 
                SELECT censo.id,censo.nombre,censo.apellido,censo.cedula,censo.telefono,censo.condicion,'Carga Familiar', padre.con, '' 
                from censo 
                JOIN padre ON censo.id_padre = padre.id
            ) 
            SELECT * from padre ORDER BY con asc";
        }  
        else
        {
            $sql = "WITH RECURSIVE padre(id,nombre,apellido,cedula,telefono,condicion,nivel,id_padre,con,vivienda) AS(
                
                SELECT censo.id,nombre,apellido,cedula,telefono,censo.condicion,'Carga Familiar',id_padre, id_padre as con,
                concat(vivienda.direccion,' ',vivienda.nro) as vivienda
                from censo 
                INNER JOIN vivienda ON vivienda.id = censo.id_vivienda
                where cedula = $ced and censo.id_padre > 0

                UNION ALL 

                SELECT censo.id,censo.nombre,censo.apellido,censo.cedula,censo.telefono,censo.condicion,
                'Jefe Familia',censo.id_padre, censo.id as con, ''
                from censo 
                JOIN padre ON censo.id = padre.id_padre
            ) 
            SELECT * from padre";
        }

        return $this->db->query($sql)->result();
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
    }

    public function delete_estructura($id)
    {
        $this->db->delete('estructura',['id' => $id]);
    }

// ============================ VERIFICAR MEDICO ==============================================

    public function no_verificados()
    {
        $id_centro = $this->session->userdata('id_centro'); 

        $this->db->where("c.id_medico = 0 and ui.id_centro = $id_centro");
        $this->db->select("c.*, concat(v.direccion,' ',v.piso,'-',v.nro) as vivienda");
        $this->db->join('vivienda as v','v.id = c.id_vivienda');
        $this->db->join('usuario_info as ui','ui.id_usuario = c.id_registrador');
        return $this->db->get('censo as c')->result();
        $this->db->close();
    }

}