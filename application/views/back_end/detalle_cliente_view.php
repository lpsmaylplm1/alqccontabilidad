
<div class="row">
	<div class="col-md-12 col-xs-12">
		<div class="col-md-12 col-sm-6 col-xs-12 ">
			<table class="table" width="90%">
				<thead>
				<th colspan="3">DATOS DEL CLIENTE</th>
				</thead>
				<tbody>
					<?php foreach ($clientes_data as $data_cte): ?>
						<tr>
							<td>
								<strong>CLIENTE:</strong>
							</td>
							<td>
								<?php
								if (trim($data_cte->nombres . ' ' . $data_cte->ap_p . ' ' . $data_cte->ap_m) == "") {
									echo 'N/A';
								} else {
									echo '<strong>' . strtoupper($data_cte->nombres) . ' ' . strtoupper($data_cte->ap_p) . ' ' . strtoupper($data_cte->ap_m) . '</strong>';
								}
								?>
							</td>
							<td>

							</td>
						</tr>
						<!--</div>-->
						<!--<div  class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">-->
						<tr>
							<td>
								<strong>RFC:</strong>	
							</td>
							<td>
								<span id="c1"> <?php echo $data_cte->rfc ?></span>
							</td>
							<td>
								<button class="btn btn-success btn-xs" data-clipboard-target=#c1 data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar RFC"><i class="fa fa-copy"></i></button>
							</td>
						</tr>



						<!--</div>-->

						<!--<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">-->
						<tr>
							<td> <strong>TIPO:</strong></td>
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

							</td>
						</tr>
						<!--</div>-->


						<!--<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">-->
						<tr>
							<td> <strong>RAZÓN SOCIAL:</strong></td>
							<td>
								<?php
								if (trim($data_cte->razon_social) == "") {
									echo 'N/A';
								} else {
									echo $data_cte->razon_social;
								}
								?>
							</td>
							<td>

							</td>
						</tr>
					<div>

					</div>
					<!--</div>-->
					<!--<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">-->
					<tr>
						<td> <strong>CURP:</strong></td>
						<td><span id="c2">
								<?php
								if (trim($data_cte->curp) == '') {
									echo ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
								} else {
									echo $data_cte->curp;
								}
								?>
							</span>
						</td>
						<td>
							<?php
							if (trim($data_cte->curp) == '') {
								echo ' <span style="color:#d9534f">- -</span>';
							} else {
								?>
								<button class="btn btn-success btn-xs" data-clipboard-target=#c2 data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar CURP"><i class="fa fa-copy"></i></button>
							<?php } ?>

						</td>
					</tr>

					<!--</div>-->
					<!--<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">-->
					<tr>
						<td> <strong>REGISTRO PATRONAL:</strong></td>
						<td><span id="c3">
								<?php
								if (trim($data_cte->reg_patronal) == '') {
									echo ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
								} else {
									echo $data_cte->reg_patronal;
								}
								?>
							</span></td>
						<td>
							<?php
							if (trim($data_cte->reg_patronal) == '') {
								echo ' <span style="color:#d9534f">- -</span>';
							} else {
								?>
								<button class="btn btn-success btn-xs" data-clipboard-target=#c3 data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar REGISTRO PATRONAL"><i class="fa fa-copy"></i></button></td>
						<?php } ?>

					</tr>


					<!--</div>-->
					<!--<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">-->
					<tr>
						<td> <strong>EMAIL PERSONAL:</strong></td>
						<td><span id="c4">
								<?php
								if (trim($data_cte->correo_p) == '') {
									echo ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
								} else {
									echo$data_cte->correo_p;
								}
								?>
							</span>
						</td>
						<td>
							<?php
							if (trim($data_cte->correo_p) == '') {
								echo ' <span style="color:#d9534f">- -</span>';
							} else {
								?>
								<button class="btn btn-success btn-xs" data-clipboard-target=#c4 data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar CORREO PERSONAL"><i class="fa fa-copy"></i></button></td>
						<?php } ?>

					</tr>
					<!--</div>-->

					<!--<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">-->
					<tr>
						<td> <strong>EMAIL EMPRESA:</strong></td>
						<td> <span id="c5">
								<?php
								if (trim($data_cte->correo_e) == '') {
									echo ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
								} else {
									echo$data_cte->correo_e;
								}
								?>	
							</span></td>
						<td>
							<?php
							if (trim($data_cte->correo_e) == '') {
								echo ' <span style="color:#d9534f">- -</span>';
							} else {
								?>
								<button class="btn btn-success btn-xs" data-clipboard-target=#c5 data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar CORREO EMPRESA"><i class="fa fa-copy"></i></button></td>
						<?php } ?>

					</tr>


					<!--</div>-->
					<!--<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">-->
					<tr>
						<td> <strong>DIRECCIÓN FISCAL</strong></td>
						<td><span id="c6"><?php echo wordwrap($data_cte->direc_fiscal, 40, "<br>", TRUE); ?></span></td>
						<td><button class="btn btn-success btn-xs" data-clipboard-target=#c6 data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar DIRECCIÓN FISCAL"><i class="fa fa-copy"></i></button></td>
					</tr>
					<tr>
						<td> <strong><i class="fa fa-download fa-2x"></i> DESCARGAR ARCHIVOS (Firma, Cer)</strong></td>
						<td colspan="2" style="text-align: right">
							<span>
								<?php if (trim($data_cte->file_name) == "N/A") { ?>
									<span style="color:#d9534f"><i class="fa fa-close"></i> Sin archivos dispobibles para descarga</span>
								<?php } else { ?>
									<a href="<?php echo base_url('assets/uploads/') . $data_cte->file_name ?>"class="btn btn-danger "> <i class="fa fa-download"></i> Descargar Archivos</a> 
								<?php } ?>
							</span></td>

					</tr>
				<?php endforeach; ?>
				<!--</div>-->
				</tbody>	
			</table>	
		</div>
	</div>
</div>

<script type="text/javascript">

	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
		
	});
</script>