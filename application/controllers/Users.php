<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
	protected $id_user;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('apps_model');

		$this->id_user = $this->session->id;
	}

	public function index()
	{
		$data = [
			'user' => $this->users_model->get_data_user($this->id_user),
			'apps' => $this->apps_model->get_apps_user($this->id_user),
			'count_contacts' => $this->users_model->get_statistics($this->id_user, 0),
			'count_apps' => $this->users_model->get_statistics($this->id_user, 1)
		];

		$this->load->view('users/main', $data);
	}

	public function update_user()
	{
		if ($this->form_validation->run()) {
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$data = [];

			if (!empty($name)) {
				$data['name'] =  $name;
			}
			if (!empty($email)) {
				$data['email'] = $email;
			}
			if (!empty($password)) {
				$salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
				$key_pass = crypt($password, $salt);

				$salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
				$hash_pass = crypt($password, $salt);

				$data['key'] = $key_pass;
				$data['hash'] = $hash_pass;
			}

			if ($this->users_model->update_data_user($this->id_user, $data)) {
				$data = array(
					'status' => 'success',
					'message' => 'User updated.'
				);
				print(json_encode($data));
			} else {
				$data = array(
					'status' => 'error',
					'message' => 'Please try once more.'
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
}