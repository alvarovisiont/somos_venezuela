<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#">Sistema</a>
		</li>

		<li>
			<a href="#">Censo</a>
		</li>
		<li class=""><a href="#">Vivienda</a></li>
		<li class="active">Jefe Familia</li>
	</ul><!-- /.breadcrumb -->					
</div>
<div class="page-header text-center">
	<li class="bigger-200 purple">
	 	<i class="ace-icon fa fa-circle"></i>
	 	<?= $this->session->userdata('membrete') ?>
	 	<br>
	</li>

</div><!-- /.page-header -->

<div class="row no-gutters">	
	<div class="col-md-12 col-sm-12">
		<a href="<?= base_url().'index.php/censo' ?>" class="btn btn-app btn-purple" data-tool="tooltip" title="Volver a Viviendas">
    		<i class="ace-icon fa fa-home bigger-250"></i>
    		Viviendas
    		<span class="badge badge-warning badge-left"><?= $total_viviendas ?></span>
    	</a>
		<a href="<?= base_url().'index.php/censo/create_jefe/'.base64_encode($vivienda) ?>" class="btn btn-app btn-purple" data-tool="tooltip" title="Registrar Jefe">
    		<i class="ace-icon fa fa-user-plus bigger-250"></i>
    		Jefe
    		<span class="badge badge-warning badge-left"><?= count($data) ?></span>
    	</a>
	</div>
	<div class="clearfix"></div>
	<br/>
	<div class="col-md-12 col-sm-12">
		<table class="table table-bordered table-responsive table-condensed" id="tabla">
			<thead>
				<tr>
					<th class="text-center">Nombre</th>
					<th class="text-center">Cédula</th>
					<th class="text-center">Teléfono</th>
					<th class="text-center">Edad</th>
					<th class="text-center">Genero</th>
					<th class="text-center">Condición</th>
					<th class="text-center">Embarazada</th>
					<th class="text-center">Acción</th>
				</tr>
			</thead>
			<tbody class="text-center">
				<?
					$con = 1;
					foreach ($data as $row) 
					{
						$button = '<a href="'.base_url().'index.php/censo/carga_familiar/'.base64_encode($row->id).'/'.base64_encode($vivienda).'" 
									class="btn btn-info btn-xs"
									data-tool="tooltip"
									title="Ver Carga Familiar">
									<i class="fa fa-eye"></i>
									</a>';
						$edit = '<a href="'.base_url().'index.php/censo/edit_jefe/'.base64_encode($row->id).'" 
									class="btn btn-pink btn-xs"
									data-tool="tooltip"
									title="Editar Jefe">
									<i class="fa fa-edit"></i>
									</a>';

						$embarazada = '';
						$eliminar = '';

						$genero = $row->genero === '1' ? 'Masculino' : 'Femenino';

						if($genero === 'Femenino')
						{
							$embarazada = $row->embarazada === 'f' ? 'No' : 'Si';
						}

						$fecha1 = new DateTime($row->fecha_nac);
						$fecha2 = new DateTime();
						$diff = $fecha1->diff($fecha2);

						$edad = $diff->y;

						$pensionado = '';

						if(!empty($row->pensionado))
						{
							$pensionado = '<span class="label label-sm label-pink arrowed arrowed-right">
												Pension: '.$row->pensionado.'
											</span>';
						}

						if($row->carga < 1)
						{
							$eliminar =	'<a href="'.base_url().'index.php/censo/jefe_delete/'.base64_encode($row->id).'/'.base64_encode($vivienda).'" 
											class="btn btn-danger btn-xs eliminar"
											data-tool="tooltip"
											title="Eliminar Jefe">
											<i class="fa fa-trash"></i>
										</a>';
						}
						else
						{
							$eliminar =	'<a href="#" 
											class="btn btn-danger btn-xs"
											data-tool="tooltip"
											title="No puede eliminar el jefe porque tiene carga"
											disabled="">
											<i class="fa fa-trash"></i>
										</a>';
						}


						echo 	"<tr>
									<td>{$row->nombre} {$row->apellido}</td>
									<td><span class='label label-sm label-warning arrowed arrowed-right'>{$row->cedula}</span></td>
									<td>{$row->telefono}</td>
									<td>{$edad} <br/> {$pensionado}</td>
									<td>{$genero}</td>
									<td>{$row->condicion}</td>
									<td>{$embarazada}</td>
									<td>{$button} {$edit} {$eliminar}</td>
								</tr>";

						$con++;
					}
				?>
			</tbody>
		</table>
	</div>
</div>