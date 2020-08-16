<div class="divider">

</div>
<div class="row">
	<div class="col-md-12 col-xs-12">
		<table class="table" width="90%">
			<thead>
			<th colspan="3">DATOS DEL CLIENTE</th>
			</thead>
			<tbody>
				<tr>
					<td>
						<strong>USUARIO FINANZAS</strong>	
					</td>
					<td>
						<span id="c0"><?php echo $usuario_fin ?></span>
					</td>
					<td>
						<button <?php echo $control_button ?> class="btn btn-success btn-xs" data-clipboard-target=#c0 data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar Usuario"><i class="fa fa-copy"></i></button>
					</td>
				</tr>
				<tr>
					<td>
						<strong>CONTRASEÑA </strong>	
					</td>
					<td>
						<span id="c1"><?php echo $pass_fin ?></span>
					</td>
					<td>
						<button <?php echo $control_button ?> class="btn btn-success btn-xs" data-clipboard-target=#c1 data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar Contraseña"><i class="fa fa-copy"></i></button>
					</td>
				</tr>

				<tr>
					<td>
						<strong>CLAVE ELECTOR</strong>	
					</td>
					<td>
						<span id="c2"><?php echo $clave_elector ?></span>
					</td>
					<td>
						<button <?php echo $control_button ?> class="btn btn-success btn-xs" data-clipboard-target=#c2 data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar Clave Elector"><i class="fa fa-copy"></i></button>
					</td>
				</tr>
				<tr>
					<td>
						<strong>BANCO</strong>	
					</td>
					<td>
						<span id="c3"><?php echo $banco ?></span>
					</td>
					<td>
						<button <?php echo $control_button ?> class="btn btn-success btn-xs" data-clipboard-target=#c3 data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar Banco"><i class="fa fa-copy"></i></button>
					</td>
				</tr>
				<tr>
					<td>
						<strong>CLABE INTERBANCARIA</strong>	
					</td>
					<td>
						<span id="c4"><?php echo $clabe_bancaria ?></span>
					</td>
					<td>
						<button <?php echo $control_button ?> class="btn btn-success btn-xs" data-clipboard-target=#c4 data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar Clabe Interbancaria"><i class="fa fa-copy"></i></button>
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