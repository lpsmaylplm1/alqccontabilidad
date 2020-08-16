<div class="divider">

</div>
<div class="row">
	<div class="col-md-12 col-xs-12">
		<table class="table" width="90%">
			<thead>
			<th colspan="3">DATOS DEL CLIENTE</th>
			</thead>
			<tbody>
				<?php foreach ($clientes_data as $data_cte): ?>
				<tr>
					<td>
						<strong>REGISTRO PATRONAL</strong>	
					</td>
					<td>
						<span id="c0"><?php echo $data_cte->reg_patronal ?></span>
					</td>
					<td>
						<button <?php echo $control_button ?> class="btn btn-success btn-xs" data-clipboard-target=#c0 data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar Registro Patronal"><i class="fa fa-copy"></i></button>
					</td>
				</tr>
				<tr>
					<td>
						<strong>CORREO PERSONAL </strong>	
					</td>
					<td>
						<span id="c1"><?php echo $data_cte->correo_p ?></span>
					</td>
					<td>
						<button <?php echo $control_button ?> class="btn btn-success btn-xs" data-clipboard-target=#c1 data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar Correo Personal"><i class="fa fa-copy"></i></button>
					</td>
				</tr>
				<tr>
					<td>
						<strong>CORREO EMPRESA </strong>	
					</td>
					<td>
						<span id="c2"><?php echo $data_cte->correo_e ?></span>
					</td>
					<td>
						<button <?php echo $control_button ?> class="btn btn-success btn-xs" data-clipboard-target=#c2 data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar Correo Empresa"><i class="fa fa-copy"></i></button>
					</td>
				</tr>
				<?php endforeach ?>
				<tr>
					<td>
						<strong>CONTRASEÑA INFONAVIT </strong>	
					</td>
					<td>
						<span id="c3"><?php echo $pass_infonavit ?></span>
					</td>
					<td>
						<button <?php echo $control_button ?> class="btn btn-success btn-xs" data-clipboard-target=#c3 data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar Contraseña Infonavit"><i class="fa fa-copy"></i></button>
					</td>
				</tr>
			</tbody>	
		</table>	
	</div>
</div>


<script type="text/javascript">
	new ClipboardJS('.btn');
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>
