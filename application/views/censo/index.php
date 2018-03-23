<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#">Sistema</a>
		</li>

		<li>
			<a href="#">Censo</a>
		</li>
		<li class="">Vivienda</li>
	</ul><!-- /.breadcrumb -->					
</div>

<div class="page-header text-center">
	<div class="row no-gutters">
		<div class="col-md-12 col-sm-12">
			<li class="bigger-200 purple">
			 	<i class="ace-icon fa fa-circle"></i>
			 	<?= $this->session->userdata('membrete') ?>
			 	
			 	<?
		    	if($this->session->userdata('id_permiso') <= '7')
		    	{
		    	?>
		    		<a href="<?= base_url().'index.php/dashboard/centro_medico/'.$centro ?>" class="btn btn-app btn-yellow btn-xs pull-right" data-tool="tooltip" title="Volver al dashboard de Centro Medico">
			    		<i class="ace-icon fa fa-undo bigger-250"></i>
			    		Centro
			    		<span class="badge badge-warning badge-left"></span>
			    	</a>
			    <?	
		    	}
		    	?>
			</li>	
		</div>
	</div>
</div><!-- /.page-header -->


<!-- ======================================== REGISTRAR VIVIENDA ================================================= -->

<div class="row no-gutters">
	<div class="col-md-12 col-sm-12">
		<form action="<?= base_url().'index.php/censo/store_vivienda' ?>" class="form-horizontal" method="POST">
			<input type="hidden" name="id_registrador" value="<?= $registrador; ?>">
			<div class="form-group">
				<label for="" class="control-label col-md-2 col-sm-2">Tipo Vivienda</label>
				<div class="col-sm-2 col-md-2">
					<label for="casa" class="radio-inline">
						<input type="radio" id="casa" name="tipo_vivienda" value="1" required="">
						Casa
					</label>
				</div>
				<div class="col-sm-2 col-md-2">
					<label for="aparta" class="radio-inline">
						<input type="radio" id="aparta" name="tipo_vivienda" value="0">
						Apartamento
					</label>
				</div>
				<label for="" class="control-label col-md-2 col-sm-2">Dirección</label>
				<div class="col-md-4 col-sm-4">
					<input type="text" class="form-control" name="direccion" required="">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-md-2 col-sm-2">Nº</label>
				<div class="col-md-4 col-sm-4">
					<input type="text" class="form-control" name="nro" required="">
				</div>
				<label for="" class="control-label col-md-2 col-sm-2">Piso</label>
				<div class="col-md-4 col-sm-4">
					<input type="text" class="form-control" name="piso" id="piso" disabled="">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-md-2 col-sm-2">Condición</label>
				<div class="col-md-4 col-sm-4">
					<select name="condicion" id="condicion" class="form-control" required="">
						<option selected="" disabled="">Seleccione</option>
						<option value="Muy buena">Muy buena</option>
						<option value="Buena">Buena</option>
						<option value="Regular">Regular</option>
						<option value="Mala">Mala</option>
						<option value="Muy mala">Muy mala</option>
					</select>
				</div>
				<div class="col-md-3 col-sm-3 col-md-offset-3 col-sm-offset-3">
					<?
		    		if($this->session->userdata('id_permiso') === '9')
		    		{
		    		?>
						<button class="btn btn-purple btn-block">Registrar Vivienda&nbsp;<i class="fa fa-check"></i></button>
					<?
					}
					?>
				</div>
			</div>
		</form>
	</div>	
</div>

<!-- ======================================== TABLA VIVIENDAS ================================================= -->

<div class="row no-gutters">	
	<div class="col-md-12 col-sm-12">
		<table class="table table-bordered table-responsive table-condensed" id="tabla">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Tipo Vivienda</th>
					<th class="text-center">Dirección</th>
					<th class="text-center">Piso</th>
					<th class="text-center">Nª</th>
					<th class="text-center">Condición</th>
					<th class="text-center">Jefes</th>
					<th class="text-center">Ver</th>
				</tr>
			</thead>
			<tbody class="text-center">
				<?
					$con = 1;
					$total = count($data);

					foreach ($data as $row) 
					{
						$eliminar = '';

						$button = '<a href="'.base_url().'index.php/censo/jefe/'.base64_encode($row->id).'/'.base64_encode($total).'" 
									class="btn btn-info btn-sm"
									data-tool="tooltip"
									title="Jefes de Familia">
									<i class="fa fa-eye"></i>
									</a>';
						if($this->session->userdata('id_permiso') === '9')
						{
							if($row->jefes < 1)
							{
								$eliminar =	'<a href="'.base_url().'index.php/censo/vivienda_delete/'.base64_encode($row->id).'" 
												class="btn btn-danger btn-sm eliminar"
												data-tool="tooltip"
												title="Eliminar Vivienda">
												<i class="fa fa-trash"></i>
											</a>';
							}
							else
							{
								$eliminar =	'<a href="#" 
												class="btn btn-danger btn-sm"
												data-tool="tooltip"
												title="No puede eliminar la vivienda porque tiene habitantes"
												disabled="">
												<i class="fa fa-trash"></i>
											</a>';
							}
						}
							
							

						$tipo = $row->tipo_vivienda === 't' ? 'Casa' : 'Apartamento';

						echo 	"<tr>
									<td>{$con}</td>
									<td>{$tipo}</td>
									<td>{$row->direccion}</td>
									<td>{$row->piso}</td>
									<td>{$row->nro}</td>
									<td>{$row->condicion}</td>
									<td><span class='label label-sm label-primary arrowed arrowed-right'>{$row->jefes}</span></td>
									<td>{$button} {$eliminar}</td>
								</tr>";

						$con++;
					}
				?>
			</tbody>
		</table>
	</div>
</div>