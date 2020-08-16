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
						<strong>CLAVE FIEL</strong>	
					</td>
					<td>
						<span id="c0"><?php echo $clave_fiel ?></span>
					</td>
					<td>
						<button <?php echo $control_button?> class="btn btn-success btn-xs" data-clipboard-target=#c0 data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar Clave FIEL"><i class="fa fa-copy"></i></button>
					</td>
				</tr>
				<tr>
					<td>
						<strong>CONTRASEÑA (ANTES CIEC)</strong>	
					</td>
					<td>
						<span id="c1"><?php echo $pass_sat ?></span>
					</td>
					<td>
						<button <?php echo $control_button?> class="btn btn-success btn-xs" data-clipboard-target=#c1 data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar Contraseña"><i class="fa fa-copy"></i></button>
					</td>
				</tr>

				<tr>
					<td>
						<strong>CLAVE SELLOS DIGITALES</strong>	
					</td>
					<td>
						<span id="c2"><?php echo $clave_sellosd ?></span>
					</td>
					<td>
						<button <?php echo $control_button?> class="btn btn-success btn-xs" data-clipboard-target=#c2 data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar Clave Sellos D."><i class="fa fa-copy"></i></button>
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