<div class="row">


	<div class="col-md-12 col-xs-12">

		<form class="form-horizontal form-label-left input_mask" name="edit_data_cte" id="edit_data_cte" method="POST">
			<input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $id_cliente ?>" />
			<?php foreach ($clientes_data as $data_cte): ?>
				<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="nombres">NOMBRES </label>
					<input type="text" class="form-control " id="nombres" name="nombres" value="<?php echo $data_cte->nombres ?>">
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="ap_p">APELLIDO PATERNO</label>
					<input type="text" class="form-control " id="ap_p" name="ap_p"value="<?php echo $data_cte->ap_p ?>">
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="ap_m">APELLIDO MATERNO</label>
					<input type="text" class="form-control " id="ap_m" name="ap_m" value="<?php echo $data_cte->ap_m ?>">
				</div>				
				<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="rfc">RFC</label>
					<input type="text" class="form-control " id="rfc" name="rfc" value="<?php echo $data_cte->rfc ?>">
				</div>

				<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="tipo_persona">TIPO DE PERSONA</label>
					<select class="form-control" name="tipo_persona" id="tipo_persona">
						<option value="" >Tipo de Persona</option>
						<?php
						$tipo_cte = $data_cte->tipo_persona;

						if ($tipo_cte == 1) {
							?>
							<option value="1" selected="selected">Física</option>
							<option value="2">Moral</option>
						<?php } else { ?>
							<option value="1" >Física</option>
							<option value="2" selected="selected">Moral</option>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="reg_patronal">REGISTRO PATRONAL</label>
					<input type="text" class="form-control " id="reg_patronal" name="reg_patronal" value="<?php echo $data_cte->reg_patronal ?>">
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="razon_social">RAZÓN SOCIAL</label>
					<input type="text" class="form-control " id="razon_social" name="razon_social" value="<?php
					if (trim($data_cte->razon_social) == "") {
						echo 'N/A';
					} else {
						echo $data_cte->razon_social;
					}
					?>">
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="curp">CURP</label>
					<input type="text" class="form-control " id="curp" name="curp" value="<?php echo $data_cte->curp ?>"/>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="correo_p">CORREO ELECTRÓNICO PERSONAL</label>
					<input type="text" class="form-control " id="correo_p" name="correo_p" value="<?php echo $data_cte->correo_p ?>">
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="correo_e">CORREO ELECTRÓNICO (EMPRESA)</label>
					<input type="text" class="form-control " id="correo_e" name="correo_e" value="<?php echo $data_cte->correo_e ?>">
				</div>
				<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="direccion_fiscal">DIRECCIÓN FISCAL</label>
					<input type="text" class="form-control " id="dirección_fiscal" name="direccion_fiscal" value="<?php echo $data_cte->direc_fiscal ?>">
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback ">
					<input type="hidden" name="file_name" id="file_name" value="<?php echo $data_cte->file_name ?>"/>
					<div class="checkbox">
						<label>
							<input type="checkbox"  name="activo"id="load_new_files" ><i class="fa fa-exclamation-triangle " style="color:red; text-shadow: 2px 2px 2px #aaa"></i> NO CARGAR NUEVOS ARCHIVOS 
						</label>
					</div>
				</div>
				<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="load_user_files">CARGAR CLAVES DE USUARIO (ARCHIVO ZIP)</label>
					<input type="file" class="form-control " id="userfile" name="userfile" >
				</div>
			<?php endforeach; ?>
			<!--			<div class="ln_solid"></div>-->
			<div class="form-group">
				<div class="col-md-12 col-sm-69 col-xs-12 " style="text-align:  center">
					<button type="submit" class="btn btn-success" id="save_cte"><i class="fa fa-save"></i> Actualizar datos </button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar actualización</button>
					
				</div>
			</div>

		</form>
		<div style="overflow: hidden; display: none;text-align: center" id="loading_edit_cte">
			<img style="width: 50px; height: 50px" src="<?php echo base_url('assets/images/loading.gif') ?>" alt="" />
		</div>
		<div id="result_edit_cte">

		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		base_url = "<?php echo base_url(); ?>";
	});
	$("#edit_data_cte").on("submit", function (e) {
		e.preventDefault(e);
		var formData = new FormData(document.getElementById("edit_data_cte"));
		$.ajax({
			url: base_url + 'clientes/data_edit_cte',
//            url: base_url + 'admin_productos/upload',
			type: "post",
			dataType: "html",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function () {
				$("#loading_edit_cte").show();
				$("#result_edit_cte").empty();
			}
		})
				.done(function (res) {
					$("#loading_edit_cte").hide();
					$("#result_edit_cte").html(res);

				});

	});

//	$('#load_new_files').change(function () {
//		$('#userfile').prop('disabled', false);
//	});
	$('#load_new_files').change(function () {
		$('#userfile').attr('disabled', this.checked);
	});

</script>
</div>
<!-- /page content -->
