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
			<a href="<?= base_url().'index.php/geo/estado'?>" class="btn btn-app btn-primary">
						<i class="ace-icon fa fa-eye bigger-250"></i>
						Estados&nbsp;
			</a>
	
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
					<th class="text-center">Id_estado</th>
					<th class="text-center">Id_municipio</th>
					<th class="text-center">Nombre</th>
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
						  <?php echo $row->id_estado; ?>
						</td>
						<td class="hidden-480">
						  <?php echo $row->id_municipio; ?>
						</td>
						<td class="hidden-480">
						  <?php echo $row->nombre; ?>
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

