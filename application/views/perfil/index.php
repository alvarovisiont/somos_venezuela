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
	
	<div>
	   <a title="Agregar Perfil" href="#">
	   	<img src="<?php echo base_url() ?>assets/galerias/iconos/agregar.png" alt="Agregar" height="50"/></a>

	</div>
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
		

			
