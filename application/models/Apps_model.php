<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps_model extends CI_Model
{

	/**
	 * @param $id_user
	 * @return bool
	 */
	function get_apps_user($id_user)
	{
		$data = $this->db->query("SELECT
			a.id_user, a.id_contact, a.type_contact,
			b.id AS id_app, b.name AS name_app, b.description
			FROM contacts AS a

			LEFT JOIN apps AS b ON b.id = a.id_contact

			WHERE a.id_user = $id_user AND a.type_contact = 1");
		if ($data) {
			return $data;
		} else {
			return FALSE;
		}
	}

	/**
	 * @return bool
	 */
	function get_categories()
	{
		$data = $this->db->get('apps_categories');
		if ($data) {
			return $data;
		} else {
			return FALSE;
		}
	}

	function get_data_category($name_category)
	{
		$this->db->where('name', $name_category);
		$data = $this->db->get('apps_categories');
		if ($data) {
			return $data;
		} else {
			return FALSE;
		}
	}

	function get_sort_apps($id_category)
	{
		$this->db->where('id_category', $id_category);
		$this->db->where('status', 1);
		$data = $this->db->get('apps');
		if ($data) {
			return $data;
		} else {
			return FALSE;
		}
	}

	function get_apps()
	{
		$this->db->where('status', 1);
		$data = $this->db->get('apps');
		if ($data) {
			return $data;
		} else {
			return FALSE;
		}
	}

	/**
	 * @param $data
	 * @return bool
	 */
	function add_app($data)
	{
		if ($this->db->insert('contacts', $data)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	 * @param $id_user
	 * @param $id_app
	 * @return bool
	 */
	function check_app($id_user, $id_app)
	{
		$this->db->where('id_user', $id_user);
		$this->db->where('id_contact', $id_app);
		$data = $this->db->get('contacts');
		if ($data->num_rows() == 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	 * @param $id_user
	 * @param $id_app
	 * @return bool
	 */
	function delete_app($id_user, $id_app)
	{
		$this->db->where('id_user', $id_user);
		$this->db->where('id_contact', $id_app);
		$this->db->where('type_contact', 1);
		if ($this->db->delete('contacts')) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file Apps_model.php */
/* Location: ./application/models/Apps_model.php */