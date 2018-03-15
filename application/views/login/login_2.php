
  <link href="<?php echo base_url()?>assets/assets_login1/css/main2.css" rel="stylesheet" type="text/css">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?php echo base_url()?>assets/assets_login1/images/integracion_de_sistemas.jpg" alt="IMG">
				</div>

				 <form action="<?=base_url();?>index.php/login/logueo" class="login100-form validate-form" method="post">	
	
			<?php if($this->session->userdata('usuario_mensj'))
					{?>
                    <div>
                       <p>
						<span><?php echo $this->session->userdata('usuario_mensj');?></span>
					   </p>
                </div>
             <?php  } ?>	

					<span class="login100-form-title">
						<?= $titulo; ?>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Alerta email es requerido: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
	
						<div class="wrap-input100 validate-input" data-validate="Alerta password es requerido">

						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Entrar
						</button>
					</div>


					<?php /*
					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>

					*/ ?>

				</form>
			</div>
		</div>
	</div>
