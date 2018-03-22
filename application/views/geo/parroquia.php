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
		

 		<div class="col-md-1 col-sm-1">

 		</div>	
		
		<div class="col-md-8 col-sm-8">
 		<li class="text-warning bigger-200 orange">
		 <i class="ace-icon fa fa-circle"></i>Municipio <?php echo $nombre_municipio?>
		 <i class="ace-icon fa fa-share green bigger-70"></i>  Parroquia Todas</li></li>
		</div>

 		<?php if ($this->session->userdata('id_permiso') == 4){ ?>

		<div class="col-md-1 col-sm-1">
			<a href="<?= base_url().'index.php/geo/municipio/17'?>" class="btn btn-app btn-primary">
						<i class="ace-icon fa fa-eye bigger-250"></i>
						Municipios&nbsp;
			</a>
		</div>

		<?php }?>

		<?php if ($this->session->userdata('id_permiso') == 4){ ?>

		<div class="col-md-1 col-sm-1">
			<a href="<?= base_url().'index.php/geo/centro_medico'?>" class="btn btn-app btn-primary">
						<i class="ace-icon fa fa-eye bigger-250"></i>
						C. Médicos&nbsp;
			</a>
		</div>

		<?php }?>

		<?php if ($this->session->userdata('id_permiso') == 5){ ?>

		<div class="col-md-1 col-sm-1">
			<a href="<?= base_url().'index.php/geo/centro_medico/'.$id_municipio?>" class="btn btn-app btn-primary">
						<i class="ace-icon fa fa-eye bigger-250"></i>
						C. Médicos&nbsp;
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
					<th class="text-center">Municipio</th>
					<th class="text-center">Parroquia</th>
					<th class="text-center">Login</th>
					<th class="text-center">Acceso Sistema</th>
					<th class="text-center">Acciones</th>
				</tr>
			</thead>
			<tbody class="text-center">
				<? foreach ($parroquia as $row) 
				{ ?>
					<tr>
						<td class="hidden-480">
						  <?php echo $row->id; ?>
						</td>
						<td class="hidden-480">
						  <?php echo $row->municipio; ?>
						</td>
						
						<td class="hidden-480">
						  <?php echo $row->nombre; ?>
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

						<td class="hidden-480">
								<a href="<?= base_url().'index.php/geo/centro_medico/'.$row->id_municipio.'/'.$row->id_parroquia?>">
									<i class="btn btn-xs no-hover btn-primary fa fa-eye"></i>
									Centros Médicos
								</span>
							</a>
						</td>
					</tr>
				<?php }
				?>
			</tbody>
		</table>
	</div>
</div>

