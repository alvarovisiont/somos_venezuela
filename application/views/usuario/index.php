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
		<div class="col-md-10 col-sm-10">

		<a href="<?= base_url().'index.php/usuario/index/1'?>" 
		class="btn btn-app btn-<?php echo ($this->session->userdata('tipo_bd')==1)?'primary':'default'?>">
		<i class="ace-icon fa fa-tachometer bigger-250"></i>Default&nbsp;
		</a>
		
			<a href="<?= base_url().'index.php/usuario/index/2'?>" class="btn btn-app btn-<?php echo ($this->session->userdata('tipo_bd')==2)?'primary':'default'?>">
						<i class="ace-icon fa fa-eye bigger-250"></i>
						Admin&nbsp;
			</a>
		</div>


		<div class="col-sm-2 col-md-2">				
					<a href="<?= base_url().'index.php/nuevo_u'?>" class="btn btn-app btn-success">
						<i class="ace-icon fa fa-fire bigger-230"></i>
						+ Usuario&nbsp;
					</a>
		</div>	
    </div>


     
		<br/>
  <div class="row no-gutters">
	<div class="col-xs-12">

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

