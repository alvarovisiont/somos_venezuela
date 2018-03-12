<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permisomodel extends CI_Model {

	public function __construct()
    {
      //parent::__construct();
      //Codeigniter : Write Less Do More
      //Revisar  
    	//$this->load->model(array('menumodel'));
    }

    public function show_perfil_by_selection($manual)
    {
      /* ============================================================================================
                    BUSCA LOS PERFILES DE ACUERDO A LA SELECCIÓN DEL TIPO DE PERFIL
         ============================================================================================ */

      if($manual)
      {
        $this->db->where('sistema',true);
        $perfil = $this->db->get('perfil')->result();
        $usuarios = $this->db->get('usuario')->result();

        $this->db->close();

        return ['perfiles' => $perfil,'usuarios' => $usuarios];
      }
      else
      {
        $this->db->where('sistema',false); 
        return $this->db->get('perfil')->result();
        $this->db->close();
      }

      


    }

    public function show_module_by_perfil($perfil)
    {
      /* ============================================================================================
                    BUSCA LOS MÓDULOS DE ACUERDO A LA SELECCIÓN DEL PERFIL
         ========================================================================================= */

      $this->db->where('id_perfil',$perfil);

      return  $this->db->get('acceso')->result();
    }

    public function show_module_by_user($user)
    {
      $this->db->where('id_usuario',$user);

      return  $this->db->get('acceso')->result();
    }

    public function guardar_permisos_asignados($permisos)
    {

      // función para guardar los accesos

      $insert = [];

      $array_where = [];


      if($permisos['tipo_perfil'] === 'manuales')
      {
        $insert['id_usuario'] = $permisos['usuario_select'];

      } 
      else
      {
        $insert['id_perfil'] = $permisos['perfiles_select'];
      }

      foreach ($permisos['modulos'] as $value) 
      {
        
        $array_areas = '{';
        $array_sub_areas = '{';
        $insert['id_modulo'] = $value;
        $insert['visible'] = false;

        if(array_key_exists('modulos_visible', $permisos))
        {
          if(in_array($value, $permisos['modulos_visible']))
          {
            $insert['visible'] = true;
          }
        }

        if(array_key_exists('areas_'.$value, $permisos))
        {
          
          foreach ($permisos['areas_'.$value] as $value1) 
          {
            
            $array_areas.= $value1.',';


            if(array_key_exists('sub_areas_'.$value1, $permisos))
            {
              
              foreach ($permisos['sub_areas_'.$value1] as $value2) 
              {
               
               
               $array_sub_areas.= $value2.','; 
               

              } // fin foreach sub areas

            }  // fin si existen sub areas

          } // fin foreach areas
          
        } // fin si existen areas

        if(strlen($array_areas) === 1)
        {
          $array_areas.= '}';
        }
        else
        {
          $array_areas = substr($array_areas, 0, strlen($array_areas) -1);
          $array_areas.= '}';
        }
        
        $insert['id_area'] = $array_areas;

        if(strlen($array_sub_areas) === 1)
        {
          $array_sub_areas.= '}';
        }
        else
        {
          $array_sub_areas = substr($array_sub_areas, 0, strlen($array_sub_areas) -1);
          $array_sub_areas.= '}';
        }

        $insert['id_sub_area'] = $array_sub_areas;


        // buscar si existe el registro y así modificar sus accesos 

        $key   =  array_key_exists('id_usuario', $insert) ? 'id_usuario' : 'id_perfil';

        $valor = array_key_exists('id_usuario', $insert) ? $insert['id_usuario'] : $insert['id_perfil'];

        $array_where = ['id_modulo' => $insert['id_modulo'], $key => $valor];

        $this->db->where($array_where);
        $total = $this->db->count_all_results('acceso');

        if($total > 0)
        {
          
          $insert['updatedat']   = date('Y-m-d H:i:s');
          $this->db->where($array_where);
          $this->db->update('acceso',$insert);
        }
        else
        {
          // si no existe registro se crea
          $insert['createdat']   = date('Y-m-d H:i:s');
          $insert['updatedat']   = date('Y-m-d H:i:s');
          $this->db->insert('acceso',$insert);
        }


      } // fin foreach modulos

      return true;      
    }
}