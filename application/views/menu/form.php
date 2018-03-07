<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h4>Datos necesarios para la operación</h4></div>
			<div class="panel-body">
				<form action="" class="form-horizontal" id="form_registrar" method="POST">
					<div class="form-group">
						<label for="Nombre" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2"></label>
						<div class="col-md-4 col-sm-4">
							<input type="text" id="Nombre" name="Nombre" required="" class="form-control" value="">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4 col-sm-4 col-sm-offset-3 col-md-offset-3">
							<button type="submit" class="btn btn-block btn-danger">Guardar&nbsp;<i class="fa fa-send"></i></button>
						</div>
						<div class="col-md-3 col-sm-3">
							<a class="btn btn-link" href="<?= base_url().'index.php/menu'; ?>">Volver a la vista del Menú </a>
						</div>
					</div>
				</form>
			</div>
		</div>	
	</div>
</div>