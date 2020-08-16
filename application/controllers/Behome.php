<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

Class Behome Extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url', 'file', 'text'));
		$this->load->model('Clientes_model');
	}

	public function index() {
		$dinamic_content['contenido'] = 'index';
		$dinamic_content['clientes'] = $this->Clientes_model->obtener_clientes();
		$dinamic_content['title'] = 'Panel de Administración AlqcContabilidad';
		$this->load->view('template/be_template', $dinamic_content);
	}


}
