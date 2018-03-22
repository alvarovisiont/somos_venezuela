	<link href="<?php echo base_url()?>assets/assets_login1/css/main.css" rel="stylesheet" type="text/css">

<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				
				<img src="<?= base_url().'assets_sistema/images/gallery/complementos_login/'.$banner ?>" alt="" 
				style="width: 100%; max-width: 100%; height: auto;">


				 <form action="<?=base_url();?>index.php/login/logueo" class="login100-form validate-form" method="post">	

					<span class="login100-form-title p-b-43">
						<?= $titulo; ?>
					</span>
					
					
					<div class="wrap-input100 validate-input" data-validate = "Alerta Usuario es requerido">
						<input class="input100" type="text" name="username">
						<span class="focus-input100"></span>
						<span class="label-input100">Usuario</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Alerta password es requerido">
						<input class="input100" type="password" name="pass">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<?php /*
					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>

					
					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							or sign up using
						</span>
					</div>

					<div class="login100-form-social flex-c-m">
						<a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
							<i class="fa fa-facebook-f" aria-hidden="true"></i>
						</a>

						<a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
					</div>

					*/ ?>


				</form>

				<div class="login100-more" style="background-image: url('<?php echo base_url()?>assets_sistema/images/gallery/complementos_login/<?= $imagen ?>');">
				</div>
			</div>
		</div>
	</div>
	

  