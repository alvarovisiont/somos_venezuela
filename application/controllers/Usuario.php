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
         $this->load->model(array('configmodel','usuariomodel', 'perfilmodel'));
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
                $data = array( 'bd_activa' => $this->session->userdata('bd_activa'));
               }else
               {
                $data = array( 'bd_activa' => 'default', 'tipo_bd' => $tipo_bd);
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


}
