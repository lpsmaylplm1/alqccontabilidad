<?php

class Archivos_model Extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function verificar_contador_nom_file() {
		$this->db->select('contador_id_file');
		$this->db->from('control_ai');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function update_verificar_contador_nom_file($incremento) {
		$data_new = array(
			'contador_id_file' => $incremento
		);
		$this->db->update('control_ai', $data_new);
		return TRUE;
	}

	
	
	
	
	
	
	
	
//	public function obtener_clientes() {
//		$this->db->select('*');
//		$this->db->from('clientes');
//		$this->db->where('activo', 1);
//		$consulta = $this->db->get();
//		return $consulta->result();
//	}
//
//	public function obtener_datos_usuario($id_user) {
//		$this->db->select('*');
//		$this->db->from('usuarios');
//		$this->db->where('id_user', $id_user);
//		$consulta = $this->db->get();
//		return $consulta->result();
//	}
//public function load_detalle_cte($id_cliente) {
//		$this->db->select('*');
//		$this->db->from('clientes');
//		$this->db->where('id_cliente', $id_cliente);
//		$consulta = $this->db->get();
//		return $consulta->result();
//	}
//	public function actualizar_usuario($id_user, $nombre_user, $ap_p_user, $app_m_user, $correo_user, $usuario, $password1, $is_active) {
//		$data = array(
//			'nombre_user' => $nombre_user,
//			'ap_p_user' => $ap_p_user,
//			'app_m_user' => $app_m_user,
//			'correo_user' => $correo_user,
//			'usuario' => $usuario,
//			'password' => $password1,
//			'user_activo' => $is_active
//		);
//		$this->db->where('id_user', $id_user);
//		$this->db->update('usuarios', $data);
//
//		return TRUE;
//	}
//
//	function delete_usuario($id_user) {
//		$data = array(
//			'id_user' => $id_user
//		);
//
//		$this->db->delete('usuarios', $data);
//		return TRUE;
//	}
}
