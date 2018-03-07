<div class="page-header">
	<h1>
		Dashboard
		<small>
			<i class="ace-icon fa fa-angle-double-right"></i>
			Perfil
		</small>
	</h1>
</div><!-- /.page-header -->

<div class="row no-gutters">
	<div class="col-xs-12">

	<button type='button' data-toggle='modal' data-target='#modal_perfil' 
	 title='Agregar Perfil' data-tool='tooltip'>
	 <img src="<?php echo base_url() ?>assets/galerias/iconos/agregar.png" alt="Agregar" height="50"/>
	</button>

	<br>	
	<div class="table-header">
		Perfiles registrados
	</div>	
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th class="text-center">Id</th>
					<th class="text-center">Nombre</th>
					<th class="text-center">Activo</th>
					<th class="text-center">Acción</th>
				</tr>
			</thead>
			<tbody class="text-center">
				<?php foreach ($perfil as $row) 
				{ ?>
					<tr>
						<td class="hidden-480">
						  <?php echo $row->id; ?>
						</td>
						<td class="hidden-480">
						  <?php echo $row->nombre; ?>
						</td>
				     	<td class="hidden-480">
				     	<?php if ($row->activo == 't'){?>	
				     	<span class="label label-sm label-success">Activo</span>
				     	<?php }else{ ?>	
						<span class="label label-sm label-warning">Inactivo</span>
						<?php } ?>	
						</td>
						<td class="hidden-480">
						
						</td>
					</tr>	
				<?php }?>	
			</tbody>
		</table>
	</div>
</div>

<div id="modal_perfil" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header modalHeader">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Agregar Perfil</h4>
            </div>
            <form action="<?php echo base_url()?>index.php/perfil/store" class="form-horizontal" id="form_perfil" method="POST">
	            <div class="modal-body">
					
	            	<div class="form-group">
	            		<label for="nombre" class="control-label col-md-2 col-sm-2">Nombre Perfil</label>
	            		<div class="col-md-4 col-sm-4">
	            			<input type="text" id="nombre" name="nombre" required="" class="form-control" value="">
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





		

			
