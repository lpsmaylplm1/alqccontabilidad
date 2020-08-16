<?php

class Usuarios_model Extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function validar_login($usuario, $password) {
		$this->db->where('usuario', $usuario);
		$this->db->where('user_activo', 1);
		$this->db->from('usuarios');
		$consulta = $this->db->get();
		if ($consulta->num_rows() > 0) {
			$this->db->where('usuario', $usuario);
			$this->db->where('password', $password);
			$this->db->from('usuarios');
			$consulta = $this->db->get();
			if ($consulta->num_rows() > 0) {
				$consulta = $consulta->row();
				$newdata = array(
					'login' => 1,
					'nombre_user' => $consulta->nombre_user,
					'ap_p_user' => $consulta->ap_p_user,
					'ap_m_user' => $consulta->app_m_user,
					'rol' => $consulta->nivel_user,
					'activo' => $consulta->user_activo,
				);
				$this->session->set_userdata($newdata);
				return TRUE;
			} else {
				$this->session->set_flashdata('mensaje', '<div style="color:#d22a2a"><i class="fa fa-times"></i> <i class="fa fa-key"></i> La contraseña es incorrecta</div>');
				return FALSE;
			}
		} else {
			$this->session->set_flashdata('mensaje', '<div style="color:#d22a2a"><i class="fa fa-times"></i> <i class="fa fa-user"></i>  El usuario  es incorrecto </div>');
			return FALSE;
		}
	}

	public function validar_usuario($user) {
		$this->db->select('*');
		$this->db->where('usuario', $user);
		$this->db->from('usuarios');
		$consulta = $this->db->get();
		return $consulta;
	}

	public function save_usuario($nombre_user, $ap_p_user, $app_m_user, $correo_user, $usuario, $encryp_pass, $tipo_usuario, $is_active) {
		$data = array(
			'nombre_user' => $nombre_user,
			'ap_p_user' => $ap_p_user,
			'app_m_user' => $app_m_user,
			'correo_user' => $correo_user,
			'usuario' => $usuario,
			'nivel_user' => $tipo_usuario,
			'password' => $encryp_pass,
			'user_activo' => $is_active
		);
		$this->db->insert('usuarios', $data);
		return TRUE;
	}

	public function obtener_usuarios() {
		$this->db->select('*');
		$this->db->from('usuarios');
//		$this->db->where('user_activo', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function obtener_datos_usuario($id_user) {
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where('id_user', $id_user);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function actualizar_usuario($id_user, $nombre_user, $ap_p_user, $app_m_user, $correo_user, $usuario, $encryp_pass,$nivel_usr, $is_active) {
		$data = array(
			'nombre_user' => $nombre_user,
			'ap_p_user' => $ap_p_user,
			'app_m_user' => $app_m_user,
			'correo_user' => $correo_user,
			'usuario' => $usuario,
			'password' =>$nivel_usr ,
			'nivel_user'=>$encryp_pass,
			'user_activo' => $is_active
		);
		$this->db->where('id_user', $id_user);
		$this->db->update('usuarios', $data);
		return TRUE;
	}

	function delete_usuario($id_user) {
		$data = array(
			'id_user' => $id_user
		);

		$this->db->delete('usuarios', $data);
		return TRUE;
	}

}
