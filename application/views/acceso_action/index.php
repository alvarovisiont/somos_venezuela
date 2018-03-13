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
						<div class="col-md-6 text-center">
							<h4 class="">Perfiles</h4>
							<br/>
							<button class="btn btn-app btn-danger no-radius show_div" data-type="perfiles">
								<i class="ace-icon fa fa-lock bigger-230"></i>
									Editar
								<span class="badge badge-warning badge-left"><?= $total_perfiles ?></span>
								
							</button>
						</div>
						<div class="col-md-6 text-center">
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
		<form id="form_perfil" action="<?= base_url()."index.php/permiso/guardar_permisos" ?>" method="POST">
			<input type="hidden" id="tipo_perfil" name="tipo_perfil">
			<input type="hidden" id="registros_link" name="registros_link">

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