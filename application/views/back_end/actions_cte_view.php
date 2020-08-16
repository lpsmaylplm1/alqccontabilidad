
<!-- page content -->
<div class="right_col" role="main">

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="x_panel col-md-3 col-sm-6 col-xs-12">
                <div class="x_title">
                    <h2>Operaciones con clientes  registrados.- <small>Seleccione <i style="color:green" class="fa fa-plus-circle"></i> para ver más  detalles del cliente</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </ul>
                    <div class="clearfix"> </div>
                </div>
                <div class="x_content" >
					<table id="lista_clientes" class="display responsive nowrap" >
						<thead>
							<tr>

								<th>NOMBRE CLIENTE</th>
								<th>ACCIONES</th>
								<th>RFC</th>
								<th>TIPO DE PERSONA</th>
								<th>RAZÓN SOCIAL</th>
								<th>CURP</th>
								<th>REG. PATRONAL</th>
								<th>CORREO PERSONAL</th>
								<th>CORREO EMPRESA.</th>
								<th>DIRECCIÓN FISCAL</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($clientes as $data_cte): ?>
								<tr>

									<td>
										<div id="c1">
											<?php
											if (trim($data_cte->nombres . ' ' . $data_cte->ap_p . ' ' . $data_cte->ap_m) == "") {
												echo 'N/A';
											} else {
												echo $data_cte->nombres . ' ' . $data_cte->ap_p . ' ' . $data_cte->ap_m;
											}
											?>
										</div>
									</td>
									<td>
	<!--										<button class="btn btn-sm" data-clipboard-target=#c2><i class="fa fa-copy"></i></button>-->
										<button type="button"id="<?php echo $data_cte->id_cliente ?> " class="btn btn-success btn-xs cte_edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar Cliente"><i class="fa fa-edit"></i></button>
										<button type="button" id="<?php echo $data_cte->id_cliente ?> "  class="btn btn-danger btn-xs delete_cte" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar Cliente"><i class="fa fa-trash"></i></button>
										<button type="button"id="<?php echo $data_cte->id_cliente ?>" class="btn btn-info btn-xs register_pass" data-toggle="tooltip" data-placement="top" title="" data-original-title="Registrar contraseñas"><i class="fa fa-key"></i></button>
									</td>
									<td>
										<div  id="c2"><?php echo $data_cte->rfc ?></div></td>
									<td>
										<?php
										$tipo = $data_cte->tipo_persona;
										if ($tipo == 1) {
											echo "Persona Física";
										} else {
											echo "Persona Moral";
										}
										?>
									</td>
									<td>
										<div id="c3">
											<?php
											if (trim($data_cte->razon_social) == "") {
												echo 'N/A';
											} else {
												echo $data_cte->razon_social;
											}
											?>
										</div>
									</td>
									<td><div id="c4"><?php echo $data_cte->curp ?></div></td>
									<td><div id="c5"><?php echo $data_cte->reg_patronal ?></div></td>
									<td><div id="c6"><?php echo $data_cte->correo_p ?></div></td>
									<td><div id="c7"><?php echo $data_cte->correo_e ?></div></td>
									<td><div id="c8" ><?php echo wordwrap($data_cte->direc_fiscal, 45, "<br>", FALSE); ?></div></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>


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
<!--MODAL -->
<div class="modal fade" id="form_pass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
	<!--<div class="modal-dialog modal-lg">-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" id="myModalLabel">Realizar operaciones con clientes</h4>
            </div>
            <div class="modal-body">
                <div id="cargar_detalle_pass">
                    <!-- Contenido de la ventana modal-->

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar Ventana</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
	new ClipboardJS('.btn');
	$(document).ready(function () {
		base_url = "<?php echo base_url(); ?>";


		$('#lista_clientes').DataTable({
			language: {
				processing: "Procesando...",
				search: "BUSCAR:",
				lengthMenu: "Mostrar _MENU_ registros",
				info: "Mostrando _START_  de _END_  de un total de _TOTAL_ registros",
				infoEmpty: "Mostrando  0 coincidencias",
				infoFiltered: "(de un total de _MAX_ registros)",
				infoPostFix: "",
				loadingRecords: "Cargando...",
				zeroRecords: "No existen registros que mostrar",
				emptyTable: "No existen registros en la tabla",
				paginate: {
					first: "Primer",
					previous: "Anterior",
					next: "Siguiente",
					last: "Último"
				},
				aria: {
					sortAscending: ": Ordenar la columna en forma Ascendente",
					sortDescending: ": Ordenar la columna en forma Descendente"
				}
			}
		});
	});
	$("body").on('click', ".register_pass", function (e) {
		e.preventDefault(e);
		var id_cliente = $(this).attr("id");
		$("#form_pass").modal({backdrop: 'static', keyboard: false});
		$.ajax({
			url: base_url + "clientes/select_type_pass",
			async: true,
			type: 'POST',
			data: 'id_cliente=' + id_cliente,
			dataType: 'html',
			beforeSend: function () {
				$("#cargar_detalle_pass").empty();
			},
			success: function (load) {
				$("#cargar_detalle_pass").empty();
				$("#cargar_detalle_pass").append(load);
			}
		});
	});
	$("body").on('click', ".cte_edit", function (e) {
		e.preventDefault(e);
		var id_cliente = $(this).attr("id");
		$("#form_pass").modal({backdrop: 'static', keyboard: false});
		$.ajax({
			url: base_url + "clientes/edit_cte",
			async: true,
			type: 'POST',
			data: 'id_cliente=' + id_cliente,
			dataType: 'html',
			beforeSend: function () {
				$("#cargar_detalle_pass").empty();
			},
			success: function (load) {
				$("#cargar_detalle_pass").empty();
				$("#cargar_detalle_pass").append(load);
			}
		});
	});
	$("body").on('click', ".delete_cte", function (e) {
		e.preventDefault(e);
		var id_cliente = $(this).attr("id");
		$("#form_pass").modal({backdrop: 'static', keyboard: false});
		$.ajax({
			url: base_url + "clientes/delete_cte",
			async: true,
			type: 'POST',
			data: 'id_cliente=' + id_cliente,
			dataType: 'html',
			beforeSend: function () {
				$("#cargar_detalle_pass").empty();
			},
			success: function (load) {
				$("#cargar_detalle_pass").empty();
				$("#cargar_detalle_pass").append(load);
			}
		});
	});
</script>
</div>
<!-- /page content -->
