

<!-- page content -->
<div class="right_col" role="main">

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Lista de clientes  registrados.- <small>Seleccione para ver detalles del cliente</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </ul>
                    <div class="clearfix"> </div>
                </div>
                <div class="x_content" >
					<div class="col-md-12 col-sm-6 col-xs-12 ">

						<table id="lista_clientes" class="display responsive nowrap" style="width:100%">
							<thead>
							<th>NOMBRE</th>
							<th>RFC</th>
							<th>VER DETALLE</th>
							</thead>
							<tbody>
								<?php foreach ($clientes as $data_cte): ?>
									<tr>
										<td>
											<?php
											if (trim($data_cte->nombres . ' ' . $data_cte->ap_p . ' ' . $data_cte->ap_m) == "") {
												echo 'N/A';
											} else {
												echo $data_cte->nombres . ' ' . $data_cte->ap_p . ' ' . $data_cte->ap_m;
											}
											?>
										</td>
										<td>
											<?php echo $data_cte->rfc ?>
										</td>
										<td>
											<button type="button"id="<?php echo $data_cte->id_cliente ?> " class="btn btn-success btn-xs detail_cte_modal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver detalle"><i class="fa fa-external-link"></i></button>
											<button type="button"id="<?php echo $data_cte->id_cliente ?> " class="btn btn-danger btn-xs detail_cte_pass_modal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Consultar contraseñas"><i class="fa fa-key"></i></button>
										</td>
									</tr>

								<?php endforeach; ?>
								<!--</div>-->
							</tbody>	
						</table>	
					</div>
				</div>

            </div>
        </div>
    </div>
    <br />
</div>
<!--MODAL -->

<div class="modal fade" id="detalle_cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Detalle de clientes</h4>
            </div>
            <div class="modal-body">
                <div id="cargar_detalle_cte">
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
	$('#save_cte').click(function () {
		URL = base_url + "clientes/agregar_cliente";
		$.ajax({
			type: "POST",
			url: URL,
			data: $("#add_cte").serialize(),
			dataType: "html",
			beforeSend: function () {
				$("#loading_save").show();
				$("#result_save").empty();
			},
			success: function (data) {
				$("#loading_save").hide();
				$('#result_save').html(data);
			}
		});
	});
	$('#clean_form').click(function () {
		$("#add_cte")[0].reset();
		$("#result_save").empty();
		$("#nombres").focus();
	});

	$("body").on('click', ".detail_cte_pass_modal", function (e) {
		e.preventDefault(e);
		var id_cliente = $(this).attr("id");
		$("#detalle_cliente").modal({backdrop: 'static', keyboard: false});
		$.ajax({
			url: base_url + "clientes/load_form_pass_clientes",
			async: true,
			type: 'POST',
			data: 'id_cliente=' + id_cliente,
			dataType: 'html',
			beforeSend: function () {
				$("#cargar_detalle_cte").empty();
			},
			success: function (load) {
				$("#cargar_detalle_cte").empty();
				$("#cargar_detalle_cte").append(load);
			}
		});
	});
	$("body").on('click', ".detail_cte_modal", function (e) {
		e.preventDefault(e);
		var id_cliente = $(this).attr("id");
		$("#detalle_cliente").modal({backdrop: 'static', keyboard: false});
		$.ajax({
			url: base_url + "clientes/detalle_clientes",
			async: true,
			type: 'POST',
			data: 'id_cliente=' + id_cliente,
			dataType: 'html',
			beforeSend: function () {
				$("#cargar_detalle_cte").empty();
			},
			success: function (load) {
				$("#cargar_detalle_cte").empty();
				$("#cargar_detalle_cte").append(load);
			}
		});
	});
</script>
</div>
<!-- /page content -->
