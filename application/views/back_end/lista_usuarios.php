
<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->

    <!-- /top tiles -->

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> <i class="fa fa-users"></i> LISTA DE USUARIOS REGISTRADOS EN EL SISTEMA.<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </ul>
                    <div class="clearfix"> </div>
                </div>
                <div class="x_content" >
                    <div class="x_content">
                        <table class="display responsive nowrap" id="lista_publicaciones" style="width:100%">
                            <thead>
                                <tr>
                                    <th>NOMBRE COMPLETO</th>
			   <th>OPERACIONES</th>
                                    <th>USUARIO</th>
			    <th>ESTADO</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach ($prev_usr as $usr): ?>

									<tr>
										<td><i class="fa fa-user"></i> <?php echo ($usr->nombre_user . ' ' . $usr->ap_p_user . ' ' . $usr->app_m_user ) ?></td>
										<td>
											<button  type="button"id="<?php echo ($usr->id_user) ?>" class="btn btn-info btn-xs consultar_registro"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver detalle del Registro"><i class="fa fa-info-circle "></i></button>
											<button type="button"id="<?php echo ($usr->id_user) ?>" class="btn btn-success btn-xs editar_registro" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar el Registro"><i class="fa fa-edit "></i></button>
											<button type="button" id="<?php echo ($usr->id_user) ?>" class="btn btn-danger btn-xs eliminar_registro"data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar el Registro" ><i class="fa fa-trash"></i></button>
										</td>
										<td><i class="fa fa-user"></i> <?php echo ($usr->usuario) ?></td>	
										<td>
											<?php
											if ($usr->user_activo == "1") {
												$activo = '<span style="color:green"><i class="fa fa-check"></i> Activo</span>';
											} else {
												$activo = '<span style="color:red"><i class="fa fa-times"></i> Inactivo</span>';
											}
											echo $activo;
											?>

										</td>
										


									</tr>
								<?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <br />
</div>


<!-- modals -->
<!-- Large modal -->


<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;overflow:scroll; "id="resultado" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><strong>X</strong></span>  </button>

                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user"></i> Operaciones con usuarios</h4>
            </div>
            <div class="modal-body" >
                <div  id="cargar_detalle">

                </div>
            </div>
            <!--            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>-->

        </div>
    </div>
</div>



<!-- /page content -->
<script type="text/javascript">

	$(document).ready(function () {

		base_url = "<?php echo base_url(); ?>";
		$('#lista_publicaciones').DataTable({
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

	$("body").on('click', ".editar_registro", function () {
		base_url = "<?php echo base_url(); ?>";
		var id_user = $(this).attr("id");
		$("#resultado").modal({backdrop: 'static', keyboard: false});
		$("#icon").show();
		$.ajax({
			type: "POST",
			url: base_url + "usuarios/load_data_user",
			data: 'id_user=' + id_user,
			dataType: "html",
			beforeSend: function () {
				$("#cargar_detalle").empty();
			},
			success: function (load)
			{
				$("#descrip").focus();
				$("#icon").hide();
				$("#cargar_detalle").empty();
				$("#cargar_detalle").append(load);
			}
		});
	});
	$("body").on('click', ".consultar_registro", function () {
		base_url = "<?php echo base_url(); ?>";
		var id_user = $(this).attr("id");
		$("#resultado").modal({backdrop: 'static', keyboard: false});

		$.ajax({
			type: "POST",
			url: base_url + "usuarios/get_data_user",
			data: 'id_user=' + id_user,
			dataType: "html",
			beforeSend: function () {
				$("#cargar_detalle").empty();
			},
			success: function (load)
			{
				$("#cargar_detalle").empty();
				$("#cargar_detalle").append(load);
			}
		});
	});
	$("body").on('click', ".eliminar_registro", function () {
		base_url = "<?php echo base_url(); ?>";
		var id_user = $(this).attr("id");
		$("#resultado").modal({backdrop: 'static', keyboard: false});
		$("#icon").show();
		$.ajax({
			type: "POST",
			url: base_url + "usuarios/del_user",
			data: 'id_user=' + id_user,
			dataType: "html",
			beforeSend: function () {
				$("#cargar_detalle").empty();
			},
			success: function (load)
			{
				$("#icon").hide();
				$("#cargar_detalle").empty();
				$("#cargar_detalle").append(load);
			}
		});
	});

</script>