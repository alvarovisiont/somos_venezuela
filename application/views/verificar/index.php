<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#">Sistema</a>
		</li>

		<li>
			<a href="#">Medico</a>
		</li>
		<li class="active">Verificar</li>
	</ul><!-- /.breadcrumb -->					
</div>

<div class="row no-gutters">
	<div class="col-md-12 col-sm-12">
		<table class="table table-responsive table-bordered">
			<thead>
				<tr>
					<th class="text-center">Nombre</th>
					<th class="text-center">Cédula</th>
					<th class="text-center">Teléfono</th>
					<th class="text-center">Dirección</th>
					<th class="text-center">Condición</th>
					<th class="text-center">Verificar</th>
				</tr>
			</thead>
			<tbody class="text-center">
				<?
					foreach ($data as $row) 
					{
						echo "	<tr>
									<td>{$row->nombre} {$row->apellido}</td>
									<td>{$row->cedula}</td>
									<td>{$row->telefono}</td>
									<td>{$row->direccion}</td>
									<td>{$row->condicion}</td>
									<td>
									</td>
								</tr>"
					}
				?>
			</tbody>
		</table>
	</div>
</div>