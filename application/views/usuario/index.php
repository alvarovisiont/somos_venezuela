<div class="page-header">
	<h1>
		Dashboard
		<small>
			<i class="ace-icon fa fa-angle-double-right"></i>
			Menú
		</small>
	</h1>
</div><!-- /.page-header -->

<?php //print_r ($this->session->userdata('arr_usuarios'));?>

<div class="row no-gutters">
	<div class="col-xs-12">
	    <div class="row no-gutters">	

		<div class="col-xs-offset-9 col-xs-3 text-center">
				<a href="<?= base_url().'index.php/nuevo_u' ?>" class="btn btn-purple">Usuario<i class="fa fa-plus"></i></a>
			</div>
		</div>
		<br/>
		<table class="table table-bordered table-responsive" id="tabla">
			<thead>
				<tr>
					<th class="text-center">Id</th>
					<th class="text-center">Login</th>
					<th class="text-center">Correo</th>
					<th class="text-center">Permiso</th>
					<th class="text-center">Estatus</th>
					<th class="text-center">Correo Activo</th>
					<th class="text-center">Acceso Sistema</th>
					<th class="text-center">Fecha Acceso</th>
					<th class="text-center">Acción</th>
				</tr>
			</thead>
			<tbody class="text-center">
				<? foreach ($usuario as $row) 
				{ ?>
					<tr>
						<td class="hidden-480">
						  <?php echo $row->id; ?>
						</td>
						<td class="hidden-480">
						  <?php echo $row->login; ?>
						</td>
						<td class="hidden-480">
						  <?php echo $row->email; ?>
						</td>
						<td class="hidden-480">
						  <?php echo $row->permiso; ?>
						</td>

						<td class="hidden-480">
						  <?php $res = ($row->usuario_activo == 'f') ? "denegado.png" : "activo.jpeg";?>
						  <?php $titulo = ($row->usuario_activo == 'f') ? "Acceso Denegado" : "Activado";?>
						 
						   <?php 
                           $label = "<img src='".base_url()."assets/galerias/sistema/".$res."'  
						   height='35' title='".$titulo."' data-tool='tooltip'/>";
                           echo anchor(site_url('usuario/usuario_activo/'.$row->id.'/'.$row->usuario_activo), $label, 'onclick="javasciprt: 
                           	   return confirm(\'Esta seguro de Cambiarle el estatus?\')"');
                           ?>
						</td>
						<td class="hidden-480">
						  <?php $res = ($row->correo_activo == 'f') ? "aviso.png" : "activo.jpeg";?>
						  <?php $titulo = ($row->correo_activo == 'f') ? "Sin Verificar" : "Verificado";?>
						   <img src="<?php echo base_url() ?>assets/galerias/sistema/<?php echo $res;?>"  height="35" title='<?php echo $titulo;?>' data-tool='tooltip'/>
						</td>
						<td class="hidden-480">
						  <?php $res = ($row->password_activo == 'f') ? "inactivo.png" : "activo.jpeg";?>
						  <?php $titulo = ($row->password_activo == 'f') ? "Sin Entrada" : "Activo";?>
						   <img src="<?php echo base_url() ?>assets/galerias/sistema/<?php echo $res;?>"  height="35"
						    title='<?php echo $titulo;?>' data-tool='tooltip'/>
						</td>
						<td class="hidden-480">
						   <?=invierte_date_time($row->fecha_acceso)?>
						</td>
				     
						<td class="hidden-480">
						
						</td>
					</tr>
				<?php }
				?>
			</tbody>
		</table>
	</div>
</div>

