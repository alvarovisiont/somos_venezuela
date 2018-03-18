<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//si no existe la función invierte_date_time la creamos
if(!function_exists('menu'))
{
    //formateamos la fecha y la hora, función de cesarcancino.com

 function menu()
 {
 	 $CI =& get_instance();
     $CI->load->library('session');

 	 $varhtml = $CI->session->userdata('menu_usuario');

     return $varhtml;
 }
}

if(!function_exists('invierte_date_time'))
{
    //formateamos la fecha y la hora, función de cesarcancino.com
 function invierte_date_time($fecha)
 {
  return date('d/m/Y H:i:s', strtotime($fecha));
 }
}


if(!function_exists('upload_image'))
{
	function upload_image($nombre_archivo,$ruta,$tipos = '',$resize = null, $height = null, $width = null)
	{
		/*
			======================= Leyenda =============================

			nombre_archivo : *| Nombre del campo file del formulario para la función do_upload |*

			ruta  : *| String de la locación donde guardar el archivo |*

			tipos : *| tipos de archivo permitidos aparte de los pre-aceptados por default |* 

			resize: *| Booleano para modificar las dimensiones del archivo |* 

			widh  : *| Ancho nuevo de la imagen |* 

			height: *| Alto nuevo de la imagen  |*
		*/

		$CI =& get_instance();

			$config = [];

		    $config['upload_path'] = $ruta;
		    $config['allowed_types'] = 'jpg|png|jpeg'.$tipos;
		    $config['max_size'] = '2048';
		    $config['encrypt_name'] = TRUE;
		    $config['overwrite'] = TRUE;
		    $config['file_name'] = $nombre_archivo;

		       $CI->load->library('upload');

		       $CI->upload->initialize($config);

		      if (!$CI->upload->do_upload($nombre_archivo)) {

		          $error  = array('error' => $CI->upload->display_errors('<div class="alert alert-danger">', '</div>'));

		          return $error;
		      } 
		      else 
		      {
			     
			    $upload_data = $CI->upload->data();

		      	if(!$resize)
		      	{
		          	return $upload_data['file_name'];	
		      	}
		      	else
		      	{
		      		//resize:

			          $config['image_library'] = 'gd2';
			          $config['source_image'] = $upload_data['full_path'];
			          $config['maintain_ratio'] = TRUE;
			          $config['width']     = $width;
			          $config['height']   = $height;

			          $CI->load->library('image_lib', $config); 

			          $CI->image_lib->resize();

			          // return name of file
			          return $upload_data['file_name'];
		      	}
		          

			          

	        } // fin guardado imagen
	}
}

if(!function_exists('select_db'))
{
	function select_db($tipo_bd)
	{
		// -----------* Función para seleccionar la bd a trabajar *------------------- //
		$data = [];

		$CI =& get_instance();
     	$CI->load->library('session');

		switch ($tipo_bd) 
       {
        case null:
          if ($CI->session->userdata('bd_activa')){
              $data = array( 'bd_activa' => $CI->session->userdata('bd_activa'),
              'tipo_bd' =>  $CI->session->userdata('tipo_bd'));
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


        $CI->session->set_userdata($data); 

        return true;
        
	}
}

 


 