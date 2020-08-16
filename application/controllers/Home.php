<?php

//

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

Class Home Extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url', 'file', 'text'));
//        $this->load->model('Noticias_model');
	}

	public function index() {
		$dinamic_content['contenido'] = 'index';
		$dinamic_content['title'] = 'Panel de inicio de sesión';
		$this->load->view('template/fe_template', $dinamic_content);
	}

}
