<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

Class Clientes Extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url', 'file', 'text'));
		$this->load->model('Clientes_model');
		$this->load->model('Archivos_model');
	}

	public function new_cte() {
		$dinamic_content['contenido'] = 'add_cte_view';
		$dinamic_content['title'] = 'Agregar cliente nuevo';
		$this->load->view('template/be_template', $dinamic_content);
	}

	public function agregar_cliente() {
		sleep(1);
		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="fa fa-close"></i> ', '</div>');
		$this->form_validation->set_rules('rfc', 'RFC', 'required');
		$this->form_validation->set_rules('tipo_persona', 'Tipo de Persona', 'required');
		$this->form_validation->set_rules('reg_patronal', 'Registro Patronal', 'exact_length[11]');
		$this->form_validation->set_rules('correo_p', 'Correo Personal', 'valid_email');
		$this->form_validation->set_rules('correo_e', 'Correo de la empresa', 'valid_email');
		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
		} else {
			$nombres = trim($this->security->xss_clean(strip_tags($this->input->post('nombres'))));
			$ap_p = trim($this->security->xss_clean(strip_tags($this->input->post('ap_p'))));
			$ap_m = trim($this->security->xss_clean(strip_tags($this->input->post('ap_m'))));
			$rfc = trim($this->security->xss_clean(strip_tags($this->input->post('rfc'))));
			$tipo_persona = trim($this->security->xss_clean(strip_tags($this->input->post('tipo_persona')))); //
			$razon_social = trim($this->security->xss_clean(strip_tags($this->input->post('razon_social'))));
			$curp = trim($this->security->xss_clean(strip_tags($this->input->post('curp'))));
			$reg_patronal = trim($this->security->xss_clean(strip_tags($this->input->post('reg_patronal'))));
			$correo_p = trim($this->security->xss_clean(strip_tags($this->input->post('correo_p'))));
			$correo_e = trim($this->security->xss_clean(strip_tags($this->input->post('correo_e'))));
			$direccion_fiscal = trim($this->security->xss_clean(strip_tags($this->input->post('direccion_fiscal'))));
			$activo = $this->security->xss_clean(strip_tags($this->input->post('activo')));
			If ($activo === "on") {
				$is_active = 1;
			} else {
				$is_active = 0;
			}
//ASIGNAR NOMBRE DE ARCHIVO ZIP
			$nombre_archivo_zip = url_title(convert_accented_characters($_FILES['userfile']['name']), '-', TRUE);
			if ($nombre_archivo_zip == '') {
				$file_name = "N/A";
				$valida = $this->Clientes_model->save_clientes($nombres, $ap_p, $ap_m, $rfc, $tipo_persona, $razon_social, $curp, $reg_patronal, $correo_p, $correo_e, $direccion_fiscal, $is_active, $file_name);
				if ($valida == TRUE) {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;text-align: center;" class= "alert alert-success"><i class="fa fa-check-square-o fa-3x"></i> <br> El usuario se agregó correctamente a la base de datos <strong>SIN ARCHIVOS VINCULADOS</strong> <br>';
					echo "<script> setTimeout(function () { $(location).attr('href', '" . base_url('clientes/new_cte') . "'); },3000); </script>";
				} else {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-warnig"><i class="fa fa-download fa-2x"></i> Ocurrió un error al intentar guardar el usuario, por favor validar: <br>';
				}
			} else {

				$data = $this->Archivos_model->verificar_contador_nom_file();
				foreach ($data as $cont):
					$incremento = ($cont->contador_id_file + 1);
				endforeach;
				$file_name = str_replace('zip', '', $nombre_archivo_zip);
				$file_name .= str_pad($incremento, 3, 0, STR_PAD_LEFT) . '.zip';


//proceso de carga de la imagen
				$config['max_size'] = 0;
				$config['upload_path'] = './assets/uploads';
				$config['allowed_types'] = 'zip';
				$config['file_name'] = $file_name;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('userfile')) {
					echo $this->upload->display_errors();
				} else {
					$data = array('upload_data' => $this->upload->data());
//					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-success"><i class="fa fa-download fa-2x"></i> El siguiente archivo se vinculó correctamente a la noticia: <br>';
					$valida = $this->Clientes_model->save_clientes($nombres, $ap_p, $ap_m, $rfc, $tipo_persona, $razon_social, $curp, $reg_patronal, $correo_p, $correo_e, $direccion_fiscal, $is_active, $file_name);
					$this->Archivos_model->update_verificar_contador_nom_file($incremento);
					if ($valida == TRUE) {
						echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;text-align: center;" class= "alert alert-success"><i class="fa fa-check-square-o fa-3x"></i> <br> El usuario se agregó correctamente a la base de datos <br>';
						echo "<script> setTimeout(function () { $(location).attr('href', '" . base_url('clientes/new_cte') . "'); },3000); </script>";
					} else {
						echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-warnig"><i class="fa fa-download fa-2x"></i> Ocurrió un error al intentar guardar el usuario, por favor validar: <br>';
					}
				}
			}
		}
	}

	public function actions_ctes() {
		$dinamic_content['contenido'] = 'actions_cte_view';
		$dinamic_content['clientes'] = $this->Clientes_model->obtener_clientes();
		$dinamic_content['title'] = 'Operaciones con clientes registrados';
		$this->load->view('template/be_template', $dinamic_content);
	}

	public function detalle_clientes() {
		$id_cliente = $this->security->xss_clean(strip_tags($this->input->post('id_cliente')));
		$dinamic_content['clientes_data'] = $this->Clientes_model->load_detalle_cte($id_cliente);
		$this->load->view('back_end/detalle_cliente_view', $dinamic_content);
	}

	public function load_form_pass_clientes() {
		$id_cliente = $this->security->xss_clean(strip_tags($this->input->post('id_cliente')));
		$dinamic_content['clientes_data'] = $this->Clientes_model->load_detalle_cte($id_cliente);
		$this->load->view('back_end/consultar_contrasenia_view', $dinamic_content);
	}

	public function consulta_type_form_pass() {
		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="fa fa-close"></i> ', '</div>');
		$this->form_validation->set_rules('tipo_pass', 'Tipo de usuario y contraseña', 'required');
		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
		} else {
			$tipo_pass = trim($this->security->xss_clean(strip_tags($this->input->post('tipo_pass')))); //
			$id_cliente = trim($this->security->xss_clean(strip_tags($this->input->post('id_cliente')))); //
			$dinamic_content['tipo_pass'] = $tipo_pass;
			$dinamic_content['id_cliente'] = $id_cliente;
			$this->load->library('opencypher');
			switch ($tipo_pass) {
				case 1:
					$check_data = $this->Clientes_model->seek_pass_sat($id_cliente, $tipo_pass);
					if ($check_data !== 0) {
						$data_sat = $this->Clientes_model->load_detalle_pass_sat($id_cliente, $tipo_pass);
						foreach ($data_sat as $sat) {
							$clave_fiel = $sat->clave_fiel;
							$pass_Sat = $sat->pass_sat;
							$clave_sellosd = $sat->clave_sellosd;
						}
						$decryp_clave_fiel = $this->opencypher->cifrararchivos('decrypt', $clave_fiel);
						$decryp_pass_Sat = $this->opencypher->cifrararchivos('decrypt', $pass_Sat);
						$decryp_clave_sellosd = $this->opencypher->cifrararchivos('decrypt', $clave_sellosd);
						$dinamic_content['control_button'] = "";
						$dinamic_content['clave_fiel'] = $decryp_clave_fiel;
						$dinamic_content['pass_sat'] = $decryp_pass_Sat;
						$dinamic_content['clave_sellosd'] = $decryp_clave_sellosd;
					} else {
						$dinamic_content['control_button'] = "disabled";
						$dinamic_content['clave_fiel'] = ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
						$dinamic_content['pass_sat'] = ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
						$dinamic_content['clave_sellosd'] = ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
					}

					$this->load->view('back_end/consultar_contrasenia_sat', $dinamic_content);
					break;
				case 2:
					$check_data = $this->Clientes_model->seek_pass_finanzas($id_cliente, $tipo_pass);
					if ($check_data !== 0) {
						$data_fin = $this->Clientes_model->load_detalle_pass_finanzas($id_cliente, $tipo_pass);
						foreach ($data_fin as $finanzas) {
							$usuario_fin = $finanzas->usuario_fin;
							$pass_fin = $finanzas->pass_fin;
							$clave_elector = $finanzas->clave_elector;
							$banco = $finanzas->banco;
							$clabe_bancaria = $finanzas->clabe_bancaria;
						}
						$decryp_usuario_fin = $this->opencypher->cifrararchivos('decrypt', $usuario_fin);
						$decryp_pass_fin = $this->opencypher->cifrararchivos('decrypt', $pass_fin);
						$decryp_clave_elector = $this->opencypher->cifrararchivos('decrypt', $clave_elector);
						$decryp_banco = $this->opencypher->cifrararchivos('decrypt', $banco);
						$decryp_clabe_bancaria = $this->opencypher->cifrararchivos('decrypt', $clabe_bancaria);
						$dinamic_content['control_button'] = "";
						$dinamic_content['usuario_fin'] = $decryp_usuario_fin;
						$dinamic_content['pass_fin'] = $decryp_pass_fin;
						$dinamic_content['clave_elector'] = $decryp_clave_elector;
						$dinamic_content['banco'] = $decryp_banco;
						$dinamic_content['clabe_bancaria'] = $decryp_clabe_bancaria;
					} else {
						$dinamic_content['control_button'] = "disabled";
						$dinamic_content['usuario_fin'] = ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
						$dinamic_content['pass_fin'] = ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
						$dinamic_content['clave_elector'] = ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
						$dinamic_content['banco'] = ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
						$dinamic_content['clabe_bancaria'] = ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
					}
					$this->load->view('back_end/consultar_contrasenia_finanzas', $dinamic_content);
					break;
				case 3:
					$check_data = $this->Clientes_model->seek_pass_imss($id_cliente, $tipo_pass);
					if ($check_data !== 0) {
						$data_imss = $this->Clientes_model->load_detalle_pass_imss($id_cliente, $tipo_pass);
						foreach ($data_imss as $data) {
							$usuario_imss = $data->usuario_imss;
							$pass_imss = $data->pass_imss;
						}
						$decryp_usuario_imss = $this->opencypher->cifrararchivos('decrypt', $usuario_imss);
						$decryp_pass_imss = $this->opencypher->cifrararchivos('decrypt', $pass_imss);
						$dinamic_content['control_button'] = "";
						$dinamic_content['usuario_imss'] = $decryp_usuario_imss;
						$dinamic_content['pass_imss'] = $decryp_pass_imss;
					} else {
						$dinamic_content['control_button'] = "disabled";
						$dinamic_content['usuario_imss'] = ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
						$dinamic_content['pass_imss'] = ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
					}
					$this->load->view('back_end/consultar_contrasenia_imss', $dinamic_content);
					break;
				case 4:
					$check_data = $this->Clientes_model->seek_pass_imss_ev($id_cliente, $tipo_pass);
					if ($check_data !== 0) {
						$data_imss_ev = $this->Clientes_model->load_detalle_pass_imss_ev($id_cliente, $tipo_pass);
						foreach ($data_imss_ev as $data) {
							$rfc_rep_legal_imss = $data->rfc_rep_legal;
							$pass_imss_ev = $data->pass_imss_ev;
						}
						$decryp_rfc_rep_legal = $this->opencypher->cifrararchivos('decrypt', $rfc_rep_legal_imss);
						$decryp_pass_imss_ev = $this->opencypher->cifrararchivos('decrypt', $pass_imss_ev);
						$dinamic_content['control_button'] = "";
						$dinamic_content['rfc_rep_legal'] = $decryp_rfc_rep_legal;
						$dinamic_content['pass_imss_ev'] = $decryp_pass_imss_ev;
					} else {
						$dinamic_content['control_button'] = "disabled";
						$dinamic_content['rfc_rep_legal'] = ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
						$dinamic_content['pass_imss_ev'] = ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
					}
					$this->load->view('back_end/consultar_contrasenia_imss_ev', $dinamic_content);
					break;
				case 5:
					$check_data = $this->Clientes_model->seek_pass_sipare($id_cliente, $tipo_pass);
					if ($check_data !== 0) {
						$data_sipare = $this->Clientes_model->load_detalle_pass_sipare($id_cliente, $tipo_pass);
						foreach ($data_sipare as $data) {
							$usuario_sipare = $data->usuario_sipare;
							$pass_sipare = $data->pass_sipare;
						}
						$decryp_usuario_sipare = $this->opencypher->cifrararchivos('decrypt', $usuario_sipare);
						$decryp_pass_sipare = $this->opencypher->cifrararchivos('decrypt', $pass_sipare);
						$dinamic_content['control_button'] = "";
						$dinamic_content['usuario_sipare'] = $decryp_usuario_sipare;
						$dinamic_content['pass_sipare'] = $decryp_pass_sipare;
					} else {
						$dinamic_content['control_button'] = "disabled";
						$dinamic_content['usuario_sipare'] = ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
						$dinamic_content['pass_sipare'] = ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
					}
					$this->load->view('back_end/consultar_contrasenia_sipare', $dinamic_content);
					break;
				case 6:

					$check_data = $this->Clientes_model->seek_pass_infonavit($id_cliente, $tipo_pass);
					if ($check_data !== 0) {
						$data_infonavit = $this->Clientes_model->load_detalle_pass_infonavit($id_cliente, $tipo_pass);
						foreach ($data_infonavit as $data) {
							$pass_infonavit = $data->pass_infonavit;
						}
						$decryp_pass_infonavit = $this->opencypher->cifrararchivos('decrypt', $pass_infonavit);
						$dinamic_content['control_button'] = "";
						$dinamic_content['pass_infonavit'] = $decryp_pass_infonavit;
					} else {
						$dinamic_content['control_button'] = "disabled";
						$dinamic_content['pass_infonavit'] = ' <span style="color:#d9534f"><i class="fa fa-close"></i> No registrado</span>';
					}
					$dinamic_content['clientes_data'] = $this->Clientes_model->load_detalle_cte($id_cliente);
					$this->load->view('back_end/consultar_contrasenia_infonavit', $dinamic_content);
					break;
			}
		}
	}

	public function select_type_pass() {

		$id_cliente = $this->security->xss_clean(strip_tags($this->input->post('id_cliente')));
		$dinamic_content['clientes_data'] = $this->Clientes_model->load_detalle_cte($id_cliente);
//		$this->load->view('back_end/registrar_contrasenia_view', $dinamic_content);
		$this->load->view('back_end/registrar_contrasenia_view', $dinamic_content);
	}

	public function load_type_form_pass() {
		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="fa fa-close"></i> ', '</div>');
		$this->form_validation->set_rules('tipo_pass', 'Tipo de usuario y contraseña', 'required');
		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
		} else {
			$tipo_pass = trim($this->security->xss_clean(strip_tags($this->input->post('tipo_pass')))); //
			$id_cliente = trim($this->security->xss_clean(strip_tags($this->input->post('id_cliente')))); //
			$dinamic_content['tipo_pass'] = $tipo_pass;
			$dinamic_content['id_cliente'] = $id_cliente;
			switch ($tipo_pass) {
				case 1:
					$this->load->view('back_end/contrasenia_sat', $dinamic_content);
					break;
				case 2:
					$this->load->view('back_end/contrasenia_finanzas', $dinamic_content);
					break;
				case 3:
					$this->load->view('back_end/contrasenia_imss', $dinamic_content);
					break;
				case 4:
					$this->load->view('back_end/contrasenia_imss_ev', $dinamic_content);
					break;
				case 5:
					$this->load->view('back_end/contrasenia_sipare', $dinamic_content);
					break;
				case 6:
					$dinamic_content['clientes_data'] = $this->Clientes_model->load_detalle_cte($id_cliente);
					$this->load->view('back_end/contrasenia_infonavit', $dinamic_content);
					break;
			}
		}
	}

	public function edit_cte() {
		$dinamic_content['contenido'] = 'edit_cte_view';
		$dinamic_content['title'] = 'Editar clientes existentes';
		$id_cliente = $this->security->xss_clean(strip_tags($this->input->post('id_cliente')));
		$dinamic_content['id_cliente'] = $id_cliente;
		$dinamic_content['clientes_data'] = $this->Clientes_model->load_detalle_cte($id_cliente);
		$this->load->view('back_end/edit_cte_view', $dinamic_content);
	}

	public function data_edit_cte() {
		sleep(1);
		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="fa fa-close"></i> ', '</div>');
		$this->form_validation->set_rules('rfc', 'RFC', 'required');
		$this->form_validation->set_rules('tipo_persona', 'Tipo de Persona', 'required');
		$this->form_validation->set_rules('reg_patronal', 'Registro Patronal', 'exact_length[11]');
		$this->form_validation->set_rules('correo_p', 'Correo Personal', 'valid_email');
		$this->form_validation->set_rules('correo_e', 'Correo de la empresa', 'valid_email');
		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
		} else {
			$id_cliente = trim($this->security->xss_clean(strip_tags($this->input->post('id_cliente'))));
			$nombres = trim($this->security->xss_clean(strip_tags($this->input->post('nombres'))));
			$ap_p = trim($this->security->xss_clean(strip_tags($this->input->post('ap_p'))));
			$ap_m = trim($this->security->xss_clean(strip_tags($this->input->post('ap_m'))));
			$rfc = trim($this->security->xss_clean(strip_tags($this->input->post('rfc'))));
			$tipo_persona = trim($this->security->xss_clean(strip_tags($this->input->post('tipo_persona')))); //
			$razon_social = trim($this->security->xss_clean(strip_tags($this->input->post('razon_social'))));
			$curp = trim($this->security->xss_clean(strip_tags($this->input->post('curp'))));
			$reg_patronal = trim($this->security->xss_clean(strip_tags($this->input->post('reg_patronal'))));
			$correo_p = trim($this->security->xss_clean(strip_tags($this->input->post('correo_p'))));
			$correo_e = trim($this->security->xss_clean(strip_tags($this->input->post('correo_e'))));
			$direccion_fiscal = trim($this->security->xss_clean(strip_tags($this->input->post('direccion_fiscal'))));
			$file_name = trim($this->security->xss_clean(strip_tags($this->input->post('file_name'))));
			$activo = $this->security->xss_clean(strip_tags($this->input->post('activo')));
			If ($activo === "on") {
				$is_active = 1;
				$valida = $this->Clientes_model->update_data_cte($id_cliente, $nombres, $ap_p, $ap_m, $rfc, $tipo_persona, $razon_social, $curp, $reg_patronal, $correo_p, $correo_e, $direccion_fiscal, $is_active, $file_name);
				if ($valida == TRUE) {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;text-align: center;" class= "alert alert-success"><i class="fa fa-check-square-o fa-3x"></i> <br> La información del usuario se ACTUALIZÓ correctamente en la base de datos <br>';
					echo "<script> setTimeout(function () { $(location).attr('href', '" . base_url('clientes/actions_ctes') . "'); },3000); </script>";
				} else {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-warnig"><i class="fa fa-download fa-2x"></i> Ocurrió un error al intentar actualizar los datos  del usuario, por favor intente de nuevo: <br>';
				}
			} else {
				$is_active = 1;
//ASIGNAR NOMBRE DE ARCHIVO ZIP
				$nombre_archivo_zip = url_title(convert_accented_characters($_FILES['userfile']['name']), '-', TRUE);
				if ($nombre_archivo_zip == '') {
					echo '<br><div class= "alert alert-danger" style="font-size:14px;text-shadow:1px 1px 1px black;text-align:center"><i class="fa fa-close fa-3x"></i> <br> No se ha seleccionado ningún archivo, por favor seleccione el archivo ZIP que desea cargar.';
					exit();
				} else {

					$data = $this->Archivos_model->verificar_contador_nom_file();
					foreach ($data as $cont):
						$incremento = ($cont->contador_id_file + 1);
					endforeach;
					$file_name = str_replace('zip', '', $nombre_archivo_zip);
					$file_name .= str_pad($incremento, 3, 0, STR_PAD_LEFT) . '.zip';


//proceso de carga de la imagen
					$config['max_size'] = 0;
					$config['upload_path'] = './assets/uploads';
					$config['allowed_types'] = 'zip';
					$config['file_name'] = $file_name;

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if (!$this->upload->do_upload('userfile')) {
						echo $this->upload->display_errors();
					} else {
						$data = array('upload_data' => $this->upload->data());
//					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-success"><i class="fa fa-download fa-2x"></i> El siguiente archivo se vinculó correctamente a la noticia: <br>';
						$valida = $this->Clientes_model->update_data_cte($id_cliente, $nombres, $ap_p, $ap_m, $rfc, $tipo_persona, $razon_social, $curp, $reg_patronal, $correo_p, $correo_e, $direccion_fiscal, $is_active, $file_name);
						$this->Archivos_model->update_verificar_contador_nom_file($incremento);
						if ($valida == TRUE) {
							echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;text-align: center;" class= "alert alert-success"><i class="fa fa-check-square-o fa-3x"></i> <br> La información del usuario se ACTUALIZÓ correctamente en la base de datos <br>';
							echo "<script> setTimeout(function () { $(location).attr('href', '" . base_url('clientes/actions_ctes') . "'); },3000); </script>";
						} else {
							echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-warnig"><i class="fa fa-download fa-2x"></i> Ocurrió un error al intentar actualizar los datos  del usuario, por favor intente de nuevo: <br>';
						}
					}
				}
			}
		}
	}

	public function delete_cte() {
		$id_cliente = $this->security->xss_clean(strip_tags($this->input->post('id_cliente')));
		$dinamic_content['id_cliente'] = $id_cliente;
		$dinamic_content['title'] = 'Eliminar clientes existentes';
//		$dinamic_content['clientes_data'] = $this->Clientes_model->load_detalle_cte($id_cliente);
		$this->load->view('back_end/delete_cte_view', $dinamic_content);
	}

	public function confirma_delete_cte() {
		sleep(1);
		$id_cliente = $this->security->xss_clean(strip_tags($this->input->post('id_cliente')));
		$valida = $this->Clientes_model->delete_cte($id_cliente);
		if ($valida == TRUE) {
			echo '<br><div style="color:#d9534f; text-align:center;"><i class="fa fa-check-square-o fa-2x"></i> <br><strong> La información del usuario se ELIMINÓ correctamente de la base de datos</strong> <br>';
			echo "<script> setTimeout(function () { $(location).attr('href', '" . base_url('clientes/actions_ctes') . "'); },1000); </script>";
		} else {
			echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-warnig"><i class="fa fa-download fa-2x"></i> Ocurrió un error al intentar eliminar los datos  del usuario, por favor intente de nuevo: <br>';
		}
	}

	public function agregar_pass_sat() {
		sleep(1);
		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="fa fa-close"></i> ', '</div>');
		$this->form_validation->set_rules('clave_fiel', '<b>Clave Fiel</b>', 'required');
		$this->form_validation->set_rules('contrasenia_sat', '<b>Contraseña SAT</b>', 'required');
		$this->form_validation->set_rules('clave_sellos', '<b>Clave Sellos Digitales</b>', 'required');
		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
			echo " <script> $('#save_form_register_pass').prop('disabled', false);</script> ";
		} else {

			$id_cliente = trim($this->security->xss_clean(strip_tags($this->input->post('id_cliente'))));
			$tipo_pass = trim($this->security->xss_clean(strip_tags($this->input->post('tipo_pass'))));
			$clave_fiel = trim($this->security->xss_clean(strip_tags($this->input->post('clave_fiel'))));
			$contrasenia_sat = trim($this->security->xss_clean(strip_tags($this->input->post('contrasenia_sat'))));
			$clave_sellos = trim($this->security->xss_clean(strip_tags($this->input->post('clave_sellos'))));
			$this->load->library('opencypher');
			$encrypt_clave_fiel = $this->opencypher->cifrararchivos('encrypt', $clave_fiel);
			$encrypt_contrasenia_sat = $this->opencypher->cifrararchivos('encrypt', $contrasenia_sat);
			$encrypt_clave_sellos = $this->opencypher->cifrararchivos('encrypt', $clave_sellos);
			$check_data = $this->Clientes_model->seek_pass_sat($id_cliente, $tipo_pass);
			if ($check_data !== 0) {
				$insert_data = $this->Clientes_model->update_pass_sat($id_cliente, $tipo_pass, $encrypt_clave_fiel, $encrypt_contrasenia_sat, $encrypt_clave_sellos);
				if ($insert_data == TRUE) {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;text-align: center;" class= "alert alert-success"><i class="fa fa-info-circle fa-3x"></i> <br><strong> ¡SE DETECTÓ UNA CONTRASEÑA REGISTRADA ANTERIORMENTE!.</strong> <br> Los datos de inicio de sesión del SAT  <strong>HAN SIDO ACTUALIZADOS</strong> correctamente <i class="fa fa-check"></i> <br>';
					echo "<script> setTimeout(function () { $('#add_pass_sat')[0].reset(); $('#tipo_pass').prop('disabled', false); $('#tipo_pass')[0].selectedIndex = 0; $('#load_form_register_pass').prop('disabled', false); $('#result_save_tpass').empty(); $('#load_form_detail').empty();},5000); </script>";
					exit();
				} else {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-warnig"><i class="fa fa-download fa-2x"></i> Ocurrió un error al intentar guardar los datos, por favor validar. <br>';
					exit();
				}

//				
			} else {
				$insert_data = $this->Clientes_model->save_pass_sat($id_cliente, $tipo_pass, $encrypt_clave_fiel, $encrypt_contrasenia_sat, $encrypt_clave_sellos);
				if ($insert_data == TRUE) {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;text-align: center;" class= "alert alert-success"><i class="fa fa-check-square-o fa-3x"></i> <br> Los datos de inicio de sesión del SAT se han registrado satisfactoriamente <br>';
					echo "<script> setTimeout(function () { $('#add_pass_sat')[0].reset(); $('#tipo_pass').prop('disabled', false); $('#tipo_pass')[0].selectedIndex = 0; $('#load_form_register_pass').prop('disabled', false); $('#result_save_tpass').empty(); $('#load_form_detail').empty();},3000); </script>";
					exit();
				} else {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-warnig"><i class="fa fa-download fa-2x"></i> Ocurrió un error al intentar guardar los datos, por favor validar. <br>';
					exit();
				}
			}
		}
	}

	public function agregar_pass_finanzas() {
		sleep(1);
		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="fa fa-close"></i> ', '</div>');
		$this->form_validation->set_rules('usuario_finanzas', '<b>Usuario Finanzas</b>', 'required');
		$this->form_validation->set_rules('contrasenia_finanzas', '<b>Contraseña Finanzas</b>', 'required');
		$this->form_validation->set_rules('clave_elector', '<b>Clave Elector</b>', 'required');
		$this->form_validation->set_rules('banco', '<b>Nombre de Banco</b>', 'required');
		$this->form_validation->set_rules('clabe_bancaria', '<b>Clave Interbancaria</b>', 'required');
		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
			echo " <script> $('#save_form_register_pass').prop('disabled', false);</script> ";
		} else {

			$id_cliente = trim($this->security->xss_clean(strip_tags($this->input->post('id_cliente'))));
			$tipo_pass = trim($this->security->xss_clean(strip_tags($this->input->post('tipo_pass'))));
			$usuario_finanzas = trim($this->security->xss_clean(strip_tags($this->input->post('usuario_finanzas'))));
			$contrasenia_finanzas = trim($this->security->xss_clean(strip_tags($this->input->post('contrasenia_finanzas'))));
			$clave_elector = trim($this->security->xss_clean(strip_tags($this->input->post('clave_elector'))));
			$banco = trim($this->security->xss_clean(strip_tags($this->input->post('banco'))));
			$clabe_bancaria = trim($this->security->xss_clean(strip_tags($this->input->post('clabe_bancaria'))));
			$this->load->library('opencypher');
			$encrypt_usuario_finanzas = $this->opencypher->cifrararchivos('encrypt', $usuario_finanzas);
			$encrypt_contrasenia_finanzas = $this->opencypher->cifrararchivos('encrypt', $contrasenia_finanzas);
			$encrypt_clave_elector = $this->opencypher->cifrararchivos('encrypt', $clave_elector);
			$encrypt_banco = $this->opencypher->cifrararchivos('encrypt', $banco);
			$encrypt_clabe_bancaria = $this->opencypher->cifrararchivos('encrypt', $clabe_bancaria);
			$check_data = $this->Clientes_model->seek_pass_finanzas($id_cliente, $tipo_pass);
			if ($check_data !== 0) {
				$insert_data = $this->Clientes_model->update_pass_finanzas($id_cliente, $tipo_pass, $encrypt_usuario_finanzas, $encrypt_contrasenia_finanzas, $encrypt_clave_elector, $encrypt_banco, $encrypt_clabe_bancaria);
				if ($insert_data == TRUE) {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;text-align: center;" class= "alert alert-success"><i class="fa fa-info-circle fa-3x"></i> <br><strong> ¡SE DETECTÓ UNA CONTRASEÑA REGISTRADA ANTERIORMENTE!.</strong> <br> Los datos de inicio de sesión de FINANZAS ESTATAL  <strong>HAN SIDO ACTUALIZADOS</strong> correctamente <i class="fa fa-check"></i> <br>';
					echo "<script> setTimeout(function () { $('#add_pass_finanzas')[0].reset(); $('#tipo_pass').prop('disabled', false); $('#tipo_pass')[0].selectedIndex = 0; $('#load_form_register_pass').prop('disabled', false); $('#result_save_tpass').empty(); $('#load_form_detail').empty();},5000); </script>";
					exit();
				} else {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-warnig"><i class="fa fa-download fa-2x"></i> Ocurrió un error al intentar guardar los datos, por favor validar: <br>';
					exit();
				}

//				
			} else {
				$insert_data = $this->Clientes_model->save_pass_finanzas($id_cliente, $tipo_pass, $encrypt_usuario_finanzas, $encrypt_contrasenia_finanzas, $encrypt_clave_elector, $encrypt_banco, $encrypt_clabe_bancaria);
				if ($insert_data == TRUE) {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;text-align: center;" class= "alert alert-success"><i class="fa fa-check-square-o fa-3x"></i> <br> Los datos de inicio de sesión de FINANZAS ESTATAL se han registrado satisfactoriamente <br>';
					echo "<script> setTimeout(function () { $('#add_pass_finanzas')[0].reset(); $('#tipo_pass').prop('disabled', false); $('#tipo_pass')[0].selectedIndex = 0; $('#load_form_register_pass').prop('disabled', false); $('#result_save_tpass').empty(); $('#load_form_detail').empty();},3000); </script>";
					exit();
				} else {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-warnig"><i class="fa fa-download fa-2x"></i> Ocurrió un error al intentar guardar los datos, por favor validar. <br>';
					exit();
				}
			}
		}
	}

	public function agregar_pass_imss() {
		sleep(1);
		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="fa fa-close"></i> ', '</div>');
		$this->form_validation->set_rules('usuario_imss', '<b>Usuario IMSS</b>', 'required');
		$this->form_validation->set_rules('contrasenia_imss', '<b>Contraseña</b>', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
			echo " <script> $('#save_form_register_pass').prop('disabled', false);</script> ";
		} else {

			$id_cliente = trim($this->security->xss_clean(strip_tags($this->input->post('id_cliente'))));
			$tipo_pass = trim($this->security->xss_clean(strip_tags($this->input->post('tipo_pass'))));
			$usuario_imss = trim($this->security->xss_clean(strip_tags($this->input->post('usuario_imss'))));
			$contrasenia_imss = trim($this->security->xss_clean(strip_tags($this->input->post('contrasenia_imss'))));
			$this->load->library('opencypher');
			$encrypt_usuario_imss = $this->opencypher->cifrararchivos('encrypt', $usuario_imss);
			$encrypt_contrasenia_imss = $this->opencypher->cifrararchivos('encrypt', $contrasenia_imss);
			$check_data = $this->Clientes_model->seek_pass_imss($id_cliente, $tipo_pass);
			if ($check_data !== 0) {
				$insert_data = $this->Clientes_model->update_pass_imss($id_cliente, $tipo_pass, $encrypt_usuario_imss, $encrypt_contrasenia_imss);
				if ($insert_data == TRUE) {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;text-align: center;" class= "alert alert-success"><i class="fa fa-info-circle fa-3x"></i> <br><strong> ¡SE DETECTÓ UNA CONTRASEÑA REGISTRADA ANTERIORMENTE!.</strong> <br> Los datos de inicio de sesión del IMSS  <strong>HAN SIDO ACTUALIZADOS</strong> correctamente <i class="fa fa-check"></i> <br>';
					echo "<script> setTimeout(function () { $('#add_pass_imss')[0].reset(); $('#tipo_pass').prop('disabled', false); $('#tipo_pass')[0].selectedIndex = 0; $('#load_form_register_pass').prop('disabled', false); $('#result_save_tpass').empty(); $('#load_form_detail').empty();},5000); </script>";
					exit();
				} else {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-warnig"><i class="fa fa-download fa-2x"></i> Ocurrió un error al intentar guardar los datos, por favor validar: <br>';
					exit();
				}

//				
			} else {
				$insert_data = $this->Clientes_model->save_pass_imss($id_cliente, $tipo_pass, $encrypt_usuario_imss, $encrypt_contrasenia_imss);
				if ($insert_data == TRUE) {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;text-align: center;" class= "alert alert-success"><i class="fa fa-check-square-o fa-3x"></i> <br> Los datos de inicio de sesión del IMSS se han registrado satisfactoriamente <br>';
					echo "<script> setTimeout(function () { $('#add_pass_imss')[0].reset(); $('#tipo_pass').prop('disabled', false); $('#tipo_pass')[0].selectedIndex = 0; $('#load_form_register_pass').prop('disabled', false); $('#result_save_tpass').empty(); $('#load_form_detail').empty();},3000); </script>";
					exit();
				} else {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-warnig"><i class="fa fa-download fa-2x"></i> Ocurrió un error al intentar guardar los datos, por favor validar. <br>';
					exit();
				}
			}
		}
	}

	public function agregar_pass_imss_ev() {
		sleep(1);
		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="fa fa-close"></i> ', '</div>');
		$this->form_validation->set_rules('rfc_representante', '<b>RFC representante legal</b>', 'required');
		$this->form_validation->set_rules('contrasenia_imss_ev', '<b>Contraseña</b>', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
			echo " <script> $('#save_form_register_pass').prop('disabled', false);</script> ";
		} else {

			$id_cliente = trim($this->security->xss_clean(strip_tags($this->input->post('id_cliente'))));
			$tipo_pass = trim($this->security->xss_clean(strip_tags($this->input->post('tipo_pass'))));
			$rfc_representante = trim($this->security->xss_clean(strip_tags($this->input->post('rfc_representante'))));
			$contrasenia_imss_ev = trim($this->security->xss_clean(strip_tags($this->input->post('contrasenia_imss_ev'))));
			$this->load->library('opencypher');
			$encrypt_rfc_representante = $this->opencypher->cifrararchivos('encrypt', $rfc_representante);
			$encrypt_contrasenia_imss_ev = $this->opencypher->cifrararchivos('encrypt', $contrasenia_imss_ev);
			$check_data = $this->Clientes_model->seek_pass_imss_ev($id_cliente, $tipo_pass);
			if ($check_data !== 0) {
				$insert_data = $this->Clientes_model->update_pass_imss_ev($id_cliente, $tipo_pass, $encrypt_rfc_representante, $encrypt_contrasenia_imss_ev);
				if ($insert_data == TRUE) {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;text-align: center;" class= "alert alert-success"><i class="fa fa-info-circle fa-3x"></i> <br><strong> ¡SE DETECTÓ UNA CONTRASEÑA REGISTRADA ANTERIORMENTE!.</strong> <br> Los datos de inicio de sesión del IMSS Escritorio Virtual  <strong>HAN SIDO ACTUALIZADOS</strong> correctamente <i class="fa fa-check"></i> <br>';
					echo "<script> setTimeout(function () { $('#add_pass_imss_ev')[0].reset(); $('#tipo_pass').prop('disabled', false); $('#tipo_pass')[0].selectedIndex = 0; $('#load_form_register_pass').prop('disabled', false); $('#result_save_tpass').empty(); $('#load_form_detail').empty();},5000); </script>";
					exit();
				} else {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-warnig"><i class="fa fa-download fa-2x"></i> Ocurrió un error al intentar guardar los datos, por favor validar: <br>';
					exit();
				}

//				
			} else {
				$insert_data = $this->Clientes_model->save_pass_imss_ev($id_cliente, $tipo_pass, $encrypt_rfc_representante, $encrypt_contrasenia_imss_ev);
				if ($insert_data == TRUE) {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;text-align: center;" class= "alert alert-success"><i class="fa fa-check-square-o fa-3x"></i> <br> Los datos de inicio de sesión del IMSS Escritorio Virtual se han registrado satisfactoriamente <br>';
					echo "<script> setTimeout(function () { $('#add_pass_imss_ev')[0].reset(); $('#tipo_pass').prop('disabled', false); $('#tipo_pass')[0].selectedIndex = 0; $('#load_form_register_pass').prop('disabled', false); $('#result_save_tpass').empty(); $('#load_form_detail').empty();},3000); </script>";
					exit();
				} else {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-warnig"><i class="fa fa-download fa-2x"></i> Ocurrió un error al intentar guardar los datos, por favor validar. <br>';
					exit();
				}
			}
		}
	}

	public function agregar_pass_sipare() {
		sleep(1);
		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="fa fa-close"></i> ', '</div>');
		$this->form_validation->set_rules('usuario_sipare', '<b>USUARIO SIPARE</b>', 'required');
		$this->form_validation->set_rules('contrasenia_sipare', '<b>Contraseña</b>', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
			echo " <script> $('#save_form_register_pass').prop('disabled', false);</script> ";
		} else {

			$id_cliente = trim($this->security->xss_clean(strip_tags($this->input->post('id_cliente'))));
			$tipo_pass = trim($this->security->xss_clean(strip_tags($this->input->post('tipo_pass'))));
			$usuario_sipare = trim($this->security->xss_clean(strip_tags($this->input->post('usuario_sipare'))));
			$contrasenia_sipare = trim($this->security->xss_clean(strip_tags($this->input->post('contrasenia_sipare'))));
			$this->load->library('opencypher');
			$encrypt_usuario_sipare = $this->opencypher->cifrararchivos('encrypt', $usuario_sipare);
			$encrypt_contrasenia_sipare = $this->opencypher->cifrararchivos('encrypt', $contrasenia_sipare);
			$check_data = $this->Clientes_model->seek_pass_sipare($id_cliente, $tipo_pass);
			if ($check_data !== 0) {
				$insert_data = $this->Clientes_model->update_pass_sipare($id_cliente, $tipo_pass, $encrypt_usuario_sipare, $encrypt_contrasenia_sipare);
				if ($insert_data == TRUE) {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;text-align: center;" class= "alert alert-success"><i class="fa fa-info-circle fa-3x"></i> <br><strong> ¡SE DETECTÓ UNA CONTRASEÑA REGISTRADA ANTERIORMENTE!.</strong> <br> Los datos de inicio de sesión de SIPARE  <strong>HAN SIDO ACTUALIZADOS</strong> correctamente <i class="fa fa-check"></i> <br>';
					echo "<script> setTimeout(function () { $('#add_pass_sipare')[0].reset(); $('#tipo_pass').prop('disabled', false); $('#tipo_pass')[0].selectedIndex = 0; $('#load_form_register_pass').prop('disabled', false); $('#result_save_tpass').empty(); $('#load_form_detail').empty();},5000); </script>";
					exit();
				} else {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-warnig"><i class="fa fa-download fa-2x"></i> Ocurrió un error al intentar guardar los datos, por favor validar: <br>';
					exit();
				}

//				
			} else {
				$insert_data = $this->Clientes_model->save_pass_sipare($id_cliente, $tipo_pass, $encrypt_usuario_sipare, $encrypt_contrasenia_sipare);
				if ($insert_data == TRUE) {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;text-align: center;" class= "alert alert-success"><i class="fa fa-check-square-o fa-3x"></i> <br> Los datos de inicio de sesión de SIPARE se han registrado satisfactoriamente <br>';
					echo "<script> setTimeout(function () { $('#add_pass_sipare')[0].reset(); $('#tipo_pass').prop('disabled', false); $('#tipo_pass')[0].selectedIndex = 0; $('#load_form_register_pass').prop('disabled', false); $('#result_save_tpass').empty(); $('#load_form_detail').empty();},3000); </script>";
					exit();
				} else {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-warnig"><i class="fa fa-download fa-2x"></i> Ocurrió un error al intentar guardar los datos, por favor validar. <br>';
					exit();
				}
			}
		}
	}

	public function agregar_pass_infonavit() {
		sleep(1);
		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="fa fa-close"></i> ', '</div>');
		$this->form_validation->set_rules('contrasenia_infonavit', '<b>Contraseña</b>', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
			echo " <script> $('#save_form_register_pass').prop('disabled', false);</script> ";
		} else {

			$id_cliente = trim($this->security->xss_clean(strip_tags($this->input->post('id_cliente'))));
			$tipo_pass = trim($this->security->xss_clean(strip_tags($this->input->post('tipo_pass'))));
			$contrasenia_infonavit = trim($this->security->xss_clean(strip_tags($this->input->post('contrasenia_infonavit'))));
			$this->load->library('opencypher');
			$encrypt_contrasenia_infonavit = $this->opencypher->cifrararchivos('encrypt', $contrasenia_infonavit);
			$check_data = $this->Clientes_model->seek_pass_infonavit($id_cliente, $tipo_pass);
			if ($check_data !== 0) {
				$insert_data = $this->Clientes_model->update_pass_infonavit($id_cliente, $tipo_pass, $encrypt_contrasenia_infonavit);
				if ($insert_data == TRUE) {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;text-align: center;" class= "alert alert-success"><i class="fa fa-info-circle fa-3x"></i> <br><strong> ¡SE DETECTÓ UNA CONTRASEÑA REGISTRADA ANTERIORMENTE!.</strong> <br> Los datos de inicio de sesión de INFONAVIT  <strong>HAN SIDO ACTUALIZADOS</strong> correctamente <i class="fa fa-check"></i> <br>';
					echo "<script> setTimeout(function () { $('#add_pass_infonavit')[0].reset(); $('#tipo_pass').prop('disabled', false); $('#tipo_pass')[0].selectedIndex = 0; $('#load_form_register_pass').prop('disabled', false); $('#result_save_tpass').empty(); $('#load_form_detail').empty();},5000); </script>";
					exit();
				} else {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-warnig"><i class="fa fa-download fa-2x"></i> Ocurrió un error al intentar guardar los datos, por favor validar: <br>';
					exit();
				}

//				
			} else {
				$insert_data = $this->Clientes_model->save_pass_infonavit($id_cliente, $tipo_pass, $encrypt_contrasenia_infonavit);
				if ($insert_data == TRUE) {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;text-align: center;" class= "alert alert-success"><i class="fa fa-check-square-o fa-3x"></i> <br> Los datos de inicio de sesión de INFONAVIT se han registrado satisfactoriamente <br>';
					echo "<script> setTimeout(function () { $('#add_pass_infonavit')[0].reset(); $('#tipo_pass').prop('disabled', false); $('#tipo_pass')[0].selectedIndex = 0; $('#load_form_register_pass').prop('disabled', false); $('#result_save_tpass').empty(); $('#load_form_detail').empty();},3000); </script>";
					exit();
				} else {
					echo '<br><div style="font-size:14px;text-shadow:1px 1px 1px black;" class= "alert alert-warnig"><i class="fa fa-download fa-2x"></i> Ocurrió un error al intentar guardar los datos, por favor validar. <br>';
					exit();
				}
			}
		}
	}

}
