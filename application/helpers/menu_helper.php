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

if(!function_exists('make_view'))
{
	// función para pintar una vista

	function make_view($data = null,$th = null,$key_data = null,$totales = null,$color_totales = null,$breadcrumbs,$titulo_vista = null,$membrete = null)
	{

		/*
			======================= Leyenda =============================
			
			data       : *| data de la base de datos del dataTable |*

			th         : *| Nombre de los campos en la tabla |*

			key_data   : *| arreglo de las keys del foreach de data en el dataTable, ejemplo: ['id_permiso','nombre'] |*

			totales    : *| arreglo para mostrar los totales de la vista, ejemplo: ['compras' => 80,'inventario' => 100] |*  

			color_totales: *| string del color de los botones de totales |*

			breadcrumbs: *| indicatorio de que vista esta, ejemplo: ['censo', 'padre_familia', 'registrar_padre_familia'] |*

			titulo_vist: *| Título de la vista en la caja de texto |*

			membrete   : *| Si se manda true mostrara el membrete de la vista con el nivel de acceso del trabajador *|
		*/
		

		$CI =& get_instance();
     	$CI->load->library('session');
     	$CI->load->model('accesomodel');


		$clase_bd_1 = $CI->session->userdata('tipo_bd') == 1 ? 'primary' : 'default';
		$clase_bd_2 = $CI->session->userdata('tipo_bd') == 2 ? 'primary' : 'default';
		$clase_bd_3 = $CI->session->userdata('tipo_bd') == 3 ? 'primary' : 'default';

		$url = explode('/', $_SERVER['REQUEST_URI']);
		$url = array_slice($url, 2,2);

		$url = implode('/', $url);
		$ruta = base_url().$url;
		$ruta_acciones = base_url().'assets_sistema/images/acciones/';

		$boton_header = '';
		$boton_accion = '';

		$membrete_html = '';
		$totales_html = '';
		$keys_tabla   = '';
		$cuerpo_tabla = '';
		$breadcrumbs_html = '<div class="breadcrumbs ace-save-state" id="breadcrumbs">
								<ul class="breadcrumb">
									<li>
										<i class="ace-icon fa fa-home home-icon"></i>
										<a href="#">Sistema</a>
									</li>';


// ================================= | MEMBRETE | ============================================================					

	if($membrete)
	{
		$membrete_html = '	<div class="page-header text-center">
								<li class="bigger-200 '.$color_totales.'">
								 	<i class="ace-icon fa fa-circle"></i>
								 	'.$CI->session->userdata('membrete').'
								 	<br>
								</li>
							</div><!-- /.page-header -->';
	}			

// ================================= | TOTALES DE LA VISTA | ============================================================

		foreach ($totales as $key => $row) {

			$totales_html.='	<button class="btn btn-app btn-'.$color_totales.' no-radius" data-tool="tooltip" title="total '.$key.'">
							<i class="ace-icon fa fa-pencil-square-o bigger-230"></i>
								'.$key.'
							<span class="badge badge-warning badge-left">'.$row.'</span>
						</button>';
		}
// ================================== | BREADCRUMBS | ==========================================================
		$con = 1;
		foreach ($breadcrumbs as $row) 
		{
			

			if($con === count($breadcrumbs))
			{
				$breadcrumbs_html.='<li class="active">'.$row.'</li>';
			}
			else
			{

				$breadcrumbs_html.='<li><a href="#">Configuración</a></li>';
			}

			$con++;
		}

		$breadcrumbs_html.='</ul></div><!-- /.breadcrumb -->';

// =============================== | NOMBRE DE LOS CAMPOS EN LA TABLA | ========================================
		
		foreach ($th as $row) {
			$keys_tabla.='<th class="text-center text-primary">'.ucwords($row).'</th>';
		}

// =============================== | BOTONES PERMISOS TABLA | ==================================================

		$result = $CI->accesomodel->all_access($CI->session->userdata('id_menu'));

		if($result->n_accion === 't')
		{
			$boton_header = '<a href="'.$ruta.'/create'.'" class="btn btn-'.$color_totales.' btn-fill pull-right">
								Crear Registro&nbsp;<i class="fa fa-plus"></i>
							</a>';
		}

		if($result->r_accion === 't')
		{
			$boton_header .= '<a class="btn btn-default btn-fill pull-right" data-tool="tooltip" title="PDF de 					toda la data">
								Imprimir
								<img src="'.$ruta_acciones.'reporte.jpg'.'" width="20px" />
							  </a>';	
		}

// =============================== | DATA DE LA TABLA | ========================================================
		
		foreach ($data as $row) {

			$boton_accion = '';

			if($result->m_accion === 't')
			{
				$boton_accion .= '<a data-tool="tooltip" title="modificar" href="'.$ruta.'/edit/'.$row->id.'">

									<img src="'.$ruta_acciones.'modificar.png'.'" width="20px" />
								</a>';
			}

			if($result->m_accion === 't')
			{
				$boton_accion .= '<a data-tool="tooltip" title="Ver Detalles">
									<img src="'.$ruta_acciones.'ver.jpg'.'" width="20px" />
								</a>';	
			}

			if($result->e_accion === 't')
			{
				$boton_accion .= '<a data-tool="tooltip" title="Eliminar" class="eliminar">
									<img src="'.$ruta_acciones.'remover.jpg'.'" width="20px" />
								</a>';	
			}

			if($result->i_accion === 't')
			{
				$boton_accion .= '<a data-tool="tooltip" title="Imprimir Registro">
									<img src="'.$ruta_acciones.'imprimir.jpg'.'" width="20px" />
								</a>';	
			}

			$cuerpo_tabla.='<tr><td>'.$boton_accion.'</td>';

			foreach ($key_data as $row1) 
			{
				$cuerpo_tabla.='<td>'.$row->{$row1}.'</td>';
				
			}

			$cuerpo_tabla.='</tr>';
		}

// ================================ | HTML DE LA VISTA | =================================================================




		if($CI->session->userdata('id_permiso') === '2')
		{
			$boton_header .= '<button class="btn btn-purple btn-fill pull-right"
										data-toggle="modal" data-target="#modal_bd"
									>
										Base de Datos&nbsp;<i class="fa fa-folder"></i>
									</button>';
		}

		$html = $breadcrumbs_html.'
				'.$membrete_html.'

				<div class="row no-gutters" id="div_principal">
					<div class="col-md-12 col-sm-12">
						<div class="widget-box">
							<div class="widget-header">
								<h3 class="widget-title">
									'.$titulo_vista.'
									'.$boton_header.'
								</h3>
							</div>
							<div class="widget-body">
								<div class="widget-main">
									<div class="row no-gutters">
										'.$totales_html.'
									</div>
								</div>
							</div>	
							<div class="row no-gutters">
								<div class="col-sm-12 col-md-12">
									<table class="table table-bordered table-hover table-responsive" id="tabla">
										<thead>
											<tr>
												'.$keys_tabla.'
											</tr>
										</thead>
										<tbody class="text-center">
											'.$cuerpo_tabla.'
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="modal_bd" class="modal fade" role="dialog"> <!-- Modal Base Datos -->
				    <div class="modal-dialog">
				        <!-- Modal content-->
				        <div class="modal-content">
				            <div class="modal-header modalHeader">
				                <button type="button" class="close" data-dismiss="modal">×</button>
				                <h4 class="modal-title">
				                Escoger BD&nbsp;<img src="'.base_url().'assets_sistema/images/database_modal.jpg'.'"
				                	width="40px"
				                />
				                </h4>
				            </div>
				            <div class="modal-body">
								<div class="row no-gutters">
									<div class="col-md-4 col-sm-4">
										<a href="'.$ruta.'/1'.'" 
										class="btn btn-app btn-'.$clase_bd_1.'">
										<i class="ace-icon fa fa-tachometer bigger-250"></i>Default&nbsp;
										</a>
									</div>
									<div class="col-md-4 col-sm-4">
										<a href="'.$ruta.'/2'.'" 
											class="btn btn-app btn-'.$clase_bd_2.'">
												<i class="ace-icon fa fa-eye bigger-250"></i>
											Admin&nbsp;
										</a>
									</div>
									<div class="col-md-4 col-sm-4">
										<a href="'.$ruta.'/3'.'" 
											class="btn btn-app btn-'.$clase_bd_3.'">
												<i class="ace-icon fa fa-ban bigger-250"></i>
												Bienes&nbsp;
										</a>
									</div>
							    </div> <!-- fin row base datos -->
				            </div><!-- fin modal-body -->
				            <div class="modal-footer">
				                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				            </div>
				        </div><!-- fin modal-content -->
				    </div><!-- fin modal-dialog -->
				</div> <!-- fin modal -->';

		return $html;
        
	}
}

 


 