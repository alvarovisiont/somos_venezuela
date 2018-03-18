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
    <div class="row no-gutters">
		<div class="col-md-12 col-sm-12">
			<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th class="text-center">Municipio</th>
						<th class="text-center">Centros Medicos</th>
						<th class="text-center">Registradores</th>
						<th class="text-center">Doctores</th>
						<th class="text-center">Censados</th>
						<th class="text-center">Ver</th>
					</tr>
				</thead>
				<tbody class="text-center">
					<?
						foreach ($municipio as $row) 
						{
							$button = '<a href="'.base_url().'index.php/dashboard_parroquias'.'" 
										class="btn btn-info btn-sm">
										Ver <i class="fa fa-eyes-open"></i>
										</a>';

							echo 	"<tr>
										<td>{$row->municipio}</td>
										<td>5</td>
										<td>50</td>
										<td>40</td>
										<td>80</td>
										<td>{$button}</td>
									</tr>";
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>