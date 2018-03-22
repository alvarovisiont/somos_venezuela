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
            $sql = "WITH RECURSIVE padre(id,nombre,apellido,cedula,telefono,fecha_nac,genero,condicion,embarazada,nivel,id_padre) AS(
                
                SELECT id,nombre,apellido,cedula,telefono,fecha_nac,genero,condicion,embarazada,'Jefe Familia', id_padre from censo where cedula = $ced and id_padre = 0
                UNION ALL 
                SELECT censo.id,censo.nombre,censo.apellido,censo.cedula,censo.telefono,censo.fecha_nac,censo.genero,censo.condicion,censo.embarazada,'Carga Familiar', censo.id_padre from censo 
                JOIN padre ON censo.id_padre = padre.id
            ) 
            SELECT * from padre";
        }  
        else
        {
            $sql = "WITH RECURSIVE padre(id,nombre,apellido,cedula,telefono,fecha_nac,genero,condicion,embarazada,nivel,id_padre) AS(
                
                SELECT id,nombre,apellido,cedula,telefono,fecha_nac,genero,condicion,embarazada,'Carga Familiar', id_padre from censo where cedula = $ced and censo.id_padre > 0

                UNION ALL 

                SELECT censo.id,censo.nombre,censo.apellido,censo.cedula,censo.telefono,censo.fecha_nac,censo.genero,censo.condicion,censo.embarazada,'Jefe Familia', censo.id_padre from censo 
                JOIN padre ON censo.id = padre.id_padre
            ) 
            SELECT * from padre";
        }

        return $this->db->query($sql)->result();
        $this->db->close();
    }

    public function store_estructura($estr)
    {
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

}