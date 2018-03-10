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

<!-- =============================== Sección Perfiles ==================================== -->

<div class="row no-gutters" id="div_oculto" style="display: none;">
	<div class="row no-gutters">
		<div class="col-md-4 col-sm-4 col-sm-offset-3 col-md-offset-3">
			<label for="" class="control-label">Perfiles</label>
			<select name="perfiles_select" id="perfiles_select" class="form-control">
				
			</select>
		</div>
		<div class="col-md-offset-3 col-sm-offset-3 col-md-2 col-sm-2">
			<button type="button" class="btn btn-fill btn-pink show_permissions">
				Tipo Permisos &nbsp;<i class="fa fa-arrow-up"></i>
			</button>
		</div>
	</div>
	<br/>

	<!-- =============================== Sección Módulos y Áreas ==================================== -->

	<div class="row no-gutters" id="div_oculto_modulos" style="display: none">
		<div class="col-md-12 col-sm-12">
			<div class="tabbable" id="contenido">

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

					$clase = '';
					if($con === 1)
					{
						$clase = 'active';
					}

					if($value->id_tipo === '1')
					{

						$tabs.= '<li class="'.$clase.'">
									<a data-toggle="tab" href="#'.$value->id.'">
										<i class="green ace-icon fa '.$value->icono.' bigger-120"></i>
										'.$value->nombre.'
									</a>
								</li>';

						$areas.='
								<div id="'.$value->id.'" class="tab-pane fade in '.$clase.'">
									<div class="row">
										<div class="col-md-12 col-sm-12">
											<div class="tabbable tabs-left">
												<ul class="nav nav-tabs" id="myTab3">';

						$sub_areas = '<div class="tab-content">';


						foreach ($accesos as $value1) 
						{

							if($value1->id_padre === $value->id)
							{

								// ===================== \ foreach areas \ ==============================
								$clase_area = $con_areas === 1 ? 'active' : '';

								$areas.='<li class="'.$clase_area.'">
											<a data-toggle="tab" href="#'.$value1->id.'">
												<i class="pink ace-icon fa fa-tachometer bigger-110"></i>
												'.$value1->nombre.'
											</a>
										</li>';
								
								$sub_areas.='<div id="'.$value1->id.'" class="tab-pane in '.$clase_area.'">
												<div class="row">
													<div class="col-md-12 col-sm-12">';

								foreach ($accesos as $value2) 
								{
									// ===================== \ foreach sub-areas \ ==============================

									if($value2->id_padre === $value1->id)									{
										
										$sub_areas.='
													<div class="col-md-2">
														<label class="checkbox-inline" for="'.$value2->id.'">
															<input type="checkbox" id="'.$value2->id.'" name="check_sub_areas" value="'.$value2->id.'" /> 
															'.$value2->nombre.'
														</label>
													</div>';

									}

								} // fin foreach sub-areas

								$sub_areas.='
											</div>
										</div>
									</div>';

								$con_areas++;
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

						$con++;
					
					} // fin si es un módulo					
				
				} // finn foreach modulo

				$tabs.='</ul>';

				echo $tabs;
			?>

	<!-- =============================== Áreas y Sub-Áreas ==================================== -->

				<div class="tab-content">
					<?= $areas; ?>
				</div>
			</div>
		</div>
	</div>	
</div>

<!-- =============================== Gift Cargando ==================================== -->

	<div class="row no-gutters" id="div_image" style="display: none;">
		<div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
			<div class="text-center">
				<img src="<?= base_url().'assets_sistema/images/gift/cargando.gif' ?>" alt="">
				<br/>
				Cargando...
			</div>
		</div>
	</div>