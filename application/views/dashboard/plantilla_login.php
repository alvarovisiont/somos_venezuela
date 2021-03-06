<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">

  function activate_match()
 {
 	var id = $('select#login').val();
 	var ruta = "<?php echo base_url()?>assets_sistema/images/gallery/login/login"+id+".jpg";
 	document.getElementById('imagen_login').src = ruta;
 	document.getElementById('ref_login').href = ruta;

 	document.querySelectorAll('input[name="acceso"]').forEach((ele,i) =>{
 		ele.checked = false
 	})
 }

</script>

<?php $ruta_controller = base_url() . "index.php/admin/a_plantilla";?>

<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#">Sistema</a>
		</li>

		<li>
			<a href="#">Configuración</a>
		</li>
		<li class="active">Configuración Login</li>
	</ul><!-- /.breadcrumb -->					
</div>

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
								<h4 class="widget-title">
									Imagen Complementaria
									<?
									if($datos->imagen)
									{
									?>
										<button class="btn btn-danger btn-md remove_img_plantilla_img pull-right" 
										type="button"
										data-id="<?= $datos->id ?>"
										data-ref="complemento"
										data-tool="tooltip"
										title="Remover Imagen"
										data-img="<?= $datos->imagen ?>"

										>
											<i class="fa fa-remove"></i>
										</button>
									<?
									}
									?>
										
								</h4>
							</div>	
							 <div class="widget-body">
								 <div class="widget-main">
									<div>
										<input type="file" name="imagen">
								     </div>	
								     <div>
								     	<ul class="ace-thumbnails clearfix text-center" style="list-style-type: none;">
											<li class="">		
												<a id="ref_complemento" href="<?php echo base_url()?>assets_sistema/images/gallery/complementos_login/<?= $datos->imagen; ?>" data-rel="colorbox" class="text-center">
													
													<img id="imagen_complemento" width="200" height="170" alt="200x170" src="<?php echo base_url()?>assets_sistema/images/gallery/complementos_login/<?= $datos->imagen; ?>"/>
													
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
								<h4 class="widget-title">
									Imagen Cintillo
									<?
									if($datos->cintillo)
									{
									?>
										<button class="btn btn-danger btn-md remove_img_plantilla_img pull-right" 
										type="button"
										data-id="<?= $datos->id ?>"
										data-ref="cintillo"
										data-tool="tooltip"
										title="Remover Imagen"
										data-img="<?= $datos->cintillo ?>"
										>
											<i class="fa fa-remove"></i>
										</button>
									<?
									}
									?>
								</h4>
							</div>	
							 <div class="widget-body">
								 <div class="widget-main">
									<div>
										<input type="file" name="cintillo">
								     </div>	
								     <div>
								     	<ul class="ace-thumbnails clearfix text-center" style="list-style-type: none;">
											<li class="">		
												<a id="ref_cintillo" href="<?php echo base_url()?>assets_sistema/images/gallery/complementos_login/<?= $datos->cintillo; ?>"" data-rel="colorbox" class="text-center">
													
													<img id ="imagen_cintillo" width="200" height="170" alt="200x170" src="<?php echo base_url()?>assets_sistema/images/gallery/complementos_login/<?= $datos->cintillo; ?>"/>
													
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
								<h4 class="widget-title">
									Logo Reportes
									<?
									if($datos->logo)
									{
									?>
										<button class="btn btn-danger btn-md remove_img_plantilla_img pull-right" 
										type="button"
										data-id="<?= $datos->id ?>"
										data-ref="logo"
										data-tool="tooltip"
										title="Remover Imagen"
										data-img="<?= $datos->logo ?>"
										>
											<i class="fa fa-remove"></i>
										</button>
									<?
									}
									?>
								</h4>
							</div>	
							 <div class="widget-body">
								 <div class="widget-main">
									<div>
										<input type="file" name="logo">
								     </div>	
								     <div>
								     	<ul class="ace-thumbnails clearfix text-center" style="list-style-type: none;">
											<li class="">		
												<a id="ref_logo" href="<?php echo base_url()?>assets_sistema/images/gallery/complementos_login/<?= $datos->logo; ?>"" data-rel="colorbox" class="text-center">
													
													<img id = "imagen_logo" width="200" height="170" alt="200x170" src="<?php echo base_url()?>assets_sistema/images/gallery/complementos_login/<?= $datos->logo; ?>""/>
													
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
					<br/>
					<div class="row no-gutters">
						<div class="col-xs-12 text-right">
		   					<button class="btn btn-pink btn-md radius-4">
									<i class="ace-icon fa fa-floppy-o bigger-160"></i>
									Guardar Cambios
							</button>
						</div>
					</div>
				   <input type="hidden" id="id" name="id" value="<?php echo $datos->id ;?>">
</form>
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
			   


			
