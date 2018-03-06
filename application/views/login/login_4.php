
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/assets_login1/css/main4.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-190 p-b-30">
				 <form action="<?=base_url();?>index.php/login/logueo" class="login100-form validate-form" method="post">	
					<div class="login100-form-avatar">
						<img src="<?php echo base_url()?>assets/assets_login1/images/usuario.jpg" alt="AVATAR">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						Inicio de Sesion
					</span>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Alerta Usuario es requerido">
						<input class="input100" type="text" name="username" placeholder="Usuario">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Alerta password es requerido">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn">
							Entrar
						</button>
					</div>


					<?php /*
					<div class="text-center w-full p-t-25 p-b-230">
						<a href="#" class="txt1">
							Forgot Username / Password?
						</a>
					</div>

					<div class="text-center w-full">
						<a class="txt1" href="#">
							Create new account
							<i class="fa fa-long-arrow-right"></i>						
						</a>
					</div>

					*/ ?>
				</form>
			</div>
		</div>
	</div>
