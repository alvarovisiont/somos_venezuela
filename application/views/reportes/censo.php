<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#">Sistema</a>
		</li>

		<li>
			<a href="#">Reportes</a>
		</li>
		<li class="">Censo</li>
		
	</ul><!-- /.breadcrumb -->					
</div>
<div class="page-header text-center">
	<li class="bigger-200 purple">
	 	<i class="ace-icon fa fa-circle"></i>
	 	Sala Situacional: <b class="">Estado Sucre</b>
	</li>

</div><!-- /.page-header -->

<div class="row no-gutters">
	<div class="col-md-12 col-sm-12">
		<div class="widget-box">
			<div class="widget-header">
				<h3 class="widget-title">Creación del Reporte</h3>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row no-gutters">
						<form action="<?= base_url().'index.php/reportes/show_censo_pdf' ?>" class="form-horizontal" id="form_reporte" method="POST">
							<div class="form-group">
								<label for="" class="control-label col-md-2 col-sm-2">Municipio</label>
								<div class="col-md-4 col-sm-4">
									<select name="id_municipio" id="id_municipio" class="form-control">
										<option value="" disabled="" selected="">Seleccione</option>
										<?	
											foreach ($municipios as $row) {
												
												echo '<option value="'.$row->id.'">'.$row->nombre.'</option>';
											}
										?>
									</select>
								</div>
								<label for="" class="control-label col-md-2 col-sm-2">Parroquia</label>
								<div class="col-md-4 col-sm-4">
									<select name="id_parroquia" id="id_parroquia" class="form-control">
										<option value="" disabled="" selected="">Seleccione un Municipio</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<!-- cédula  -->
								<label for="" class="control-label col-sm-2 col-md-2">Cédula</label>
								<div class="col-md-4 col-sm-4">
									<input type="number" class="form-control" name="cedula" id="cedula">
								</div>
							</div>
							<div class="form-group">
								<!-- desde y hasta -->	
								<label for="" class="control-label col-md-2 col-sm-2">Desde</label>
								<div class="col-md-4 col-sm-4">
									<input type="date" name="desde" id="desde" class="form-control">
								</div>
								<label for="" class="control-label col-md-2 col-sm-2">Hasta</label>
								<div class="col-md-4 col-sm-4">
									<input type="date" name="hasta" id="hasta" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<!-- Genero y Embarazada -->
								<label for="" class="control-label col-sm-2 col-md-2">Genero</label>
								<div class="col-md-2 col-sm-2">
									<label for="masculino" class="radio-inline">
										<input type="radio" name="genero" id="masculino" value="1">
										Masculino
									</label>
								</div>
								<div class="col-md-2 col-sm-2">
									<label for="femenino" class="radio-inline">
										<input type="radio" name="genero" id="femenino" value="0">
										Femenino
									</label>
								</div>
								<label for="" class="control-label col-sm-2 col-md-2">Discapacidad</label>
								<div class="col-sm-4 col-md-4">
									<input type="text" class="form-control" name="condicion">
								</div>
							</div>
							<br/><br/>
							<div class="form-group">
								<!-- Verificado y Discapacidad -->
								<div class="col-md-2 col-sm-2 col-md-offset-3 col-sm-offset-3">
									 <label class="inline">
										<small class="muted smaller-90">Embarazada</small>
										<input id="id-button-borders" type="checkbox" class="ace ace-switch ace-switch-5" name="embarazada" value="t" />
										<span class="lbl middle"></span>
									</label>
								</div>
								<div class="col-md-2 col-sm-2">
									 <label class="inline">
										<small class="muted smaller-90">Verificado</small>
										<input id="id-button-borders" type="checkbox" class="ace ace-switch ace-switch-5" name="verificado" value="t" />
										<span class="lbl middle"></span>
									</label>
								</div>
								<div class="col-md-2 col-sm-2">
									 <label class="inline">
										<small class="muted smaller-90">Pensionado</small>
										<input id="id-button-borders" type="checkbox" class="ace ace-switch ace-switch-5" name="pensionado" value="1" />
										<span class="lbl middle"></span>
									</label>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
									<button class="btn btn-pink btn-block">Generar&nbsp;<i class="fa fa-file-pdf-o"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>