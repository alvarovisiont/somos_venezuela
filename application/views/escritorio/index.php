<div class="page-header text-center">
	<li class="text-purlple bigger-200 purple">
	 	<i class="ace-icon fa fa-circle"></i>
	 	Sala Situacional: <b>Estado Sucre</b>
	</li>
</div><!-- /.page-header -->

<div class="row no-gutters">
    <div class="col-md-12 col-sm-12 pull-right">
    	<button class="btn btn-app btn-purple btn-block">
    		<i class="ace-icon fa fa-medkit bigger-250"></i>
    		Centros
    		<span class="badge badge-warning badge-left"><?= 5 ?></span>
    	</button>	
    	<button class="btn btn-app btn-purple">
    		<i class="ace-icon fa fa-user bigger-250"></i>
    		Registrador
    		<span class="badge badge-warning badge-left"><?= 50 ?></span>
    	</button>	
    	<button class="btn btn-app btn-purple">
    		<i class="ace-icon fa fa-user-md bigger-250"></i>
    		Doctores
    		<span class="badge badge-warning badge-left"><?= 40 ?></span>
    	</button>	
    	<button class="btn btn-app btn-purple">
    		<i class="ace-icon fa fa-users bigger-250"></i>
    		Censados
    		<span class="badge badge-warning badge-left"><?= 80 ?></span>
    	</button>	
    </div>
</div>
<br/><br/>
<div class="row no-gutters">	
	<div class="col-md-12 col-sm-12">
		<table class="table table-bordered table-responsive" id="tabla">
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
					foreach ($data as $row) 
					{
						$button = '<a href="'.base_url().'index.php/dashboard/municipio/'.base64_encode($row->id_municipio).'" 
									class="btn btn-info btn-sm"
									data-tool="tooltip"
									title="Ver datos del municipio">
									Ver <i class="fa fa-eye"></i>
									</a>';

						echo 	"<tr>
									<td>{$row->nombre}</td>
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