
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/assets_login1/css/main5.css">
<!--===============================================================================================-->
</head>
<body>
	<img src="<?= base_url().'assets_sistema/images/gallery/complementos_login/'.$banner ?>" alt="" 
		style="width: 100%; max-width: 100%; height: auto;">
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				

				<div class="login100-form-title" style="background-image: url(<?php echo base_url()?>assets_sistema/images/gallery/complementos_login/<?= $imagen ?>);">
					<span class="login100-form-title-1">
						<?= $titulo; ?>
					</span>
				</div>

				 <form action="<?=base_url();?>index.php/login/logueo" class="login100-form validate-form" method="post">	
					<div class="wrap-input100 validate-input m-b-26" data-validate="Alerta Usuario es requerido">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Usuario">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Alerta password es requerido">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
					</div>

					<?php /*
					<div class="flex-sb-m w-full p-b-30">
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

					*/ ?>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
