<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends CI_Controller
{
	protected $id_user;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('apps_model');

		$this->id_user = $this->session->id;
	}

	public function index()
	{
		$data = [
			'categories' => $this->apps_model->get_categories(),
			'apps' => $this->apps_model->get_apps()->result_array()
		];

		$this->load->view('apps/main', $data);
	}

	public function sort_apps()
	{
		$name_category = $this->uri->segment(2);
		if ($name_category != 'all') {
			$data_category = $this->apps_model->get_data_category($name_category)->row();
			$apps = $this->apps_model->get_sort_apps($data_category->id)->result_array();
		} else {
			$apps = $this->apps_model->get_apps()->result_array();
		}

		$sort = $this->uri->segment(4);
		if ($sort == 'new') {
			uasort($apps, function($a, $b){
				return -($a['id'] - $b['id']);
			});
		}
		if ($sort == 'best') {
			uasort($apps, function($a, $b){
				return -($a['count_added'] - $b['count_added']);
			});
		}

		$data = [
			'categories' => $this->apps_model->get_categories(),
			'apps' => $apps
		];

		$this->load->view('apps/main', $data);
	}

	public function add_app()
	{
		if ($this->form_validation->run()) {
			$id_app = $this->input->post('id_app');

			if ($this->apps_model->check_app($this->session->id, $id_app)) {
				$data = [
					'id_user' => $this->session->id,
					'id_contact' => $id_app,
					'type_contact' => 1
				];

				$data_re = [
					'id_user' => $id_app,
					'id_contact' => $this->session->id,
					'type_contact' => 1
				];

				if ($this->apps_model->add_app($data) && $this->apps_model->add_app($data_re)) {
					$data = array(
						'status' => 'success',
						'message' => 'App added.'
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
					'message' => 'App already added.'
				];
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

	public function delete_app()
	{
		if ($this->form_validation->run()) {
			$id_app = $this->input->post('id_app');

			if ($this->apps_model->delete_app($this->id_user, $id_app) && $this->apps_model->delete_app($id_app, $this->id_user)) {
				$data = array(
					'status' => 'success',
					'message' => 'App deleted.'
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