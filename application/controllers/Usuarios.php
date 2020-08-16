<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

Class Usuarios Extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url', 'file', 'text'));
		$this->load->model('Usuarios_model');
	}

//Cargar  lista de usuarios activos e inactivos
	public function index() {
		$dinamic_content['contenido'] = 'lista_usuarios';
		$dinamic_content['title'] = 'Gestión de usuarios del Sistema';
		$dinamic_content['prev_usr'] = $this->Usuarios_model->obtener_usuarios();
		$this->load->view('template/be_template', $dinamic_content);
	}

	public function nuevo_usuario() {
		$dinamic_content['contenido'] = 'new_data_user_view';
		$dinamic_content['title'] = 'Gestión de usuarios del Sistema';
		$dinamic_content['prev_usr'] = $this->Usuarios_model->obtener_usuarios();
		$this->load->view('template/be_template', $dinamic_content);
	}

	public function save_user() {
		$nombre_user = $this->security->xss_clean(strip_tags($this->input->post('nombre_user')));
		$ap_p_user = $this->security->xss_clean(strip_tags($this->input->post('ap_p_user')));
		$app_m_user = $this->security->xss_clean(strip_tags($this->input->post('app_m_user')));
		$correo_user = $this->security->xss_clean(strip_tags($this->input->post('correo_user')));
		$usuario = $this->security->xss_clean(strip_tags($this->input->post('usuario')));
		$tipo_usuario = $this->security->xss_clean(strip_tags($this->input->post('tipo_usuario')));
		$password1 = $this->security->xss_clean(strip_tags($this->input->post('password1')));
		$password2 = $this->security->xss_clean(strip_tags($this->input->post('password2')));
		$is_active = "1";

		if ($password1 == $password2) {
			$this->load->library('opencypher');
			$encryp_pass = $this->opencypher->cifrararchivos('encrypt', $password1);
			$valida = $this->Usuarios_model->save_usuario($nombre_user, $ap_p_user, $app_m_user, $correo_user, $usuario, $encryp_pass, $tipo_usuario, $is_active);
			if ($valida === TRUE) {
				echo ' <div class="alert alert-success"  style="font-size: 12px"> <i class="fa fa-check-square-o fa "></i> El usuario se guardo correctamente en la base de datos.  </div>';
				echo ' <script>setTimeout(function () { location.href = base_url + "usuarios"; }, 1000)</script>';
				exit();
			} else {
				echo ' <div class="alert alert-success"  style="font-size: 12px"> <i class="fa fa-check-square-o fa "></i> Ocurrió un error al intentar guardar los datos de usuario en la base de datos, por favor intente de nuevo.  </div>';
				exit();
			}
		} else {
			echo ' <div class="alert alert-danger"  style="font-size: 12px"> <i class="fa fa-check-square-o fa "></i> Las contraseñas no coinciden, por favor, verifique e intente de nuevo.  </div>';
			echo '<script>$("#btn_submit_edit").prop("disabled", false);</script>';
		}
	}

	public function load_data_user() {
		$id_user = $this->security->xss_clean(strip_tags($this->input->post('id_user')));
		$dinamic_content['prev_data_user'] = $this->Usuarios_model->obtener_datos_usuario($id_user);
		$data_usr = $this->Usuarios_model->obtener_datos_usuario($id_user);
		$this->load->library('opencypher');
		foreach ($data_usr as $data) {
			$pass = $data->password;
		};
		$decryp_pass = $this->opencypher->cifrararchivos('decrypt', $pass);
		$dinamic_content['pass'] = $decryp_pass;
		$this->load->view('back_end/load_data_user_view', $dinamic_content);
	}

	public function get_data_edit_user() {

		$id_user = $this->security->xss_clean(strip_tags($this->input->post('id_user')));
		$nombre_user = $this->security->xss_clean(strip_tags($this->input->post('nombre_user')));
		$ap_p_user = $this->security->xss_clean(strip_tags($this->input->post('ap_p_user')));
		$app_m_user = $this->security->xss_clean(strip_tags($this->input->post('app_m_user')));
		$correo_user = $this->security->xss_clean(strip_tags($this->input->post('correo_user')));
		$usuario = $this->security->xss_clean(strip_tags($this->input->post('usuario')));
		$nivel_usr = $this->security->xss_clean(strip_tags($this->input->post('tipo_usuario')));
		$password1 = $this->security->xss_clean(strip_tags($this->input->post('password1')));
		$password2 = $this->security->xss_clean(strip_tags($this->input->post('password2')));
		$prev_activo = $this->security->xss_clean(strip_tags($this->input->post('activo')));
		if ($prev_activo == "1") {
			$is_active = "1";
		} else {
			$is_active = "0";
		}

		if ($password1 == $password2) {
			$this->load->library('opencypher');
			$encryp_pass = $this->opencypher->cifrararchivos('encrypt', $password1);
			$valida = $this->Usuarios_model->actualizar_usuario($id_user, $nombre_user, $ap_p_user, $app_m_user, $correo_user, $usuario, $nivel_usr, $encryp_pass, $is_active);

			if ($valida === TRUE) {
				echo ' <div class="alert alert-success alert-dismissible fade in" role="alert" style="font-size: 18px"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button> <i class="fa fa-check-square-o fa "></i> El usuario se actualizó correctamente en la base de datos.  </div>';
				echo '<script>setTimeout(function () { location.href = base_url + "usuarios"; }, 1000); $("#btn_submit_edit").prop("disabled", false);</script>';
			} elseif ($valida === FALSE) {
				echo ' <div class="alert alert-danger  alert-dismissible fade in" role="alert" style="font-size: 18px"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button> <i class="fa fa-check-square-o fa "></i> Ocurrió un error al intentar actualizar la información del usuario en la base de datos.  </div>';
			}
		} else {
			echo ' <div class="alert alert-danger  alert-dismissible fade in" role="alert" style="font-size: 18px"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button> <i class="fa fa-check-square-o fa "></i> Las contraseñas no coinciden, por favor verificar.  </div>';
			echo '<script> $("#btn_submit_edit").prop("disabled", false);</script>';
			exit();
		}
	}

	public function get_data_user() {
		$id_user = $this->security->xss_clean(strip_tags($this->input->post('id_user')));
		$dinamic_content['prev_data_user'] = $this->Usuarios_model->obtener_datos_usuario($id_user);
		$data_usr = $this->Usuarios_model->obtener_datos_usuario($id_user);
		$this->load->library('opencypher');
		foreach ($data_usr as $data) {
			$pass = $data->password;
		};
		$decryp_pass = $this->opencypher->cifrararchivos('decrypt', $pass);
		$dinamic_content['pass'] = $decryp_pass;
		$this->load->view('back_end/get_data_user_view', $dinamic_content);
	}

	public function del_user() {
		$dinamic_content['id_user'] = $this->security->xss_clean(strip_tags($this->input->post('id_user')));
		$this->load->view('back_end/del_data_user_view', $dinamic_content);
	}

	public function confirm_del_user() {
		$id_user = $this->security->xss_clean(strip_tags($this->input->post('id_user')));
		$valida = $this->Usuarios_model->delete_usuario($id_user);
		if ($valida === TRUE) {
			echo ' <div class="alert alert-success alert-dismissible fade in" role="alert" style="font-size: 18px"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button> <i class="fa fa-check-square-o fa-2x "></i> <br>El usuario se eliminó correctamente en la base de datos.  </div>';
		} elseif ($valida === FALSE) {
			echo ' <div class="alert alert-danger  alert-dismissible fade in" role="alert" style="font-size: 18px"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button> <i class="fa fa-check-square-o fa "></i> Ocurrió un error al intentar actualizar la información del usuario en la base de datos.  </div>';
		}
	}

}
