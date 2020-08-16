

<!-- page content -->
<div class="right_col" role="main">

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Registro de Clientes.- <small>Por favor, ingrese los siguientes elementos</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </ul>
                    <div class="clearfix"> </div>
                </div>
                <div class="x_content" >
                    <form class="form-horizontal form-label-left input_mask" name="add_cte" id="add_cte" method="POST">
						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="nombres">NOMBRES </label>
							<input type="text" class="form-control has-feedback-left" id="nombres" name="nombres" placeholder="Nombres">
							<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="ap_p">APELLIDO PATERNO</label>
							<input type="text" class="form-control has-feedback-left" id="ap_p" name="ap_p" placeholder="Apellido Paterno">
							<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="ap_m">APELLIDO MATERNO</label>
							<input type="text" class="form-control has-feedback-left" id="ap_m" name="ap_m" placeholder="Apellido Materno">
							<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
						</div>				
						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="rfc">RFC</label>
							<input type="text" class="form-control has-feedback-left" id="rfc" name="rfc" placeholder="RFC">
							<span class="fa fa-folder form-control-feedback left" aria-hidden="true"></span>
						</div>

						<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="tipo_persona">TIPO DE PERSONA</label>
							<select class="form-control" name="tipo_persona" id="tipo_persona">
								<option value="" selected="selected">Tipo de Persona</option>
								<option value="1">Física</option>
								<option value="2">Moral</option>
							</select>
						</div>
						<div class="col-md-7 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="razon_social">RAZÓN SOCIAL</label>
							<input type="text" class="form-control has-feedback-left" id="razon_social" name="razon_social" placeholder="Razón social">
							<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="curp">CURP</label>
							<input type="text" class="form-control has-feedback-left" id="curp" name="curp" placeholder="CURP"/>
							<span class="fa fa-folder form-control-feedback left" aria-hidden="true"></span>
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="reg_patronal">NÚMERO DE REGISTRO PATRONAL</label>
							<input type="text" class="form-control has-feedback-left" id="reg_patronal" name="reg_patronal" placeholder="Registro Patronal">
							<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="correo_p">CORREO ELECTRÓNICO PERSONAL</label>
							<input type="text" class="form-control has-feedback-left" id="correo_p" name="correo_p" placeholder="Correo Personal">
							<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
						</div>

						<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="correo_e">CORREO ELECTRÓNICO (EMPRESA)</label>
							<input type="text" class="form-control has-feedback-left" id="correo_e" name="correo_e" placeholder="Correo Empresa">
							<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
						</div>
						<div class="col-md-7 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="direccion_fiscal">DIRECCIÓN FISCAL</label>
							<input type="text" class="form-control has-feedback-left" id="dirección_fiscal" name="direccion_fiscal" placeholder="Dirección Fiscal">
							<span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
						</div>
						<div class="col-md-5 col-sm-6 col-xs-12 form-group has-feedback">
							<label for="load_user_files">CARGAR CLAVES DE USUARIO (ARCHIVO ZIP)</label>
							<input type="file" class="form-control has-feedback-left" id="userfile" name="userfile" >
							<span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
						</div>

						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback ">
							<div class="checkbox">
								<label>
									<input type="checkbox"  name="activo" checked="TRUE"><i class="fa fa-cog"></i> ACTIVO 
								</label>
							</div>
						</div>

						<!--			<div class="ln_solid"></div>-->
						<div class="form-group">
							<div class="col-md-12 col-sm-69 col-xs-12 " style="text-align:  center">
								<button type="button" class="btn btn-danger"  id="clean_form"><i class="fa fa-eraser"></i> Limpiar Datos</button>
								<button type="submit" class="btn btn-success" id="save_cte"><i class="fa fa-save"></i> Guardar cliente</button>
							</div>
						</div>

                    </form>
					<div style="overflow: hidden; display: none;text-align: center" id="loading_save">
						<img style="width: 50px; height: 50px" src="<?php echo base_url('assets/images/loading.gif') ?>" alt="" />
					</div>
					<div id="result_save">

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
	$("#add_cte").on("submit", function (e) {
		e.preventDefault(e);
		var formData = new FormData(document.getElementById("add_cte"));
		$.ajax({
			url: base_url + 'clientes/agregar_cliente',
//            url: base_url + 'admin_productos/upload',
			type: "post",
			dataType: "html",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function () {
				$("#loading_save").show();
				$("#result_save").empty();
			}
		})
				.done(function (res) {
					$("#loading_save").hide();
					$("#result_save").html(res);

				});

	});

	$('#clean_form').click(function () {
		$("#add_cte")[0].reset();
		$("#result_save").empty();
		$("#nombres").focus();
	});
</script>
</div>
<!-- /page content -->
