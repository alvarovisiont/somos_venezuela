<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#">Sistema</a>
		</li>

		<li>
			<a href="#">Escritorio</a>
		</li>
		<li class=""><a href="#">Parroquias</a></li>
		<li class="active">Centros Medicos</li>
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
    	<button class="btn btn-app btn-purple" data-target="#modal_censados" data-toggle="modal" data-centro="<?= $centro ?>">
    		<i class="ace-icon fa fa-users bigger-250"></i>
    		Censados
    		<span class="badge badge-warning badge-left"><?= $totales->censados ?></span>
    	</button>	

    	<?
    	if($this->session->userdata('id_permiso') >= '4' &&  $this->session->userdata('id_permiso') <= '6')
    	{
	    ?>
	    		<a href="<?= base_url().'index.php/dashboard/parroquia/'.$municipio.'/'.$parroquia ?>" class="btn btn-app btn-pink pull-right" data-tool="tooltip" title="Volver al dashboard de Parroquia">
		    		<i class="ace-icon fa fa-undo bigger-250"></i>
		    		Parroquia
		    		<span class="badge badge-warning badge-left"></span>
		    	</a>
	    <?	
		}
		?>

    	<? 
    	if($this->session->userdata('id_permiso') === '7')
    	{
    	?>
			<button class="btn btn-app btn-primary pull-right" data-tool="tooltip" title="Agregar Estructura"
				data-toggle="modal" data-target="#modal_estructura">
				<i class="ace-icon fa fa-user-plus bigger-250"></i>
				Estructura
			</button>
    	<?
    	}
    	?>

    	<button class="btn btn-app btn-success pull-right" data-tool="tooltip" title="Mostrar Estructura" id="btn_mostrar_estructura">
    		<i class="ace-icon fa fa-user bigger-250"></i>
    		Estructura
    		<span class="badge badge-warning badge-left"><?= count($estructura) ?></span>
    	</button>
    	<button class="btn btn-app btn-success pull-right" data-tool="tooltip" title="Mostrar Tabla" id="btn_mostrar_tabla" style="display: none">
    		<i class="ace-icon fa fa-list bigger-250"></i>
    		Tabla
    		<span class="badge badge-warning badge-left"><?= count($data) ?></span>
    	</button>	
    </div>
</div>
<br/><br/>

<!-- ==================================== TABLA CENSO =================================================== -->

<div class="row no-gutters" id="div_tabla">	
	<div class="col-md-12 col-sm-12">
		<table class="table table-bordered table-responsive" id="tabla">
			<thead>
				<tr>
					<th class="text-center">Nombre</th>
					<th class="text-center">Tipo</th>
					<th class="text-center">Censados</th>
					<th class="text-center">Verificados</th>
				</tr>
			</thead>
			<tbody class="text-center">
				<?
					foreach ($data as $row) 
					{

						$registrados = 0;
						$verificados = 0;

						$registrados = $row->tipo === 'Registrador' ? $row->contados : $registrados;

						$verificados = $row->tipo === 'Medico' ? $row->contados : $verificados;
						$button = '';
							

						echo 	"<tr>
									<td>{$row->nombre}</td>
									<td>{$row->tipo}</td>
									<td>{$registrados}</td>
									<td>{$verificados}</td>
								</tr>";
					}
				?>
			</tbody>
		</table>
	</div>
</div>

<!-- ==================================== TABLA ESTRUCTURA =================================================== -->

<div class="row no-gutters" id="div_estructura" style="display: none">
	<div class="col-md-12 col-sm-12">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th class="text-center">Cédula</th>
					<th class="text-center">Nombre</th>
					<th class="text-center">Apellido</th>
					<th class="text-center">Teléfono</th>
					<th class="text-center">Correo</th>
					<th class="text-center">Cargo</th>
					<th class="text-center">Acción</th>
				</tr>
			</thead>
			<tbody class="text-center">
				<?
					foreach ($estructura as $row) 
					{
						$edit = '';
						$eliminar = '';

						if($this->session->userdata('id_permiso') === '7')
						{
							$edit = '<button class="btn btn-xs btn-warning editar" data-tool="tooltip" title="Editar Registro"
									data-id="'.$row->id.'"
									data-nombre="'.$row->nombre.'"
									data-apellido="'.$row->apellido.'"
									data-cedula="'.$row->cedula.'"
									data-telefono="'.$row->telefono.'"
									data-email="'.$row->email.'"
									data-cargo="'.$row->cargo.'"
									>
										<i class="fa fa-edit"></i>
									</button>';
							
							$eliminar = '<button class="btn btn-xs btn-purple eliminar" data-tool="tooltip" title="Eliminar Registro"
											data-id="'.$row->id.'"
											data-centro="'.$centro.'">
											<i class="fa fa-trash"></i>
										</button>';
						}
							

						echo "	<tr>
									<td>{$row->cedula}</td>
									<td>{$row->nombre}</td>
									<td>{$row->apellido}</td>
									<td>{$row->telefono}</td>
									<td>{$row->email}</td>
									<td><span class='label label-lg label-yellow arrowed-in arrowed-in-right'>{$row->cargo}</span></td>
									<td>{$edit} {$eliminar}</td>
								</tr>";
					}
				?>
			</tbody>
		</table>
	</div>
</div>

<!-- ==================================== MODALS ESTRUCTURA =================================================== -->

<div id="modal_estructura" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header modalHeader">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Agregar Integrante&nbsp;<i class="fa fa-user-plus"></i></h4>
            </div>
            <form action="<?= base_url().'index.php/censo/store_estructura' ?>" class="form-horizontal" id="form_estructura"
            	method="POST">
	            <div class="modal-body">
	            	<input type="hidden" name="id_centro" value="<?= $centro ?>">
	            	<div class="form-group">
	            		<label for="cedula" class="control-label col-md-2 col-sm-2">Cédula</label>
	            		<div class="col-md-4 col-sm-4">
	            			<input type="number" name="cedula" required="" class="form-control" value="">
	            		</div>
	            		<label for="" class="col-md-2 col-sm-2 control-label">Nombre</label>
	            		<div class="col-md-4 col-sm-4">
	            			<input type="text" name="nombre" class="form-control" required="">
	            		</div>
	            		
	            	</div>
	            	<div class="form-group">
	            		<label for="" class="col-md-2 col-sm-2 control-label">Apellido</label>
	            		<div class="col-md-4 col-sm-4">
	            			<input type="text" name="apellido" class="form-control" required="">
	            		</div>
	            		<label for="telefono" class="control-label col-md-2 col-sm-2">Teléfono</label>
	            		<div class="col-md-4 col-sm-4">
	            			<input type="text" name="telefono" required="" class="form-control input-mask-phone" value="">
	            		</div>
	            	</div>
	            	<div class="form-group">
	            		<label for="email" class="control-label col-md-2 col-sm-2">Correo</label>
	            		<div class="col-md-4 col-sm-4">
	            			<input type="text" name="email" class="form-control">
	            		</div>
	            		<label for="cargo" class="control-label col-md-2 col-sm-2">Cargo</label>
	            		<div class="col-md-4 col-sm-4">
	            			<input type="text" name="cargo" required="" class="form-control">
	            		</div>
	            	</div>
	            </div><!-- fin modal-body -->
	            <div class="modal-footer">
	                <button type="submit" class="btn btn-pink" id="btn_guardar">Grabar</button>
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	            </div>
	        </form>
        </div><!-- fin modal-content -->
    </div><!-- fin modal-dialog -->
</div> <!-- fin modal -->

<div id="modal_editar" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header modalHeader">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Editar Integrante&nbsp;<i class="fa fa-pencil"></i></h4>
            </div>
            <form action="<?= base_url().'index.php/censo/edit_estructura' ?>" class="form-horizontal" id="form_estructura_edit"
            	method="POST">
	            <div class="modal-body">
	            	<input type="hidden" name="id_centro" value="<?= $centro ?>">
	            	<input type="hidden" id="id_edit" name="id_edit" value="">
	            	<input type="hidden" name="updatedat" value="<?= date('Y-m-d',strtotime('-4 hour')) ?>">
	            	<div class="form-group">
	            		<label for="cedula" class="control-label col-md-2 col-sm-2">Cédula</label>
	            		<div class="col-md-4 col-sm-4">
	            			<input type="number" id="cedula_estruc" name="cedula" required="" class="form-control" value="">
	            		</div>
	            		<label for="" class="col-md-2 col-sm-2 control-label">Nombre</label>
	            		<div class="col-md-4 col-sm-4">
	            			<input type="text" name="nombre" id="nombre_estruc" class="form-control" required="">
	            		</div>
	            		
	            	</div>
	            	<div class="form-group">
	            		<label for="" class="col-md-2 col-sm-2 control-label">Apellido</label>
	            		<div class="col-md-4 col-sm-4">
	            			<input type="text" name="apellido" id="apellido_estruc" class="form-control" required="">
	            		</div>
	            		<label for="telefono" class="control-label col-md-2 col-sm-2">Teléfono</label>
	            		<div class="col-md-4 col-sm-4">
	            			<input type="text" id="telefono_estruc" name="telefono" required="" class="form-control input-mask-phone" value="">
	            		</div>
	            	</div>
	            	<div class="form-group">
	            		<label for="email" class="control-label col-md-2 col-sm-2">Correo</label>
	            		<div class="col-md-4 col-sm-4">
	            			<input type="text" id="email_estruc" name="email" class="form-control">
	            		</div>
	            		<label for="cargo" class="control-label col-md-2 col-sm-2">Cargo</label>
	            		<div class="col-md-4 col-sm-4">
	            			<input type="text" id="cargo_estruc" name="cargo" required="" class="form-control">
	            		</div>
	            	</div>
	            </div><!-- fin modal-body -->
	            <div class="modal-footer">
	                <button type="submit" class="btn btn-pink" id="btn_guardar">Grabar</button>
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	            </div>
	        </form>
        </div><!-- fin modal-content -->
    </div><!-- fin modal-dialog -->
</div> <!-- fin modal -->

<!-- MODAL CENSADOS -->

<div id="modal_censados" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 100%">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header modalHeader">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title text-center">Censados del Centro Medico&nbsp;<i class="fa fa-users"></i></h4>
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

<!-- =============================== MODAL CAMBIAR CONTRASEÑA ==================================== -->
	
	<div id="modal_constraseña" class="modal fade" role="dialog" data-backdrop="static">
	    <div class="modal-dialog">
	        <!-- Modal content-->
	        <div class="modal-content">
	            <div class="modal-header modalHeader">
	                <h4 class="modal-title">Cambiar Contraseña por Defecto&nbsp;<i class="fa fa-pencil"></i></h4>
	            </div>
	            <form action="<?= base_url().'index.php/usuario/cambiar_contra' ?>" id="form_cambiar_contraseña" method="POST">
		            <div class="modal-body">
		            	<div class="row no-gutters">
		            		<div class="form-group">
			            		<label for="" class="control-label">Contraseña</label>
			            		<input type="password" class="form-control" name="contraseña" id="contraseña">
			            	</div>
			            	<div class="form-group">
			            		<label for="" class="control-label">Nueva Contraseña</label>
			            		<input type="password" class="form-control" name="nueva_contraseña" id="nueva_contraseña">
			            	</div>
		            	</div>
		            </div><!-- fin modal-body -->
		            <div class="modal-footer">
		                <button type="submit" class="btn btn-success">Cambiar&nbsp;<i class="fa fa-thumbs-up"></i></button>
		            </div>
	            </form>
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