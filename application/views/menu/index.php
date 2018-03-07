<div class="page-header">
	<h1>
		Dashboard
		<small>
			<i class="ace-icon fa fa-angle-double-right"></i>
			Menú
		</small>
	</h1>
</div><!-- /.page-header -->


<div class="row no-gutters">
	<div class="col-xs-12">
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th class="text-center">Id</th>
					<th class="text-center">Nombre</th>
					<th class="text-center">Id Padre</th>
					<th class="text-center">Tipo</th>
					<th class="text-center">Icono</th>
					<th class="text-center">Ruta</th>
					<th class="text-center">Acción</th>
				</tr>
			</thead>
			<tbody class="text-center">
				<? foreach ($menu as $row) 
				{
					$tipo = '';
					$agregar_area = '';
					$agregar_sub_area = '';

					switch ($row->id_tipo) {
						case 1:
							$tipo = '<span class="badge">Módulo</span>';

							$agregar_area = "<button type='button' class='btn btn-xs btn-info' data-toggle='modal' data-target='#modal_area' data-modulo='".$row->id_padre."' title='Agregar Area'>
								<i class='fa fa-edit'></i> 
							</button>";

						break;
						case 2:
							$tipo = '<span class="badge">Área</span>';

							$agregar_sub_area = "<button type='button' class='btn btn-xs btn-pink' data-toggle='modal' data-target='#modal_sub_area' data-area='".$row->id_padre."' title='Agregar Sub Area'>
								<i class='fa fa-edit'></i>
							</button>";

						break;
						case 3:
							$tipo = '<span class="badge">Sub Area</span>';
						break;
					}

					echo 	"<tr>
								<td>{$row->id}</td>
								<td>{$row->nombre}</td>
								<td>{$row->id_padre}</td>
								<td>{$tipo}</td>
								<td>{$row->icono}</td>
								<td>{$row->ruta}</td>
								<td>{$agregar_area} {$agregar_sub_area}</td>
							";
				}
				?>
			</tbody>
		</table>
	</div>
</div>
		