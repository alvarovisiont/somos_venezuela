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
			<a href="#" class="btn btn-app btn-primary">
						<i class="ace-icon fa fa-eye bigger-250"></i>
						Estados&nbsp;
			</a>
			<a href="#" class="btn btn-app btn-primary">
						<i class="ace-icon fa fa-eye bigger-250"></i>
						Crear cuenta&nbsp;
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
					<th class="text-center">Id_Estado</th>
					<th class="text-center">Cuenta</th>
					<th class="text-center">Nombre</th>
					<th class="text-center">Acción</th>
				</tr>
			</thead>
			<tbody class="text-center">
				<? foreach ($estados as $row) 
				{ ?>
					<tr>
						<td class="hidden-480">
						  <?php echo $row->id; ?>
						</td>
						<td class="hidden-480">
						  <?php echo $row->id_estado; ?>
						</td>
						<td class="hidden-480">
						  <?php echo $row->id_estado; ?>
						</td>
						<td class="hidden-480">
						  <?php echo $row->nombre; ?>
						</td>
						<td class="hidden-480">
							<?php if ($row->id_estado == 17) { ?>
								<a href="<?= base_url().'index.php/geo/municipio'?>">
									<i class="btn btn-xs no-hover btn-primary fa fa-eye"></i>
									Municipio
								</span>
							</a>
							<?php }?>	
						</td>
					</tr>
				<?php }
				?>
			</tbody>
		</table>
	</div>
</div>

