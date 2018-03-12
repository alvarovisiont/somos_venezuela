<div class="page-header">
	<h1>
		Dashboard
		<small>
			<i class="ace-icon fa fa-angle-double-right"></i>
			Permisología
		</small>
	</h1>
</div><!-- /.page-header -->

<!-- =============================== Sección principal ==================================== -->

<div class="row no-gutters" id="div_principal">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3>Permisología</h3>
			</div>
			<div class="panel-body">
				<div class="col-md-6 text-center">
					<h4 class="">Perfiles</h4>
					<br/>
					<button class="btn btn-app btn-primary no-radius show_div" data-type="perfiles">
						<i class="ace-icon fa fa-pencil-square-o bigger-230"></i>
							Edit
						<span class="badge badge-warning badge-left"><?= $total_perfiles ?></span>
						Editar
					</button>
				</div>
				<div class="col-md-6 text-center">
					<h4 class="">Usuario</h4>
					<br/>
					<button class="btn btn-app btn-primary no-radius show_div" data-type="manuales">
						<i class="ace-icon fa fa-pencil-square-o bigger-230"></i>
							Edit
						<span class="badge badge-warning badge-left"><?= $total_users ?></span>
						Editar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="row no-gutters" id="div_oculto" style="display: none;">
	

	<div class="row no-gutters">
		<form id="form_perfil" action="<?= base_url()."index.php/permiso/guardar_permisos" ?>" method="POST">
			<input type="hidden" id="tipo_perfil" name="tipo_perfil">
			<div class="col-md-12 col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>
							Otorgar Permisos&nbsp;<i class="fa fa-lock"></i>
							<button type="button" class="btn btn-fill btn-info show_permissions pull-right">
									Tipo Permisos &nbsp;<i class="fa fa-user"></i>
							</button>
						</h3>
					</div>
					<div class="panel-body">
						
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

					<!-- =============================== Sección Módulos y Áreas ================================ -->
						<div class="tabbable" id="div_oculto_modulos" style="display: none;">

					<!-- =============================== Módulos ==================================== -->
						<?
							$tabs = '<ul class="nav nav-tabs" id="myTab">';
							$con = 1;

							$id_area = 0;
							$con_areas = 1;
							$areas = '';

							$sub_areas = '';
							$con_sub_areas = 1;

							foreach ($accesos as $value) 
							{

								// ===================== \ foreach módulos \ ==============================

								if($value->id_tipo === '1')
								{
									$clase = '';
									if($con === 1)
									{
										$clase = 'active';
									}

									$tipo = $value->link === 't' ? '(Link)' : '(Nivel)';

									$tabs.= '<li class="'.$clase.' text-center">
												<a data-toggle="tab" href="#'.$value->id.'">
													<i class="green ace-icon fa '.$value->icono.' bigger-120"></i>
													'.$value->nombre.'
													<br/>
													'.$tipo.'
												</a>
											</li>';

									$areas.='
											<div id="'.$value->id.'" class="tab-pane fade in '.$clase.'">
												<br/>
												<div class="row">
													<div class="col-md-3 col-sm-3">
														<label class="pull-left inline">
															<small class="muted smaller-90">Añadir Módulo:</small>
															<input id="id-button-borders" type="checkbox" class="ace ace-switch ace-switch-5 modulos_visible" name="modulos[]" value="'.$value->id.'" multiple="" data-link='.$value->link.' />
															<span class="lbl middle"></span>
														</label>
													</div>
													<div class="col-md-3 col-sm-3 hidden div_visible_modulo" id="div_visible_modulo_'.$value->id.'">
														<label class="pull-left inline">
															<small class="muted smaller-90">Módulo Visible:</small>
															<input id="id-button-borders" type="checkbox" checked="true" class="ace ace-switch ace-switch-5" name="modulos_visible[]" value="'.$value->id.'" multiple="" />
															<span class="lbl middle"></span>
														</label>
													</div>
												</div>
												<br/>
												<div class="row no-gutters div_areas" id="div_areas_'.$value->id.'">
													<div class="col-md-12 col-sm-12">
														<div class="tabbable tabs-left">
															<ul class="nav nav-tabs" id="myTab3">';

									$sub_areas = '<div class="tab-content">';


									foreach ($accesos as $value1) 
									{

										if($value1->id_padre === $value->id)
										{

											// ===================== \ foreach areas \ ==============================

											$tipo = $value1->link === 't' ? '(Link)' : '(Nivel)';

											$areas.='<li class="li_areas" id="li_area_'.$value1->id.'">
														<a data-toggle="tab" href="#'.$value1->id.'">
															<i class="pink ace-icon fa fa-tachometer bigger-110"></i>
															'.$value1->nombre.'
															<br/>
															'.$tipo.'
														</a>
													</li>';
											
											$sub_areas.='<div id="'.$value1->id.'" class="tab-pane div_sub_areas_tab">
															<br/>
															<div class="row">
																<div class="col-md-12 col-sm-12" >
																	<label class="pull-right inline">
																		<small class="muted smaller-90">Añadir Área:</small>
																		<input id="id-button-borders" type="checkbox" class="ace ace-switch ace-switch-5 areas_visible check_modulo_'.$value->id.'" name="areas_'.$value->id.'[]" value="'.$value1->id.'" data-link="'.$value1->link.'"
																		/>
																		<span class="lbl middle"></span>
																	</label>
																</div>
															</div>
															<br/>
															<div class="row no-gutters div_sub_areas_modulo_'.$value->id.' div_sub_areas" id="div_sub_areas_'.$value1->id.'">
																<div class="col-md-7 col-md-offset-2 col-sm-7 col-sm-offset-2 text-center">
																<h4>Sub Áreas</h4>
																<ul class="list-group">';

											foreach ($accesos as $value2) 
											{
												// ============= \ foreach sub-areas \ ============= //

												if($value2->id_padre === $value1->id)									{
													
													$sub_areas.='
																<li class="list-group-item">
																	<div class="row no-gutters">
																		<b class="pull-left">'.$value2->nombre.'</b>
																		<label class="pull-right inline">
																			<small class="muted smaller-90">
																				Añadir Sub Área:
																			</small>
																			<input id="id-button-borders" 
																				type="checkbox" 
																				checked="true" 
																				class="ace ace-switch ace-switch-5 check_area_'.$value1->id.' check_modulo_'.$value->id.'"
																				name="sub_areas_'.$value1->id.'[]" 
																				value="'.$value->id.'" multiple=""
																				data-link='.$value2->link.' 
																			/>
																			<span class="lbl middle"></span>
																		</row>
																	</label>
																</li>
																';

												} // fin if id_padre sub-area == id área

											} // fin foreach sub-areas

											$sub_areas.='
															</ul>
														</div>
													</div>
												</div>';

										} // fin if id_padre area == id modulo

									} // fin foreach areas
											
											$areas.= '</ul>';
											$sub_areas.= '</div>';

											$areas.= $sub_areas;

											$areas.='
												</div>
											</div>
										</div>
									</div>';
								
								} // fin si es un módulo					

								$con++;
							
							} // finn foreach modulo

							$tabs.='</ul>';

							echo $tabs;
						?>

				<!-- =============================== Áreas y Sub-Áreas ==================================== -->

							<div class="tab-content">
								<?= $areas; ?>
							</div>
						</div>
					
					</div> <!-- fin panel-body -->
					<div class="panel-footer">
						<div class="row no-gutters">
							<div class="col-md-12 col-sm-12">
								<button type="submit" class="btn btn-pink btn-fill pull-right">Guardar&nbsp;<i class="fa fa-thumbs-up"></i></button>
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