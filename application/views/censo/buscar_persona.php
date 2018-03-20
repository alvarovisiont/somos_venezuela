<div class="row no-gutters">
	<div class="col-md-12 col-sm-12">
		<form action="#" class="form-horizontal" id="form_buscar">
			<br>
			<div class="form-group">
				<label for="" class="control-label col-md-2 col-sm-2">Cédula</label>
				<div class="col-md-4 col-sm-4">
					<input type="number" class="form-control" id="cedula" name="cedula" required="">
				</div>
				<label for="" class="control-label col-md-2 col-sm-2">Tipo</label>
				<div class="col-sm-2 col-md-2">
					 <label for="jefe" class="radio-inline">
					 	<input type="radio" name="tipo" id="jefe" value="1" required="">
					 	Jefe
					 </label>
				</div>
				<div class="col-sm-2 col-md-2">
					 <label for="carga" class="radio-inline">
					 	<input type="radio" name="tipo" id="carga" value="2">
					 	Carga
					 </label>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">	
					<button type="submit" class="btn btn-pink btn-block">Buscar&nbsp;<i class="fa fa-search"></i></button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="row no-gutters">
	<div class="col-md-12 col-sm-12">
		<br/>
		<h3 class="text-center">Tabla Resultados</h3>		
		<br/>
		<table class="table table-bordered table-responsive table-condensed" id="tabla_familia">
			<thead>
				<tr>
					<th class="text-center">Nombre</th>
					<th class="text-center">Cédula</th>
					<th class="text-center">Teléfono</th>
					<th class="text-center">Condición</th>
					<th class="text-center">Nivel</th>
				</tr>
			</thead>
			<tbody class="text-center">
			</tbody>
		</table>	
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