<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

Class Login Extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url', 'file', 'text'));
		$this->load->model('Usuarios_model');
//        $this->load->model('Img_model');
	}

	public function login() {
		sleep(1);
		$usuario = $this->security->xss_clean(strip_tags($this->input->post('user')));
		$decryp_password = $this->security->xss_clean(strip_tags($this->input->post('contrasenia')));
		$this->load->library('opencypher');
		$password = $this->opencypher->cifrararchivos('encrypt', $decryp_password);
		$valida = $this->Usuarios_model->validar_login($usuario, $password);
		if ($valida == TRUE) {
			echo '<div style="color:green"><i class="fa fa-check-square-o fa-2x"></i>Los datos son correctos. En breve se redireccionará al dashboard de administración </div>';
			echo '<script  type="text/javascript">    setTimeout(function (){var url = base_url + "behome";   $(location).attr("href", url);    }, 2000);</script>';
		} else {
			echo $this->session->flashdata('mensaje');
			exit();
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		$this->session->set_userdata('Sistema de Gestión de Clientes', 'https://alqccontabilidad.com/');
		redirect(base_url('home'));
	}

	public function forbidden() {
		$dinamic_content['contenido'] = 'forbidden';
		$this->load->view('plantilla/plantilla_front_end', $dinamic_content);
	}

}
