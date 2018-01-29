<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('users_model');
	}

	public function auth_user()
	{
		if ($this->form_validation->run()) {
			$login = $this->input->post('login');
			$password = $this->input->post('password');

			$data_user = $this->auth_model->get_data_user($login);
			if ($data_user->num_rows() == 1) {

				$data_user = $data_user->row();
				$hash_pass_tmp = crypt($password, $data_user->hash);
				if ($data_user->hash == $hash_pass_tmp) {
					$auth_data = array(
						'id' => $data_user->id,
						'login' => $data_user->login,
						'logged' => TRUE
					);
					$this->session->set_userdata($auth_data);
					$data = array(
						'status' => 'success',
						'message' => 'Auth success.'
					);
					print(json_encode($data));
				} else {
					$data = array(
						'status' => 'error',
						'message' => 'Wrong password.'
					);
					print(json_encode($data));
				}
			} else {
				$data = array(
					'status' => 'error',
					'message' => 'Unrecognised login.'
				);
				print(json_encode($data));
			}
		} else {
			$data = [
				'status' => 'error',
				'message' => 'This field can\'t be blank.'
			];
			print(json_encode($data));
		}
	}

	public function reg_user()
	{
		if ($this->form_validation->run()) {
			$login = $this->input->post('login');
			$password = $this->input->post('password');

			$data_user_tmp = $this->auth_model->get_data_user($login);
			if ($data_user_tmp->num_rows() == 0) {
				$salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
				$key = crypt($password, $salt);

				$salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
				$hash = crypt($password, $salt);

				$data_user = array(
					'name' => $login,
					'email' => $login,
					'login' => $login,
					'hash' => $hash,
					'key' => $key
				);

				if ($this->users_model->create_user($data_user)) {
					$data_user = $this->auth_model->get_data_user($login)->row();
					$auth_data = array(
						'id' => $data_user->id,
						'login' => $data_user->login,
						'logged' => TRUE
					);
					$this->session->set_userdata($auth_data);
					$data = array(
						'status' => 'success',
						'message' => 'User created.'
					);
					print(json_encode($data));
				} else {
					$data = array(
						'status' => 'error',
						'message' => 'User not created.'
					);
					print(json_encode($data));
				}
			} else {
				$data = array(
					'status' => 'error',
					'message' => 'This login is already in use.'
				);
				print(json_encode($data));
			}
		} else {
			$data = [
				'status' => 'error',
				'message' => 'This field can\'t be blank.'
			];
			print(json_encode($data));
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}