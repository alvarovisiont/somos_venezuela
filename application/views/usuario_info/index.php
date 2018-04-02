<div id="user-profile-2" class="user-profile">
	<div class="tabbable">
		<ul class="nav nav-tabs padding-18">
			<li class="active">
				<a data-toggle="tab" href="#perfil">
					<i class="green ace-icon fa fa-user bigger-120"></i>
					Perfil
				</a>
			</li>
			<li class="">
				<a data-toggle="tab" href="#informacion">
					<i class="green ace-icon fa fa-pencil bigger-120"></i>
					Información
				</a>
			</li>
		</ul>

		<div class="tab-content no-border padding-24">
			<div id="perfil" class="tab-pane in active">
				<div class="row no-gutters">
					<div class="col-md-3 col-sm-3 center">
						<span class="profile-picture">
							<img class="editable img-responsive" alt="" id="avatar2" src="<?= $ruta_img ?>" 
	
							/>
						</span>

						<div class="space space-4"></div>
						<form action="<?= base_url().'index.php/usuarioinfo/uploadImg' ?>" method="POST" id="form_foto" 
							enctype="multipart/form-data">

							<a href="#" id="btn_activate_img_upload" class="btn btn-sm btn-block btn-success">
								<i class="ace-icon fa fa-plus-circle bigger-120"></i>
								<span class="bigger-110">Añadir Foto Perfil</span>
							</a>
							<input type="file" name="foto" class="hidden" id="subir_img">
							
							<div id="div_acciones" style="display: none">
								<br/>	
								<button class="btn btn-default" id="btn_upload_cancel">
									Cancelar&nbsp;<i class="fa fa-remove"></i>
								</button>
								<button class="btn btn-default" id="btn_upload_submit">
									Guardar&nbsp;<i class="fa fa-thumbs-up"></i>
								</button>
								<br/>
								<br/>
							</div>

							<a href="<?= base_url().'index.php/usuarioinfo/remove_img' ?>" class="btn btn-sm btn-block btn-primary" id="remove_img">
								<i class="ace-icon fa fa-camera bigger-110"></i>
								<span class="bigger-110">Tomar foto</span>
							</a>

						</form>
					</div><!-- /.col -->

					<div class="col-xs-12 col-sm-9">
						<h4 class="blue">
							<span class="middle"><?= $info->nombre." ".$info->apellido ?></span>
						</h4>

						<div class="profile-user-info">
							<div class="profile-info-row">
								<div class="profile-info-name"> Login </div>

								<div class="profile-info-value">
									<span><?= $info->login ?></span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name"> Locación </div>

								<div class="profile-info-value">
									<i class="fa fa-map-marker light-orange bigger-110"></i>
									<span>Venezuela</span>
									<span>Sucre</span>
								</div>
							</div>
							<?
							if($this->session->userdata('id_permiso') !== '7')
							{
							?>
								<div class="profile-info-row">
									<div class="profile-info-name"> Age </div>

									<div class="profile-info-value">
										<span><?= $edad ?></span>
									</div>
								</div>
							<?
							}
							?>
								

							<div class="profile-info-row">
								<div class="profile-info-name"> Perfil </div>

								<div class="profile-info-value">
									<span><?= $info->perfil ? $info->perfil : 'Sin Perfil'; ?></span>
								</div>
							</div>
							
							<div class="profile-info-row">
								<div class="profile-info-name"> Teléfono </div>

								<div class="profile-info-value">
									<span><?= $info->telefono ? $info->telefono : 'Sin Información' ?></span>
								</div>
							</div>
							
							<?
							if($this->session->userdata('id_permiso') !== '7')
							{
							?>

								<div class="profile-info-row">
									<div class="profile-info-name"> Género </div>

									<div class="profile-info-value">
										<span><?= $info->genero === 't' ? 'Mascúlino' : $info->genero === null || '' ? 'Sin Identificación' : 'Femenino' ?></span>
									</div>
								</div>
							<?
							}	
							?>
							<!--
							<div class="profile-info-row">
								<div class="profile-info-name"> Departamentos </div>

								<div class="profile-info-value">
									<span>Presidencia</span>
								</div>
							</div>
							-->

							<div class="profile-info-row">
								<div class="profile-info-name"> Inclución al Sistema </div>

								<div class="profile-info-value">
									<span><?= invierte_date_time($info->createdat) ?></span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name"> Última Conexión </div>

								<div class="profile-info-value">
									<span><?= invierte_date_time($info->fecha_acceso) ?></span>
								</div>
							</div>
						</div>

						<div class="hr hr-8 dotted"></div>
					</div><!-- /.col -->
				</div><!-- /.row -->

				<div class="space-20"></div>

				<!--<div class="row">
					<div class="col-xs-12 col-sm-6">
						<div class="widget-box transparent">
							<div class="widget-header widget-header-small">
								<h4 class="widget-title smaller">
									<i class="ace-icon fa fa-check-square-o bigger-110"></i>
									Últimos Movimientos
								</h4>
							</div>

							<div class="widget-body">
								<div class="widget-main">
									<p>
										<span class="badge badge-transparent">
											<i class="light-red ace-icon fa fa-asterisk"></i>
										</span>
										Culminación de Acciones y Permisos
									</p>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-6">
						<div class="widget-box transparent">
							<div class="widget-header widget-header-small header-color-blue2">
								<h4 class="widget-title smaller">
									<i class="ace-icon fa fa-lightbulb-o bigger-120"></i>
									Acceso a Sistemas
								</h4>
							</div>

							<div class="widget-body">
								<div class="widget-main padding-16">
									<div class="clearfix">
										<div class="grid3 center">
											<div class="easy-pie-chart percentage" data-percent="45" data-color="#CA5952">
												<span class="percent">45</span>%
											</div>

											<div class="space-2"></div>
											Bienes
										</div>

										<div class="grid3 center">
											<div class="center easy-pie-chart percentage" data-percent="90" data-color="#59A84B">
												<span class="percent">90</span>%
											</div>

											<div class="space-2"></div>
											Correspondecia
										</div>

										<div class="grid3 center">
											<div class="center easy-pie-chart percentage" data-percent="80" data-color="#9585BF">
												<span class="percent">80</span>%
											</div>

											<div class="space-2"></div>
											Soporte
										</div>
									</div>
									<div class="hr hr-16"></div>
								</div>
							</div>
						</div>
					</div>
				</div>-->
			</div><!-- /#home -->
			<div id="informacion" class="tab-pane">
				<div class="user-profile row no-gutters">
					<div class="col-sm-offset-1 col-md-offset-1 col-sm-10 col-md-10">

						<form class="form-horizontal" id="form_info" action="<?= base_url().'index.php/usuarioinfo/create' ?>" method="POST">
							<input type="hidden" name="id_usuario" value="<?= $info->id_usuario ?>">
							<div class="tabbable">
								<ul class="nav nav-tabs padding-16">
									<li class="active">
										<a data-toggle="tab" href="#edit-basic">
											<i class="green ace-icon fa fa-pencil-square-o bigger-125"></i>
											Información Básica
										</a>
									</li>

									<li>
										<a data-toggle="tab" href="#edit-settings">
											<i class="purple ace-icon fa fa-cog bigger-125"></i>
											Configuración de Acceso
										</a>
									</li>
								</ul>

								<div class="tab-content profile-edit-tab-content">
									<div id="edit-basic" class="tab-pane in active">
										<h4 class="header blue bolder smaller">General</h4>

										<div class="row no-gutters">
											<div class="form-group">
												<label class="col-sm-offset-2 col-md-offset-2 col-sm-2 col-md-2 control-label">Login</label>
												<div class="col-md-4 col-sm-4">
													<input class="form-control text-center" type="text" id="" placeholder="Username" value="<?= $info->login ?>" readonly="" />
												</div>
											</div>

											<div class="space-4"></div>

											<div class="form-group">
												<label class="col-sm-2 col-md-2 col-md-offset-1 col-sm-offset-1 control-label">Nombre</label>

												<div class="col-sm-3 col-md-3">
													<input class="form-control" name="nombre" type="text" placeholder="Nombre" value="<?= $info->nombre ?>" />
												</div>
												<label class="col-sm-2 col-md-2 control-label">Apellido</label>

												<div class="col-sm-3 col-md-3">
													<input class="form-control" name="apellido" type="text" placeholder="Nombre" value="<?= $info->apellido ?>" />
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 col-md-2 col-md-offset-1 col-sm-offset-1 control-label">Fecha Nacimiento</label>
											<div class="col-sm-3 col-md-3">
												<div class="input-group">
													<input class="form-control fecha input-mask-date" 
													type="text" placeholder="dd-mm-yyyy" 
													name="fecha_nacimiento"
													value="<?= date('d-m-Y',strtotime($info->fecha_nacimiento)) ?>" />
													<span class="input-group-addon">
														<i class="ace-icon fa fa-calendar"></i>
													</span>
												</div>
											</div>
											<label class="col-md-2 col-sm-2 control-label">Género</label>

											<div class="col-sm-3 col-md-3">
												<label class="inline">
													<input name="genero" type="radio" class="ace" 
														<?= $info->genero === 't' ? 'checked=""' : '' ?>
													 value="1"/>
													<span class="lbl middle"> Hombre</span>
												</label>

												&nbsp; &nbsp; &nbsp;
												<label class="inline">
													<input name="genero" type="radio" class="ace"
														<?= $info->genero === 'f' ? 'checked=""' : '' ?>
														value="0"
													 />
													<span class="lbl middle"> Mujer</span>
												</label>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 col-md-2 col-md-offset-1 col-sm-offset-1 control-label">Teléfono</label>

											<div class="col-sm-3 col-md-3">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="ace-icon fa fa-phone"></i>
													</span>
													<input class="form-control input-mask-phone" 
													type="text" id="form-field-mask-2" 
													name="telefono"
													placeholder="(412) 123-4567" value="<?= $info->telefono ?>"/>
												</div>
											</div>
										</div>
									</div>

									<div id="edit-settings" class="tab-pane">
										<div class="space"></div>
										<div class="form-group">
											<label for="" class="control-label col-sm-offset-1 col-md-offset-1 col-sm-2 col-md-2">Contraseña</label>
											<div class="col-md-3 col-sm-3">
												<input type="password" id="password" name="password" 
												name="password"
												class="form-control" placeholder="*********" value="<?= $info->password ?>" />
											</div>
											<label for="" class="control-label col-sm-2 col-md-2">Repita Contraseña</label>
											<div class="col-md-3 col-sm-3">
												<input type="password" id="password_repeat" class="form-control" placeholder="*********" value="<?= $info->password ?>" />
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="clearfix form-actions">
								<div class="col-md-offset-4 col-sm-offset-4 col-md-4 col-sm-4">
									<button class="btn btn-info" type="sumbit">
										<i class="ace-icon fa fa-check bigger-110"></i>
										Guardar
									</button>

									&nbsp; &nbsp;
									<button class="btn" type="reset">
										<i class="ace-icon fa fa-undo bigger-110"></i>
										Limpiar
									</button>
								</div>
							</div>
						</form>
					</div><!-- /.span -->
				</div><!-- /#informacion fin -->
			</div><!-- /#tab-pane informacion fin -->
		</div>
	</div>
</div>