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
		<?
			if($mensaje)
			{
				echo '<p class="alert alert-'.$clase.'">'.$mensaje.'</p>';
			}
		?>
	
		<div class="row no-gutters">

		<div class="col-xs-offset-9 col-xs-3 text-center">
				<a href="<?= base_url().'index.php/menu/actualizar' ?>" class="btn btn-success">Actualizar Menu&nbsp;<i class="fa fa-plus"></i></a>
			</div>

        </div>
        <br/>
		<div class="row no-gutters">	

		<div class="col-xs-offset-9 col-xs-3 text-center">
				<a href="<?= base_url().'index.php/menu/create' ?>" class="btn btn-purple">Agregar Módulo&nbsp;<i class="fa fa-plus"></i></a>
			</div>
		</div>
		<br/>
		<table class="table table-bordered table-responsive" id="tabla">
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

					$editar_area     = '';
					$editar_sub_area = '';
					$editar_modulo   = '';
					
					$eliminar_area     = '';
					$eliminar_sub_area = '';
					$eliminar_modulo   = '';

					$title = "";
					$disabled="";


					switch ($row->id_tipo) {
						case 1:
							$tipo = '<span class="badge">Módulo</span>';

							if($row->link === 't')
							{
								$disabled="disabled=''";
								$title = "No te vuelvas loco que no puedes agregar más!";
							}
							else
							{
								$title="Agregar Área";
							}

							$agregar_area = "<button type='button' class='btn btn-xs btn-info' data-toggle='modal' data-target='#modal_area' data-modulo='".$row->id."' title='".$title."' $disabled
								data-tool='tooltip'>
								<i class='fa fa-plus'></i> 
							</button>";

							$editar_modulo = "<a href='".base_url().'index.php/menu/edit/'.$row->id."' class='btn btn-xs btn-warning' title='Editar Modulo'
								data-tool='tooltip'>
								<i class='fa fa-edit'></i> 
							</a>";

							$eliminar_modulo = "<button type='button' class='btn btn-xs btn-danger eliminar' title='Eliminar Módulo'
								data-eliminar='".$row->id."'
								data-tool='tooltip'>
								<i class='fa fa-trash'></i> 
							</button>";

						break;
						case 2:
							$tipo = '<span class="badge">Área</span>';

							if($row->link === 't')
							{
								$disabled="disabled=''";
								$title = "No te vuelvas loco que no puedes agregar más!";
							}
							else
							{
								$title="Agregar Sub Area";
							}

							$agregar_sub_area = "<button type='button' class='btn btn-xs btn-info' data-toggle='modal' data-target='#modal_sub_area' data-area='".$row->id."' title='".$title."' $disabled
								data-tool='tooltip'
								>
								<i class='fa fa-plus'></i>
							</button>";

							$editar_area = "<button type='button' class='btn btn-xs btn-warning' data-toggle='modal' data-target='#modal_area' data-modulo='".$row->id_padre."' title='Editar Area'
								data-tool='tooltip'
								data-edit='".$row->id."'
								data-nombre='".$row->nombre."'
								data-link='".$row->link."'
								data-ruta='".$row->ruta."'
								>
								<i class='fa fa-edit'></i>
							</button>";

							$eliminar_area = "<button type='button' class='btn btn-xs btn-danger eliminar' title='Eliminar Area'
								data-tool='tooltip'
								data-eliminar='".$row->id."'
								>
								<i class='fa fa-trash'></i>
							</button>";

						break;
						case 3:
							$tipo = '<span class="badge">Sub Area</span>';

							$agregar_sub_area = "<button type='button' class='btn btn-xs btn-default' data-toggle='modal' data-target='#modal_sub_area' data-area='".$row->id."' title='No te vuelvas loco que no puedes agregar más!'
								data-tool='tooltip'
								disabled=''
								>
								<i class='fa fa-plus'></i>
							</button>";


							$editar_sub_area = "<button type='button' class='btn btn-xs btn-warning' data-toggle='modal' data-target='#modal_sub_area' data-area='".$row->id_padre."' title='Editar Sub Area'
								data-tool='tooltip'
								data-edit='".$row->id."'
								data-nombre='".$row->nombre."'
								data-ruta='".$row->ruta."'
								>
								<i class='fa fa-edit'></i>
							</button>";

							$eliminar_sub_area = "<button type='button' class='btn btn-xs btn-danger eliminar' title='Eliminar Sub Area'
								data-tool='tooltip'
								data-eliminar='".$row->id."'
								>
								<i class='fa fa-trash'></i>
							</button>";
						break;
					}

					echo 	"<tr>
								<td>{$row->id}</td>
								<td>{$row->nombre}</td>
								<td>{$row->id_padre}</td>
								<td>{$tipo}</td>
								<td><i class='fa ".$row->icono."'></i></td>
								<td>{$row->ruta}</td>
								<td>{$agregar_area} {$agregar_sub_area} {$editar_modulo} {$editar_area} {$editar_sub_area}  {$eliminar_modulo} {$eliminar_area} {$eliminar_sub_area}</td>
							";
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<div id="modal_area" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header modalHeader">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Agregar/Editar Área</h4>
            </div>
            <form action="" class="form-horizontal" id="form_area" method="POST">
	            <div class="modal-body">
					<input type="hidden" id="id_padre_area" name="id_padre">
					<input type="hidden" name="id_tipo" value="2">
	            	<div class="form-group">
	            		<label for="nombre" class="control-label col-md-2 col-sm-2">Nombre Área</label>
	            		<div class="col-md-4 col-sm-4">
	            			<input type="text" id="nombre_area" name="nombre" required="" class="form-control" value="">
	            		</div>
	            		<div class="col-md-3 col-sm-3">
	            			<label for="link" class="radio-inline">
	            				<input type="radio" id="link" name="link" value="1">
	            				Link
	            			</label>
	            		</div>
	            		<div class="col-md-3 col-sm-3">
	            			<label for="sub" class="radio-inline">
	            				<input type="radio" id="sub" name="link" value="0">
	            				Sub Menú
	            			</label>
	            		</div>
	            	</div>
	            	<div class="form-group" id="ruta_oculta" style="display: none;">
	            		<div class="form-group">
	            			<label for="ruta" class="control-label col-md-2 col-sm-2">Ruta</label>
	            			<div class="col-md-4 col-sm-4">
	            				<input type="text" id="ruta_area" name="ruta" class="form-control" value="">
	            			</div>
	            		</div>
	            	</div>

	            </div><!-- fin modal-body -->
	            <div class="modal-footer">
	                <button type="submit" class="btn btn-pink">Grabar</button>
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	            </div>
            </form>
        </div><!-- fin modal-content -->
    </div><!-- fin modal-dialog -->
</div> <!-- fin modal -->

<div id="modal_sub_area" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header modalHeader">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Crear/Editar Sub Área</h4>
            </div>
            <form action="" class="form-horizontal" method="POST" id="form_sub_area">
            	
           	 	<div class="modal-body">
						<input type="hidden" name="id_tipo" value="3">
						<input type="hidden" name="link" value="true">
						<input type="hidden" id="id_padre_sub_area" name="id_padre">

		            	<div class="form-group">
		            		<label for="nombre" class="control-label col-md-2 col-sm-2">Nombre Sub Área</label>
		            		<div class="col-md-4 col-sm-4">
		            			<input type="text" id="nombre_sub_area" name="nombre" required="" class="form-control" value="">
		            		</div>
		            		<label for="nombre" class="control-label col-md-2 col-sm-2">Ruta</label>
		            		<div class="col-md-4 col-sm-4">
		            			<input type="text" id="ruta_sub_area" name="ruta" required="" class="form-control" value="">
		            		</div>
		            	</div>
            	</div><!-- fin modal-body -->
	            <div class="modal-footer">
	                <button type="submit" class="btn btn-pink">Grabar</button>
	                <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
	            </div>
            </form>
        </div><!-- fin modal-content -->
    </div><!-- fin modal-dialog -->
</div> <!-- fin modal -->

