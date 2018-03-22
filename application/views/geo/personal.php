<div class="page-header">
	<h1>
		Cuentas
		<small>
			<i class="ace-icon fa fa-angle-double-right"></i>
			Municipios
		</small>
	</h1>
</div><!-- /.page-header -->

<?php //print_r ($this->session->userdata('arr_usuarios'));?>
 <div class="row no-gutters">
 		<div class="col-md-1 col-sm-1">
 		</div>	
		
		<div class="col-md-9 col-sm-9">
 		<li class="text-warning bigger-200 orange">
		 <i class="ace-icon fa fa-circle"></i> Centros Médicos <?php echo $nombre_centro?></li>
		</div>

		<?php if ($this->session->userdata('id_permiso') == 4){ ?>
		<div class="col-md-2 col-sm-2">
			<a href="<?= base_url().'index.php/geo/parroquia'?>" class="btn btn-app btn-primary">
						<i class="ace-icon fa fa-eye bigger-250"></i>
						Parroquia&nbsp;
			</a>
		</div>
		<?php }?>

		<?php if ($this->session->userdata('id_permiso') == 5){ ?>
		<div class="col-md-2 col-sm-2">
			<a href="<?= base_url().'index.php/geo/parroquia/'.$id_municipio_l?>" class="btn btn-app btn-primary">
						<i class="ace-icon fa fa-eye bigger-250"></i>
						Parroquia&nbsp;
			</a>
		</div>
		<?php }?>

		<?php if ($this->session->userdata('id_permiso') == 6){ ?>
		<div class="col-md-2 col-sm-2">
			<a href="<?= base_url().'index.php/geo/index'?>" class="btn btn-app btn-primary">
						<i class="ace-icon fa fa-eye bigger-250"></i>
						C. Médicos&nbsp;
			</a>
		</div>
		<?php }?>

		<?php if ($this->session->userdata('id_permiso') == 7){ ?>

		<div class="col-sm-2 col-md-2">				
					<a href="<?= base_url().'index.php/usuario/create_personal'?>" class="btn btn-app btn-success">
						<i class="ace-icon fa fa-fire bigger-230"></i>
						+ Personal&nbsp;
					</a>
		</div>	
		<?php }?>
		
    </div> 
	<br/>
  <div class="row no-gutters">
	<div class="col-xs-12">

		<table class="table table-bordered table-responsive" id="tabla">
			<thead>
				<tr>
					<th class="text-center">Id</th>
					<th class="text-center">Cedula</th>
					<th class="text-center">Nombre</th>
					<th class="text-center">Apellido</th>
					<th class="text-center">Tipo</th>
					<th class="text-center">Login</th>
					<th class="text-center">Acceso Sistema</th>
					<?php if ($this->session->userdata('id_permiso') == 7){ ?>
					<th class="text-center">Acción</th>
					<?php }?>
				</tr>
			</thead>
			<tbody class="text-center">
				<? foreach ($trabajadores as $row) 
				{ ?>
					<tr>
						<td class="hidden-480">
						  <?php echo $row->id; ?>
						</td>
						<td class="hidden-480">
						  <?php echo $row->cedula; ?>
						</td>
						<td class="hidden-480">
						  <?php echo $row->nombre_p; ?>
						</td>
						<td class="hidden-480">
						  <?php echo $row->apellido_p; ?>
						</td>
						<td class="hidden-480">
						  <?php echo $row->tipo; ?>
						</td>

						<td class="hidden-480">
						  <?php echo $row->cuenta; ?>
						</td>

						<td class="hidden-480">
						  <?php $res = ($row->password_activo == 'f') ? "inactivo.png" : "activo.jpeg";?>
						  <?php $titulo = ($row->password_activo == 'f') ? "Sin Entrada" : "Activo";?>
						   <img src="<?php echo base_url() ?>assets/galerias/sistema/<?php echo $res;?>"  height="35"
						    title='<?php echo $titulo;?>' data-tool='tooltip'/>
						</td>
						
						<?php if ($this->session->userdata('id_permiso') == 7){ ?>

						<td class="hidden-480">
							<span>
								<a href="<?= base_url().'index.php/geo/parroquia/'?><?=$row->id_municipio?>">
									<i class="btn btn-xs no-hover btn-primary fa fa-eye"></i>
									Ver
								</span>
							</a>
						</td>
						<?php }?>

					</tr>
				<?php }
				?>
			</tbody>
		</table>
	</div>
</div>

