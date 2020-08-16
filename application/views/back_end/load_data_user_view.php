

<div class="row"style="max-height: 550px;overflow-y: scroll;">
    <div class="col-md-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content" >
                <form class="form-horizontal form-label-left input_mask" name="load_edit_user" id="load_edit_user" action="" method="">
					<?php foreach ($prev_data_user as $load_data_user): ?>
						<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="id_venta">ID USER:</label>
							<input type="text" class="form-control has-feedback-left" id="id_user" name="id_user" value="<?php echo ($load_data_user->id_user) ?>" readonly="true" size="20" >
							<span class="fa fa-database form-control-feedback left" aria-hidden="true"></span>
						</div>

						<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="nombre_usr">Nombre</label>
							<input type="text" class="form-control has-feedback-left" id="nombre_usr" name="nombre_user" value="<?php echo ($load_data_user->nombre_user) ?>" >
							<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="ap_p_user">Apellido Paterno</label>
							<input type="text" class="form-control has-feedback-left" id="ap_p_user" name="ap_p_user" value="<?php echo ($load_data_user->ap_p_user) ?>" >
							<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="app_m_user">Apellido Materno</label>
							<input type="text" class="form-control has-feedback-left" id="app_m_user" name="app_m_user" value="<?php echo ($load_data_user->app_m_user) ?>" >
							<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="correo_user">Correo Electrónico</label>
							<input type="email" class="form-control has-feedback-left" id="correo_user" name="correo_user" value="<?php echo ($load_data_user->correo_user) ?>" >
							<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="tipo_usuario">Tipo  de usuario</label>
							<select class="form-control" name="tipo_usuario" id="tipo_usuario">
								<option value=""> Seleccione</option>
								<?php if (($load_data_user->nivel_user) == 1) { ?>
									<option value="1" selected="selected"> Administrador</option>
									<option value="2"> Auxiliar</option>
								<?php } else { ?>
									<option value="1" > Administrador</option>
									<option value="2" selected="selected"> Auxiliar</option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="usuario">USUARIO</label>
							<input type="text" class="form-control has-feedback-left" id="usuario" name="usuario" value="<?php echo ($load_data_user->usuario) ?>" >
							<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="password1">CONTRASEÑA</label>
							<input type="password" class="form-control has-feedback-left" id="password1" name="password1" value="<?php echo ($pass) ?>" >
							<span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
						</div>
						<div><hr /></div>
						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="password2">CONTRASEÑA</label>
							<input type="password" class="form-control has-feedback-left" id="password2" name="password2" value="<?php echo ($pass) ?>" >
							<span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
						</div>   
						<div class="col-md-2 col-sm-2 col-xs-2 form-group has-feedback">
							<label for="ver_contra">VER</label><br />
							<button class="btn btn-default" id="ver_contra" name="ver_contra"><i class="fa fa-eye"></i></button>
						</div>
						<div class="form-check col-md-4 col-sm-9 col-xs-12" style="vertical-align: middle">
							<br /> <br />
							<input type="checkbox" class="form-check" 
							<?php
							if ($load_data_user->user_activo == "1") {
								echo 'checked';
							} else {
								echo '';
							}
							?>   
								   id="activo" name="activo" value="1"> 
							<label class="form-check-label" for="activo">Usuario Activo</label>
						</div>

						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
								<div id="confirm_update_user">

								</div>
							</div>
							<div class="col-md-12 col-sm-9 col-xs-12 col-md-offset-3">

								<br />
								<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancelar Edición</button>
								<button type="button" class="btn btn-success" id="btn_submit_edit"><i class="fa fa-download"></i> Actualizar Usuario</button>
							</div>
						</div>
				</div>
			<?php endforeach; ?>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		base_url = "<?php echo base_url(); ?>";


	});
	$('#ver_contra').click(function (event) {
		event.preventDefault();
		var tipo = document.getElementById("password1");
		if (tipo.type == "password") {
			tipo.type = "text";
			$(this).children("i").addClass("fa-eye-slash");
		} else {
			tipo.type = "password";
			$(this).children("i").removeClass("fa-eye-slash");
			$(this).children("i").addClass("fa-eye");
		}
		var tipo = document.getElementById("password2");
		if (tipo.type == "password") {
			tipo.type = "text";
			$(this).children("i").addClass("fa-eye-slash");
		} else {
			tipo.type = "password";
			$(this).children("i").removeClass("fa-eye-slash");
			$(this).children("i").addClass("fa-eye");
		}
	});
	$('#btn_submit_edit').click(function () {
		$("#btn_submit_edit").prop('disabled', true);
		URL = base_url + "usuarios/get_data_edit_user";
		$.ajax({
			type: "POST",
			url: URL,
			data: $("#load_edit_user").serialize(),
			dataType: "html",
			beforeSend: function () {
				$("#confirm_update_user").empty();
			},
			success: function (data) {
//                    $("#btn_submit_edit").prop('disabled', false);
				$('#confirm_update_user').html(data);
				
			}
		});
	});
</script>