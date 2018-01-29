<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
	function get_data_user($id_user)
	{
		$this->db->where('id', $id_user);
		$data = $this->db->get('users_app');
		if ($data) {
			return $data;
		} else {
			return FALSE;
		}
	}

	/**
	 * @param $id_user
	 * @param $type_contact
	 * @return bool
	 */
	function get_statistics($id_user, $type_contact)
	{
		$this->db->where('id_user', $id_user);
		$this->db->where('type_contact', $type_contact);
		$data = $this->db->count_all_results('contacts');
		return $data;
	}

	/**
	 * @param $id_user
	 * @param $data
	 * @return bool
	 */
	function update_data_user($id_user, $data)
	{
		$this->db->where('id', $id_user);
		if ($this->db->update('users_app', $data)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */