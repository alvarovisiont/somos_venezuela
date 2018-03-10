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
						<span class="badge badge-warning badge-left">11</span>
						Editar
					</button>
				</div>
				<div class="col-md-6 text-center">
					<h4 class="">Usuario</h4>
					<br/>
					<button class="btn btn-app btn-primary no-radius show_div" data-type="manuales">
						<i class="ace-icon fa fa-pencil-square-o bigger-230"></i>
							Edit
						<span class="badge badge-warning badge-left">11</span>
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
				foreach ($accesos as $value) 
				{
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

						$con++;
					}						
				}

				$tabs.='</ul>';

				echo $tabs;
			?>

	<!-- =============================== Áreas y Sub-Áreas ==================================== -->

				<div class="tab-content">

				<?
					$id_area = 0;
					$con = 1;
					$areas = "";

					foreach ($accesos as $value) 
					{
						$clase = '';

						if($con === 1)
						{
							$clase = 'in active';
						}

						if($value->id_tipo === '2')
						{
							$areas = '
								<div id="'.$value->id_padre.'" class="tab-pane fade '.$clase.'">
									aqui '.$value->nombre.'
								</div>';

							$con++;
						}
							
					}

					echo $areas;
				?>

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
			</div>
		</div>
	</div>