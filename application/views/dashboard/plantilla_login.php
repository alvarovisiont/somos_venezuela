<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">

  function activate_match()
 {
 	var id = $('select#login').val();
 	var ruta = "<?php echo base_url()?>assets_sistema/images/gallery/login/login"+id+".jpg";
 	document.getElementById('imagen_login').src = ruta;
 	document.getElementById('ref_login').href = ruta;
 }

</script>

<?php $ruta_controller = base_url() . "index.php/admin/a_plantilla";?>

<div class="page-header">
	<h1>
		Dashboard
		<small>
			<i class="ace-icon fa fa-angle-double-right"></i>
			Configuración
		</small>
	</h1>
</div><!-- /.page-header -->


 <form action="<?php echo $ruta_controller;?>" method="post" enctype="multipart/form-data">

					<div class="col-xs-12 col-sm-4">
						<div class="widget-box">
							<div class="widget-header">
								<h4 class="widget-title">Tipo de logueo
							</div>	

							 <div class="widget-body">
								 <div class="widget-main">
									<div>
										<label for="form-field-select-1">Seleccione</label>
										<span class="badge badge-transparent">
											<i class="light-red ace-icon fa fa-asterisk"></i>
										</span>
										<select class="form-control" id="login" name="login"
										onchange="activate_match()">
											
										<?php for ($i = 1; $i <= 5; $i++) { 

										if ($tipo == $i){?>
										<option value=<?php echo $i;?> selected> Tipo <?php echo $i;?> </option>	   
										<?php }else { ?>
										<option value=<?php echo $i;?>> Tipo <?php echo $i;?> </option>	   
										<?php }	
										?>
										<?php } ?>						
						   		        </select>
								     </div>	
							     </div>
							  </div>
					    </div>

					    <div class="widget-box">
							<div class="widget-header">
								<h4 class="widget-title">Imagen Vista Previa</h4>
							</div>	
							 <div class="widget-body">
								 <div class="widget-main">
									<ul class="ace-thumbnails clearfix text-center" style="list-style-type: none;">
										<li class="">		
											<a id="ref_login" href="<?php echo base_url()?>assets_sistema/images/gallery/login/login<?= $datos->login?>.jpg" data-rel="colorbox" class="text-center">
												
												<img id = "imagen_login" width="200" height="170" alt="200x170" src="<?php echo base_url()?>assets_sistema/images/gallery/login/login<?= $datos->login?>.jpg"/>
												
												<div class="text">
													<div class="inner">Imagenes pichurri</div>
												</div>
											</a>
										</li>
									</ul>				
								</div>
						  	</div>
					    </div>
					    <div class="widget-box">
							<div class="widget-header">
								<h4 class="widget-title">Tipo Login</h4>
							</div>	
							 <div class="widget-body">
								 <div class="widget-main">
								 	<div class="row">
								 		<div class="col-sm-6 col-md-6">
											<label for="" class="radio-inline" for="email">
												<input type="radio" id="email" name="acceso" value="1"
												<?= $datos->acceso === '1' ? 'checked=""' : '' ?>
												/>
												Email
											</label>
										</div>
										<div class="col-sm-6 col-md-6">
											<label for="" class="radio-inline" for="username">
												<input type="radio" id="username" name="acceso" value="2" 
												<?= $datos->acceso === '2' ? 'checked=""' : '' ?>
												/>
												Username
											</label>
										</div>
								 	</div>
								</div>
						  	</div>
					    </div>
				     </div> <!-- fin div col-xs-12 -->

				    <div class="col-xs-12 col-sm-4">
					    <div class="widget-box">
							<div class="widget-header">
								<h4 class="widget-title">Imagen Complementaria</h4>
							</div>	
							 <div class="widget-body">
								 <div class="widget-main">
									<div>
										<input type="file" name="imagen">
								     </div>	
								     <div>
								     	<ul class="ace-thumbnails clearfix text-center" style="list-style-type: none;">
											<li class="">		
												<a id="ref_login" href="<?php echo base_url()?>assets_sistema/images/gallery/complementos_login/<?= $datos->imagen; ?>" data-rel="colorbox" class="text-center">
													
													<img id = "imagen_login" width="200" height="170" alt="200x170" src="<?php echo base_url()?>assets_sistema/images/gallery/complementos_login/<?= $datos->imagen; ?>"/>
													
													<div class="text">
														<div class="inner">Imagenes pichurri</div>
													</div>
												</a>
											</li>
										</ul>
								     </div>
							     </div>
							  </div>
					    </div>
					    <div class="widget-box">
							<div class="widget-header">
								<h4 class="widget-title">Imagen Cintillo</h4>
							</div>	
							 <div class="widget-body">
								 <div class="widget-main">
									<div>
										<input type="file" name="cintillo">
								     </div>	
								     <div>
								     	<ul class="ace-thumbnails clearfix text-center" style="list-style-type: none;">
											<li class="">		
												<a id="ref_login" href="<?php echo base_url()?>assets_sistema/images/gallery/complementos_login/<?= $datos->cintillo; ?>"" data-rel="colorbox" class="text-center">
													
													<img id = "imagen_login" width="200" height="170" alt="200x170" src="<?php echo base_url()?>assets_sistema/images/gallery/complementos_login/<?= $datos->cintillo; ?>"/>
													
													<div class="text">
														<div class="inner">Imagenes pichurri</div>
													</div>
												</a>
											</li>
										</ul>
								     </div>
							     </div>
							  </div>
					    </div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div class="widget-box">
							<div class="widget-header">
								<h4 class="widget-title">Logo Reportes</h4>
							</div>	
							 <div class="widget-body">
								 <div class="widget-main">
									<div>
										<input type="file" name="logo">
								     </div>	
								     <div>
								     	<ul class="ace-thumbnails clearfix text-center" style="list-style-type: none;">
											<li class="">		
												<a id="ref_login" href="<?php echo base_url()?>assets_sistema/images/gallery/complementos_login/<?= $datos->logo; ?>"" data-rel="colorbox" class="text-center">
													
													<img id = "imagen_login" width="200" height="170" alt="200x170" src="<?php echo base_url()?>assets_sistema/images/gallery/complementos_login/<?= $datos->logo; ?>""/>
													
													<div class="text">
														<div class="inner">Imagenes pichurri</div>
													</div>
												</a>
											</li>
										</ul>
								     </div>
							     </div>
							  </div>
					    </div>
						<div class="widget-box">
							<div class="widget-header">
								<h4 class="widget-title">Titulo del Login</h4>
							</div>	
							 <div class="widget-body">
								 <div class="widget-main">
									<div>
										<input type="text" class="form-control" placeholder="Titulo Login" name="titulo"
										value="<?= $datos->titulo ?>" 
										/>
								     </div>	
							     </div>
							  </div>
					    </div>
					</div>
					 	
				   <input type="hidden" id="id" name="id" value="<?php echo $datos->id ;?>">
				   <div class="col-xs-12 text-center">
	   					<button class="btn btn-rose btn-md radius-4">
								<i class="ace-icon fa fa-floppy-o bigger-160"></i>
								Guardar Cambios
						</button>
				   </div>

				   
</form>

			   


			
