
<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->

    <!-- /top tiles -->

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> <i class="fa fa-users"></i> REGISTRAR NUEVO USUARIO EN EL SISTEMA</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </ul>
                    <div class="clearfix"> </div>
                </div>
                <div class="x_content" >
                    <form class="form-horizontal form-label-left input_mask" name="load_data_user" id="load_data_user" >
                        <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                            <label for="nombre_usr">Nombres</label>
                            <input type="text" class="form-control has-feedback-left" id="nombre_usr" name="nombre_user" >
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                            <label for="ap_p_user">Apellido Paterno</label>
                            <input type="text" class="form-control has-feedback-left" id="ap_p_user" name="ap_p_user" >
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                            <label for="app_m_user">Apellido Materno</label>
                            <input type="text" class="form-control has-feedback-left" id="app_m_user" name="app_m_user" >
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                            <label for="correo_user">Correo Electrónico</label>
                            <input type="email" class="form-control has-feedback-left" id="correo_user" name="correo_user">
                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>
		<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                            <label for="tipo_usuario">Tipo  de usuario</label>
				<select class="form-control" name="tipo_usuario" id="tipo_usuario">
					<option value="" selected="selected">Seleccione</option>
					<option value="1"> Administrador</option>
					<option value="2"> Auxiliar</option>
					
				</select>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                            <label for="usuario">USUARIO</label>
                            <input type="text" class="form-control has-feedback-left" id="usuario" name="usuario"  >
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                            <label for="password1">CONTRASEÑA</label>
                            <input type="password" class="form-control has-feedback-left" id="password1" name="password1"  >
                            <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                            <label for="password1">CONFIRMAR CONTRASEÑA</label>
                            <input type="password" class="form-control has-feedback-left" id="password2" name="password2"  >
                            <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div><hr /></div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                                <div id="confirm_save_user">
                                </div>
                            </div>
                        </div>

                    </form>
					<div class="col-md-12 col-sm-9 col-xs-12 " style="text-align: center">
						<button  id="btn_submit_edit" class="btn btn-success" data-dismiss="modal"><i class="fa fa-user"></i> Registrar  usuario</button> 
						<button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar y limpiar</button> 
					</div>


                </div>
            </div>
        </div>
    </div>
    <br />
</div>

<script type="text/javascript">
	$(document).ready(function () {
		base_url = "<?php echo base_url(); ?>";
	});
	$('#btn_submit_edit').click(function () {

		$("#btn_submit_edit").prop('disabled', true);
		URL = base_url + "usuarios/save_user";
		$.ajax({
			type: "POST",
			url: URL,
			data: $("#load_data_user").serialize(),
			dataType: "html",
			beforeSend: function () {
				$("#confirm_save_user").empty();
			},
			success: function (data) {
				$('#confirm_save_user').html(data);
			}
		});
	});
</script>