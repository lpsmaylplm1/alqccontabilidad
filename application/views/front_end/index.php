<body class="login">
	<div>
		<a class="hiddenanchor" id="signup"></a>
		<a class="hiddenanchor" id="signin"></a>
		<div class="login_wrapper">

			<div class="animate form login_form">
				<div class="img-container">
					<img src="<?php echo base_url('assets/images/logo_big.jpg') ?>" alt="" class="img-responsive" style="border-radius: 10px; -webkit-box-shadow: 12px 19px 43px -19px rgba(0,0,0,0.75);
						 -moz-box-shadow: 12px 19px 43px -19px rgba(0,0,0,0.75);
						 box-shadow: 12px 19px 43px -19px rgba(0,0,0,0.75);"/>
				</div>
				<section class="login_content">
					<form id="form_log" method="POST"  action="<?php // echo base_url('login/login')              ?>"> 
						<h2>Inicio de sesión</h2>
						<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
							<input type="text" class="form-control active" placeholder="Usuario" id="user" name="user"  />
						</div>
						<div class="col-md-10 col-sm-10 col-xs-10 form-group has-feedback">

							<input type="password" class="form-control" placeholder="Contraseña" id="contrasenia" name="contrasenia" />

						</div>
						<div class="col-md-2 col-sm-2 col-xs-2">
							<button class="btn btn-default" id="ver_contra" name="ver_contra" data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar RFC" /><i class="fa fa-eye"></i></button>
						</div>
						<div>
							<button type="button" class="btn btn-danger" id="clean"><i class="fa fa-trash"></i> Limpiar</button>
							<button type="button" class="btn btn-success active" id="login"><i class="fa fa-sign-in" ></i> Iniciar sesión</button>

						</div>
						<div class="clearfix"></div>
						<div class="separator">
							<div style="overflow: hidden; display: none" id="loading">
								<img style="width: 50px; height: 50px" src="<?php echo base_url('assets/images/loading.gif') ?>" alt="" />
							</div>

							<div id="resp">

							</div>
							<div class="clearfix"></div>
							<br />

						</div>
					</form>
				</section>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function () {
			base_url = "<?php echo base_url(); ?>";
		});

		$('#user').focus();
		$('#ver_contra').click(function (event) {
			event.preventDefault();
			var tipo = document.getElementById("contrasenia");
			if (tipo.type == "password") {
				tipo.type = "text";
				$(this).children("i").addClass("fa-eye-slash");
			} else {
				tipo.type = "password";
				$(this).children("i").removeClass("fa-eye-slash");
				$(this).children("i").addClass("fa-eye");
			}
		});
		$('#login').click(function () {
			URL = base_url + "login/login";
			$.ajax({
				type: "POST",
				url: URL,
				data: $("#form_log").serialize(),
				dataType: "html",
				beforeSend: function () {
					$("#loading").show();
					$("#resp").empty();
				},
				success: function (data) {
					$("#loading").hide();
					$('#resp').html(data);
				}
			});
		});
		$('#clean').click(function () {
			$("#form_log")[0].reset();
			$("#resp").empty();
			$("#user").focus();
		});

	</script>

</body>


