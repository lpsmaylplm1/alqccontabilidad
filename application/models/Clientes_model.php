<?php

class Clientes_model Extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function save_clientes($nombres, $ap_p, $ap_m, $rfc, $tipo_persona, $razon_social, $curp, $reg_patronal, $correo_p, $correo_e, $direccion_fiscal, $is_active, $file_name) {
		$data = array(
			'nombres' => $nombres,
			'ap_p' => $ap_p,
			'ap_m' => $ap_m,
			'rfc' => $rfc,
			'tipo_persona' => $tipo_persona,
			'razon_social' => $razon_social,
			'curp' => $curp,
			'reg_patronal' => $reg_patronal,
			'correo_p' => $correo_p,
			'correo_e' => $correo_e,
			'direc_fiscal' => $direccion_fiscal,
			'file_name' => $file_name,
			'activo' => $is_active
		);
		$this->db->insert('clientes', $data);
		return TRUE;
	}

	public function obtener_clientes() {
		$this->db->select('*');
		$this->db->from('clientes');
		$this->db->where('activo', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function update_data_cte($id_cliente, $nombres, $ap_p, $ap_m, $rfc, $tipo_persona, $razon_social, $curp, $reg_patronal, $correo_p, $correo_e, $direccion_fiscal, $is_active, $file_name) {
		$data = array(
			'nombres' => $nombres,
			'ap_p' => $ap_p,
			'ap_m' => $ap_m,
			'rfc' => $rfc,
			'tipo_persona' => $tipo_persona,
			'razon_social' => $razon_social,
			'curp' => $curp,
			'reg_patronal' => $reg_patronal,
			'correo_p' => $correo_p,
			'correo_e' => $correo_e,
			'direc_fiscal' => $direccion_fiscal,
			'file_name' => $file_name,
			'activo' => $is_active
		);

		$this->db->where('id_cliente', $id_cliente);
		$this->db->update('clientes', $data);

		return TRUE;
	}

	public function delete_cte($id_cliente) {
		$data = array(
			'activo' => 0
		);

		$this->db->where('id_cliente', $id_cliente);
		$this->db->update('clientes', $data);

		return TRUE;
	}

	public function obtener_datos_usuario($id_user) {
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where('id_user', $id_user);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function load_detalle_cte($id_cliente) {
		$this->db->select('*');
		$this->db->from('clientes');
		$this->db->where('id_cliente', $id_cliente);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function seek_pass_sat($id_cliente, $tipo_pass) {
		$this->db->from('data_sat');
		$this->db->where('id_cliente_sat', $id_cliente);
		$this->db->where('id_tpass_sat', $tipo_pass);

		return $this->db->count_all_results();
	}

	public function save_pass_sat($id_cliente, $tipo_pass, $encrypt_clave_fiel, $encrypt_contrasenia_sat, $encrypt_clave_sellos) {
		$data_sat = array(
			'id_cliente_sat' => $id_cliente,
			'id_tpass_sat' => $tipo_pass,
			'clave_fiel' => $encrypt_clave_fiel,
			'pass_sat' => $encrypt_contrasenia_sat,
			'clave_sellosd' => $encrypt_clave_sellos
		);
		$this->db->insert('data_sat', $data_sat);
		return TRUE;
	}

	public function update_pass_sat($id_cliente, $tipo_pass, $encrypt_clave_fiel, $encrypt_contrasenia_sat, $encrypt_clave_sellos) {
		$data_sat = array(
			'clave_fiel' => $encrypt_clave_fiel,
			'pass_sat' => $encrypt_contrasenia_sat,
			'clave_sellosd' => $encrypt_clave_sellos
		);
		$this->db->where('id_cliente_sat', $id_cliente);
		$this->db->where('id_tpass_sat', $tipo_pass);
		$this->db->update('data_sat', $data_sat);
		return TRUE;
	}

	public function seek_pass_finanzas($id_cliente, $tipo_pass) {
		$this->db->from('data_finanzas');
		$this->db->where('id_cliente_fin', $id_cliente);
		$this->db->where('id_tpass_fin', $tipo_pass);

		return $this->db->count_all_results();
	}

	public function save_pass_finanzas($id_cliente, $tipo_pass, $encrypt_usuario_finanzas, $encrypt_contrasenia_finanzas, $encrypt_clave_elector, $encrypt_banco, $encrypt_clabe_bancaria) {
		$data_finanzas = array(
			'id_cliente_fin' => $id_cliente,
			'id_tpass_fin' => $tipo_pass,
			'usuario_fin' => $encrypt_usuario_finanzas,
			'pass_fin' => $encrypt_contrasenia_finanzas,
			'clave_elector' => $encrypt_clave_elector,
			'banco' => $encrypt_banco,
			'clabe_bancaria' => $encrypt_clabe_bancaria
		);
		$this->db->insert('data_finanzas', $data_finanzas);
		return TRUE;
	}

	public function update_pass_finanzas($id_cliente, $tipo_pass, $encrypt_usuario_finanzas, $encrypt_contrasenia_finanzas, $encrypt_clave_elector, $encrypt_banco, $encrypt_clabe_bancaria) {
		$data_finanzas = array(
			'usuario_fin' => $encrypt_usuario_finanzas,
			'pass_fin' => $encrypt_contrasenia_finanzas,
			'clave_elector' => $encrypt_clave_elector,
			'banco' => $encrypt_banco,
			'clabe_bancaria' => $encrypt_clabe_bancaria
		);
		$this->db->where('id_cliente_fin', $id_cliente);
		$this->db->where('id_tpass_fin', $tipo_pass);
		$this->db->update('data_finanzas', $data_finanzas);
		return TRUE;
	}

	public function seek_pass_imss($id_cliente, $tipo_pass) {
		$this->db->from('data_imss');
		$this->db->where('id_cliente_imss', $id_cliente);
		$this->db->where('id_tpass_imss', $tipo_pass);

		return $this->db->count_all_results();
	}

	public function update_pass_imss($id_cliente, $tipo_pass, $encrypt_usuario_imss, $encrypt_contrasenia_imss) {
		$data_imss = array(
			'usuario_imss' => $encrypt_usuario_imss,
			'pass_imss' => $encrypt_contrasenia_imss
		);
		$this->db->where('id_cliente_imss', $id_cliente);
		$this->db->where('id_tpass_imss', $tipo_pass);
		$this->db->update('data_imss', $data_imss);
		return TRUE;
	}

	public function save_pass_imss($id_cliente, $tipo_pass, $encrypt_usuario_imss, $encrypt_contrasenia_imss) {
		$data_imss = array(
			'id_cliente_imss' => $id_cliente,
			'id_tpass_imss' => $tipo_pass,
			'usuario_imss' => $encrypt_usuario_imss,
			'pass_imss' => $encrypt_contrasenia_imss
		);
		$this->db->insert('data_imss', $data_imss);
		return TRUE;
	}

	public function seek_pass_imss_ev($id_cliente, $tipo_pass) {
		$this->db->from('data_imss_ev');
		$this->db->where('id_cliente_imss_ev', $id_cliente);
		$this->db->where('id_tpass_imss_ev', $tipo_pass);

		return $this->db->count_all_results();
	}

	public function update_pass_imss_ev($id_cliente, $tipo_pass, $encrypt_rfc_representante, $encrypt_contrasenia_imss_ev) {
		$data_imss_ev = array(
			'rfc_rep_legal' => $encrypt_rfc_representante,
			'pass_imss_ev' => $encrypt_contrasenia_imss_ev
		);
		$this->db->where('id_cliente_imss_ev', $id_cliente);
		$this->db->where('id_tpass_imss_ev', $tipo_pass);
		$this->db->update('data_imss_ev', $data_imss_ev);
		return TRUE;
	}

	public function save_pass_imss_ev($id_cliente, $tipo_pass, $encrypt_rfc_representante, $encrypt_contrasenia_imss_ev) {
		$data_imss_ev = array(
			'id_cliente_imss_ev' => $id_cliente,
			'id_tpass_imss_ev' => $tipo_pass,
			'rfc_rep_legal' => $encrypt_rfc_representante,
			'pass_imss_ev' => $encrypt_contrasenia_imss_ev
		);
		$this->db->insert('data_imss_ev', $data_imss_ev);
		return TRUE;
	}

	public function seek_pass_sipare($id_cliente, $tipo_pass) {
		$this->db->from('data_sipare');
		$this->db->where('id_cliente_sipare', $id_cliente);
		$this->db->where('id_tpass_sipare', $tipo_pass);

		return $this->db->count_all_results();
	}

	public function update_pass_sipare($id_cliente, $tipo_pass, $encrypt_usuario_sipare, $encrypt_contrasenia_sipare) {
		$data_sipare = array(
			'usuario_sipare' => $encrypt_usuario_sipare,
			'pass_sipare' => $encrypt_contrasenia_sipare
		);
		$this->db->where('id_cliente_sipare', $id_cliente);
		$this->db->where('id_tpass_sipare', $tipo_pass);
		$this->db->update('data_sipare', $data_sipare);
		return TRUE;
	}

	public function save_pass_sipare($id_cliente, $tipo_pass, $encrypt_usuario_sipare, $encrypt_contrasenia_sipare) {
		$data_imss_ev = array(
			'id_cliente_sipare' => $id_cliente,
			'id_tpass_sipare' => $tipo_pass,
			'usuario_sipare' => $encrypt_usuario_sipare,
			'pass_sipare' => $encrypt_contrasenia_sipare
		);
		$this->db->insert('data_sipare', $data_imss_ev);
		return TRUE;
	}

	public function seek_pass_infonavit($id_cliente, $tipo_pass) {
		$this->db->from('data_infonavit');
		$this->db->where('id_cliente_infonavit', $id_cliente);
		$this->db->where('id_tpass_infonavit', $tipo_pass);

		return $this->db->count_all_results();
	}

	public function update_pass_infonavit($id_cliente, $tipo_pass, $encrypt_contrasenia_infonavit) {
		$data_infonavit = array(
			'pass_infonavit' => $encrypt_contrasenia_infonavit
		);
		$this->db->where('id_cliente_infonavit', $id_cliente);
		$this->db->where('id_tpass_infonavit', $tipo_pass);
		$this->db->update('data_infonavit', $data_infonavit);
		return TRUE;
	}

	public function save_pass_infonavit($id_cliente, $tipo_pass, $encrypt_contrasenia_infonavit) {
		$data_infonavit = array(
			'id_cliente_infonavit' => $id_cliente,
			'id_tpass_infonavit' => $tipo_pass,
			'pass_infonavit' => $encrypt_contrasenia_infonavit
		);
		$this->db->insert('data_infonavit', $data_infonavit);
		return TRUE;
	}

	public function load_detalle_pass_sat($id_cliente, $tipo_pass) {
		$this->db->select('*');
		$this->db->from('data_sat');
		$this->db->where('id_cliente_sat', $id_cliente);
		$this->db->where('id_tpass_sat', $tipo_pass);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function load_detalle_pass_finanzas($id_cliente, $tipo_pass) {
		$this->db->select('*');
		$this->db->from('data_finanzas');
		$this->db->where('id_cliente_fin', $id_cliente);
		$this->db->where('id_tpass_fin', $tipo_pass);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function load_detalle_pass_imss($id_cliente, $tipo_pass) {
		$this->db->select('*');
		$this->db->from('data_imss');
		$this->db->where('id_cliente_imss', $id_cliente);
		$this->db->where('id_tpass_imss', $tipo_pass);
		$consulta = $this->db->get();
		return $consulta->result();
	}
	public function load_detalle_pass_imss_ev($id_cliente, $tipo_pass) {
		$this->db->select('*');
		$this->db->from('data_imss_ev');
		$this->db->where('id_cliente_imss_ev', $id_cliente);
		$this->db->where('id_tpass_imss_ev', $tipo_pass);
		$consulta = $this->db->get();
		return $consulta->result();
	}
	public function load_detalle_pass_sipare($id_cliente, $tipo_pass) {
		$this->db->select('*');
		$this->db->from('data_sipare');
		$this->db->where('id_cliente_sipare', $id_cliente);
		$this->db->where('id_tpass_sipare', $tipo_pass);
		$consulta = $this->db->get();
		return $consulta->result();
	}
	public function load_detalle_pass_infonavit($id_cliente, $tipo_pass) {
		$this->db->select('*');
		$this->db->from('data_infonavit');
		$this->db->where('id_cliente_infonavit', $id_cliente);
		$this->db->where('id_tpass_infonavit', $tipo_pass);
		$consulta = $this->db->get();
		return $consulta->result();
	}
}
