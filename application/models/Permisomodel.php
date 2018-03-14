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
      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

      if($manual)
      {
        $db_admin->where('sistema',true);
        $perfil = $db_admin->get('perfil')->result();
        $usuarios = $db_admin->get('usuario')->result();

        $db_admin->close();

        return ['perfiles' => $perfil,'usuarios' => $usuarios];
      }
      else
      {
        $db_admin->where('sistema',false); 
        return $db_admin->get('perfil')->result();
        $db_admin->close();
      }

      


    }

    public function show_module_by_perfil($perfil)
    {
      /* ============================================================================================
                    BUSCA LOS MÓDULOS DE ACUERDO A LA SELECCIÓN DEL PERFIL
         ========================================================================================= */

      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

      $db_admin->where('id_perfil',$perfil);

      return  $db_admin->get('acceso')->result();

      $db_admin->close();
    }

    public function show_module_by_user($user)
    {
      $this->db->where(['id_usuario' => $user, 'id_perfil' => 1]);

      return  $this->db->get('acceso')->result();
      $db_admin->close();
    }

    public function guardar_permisos_asignados($permisos)
    {

      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

      // función para guardar los accesos

      $insert = [];

      $array_where = [];
      $array_link = [];

      if(!empty($permisos['registros_link']))
      {
        $array_link = substr($permisos['registros_link'], 0, strlen($permisos['registros_link']) - 1);

        $array_link = explode(',', $array_link);
      }

        


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

        $this->acceso_accion_insert($value,$array_link,$insert);

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

            $this->acceso_accion_insert($value1,$array_link,$insert);


            if(array_key_exists('sub_areas_'.$value1, $permisos))
            {
              
              foreach ($permisos['sub_areas_'.$value1] as $value2) 
              {
               
               
               $array_sub_areas.= $value2.','; 

               $this->acceso_accion_insert($value2,$array_link,$insert);
               

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

        $db_admin->where($array_where);
        $total = $db_admin->count_all_results('acceso');

        if($total > 0)
        {
          
          $insert['updatedat']   = date('Y-m-d H:i:s');
          $db_admin->where($array_where);
          $db_admin->update('acceso',$insert);
        }
        else
        {
          // si no existe registro se crea
          $insert['createdat']   = date('Y-m-d H:i:s');
          $insert['updatedat']   = date('Y-m-d H:i:s');
          $db_admin->insert('acceso',$insert);
        }


      } // fin foreach modulos

      $db_admin->close();
      return true;      
    }

    private function acceso_accion_insert($value, $array_link, $insert)
    {

      $db_admin = $this->load->database($this->session->userdata('bd_activa'), TRUE);

      // buscar si existe el registro en acceso_accion y así no tener que volver a registralo
      // y si no existe registralo

        if(in_array($value, $array_link))
        {

          $key   =  array_key_exists('id_usuario', $insert) ? 'id_usuario' : 'id_perfil';

          $valor = array_key_exists('id_usuario', $insert) ? $insert['id_usuario'] : $insert['id_perfil'];

          $array_where = ['id_modulo' => $value, $key => $valor];

          $db_admin->where($array_where);
          $total = $db_admin->count_all_results('acceso_accion'); 

          if($total < 1)
          {
            $array_insert = ['id_modulo' => $value, $key => $valor, 
                             'createdat' => date('Y-m-d H:i:s'), 
                             'updatedat' => date('Y-m-d H:i:s')];

            $db_admin->insert('acceso_accion',$array_insert);
          }
        }
    }
}