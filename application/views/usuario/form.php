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
								<h4 class="widget-title">Tipo de Usuario
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
										<?php foreach ($perfil as $row) 
				                        { ?>	 
									<option value=<?php echo $row->id;?>> <?php echo $row->nombre;?> </option>   
										<?php } ?>						
						   		        </select>
								     </div>	
							     </div>
							  </div>
					    </div>

					    <div class="widget-box">
							<div class="widget-header">
								<h4 class="widget-title">Login</h4>
							</div>	
							 <div class="widget-body">
								 <div class="widget-main">
									<div>
										<label for="form-field-select-1">Requerido</label>
										<span class="badge badge-transparent">
											<i class="light-red ace-icon fa fa-asterisk"></i>
										</span>
										<input type="text" class="form-control" placeholder="Login" name="login" id="login" required="true">
								     </div>	
							     </div>
							  </div>
					    </div>

					    <div class="widget-box">
							<div class="widget-header">
								<h4 class="widget-title">Correo</h4>
							</div>	
							<div class="widget-body">
							<div class="widget-main">

							<label for="form-field-select-1">Requerido</label>
										<span class="badge badge-transparent">
											<i class="light-red ace-icon fa fa-asterisk"></i>
										</span> <br>	
						    <span class="input-icon">
							<input type="email" placeholder="Email" name="email" id="email" class="form-control" required="true" />
								<i class="ace-icon fa fa-envelope"></i>
							</span>
							 </div>
						   </div>
					    </div>
				     </div>

				      <div class="col-xs-12 col-sm-4">

				      	 <div class="widget-box">
							<div class="widget-header">
								<h4 class="widget-title">Cédula</h4>
							</div>	
							 <div class="widget-body">
								 <div class="widget-main">
									<div>
										<label for="form-field-select-1">Requerido</label>
										<span class="badge badge-transparent">
											<i class="light-red ace-icon fa fa-asterisk"></i>
										</span>
										<input type="text" class="form-control" placeholder="Cédula" name="cedula" id="cedula" required="true">
								     </div>	
							     </div>
							  </div>
					    </div>
						
					   
					   <div class="widget-box">
							<div class="widget-header">
								<h4 class="widget-title">Nombre y Apellido</h4>
							</div>	
							 <div class="widget-body">
								 <div class="widget-main">
									<div>
										<label for="form-field-select-1">Requerido</label>
										<span class="badge badge-transparent">
											<i class="light-red ace-icon fa fa-asterisk"></i>
										</span>
										<input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" required="true">
								     </div>	
								     <div> <br>
										<input type="text" class="form-control" placeholder="Apellido" name="apellido" id="apellido" required="true">
								     </div>	
							     </div>
							  </div>
					    </div>
					 </div>


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
											<a id="ref_login" href="<?php echo base_url()?>assets_sistema/images/avatars/avatar1.png" data-rel="colorbox" class="text-center">
												
												<img id = "imagen_login" width="170" height="170" alt="170x170" src="<?php echo base_url()?>assets_sistema/images/avatars/avatar1.png"/>
												
												<div class="text">
													<div class="inner">Imagenes</div>
												</div>
											</a>
										</li>
									</ul>				
								</div>
						  </div>
					    </div>
				     </div>


				   <input type="hidden" id="id" name="id" value="<?php echo @$id;?>">
				   <div class="col-xs-12 text-center">
	   					<button class="btn btn-rose btn-md radius-4">
								<i class="ace-icon fa fa-floppy-o bigger-160"></i>
								Guardar Cambios
						</button>
				   </div>

				   
</form>

			   


			
