<div class="row">
	<div class="col-md-12 col-xs-12">
		<form class="form-horizontal form-label-left input_mask" name="del_data" id="del_data" method="POST">
			<input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $id_cliente ?>" />
			<div class="alert alert-danger" style="text-align: center">
				<div style="text-align: center"><i class="fa fa-exclamation-triangle fa-3x"></i></div>
				<h2>¿Confirma que desea eliminar los datos de este usuario? </h2>
				<strong>NOTA:</strong> No es posible recuperar la información del cliente posterior al proceso de eliminación.
			</div>

			<div class="form-group">
				<div class="col-md-12 col-sm-69 col-xs-12 " style="text-align:  center">
					<button type="button" class="btn btn-success" id="delete_cte"><i class="fa fa-save"></i> Confirmar eliminación  </button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar Eliminación</button>

				</div>
			</div>

		</form>
		<div style="overflow: hidden; display: none;text-align: center" id="loading_del_cte">
			<img style="width: 50px; height: 50px" src="<?php echo base_url('assets/images/loading.gif') ?>" alt="" />
		</div>
		<div id="result_del_cte">

		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		base_url = "<?php echo base_url(); ?>";
	});
//	$("#del_data").on("submit", function (e) {
//		e.preventDefault(e);
//		alert("hola");
//		var formData = new FormData(document.getElementById("del_data_cte"));
//		alert (formData);
//		$.ajax({
//			url: base_url + 'clientes/confirma_delete_cte',
//			type: "post",
//			dataType: "html",
//			data: formData,
//			cache: false,
//			contentType: false,
//			processData: false,
//			beforeSend: function () {
//				$("#loading_del_cte").show();
//				$("#result_del_cte").empty();
//			}
//		})
//				.done(function (res) {
//					$("#loading_del_cte").hide();
//					$("#result_del_cte").html(res);
//
////				});
//
//	});
	$('#delete_cte').click(function () {
		URL = base_url + 'clientes/confirma_delete_cte',
				$.ajax({
					type: "POST",
					url: URL,
					data: $("#del_data").serialize(),
					dataType: "html",
					beforeSend: function () {
						$("#loading_del_cte").show();
						$("#result_del_cte").empty();
					},
					success: function (data) {
						$("#loading_del_cte").hide();
						$("#result_del_cte").html(data);
					}
				});
	});


