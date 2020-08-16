<div class="divider">

</div>
<div class="row">
	<div class="col-md-12 col-xs-12">
		<div class="col-md-12 col-sm-6 col-xs-12 ">
			<form class="form-horizontal form-label-left input_mask" name="add_pass_finanzas" id="add_pass_finanzas" method="POST">
				<input type="hidden" class="form-control has-feedback-left" id="id_cliente" name="id_cliente" value="<?php echo $id_cliente ?>">
				<input type="hidden" class="form-control has-feedback-left" id="tipo_pass" name="tipo_pass" value="<?php echo $tipo_pass ?>">

				<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="usuario_finanzas">USUARIO PÁGINA FINANZAS</label>
					<input type="text" class="form-control has-feedback-left" id="usuario_finanzas" name="usuario_finanzas" placeholder="Usuario">
					<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
				</div>
				<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="contrasenia_finanzas">CONTRASEÑA</label>
					<input type="text" class="form-control has-feedback-left" id="contrasenia_finanzas" name="contrasenia_finanzas" placeholder="Contraseña">
					<span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
				</div>
				<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="clave_elector">CLAVE ELECTOR</label>
					<input type="text" class="form-control has-feedback-left" id="clave_elector" name="clave_elector" placeholder="Clave Elector">
					<span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
				</div>
				<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="banco">NOMBRE DE BANCO</label>
					<input type="text" class="form-control has-feedback-left" id="banco" name="banco" placeholder="Banco">
					<span class="fa fa-bank form-control-feedback left" aria-hidden="true"></span>
				</div>
				<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="clave_bancaria">CLABE INTERBANCARIA</label>
					<input type="text" class="form-control has-feedback-left" id="clabe_bancaria" name="clabe_bancaria" placeholder="CLABE">
					<span class="fa fa-sign-in form-control-feedback left" aria-hidden="true"></span>
				</div>
				<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback" style="text-align: center">
					<button type="button" class="btn btn-success"  id="save_form_register_pass"><i class="fa fa-download"></i> Guardar contraseñas</button>
				</div>

			</form>
			<div style="overflow: hidden; display: none;text-align: center" id="loading_saving_data_fin_cte">
				<img style="width: 50px; height: 50px" src="<?php echo base_url('assets/images/loading.gif') ?>" alt="" />
			</div>
			<div id="result_save_tpass">

			</div>
		</div>

	</div>


	<script type="text/javascript">
		$('#save_form_register_pass').click(function () {
			 $('#save_form_register_pass').prop('disabled', true);
			URL = base_url + "clientes/agregar_pass_finanzas";
			$.ajax({
				type: "POST",
				url: URL,
				data: $("#add_pass_finanzas").serialize(),
				dataType: "html",
				beforeSend: function () {
					
					$("#loading_saving_data_cte").show();
					$("#result_save_tpass").empty();
				},
				success: function (data) {

					$("#loading_saving_data_cte").hide();
					$('#result_save_tpass').html(data);
				}
			});
		});
	</script>