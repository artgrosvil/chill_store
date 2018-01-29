<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'auth/auth_user' => array(
		array(
			'field' => 'password',
			'label' => 'Password user',
			'rules' => 'trim|required|min_length[6]'
		),
		array(
			'field' => 'login',
			'label' => 'Login user',
			'rules' => 'trim|required'
		)
	),
	'users/update_user' => array(
		array(
			'field' => 'password',
			'label' => 'Password user',
			'rules' => 'trim'
		),
		array(
			'field' => 'email',
			'label' => 'Login user',
			'rules' => 'trim'
		),
		array(
			'field' => 'name',
			'label' => 'Login user',
			'rules' => 'trim'
		)
	),
	'apps/add_app' => array(
		array(
			'field' => 'id_app',
			'label' => 'App ID',
			'rules' => 'trim|required'
		)
	),
	'apps/delete_app' => array(
		array(
			'field' => 'id_app',
			'label' => 'App ID',
			'rules' => 'trim|required'
		)
	)
);