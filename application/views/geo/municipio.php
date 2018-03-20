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
		 <i class="ace-icon fa fa-circle"></i>Estado Sucre  <i class="ace-icon fa fa-share green bigger-70"></i> Municipios Todos</li></li>
		</div>
																
		<div class="col-md-2 col-sm-2">
			<a href="<?= base_url().'index.php/geo/parroquia'?>" class="btn btn-app btn-primary">
						<i class="ace-icon fa fa-eye bigger-250"></i>
						Parroquia&nbsp;
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
					<th class="text-center">Municipio</th>
					<th class="text-center">Login</th>
					<th class="text-center">Acceso Sistema</th>
					<th class="text-center">Acción</th>
				</tr>
			</thead>
			<tbody class="text-center">
				<? foreach ($municipio as $row) 
				{ ?>
					<tr>
						<td class="hidden-480">
						  <?php echo $row->id; ?>
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
								<a href="<?= base_url().'index.php/geo/parroquia/'?><?=$row->id_municipio?>">
									<i class="btn btn-xs no-hover btn-primary fa fa-eye"></i>
									Parroquia
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

