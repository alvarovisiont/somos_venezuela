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

 <form action="<?php echo $ruta_controller;?>" method="post">

					<div class="col-xs-12 col-sm-4">
											<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">Tipo de logueo
											</div>	

						 <div class="widget-body">
							 <div class="widget-main">
								<div>
									<label for="form-field-select-1">Seleccione</label>
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
													<h4 class="widget-title">Imagen logueo</h4>
												</div>	
						 <div class="widget-body">
							 <div class="widget-main">
									
						<li>

							<ul class="ace-thumbnails clearfix">
										<li>		
											<a id="ref_login" href="<?php echo base_url()?>assets_sistema/images/gallery/login/login<?php echo $tipo?>.jpg" data-rel="colorbox">
												
												<img id = "imagen_login" width="200" height="170" alt="200x170" src="<?php echo base_url()?>assets_sistema/images/gallery/login/login<?php echo $tipo?>.jpg" />
												
												<div class="text">
													<div class="inner">Imagenes pichurri</div>
												</div>
											</a>
										</li>
								</ul>			
							</li>		
						    </div>
						  </div>
					    </div>
				     </div>

				      <div class="col-xs-12 col-sm-4">
											<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">Titulos</h4>
												</div>	
						 <div class="widget-body">
							 <div class="widget-main">
								<div>

									
							     </div>	
						     </div>
						  </div>
					    </div>

				     <div class="col-xs-12 col-sm-4">
											<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">Acciones</h4>
												</div>	
						 <div class="widget-body">
							 <div class="widget-main">
								<div>

									<button class="btn btn-app btn-grey btn-xs radius-4">
											<i class="ace-icon fa fa-floppy-o bigger-160"></i>

											Save
											<span class="badge badge-transparent">
												<i class="light-red ace-icon fa fa-asterisk"></i>
											</span>
									</button>
									
							     </div>	
						     </div>
						  </div>
					    </div>

				   <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
</form>

			   


			
