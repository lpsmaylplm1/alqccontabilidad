
<div class="row">
	<div class="col-md-12 col-xs-12">
		<div class="x_panel">
			<div class="x_content" >
				<div class="col-md-12 col-sm-6 col-xs-12 ">
					<form class="form-horizontal form-label-left input_mask" name="add_pass" id="add_pass" method="POST">
						<?php foreach ($clientes_data as $data_cte): ?>
							<input type="hidden" value="<?php echo $data_cte->id_cliente ?>" name="id_cliente" id="id_cliente" />
							<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
								<i class="fa fa-key"></i> REGISTRAR CONTRASEÑAS PARA: <i class="fa fa-user"></i> <strong><?php echo strtoupper($data_cte->nombres) . ' ' . strtoupper($data_cte->ap_p) . ' ' . strtoupper($data_cte->ap_m); ?></strong>
							</div>
						<?php endforeach; ?>
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<select class="form-control" name="tipo_pass" id="tipo_pass">
								<option value="" selected="selected">Seleccione sistema a registrar</option>
								<option value="1"> SAT</option>
								<option value="2"> FINANZAS ESTATAL</option>
								<option value="3"> IMSS</option>
								<option value="4"> IMSS ESCRITORIO VIRTUAL</option>
								<option value="5"> SIPARE</option>
								<option value="6"> INFONAVIT</option>
							</select>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12" >
							<button type="button" class="btn btn-success"  id="load_form_register_pass"  > Continuar <i class="fa fa-arrow-right"></i></button>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12 ">
							<button type="button" class="btn btn-danger"  id="cancel_all"> Cancelar  <i class="fa fa-ban"></i></button>
						</div>


					</form>

					<div id="load_form_detail">

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
	});
	$('#load_form_register_pass').click(function () {
		URL = base_url + "clientes/load_type_form_pass";
		$.ajax({
			type: "POST",
			url: URL,
			data: $("#add_pass").serialize(),
			dataType: "html",
			beforeSend: function () {
				$("#load_form_detail").empty();
			},
			success: function (data) {
				$("#tipo_pass").prop("disabled", true);
				$("#load_form_register_pass").prop("disabled", true);
				$('#load_form_detail').html(data);
			}
		});
	});
	$('#cancel_all').click(function () {
		$('#load_form_detail').empty();
		$('#tipo_pass').prop("disabled", false);
		$('#load_form_register_pass').prop("disabled", false);
		 $('#tipo_pass')[0].selectedIndex = 0; 
	});


</script>