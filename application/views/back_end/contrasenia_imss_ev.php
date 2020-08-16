<div class="divider">

</div>
<div class="row">
	<div class="col-md-12 col-xs-12">
		<div class="col-md-12 col-sm-6 col-xs-12 ">
			<form class="form-horizontal form-label-left input_mask" name="add_pass_imss_ev" id="add_pass_imss_ev" method="POST">
				<input type="hidden" class="form-control has-feedback-left" id="id_cliente" name="id_cliente" value="<?php echo $id_cliente ?>">
				<input type="hidden" class="form-control has-feedback-left" id="tipo_pass" name="tipo_pass" value="<?php echo $tipo_pass ?>">
				<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="rfc_representante">RFC REPRESENTANTE LEGAL</label>
					<input type="text" class="form-control has-feedback-left" id="rfc_representante" name="rfc_representante" placeholder="RFC Representante">
					<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
				</div>
				<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="contrasenia_imss_ev">CONTRASEÑA</label>
					<input type="text" class="form-control has-feedback-left" id="contrasenia_imss_ev" name="contrasenia_imss_ev" placeholder="Contraseña">
					<span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
				</div>

				<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback" style="text-align: center">
					<button type="button" class="btn btn-success"  id="save_form_register_pass"><i class="fa fa-download"></i> Guardar contraseñas</button>
				</div>

			</form>
			<div style="overflow: hidden; display: none;text-align: center" id="loading_saving_data_cte">
				<img style="width: 50px; height: 50px" src="<?php echo base_url('assets/images/loading.gif') ?>" alt="" />
			</div>
			<div id="result_save_tpass">

			</div>
		</div>

	</div>


	<script type="text/javascript">
		$('#save_form_register_pass').click(function () {
			 $('#save_form_register_pass').prop('disabled', true);
			URL = base_url + "clientes/agregar_pass_imss_ev";
			$.ajax({
				type: "POST",
				url: URL,
				data: $("#add_pass_imss_ev").serialize(),
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