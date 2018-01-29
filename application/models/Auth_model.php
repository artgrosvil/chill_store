<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	/**
	 * @param $login
	 * @return bool
	 */
	function get_data_user($login)
	{
		$this->db->where('login', $login);
		$data = $this->db->get('users_app');
		if ($data) {
			return $data;
		} else {
			return FALSE;
		}
	}
}

/* End of file Auth_model.php */
/* Location: ./application/models/Auth_model.php */