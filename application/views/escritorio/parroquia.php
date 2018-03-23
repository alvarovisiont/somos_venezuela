<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#">Sistema</a>
		</li>

		<li>
			<a href="#">Escritorio</a>
		</li>
		<li class="active">Parroquias</li>
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
    <div class="col-md-12 col-sm-12 pull-right">
    	<button class="btn btn-app btn-purple" data-toggle="modal" data-target="#modal_registradores">
    		<i class="ace-icon fa fa-user bigger-250"></i>
    		Registrador
    		<span class="badge badge-warning badge-left"><?= $totales->registradores ?></span>
    	</button>	
    	<button class="btn btn-app btn-purple" data-toggle="modal" data-target="#modal_medicos">
    		<i class="ace-icon fa fa-user-md bigger-250"></i>
    		Doctores
    		<span class="badge badge-warning badge-left"><?= $totales->medicos ?></span>
    	</button>	
    	<button class="btn btn-app btn-purple" data-toggle="modal" data-target="#modal_censados_municipio">
    		<i class="ace-icon fa fa-users bigger-250"></i>
    		Censados
    		<span class="badge badge-warning badge-left"><?= $totales->censados ?></span>
    	</button>	
    	<?
    	if($this->session->userdata('id_permiso') >= '4' &&  $this->session->userdata('id_permiso') <= '5')
    	{
    	?>
    		<a href="<?= base_url().'index.php/dashboard/municipio/'.$municipio ?>" class="btn btn-app btn-pink pull-right" data-tool="tooltip" title="Volver al dashboard de Municipios">
	    		<i class="ace-icon fa fa-undo bigger-250"></i>
	    		Municipio
	    		<span class="badge badge-warning badge-left"></span>
	    	</a>
	    <?	
    	}
    	?>
    </div>
</div>
<br/><br/>
<div class="row no-gutters">	
	<div class="col-md-12 col-sm-12">
		<table class="table table-bordered table-responsive" id="tabla">
			<thead>
				<tr>
					<th class="text-center">Centro Medicos</th>
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
						$button = '<a <a href="'.base_url().'index.php/dashboard/centro_medico/'.base64_encode($row->id).'" 
									class="btn btn-info btn-sm"
									data-tool="tooltip"
									title="Ver datos del Centro Médico">
									Ver <i class="fa fa-eye"></i>
									</a>';

						echo 	"<tr>
									<td>{$row->nombre}</td>
									<td>{$row->registradores}</td>
									<td>{$row->medicos}</td>
									<td>{$row->censados}</td>
									<td>{$button}</td>
								</tr>";
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<div id="modal_registradores" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header modalHeader">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title text-center">Registradores de la Parroquia&nbsp;<i class="fa fa-hospital-o"></i></h4>
            </div>
            <div class="modal-body">
            	<div class="row no-gutters">
            		<div class="col-sm-12 col-md-12">
            			<table class="table table-bordered table-responsive" id="tabla_registradores">
		            		<thead>
		            			<tr>
		            				<th class="text-center">Nombre</th>
		            				<th class="text-center">Dirección</th>
		            				<th class="text-center">Teléfono</th>
		            				<th class="text-center">Correo</th>
		            				<th class="text-center">Centro Medico</th>
		            			</tr>
		            		</thead>
		            		<tbody class="text-center">
		            			
		            		</tbody>
		            	</table>
            		</div>
            	</div>
            </div><!-- fin modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- fin modal-content -->
    </div><!-- fin modal-dialog -->
</div> <!-- fin modal -->

<div id="modal_medicos" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header modalHeader">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title text-center">Medicos de la Parroquia&nbsp;<i class="fa fa-hospital-o"></i></h4>
            </div>
            <div class="modal-body">
            	<div class="row no-gutters">
            		<div class="col-sm-12 col-md-12">
            			<table class="table table-bordered table-responsive" id="tabla_medicos_y_medicas">
		            		<thead>
		            			<tr>
		            				<th class="text-center">Nombre</th>
		            				<th class="text-center">Dirección</th>
		            				<th class="text-center">Teléfono</th>
		            				<th class="text-center">Correo</th>
		            				<th class="text-center">Centro Medico</th>
		            			</tr>
		            		</thead>
		            		<tbody class="text-center">
		            			
		            		</tbody>
		            	</table>
            		</div>
            	</div>
            </div><!-- fin modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- fin modal-content -->
    </div><!-- fin modal-dialog -->
</div> <!-- fin modal -->

<div id="modal_censados_municipio" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 100%">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header modalHeader">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title text-center">Censados de la Parroquia&nbsp;<i class="fa fa-hospital-o"></i></h4>
            </div>
            <div class="modal-body">
            	<div class="row no-gutters">
            		<div class="col-sm-12 col-md-12">
            			<table class="table table-bordered table-responsive" id="tabla_censados">
		            		<thead>
		            			<tr>
		            				<th class="text-center">Nombre</th>
		            				<th class="text-center">Cédula</th>
		            				<th class="text-center">Teléfono</th>
		            				<th class="text-center">Dirección</th>
		            				<th class="text-center">Pensionado</th>
		            				<th class="text-center">Embarazada</th>
		            				<th class="text-center">Verificado</th>
		            				<th class="text-center">Condición</th>
		            				<th class="text-center">Registrador</th>
		            			</tr>
		            		</thead>
		            		<tbody class="text-center">
		            			
		            		</tbody>
		            	</table>
            		</div>
            	</div>
            </div><!-- fin modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- fin modal-content -->
    </div><!-- fin modal-dialog -->
</div> <!-- fin modal -->



<!-- =============================== Gift Cargando ==================================== -->

	<div class="row no-gutters loading_gift" id="div_image" style="display: none;">
		<div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
			<div class="">
				<img src="<?= base_url().'assets_sistema/images/gift/cargando.gif' ?>" alt="">
				<br/>
				Cargando...
			</div>
		</div>
	</div>