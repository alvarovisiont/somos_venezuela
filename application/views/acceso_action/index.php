<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#">Sistema</a>
		</li>

		<li>
			<a href="#">Configuración</a>
		</li>
		<li class="active">Acciones del Menú</li>
	</ul><!-- /.breadcrumb -->					
</div>

<div class="page-header">
	<h1>
		Dashboard
		<small>
			<i class="ace-icon fa fa-angle-double-right"></i>
			Acciones Menú
		</small>
	</h1>
</div><!-- /.page-header -->

<!-- =============================== Sección principal ==================================== -->

<div class="row no-gutters" id="div_principal">
	<div class="col-md-12 col-sm-12">
		<div class="widget-box">
			<div class="widget-header">
				<h3 class="widget-title">Acciones del Menú</h3>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row no-gutters">
						<div class="col-md-6 col-sm-6">
						<h4 class="">Base de datos</h4>
						<a href="<?= base_url().'index.php/acceso/index/1'?>" 
						class="btn btn-app btn-<?php echo ($this->session->userdata('tipo_bd')==1)?'primary':'default'?>">
						<i class="ace-icon fa fa-tachometer bigger-250"></i>Default&nbsp;
						</a>
						
							<a href="<?= base_url().'index.php/acceso/index/2'?>" class="btn btn-app btn-<?php echo ($this->session->userdata('tipo_bd')==2)?'primary':'default'?>">
										<i class="ace-icon fa fa-eye bigger-250"></i>
										Admin&nbsp;
							</a>
							
							<a href="#" class="btn btn-app btn-<?php echo ($this->session->userdata('tipo_bd')==3)?'primary':'default'?>">
										<i class="ace-icon fa fa-ban bigger-250"></i>
										Bienes&nbsp;
							</a>
						</div>
				    </div>
					<div class="row no-gutters">
						<div class="col-md-offset-4 col-sm-offset-4 col-md-2 col-sm-2 text-center">
							<h4 class="">Perfiles</h4>
							<br/>
							<button class="btn btn-app btn-danger no-radius show_div" data-type="perfiles">
								<i class="ace-icon fa fa-lock bigger-230"></i>
									Editar
								<span class="badge badge-warning badge-left"><?= $total_perfiles ?></span>
								
							</button>
						</div>
						<div class="col-md-2 col-sm-2 text-center">
							<h4 class="">Usuario</h4>
							<br/>
							<button class="btn btn-app btn-danger no-radius show_div" data-type="manuales">
								<i class="ace-icon fa fa-lock bigger-230"></i>
									Editar
								<span class="badge badge-warning badge-left"><?= $total_users ?></span>
								
							</button>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>

<div class="row no-gutters" id="div_oculto" style="display: none;">
	
	<div class="row no-gutters">
		<form id="form_perfil" action="">
			<input type="hidden" id="tipo_perfil" name="tipo_perfil">
			

			<div class="col-md-12 col-sm-12">
				<div class="widget-box">
					<div class="widget-header">
						<h3 class="widget-title">
							Otorgar Permisos&nbsp;<i class="fa fa-lock"></i>
							<button type="button" class="btn btn-fill btn-info show_permissions pull-right">
									Tipo Permisos &nbsp;<i class="fa fa-user"></i>&nbsp;<i class="fa fa-arrow-up"></i>
							</button>
						</h3>
					</div>
					<div class="widget-body">
						<div class="widget-main">
						
							<!-- =============================== Sección Perfiles ==================================== -->
							<div class="row no-gutters">
								<div class="col-md-4 col-sm-4 col-sm-offset-3 col-md-offset-3">
									<label for="" class="control-label">Perfiles</label>
									<select name="perfiles_select" id="perfiles_select" class="form-control">
										
									</select>
								</div>
							</div>
							<div class="row no-gutters" id="div_select_usuarios">
								<div class="col-md-4 col-sm-4 col-sm-offset-3 col-md-offset-3">
									<label for="" class="control-label">Usuario</label>
									<select name="usuario_select" id="usuario_select" class="form-control">
										
									</select>
								</div>
							</div>
							<br/>
							<div class="row no-gutters hidden" id="div_oculto_tablas">
								<div class="col-md-12 col-sm-12">
									<table class="table table-bordered table-condensed table-responsive" id="tabla_acceso" width="100%">
										<thead>
											<tr>
												<th class="text-center">Módulo</th>
												<th class="text-center">Área</th>
												<th class="text-center">Sub Área</th>
												<th class="text-center">Crear</th>
												<th class="text-center">Modificar</th>
												<th class="text-center">Ver</th>
												<th class="text-center">Eliminar</th>
												<th class="text-center">Reporte</th>
												<th class="text-center">Imprimir</th>
												<th class="text-center">Activar</th>
											</tr>
										</thead>
										<tbody class="text-center">
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- =============================== Gift Cargando ==================================== -->

	<div class="row no-gutters loading_gift" id="div_image" style="display: none;">
		<div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
			<div class="">
				<img src="<?= base_url().'assets_sistema/images/gift/cargando.gif' ?>" alt="">
				<br/>
				Cargando...
			</div>
		</div>
	</div>