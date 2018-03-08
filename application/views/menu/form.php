<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h4>Formulario para Módulo</h4></div>
			
			<div class="panel-body">
				<form action="<?= $ruta ?>" class="form-horizontal" id="form_registrar" method="POST">
					
					<input type="hidden" name="id_tipo" value="1">
					<input type="hidden" name="id_padre" value="0">

					<div class="form-group">
						<label for="Nombre" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">Módulo</label>
						<div class="col-md-4 col-sm-4">
							<input type="text" id="nombre" name="nombre" required="" class="form-control" value="<?= $register ? $register->nombre : '' ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="Nombre" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">Icono</label>
						<div class="col-md-4 col-sm-4">
							<input type="text" id="icono" name="icono" required="" class="form-control" value=" <?= $register ? $register->icono : '' ?> " placeholder="ejemplo: fa-shopping-cart">
						</div>
					</div>
					<div class="form-group">
						<label for="Nombre" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2"></label>
						<div class="col-md-3 col-sm-3">
						<label for="link" class="radio-inline">
	            				<?php if ($register){
                                      if ($register->link == 't'){ ?> 
                                         <input type="radio" id="link" name="link" value="1" checked>
                                      <?php } else { ?> <input type="radio" id="link" name="link" value="1"> <?php }  } else { ?> <input type="radio" id="link" name="link" value="1"> <?php } ?> 
	            				Link
	            			</label>
						</div>
						<div class="col-md-3 col-sm-3">
	            			<label for="sub" class="radio-inline">
	            				<?php if ($register){
                                      if ($register->link == 'f'){ ?> 
                                        <input type="radio" id="sub" name="link" value="0" checked>
                                      <?php } else { ?> <input type="radio" id="sub" name="link" value="0"> <?php }  }else {?> <input type="radio" id="sub" name="link" value="0"> <?php } ?> 
	            				
	            				Sub Menú
	            			</label>
	            		</div>	
					</div>

					<div class="form-group" id="ruta_oculta" 
					<?php if ($register){
                                      if ($register->link == 'f'){ ?>
                                      	style="display: none;
                                      <?php } } else { ?> style="display: none; <?php } ?>
                                      ">
	            		<div class="form-group">
	            			<label for="ruta" class="control-label col-md-4 col-sm-4">Ruta</label>
	            			<div class="col-md-4 col-sm-4">
	            			<input type="text" id="ruta_area" name="ruta" class="form-control" value="<?= $register ? $register->ruta : '' ?>">
	            			</div>
	            		</div>
	            	</div>

					<div class="form-group">
						<div class="col-md-4 col-sm-4 col-sm-offset-4 col-md-offset-4">
							<button type="submit" class="btn btn-block btn-pink">Guardar&nbsp;<i class="fa fa-send"></i></button>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4 col-sm-4 col-sm-offset-4 col-md-offset-4 text-center">
							<a class="btn btn-default" href="<?= base_url().'index.php/menu'; ?>">Volver a la vista del Menú </a>
						</div>
					</div>
						
				</form>
			</div>
		</div>	
	</div>
</div>