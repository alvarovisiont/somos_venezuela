<?php
/**
 * Controlador del inicio 
 * @author sistemaweb21. 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
/*---------------------------------------------------------------------*/
    public function __construct() {
         parent::__construct();
         $this->load->model(array('configmodel','usuariomodel', 'perfilmodel', 'geomodel'));
    }
/*---------------------------------------------------------------------*/
	public function index($tipo_bd = null){
		//buscar tipo de logueo

      if (!$this->session->userdata('is_logued_in'))
       {
        redirect('login/', 'refresh');
       }else
       {
       switch ($tipo_bd) 
       {
        case null:
          if ($this->session->userdata('bd_activa')){
              $data = array( 'bd_activa' => $this->session->userdata('bd_activa'),
              'tipo_bd' =>  $this->session->userdata('tipo_bd'));
             }else
             {
              $data = array( 'bd_activa' => 'default',
              'tipo_bd' => 1);
             }
             break;
         case 1:
             $data = array( 'bd_activa' => 'default', 'tipo_bd' => $tipo_bd);    
            break;
         case 2:
            $data = array( 'bd_activa' => 'admin21', 'tipo_bd' => $tipo_bd);
            break;
        }// fin switch

        $this->session->set_userdata($data); 

         $usuario  = $this->usuariomodel->show_usuario();

         $arr_usuario = $usuario;
         $correo_usuario = array();

         foreach ( $arr_usuario  as $row) 
         array_push($correo_usuario, $row->email);

         $usuario_data = array(
         'arr_usuarios' => $correo_usuario
         );
         $this->session->set_userdata($usuario_data);

         $this->load->view('dashboard/header');
         $this->load->view('dashboard/menu');
         $this->load->view('usuario/index',['usuario' => $usuario]);
         $this->load->view('dashboard/footer');
        }
	
	}// fin index

/*---------------------------------------------------------------------*/

       public function usuario_activo($id,$estatus){

       if (!$this->session->userdata('is_logued_in'))
       {
        redirect('login/', 'refresh');
       }else
       {  

        if ($estatus == 't'){
         $data = array(
                 'usuario_activo' => false);
         }else{
            $data = array(
                 'usuario_activo' => true);
         }

        if($this->usuariomodel->actualizar_registro($id,$data))
        {
            //registro modificado;
             $this->session->set_flashdata('usuario_mensj', 'Cambiado el estatus');
            redirect('usuario/','refresh');
        }
        else
        {
            redirect('usuario/','refresh');
        }
       }

   }

 /*--------------------------------------------------------------------------------------------------------*/
   public function create()
   {
      $perfil = $this->perfilmodel->show_perfil();

      $ruta = base_url().'index.php/usuario/store';
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/menu');
        $this->load->view('usuario/form',['ruta' => $ruta,'register' => null, 'perfil' => $perfil]);
        $this->load->view('dashboard/footer');
   }

    public function store()
    {

       $cedula = $this->input->post('cedula', TRUE);
        $nombre = $this->input->post('nombre', TRUE);
         $apellido = $this->input->post('apellido', TRUE);
          $imagen = $this->input->post('imagen', TRUE);

         $data = array(
                'createdat' => date('Y-m-d H:i:s'),
                'updatedat' => date('Y-m-d H:i:s'),
                'fecha_acceso' => date('Y-m-d H:i:s'),
                'password' => '123456',
                'login' => $this->input->post('login', TRUE),
                'email' => $this->input->post('email', TRUE),
                'id_permiso' => $this->input->post('id_permiso', TRUE),    
            );


            $datapersonal = array(
                'createdat' => date('Y-m-d H:i:s'),
                'updatedat' => date('Y-m-d H:i:s'),
                'cedula' => $cedula,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'imagen' => $imagen,
            );

        if($this->usuariomodel->crear_usuario($data, $datapersonal))
        {  
            redirect('usuario/','refresh');
        }
        else
        {       
            redirect('usuario/','refresh');
        }
    }



 
    /*public function store_municipio($municipio)
    {
        $data = array( 'bd_activa' => 'default');
        $this->session->set_userdata($data);

        $municipios_login = $this->geomodel->usuario_user_municipio($municipio);

        $user_final_aux = $municipios_login->login;

        $municipios = $this->geomodel->show_parroquia_mun($municipio);

        foreach ($municipios as $row) 
        {
            $user_final = "";
            $user_final = $user_final_aux."_P_".$row->id_parroquia;

            $data = array(
                'createdat' => date('Y-m-d H:i:s'),
                'updatedat' => date('Y-m-d H:i:s'),
                'fecha_acceso' => date('Y-m-d H:i:s'),
                'password' => '123456789',
                'login' => $user_final,
                'email' => $user_final."@USUARIOS.COM",
                'id_permiso' => 6,
                'correo_activo' => true,
                'id_estado' => 17,      
                'id_municipio' => $row->id_municipio,
                'id_parroquia' => $row->id_parroquia,

            );


            $datapersonal = array(
                'createdat' => date('Y-m-d H:i:s'),
                'updatedat' => date('Y-m-d H:i:s'),
                'fecha_nacimiento' => date('Y-m-d H:i:s'),
                'nombre' => $user_final,
                'apellido' => $user_final,
                'imagen' => 'avatar.png',
                'id_pais' => 1,

            );



        if($this->usuariomodel->crear_usuario($data, $datapersonal))
        {  

            echo "registro";
        }
        


        } 

          die();      

    }//fin store 
    */


}
