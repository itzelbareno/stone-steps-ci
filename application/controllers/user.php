<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class User extends CI_Controller {

		public function index()
		{
			$data['content'] = 'user';
			$this->load->view('structure/template', $data);
		}
	}
?>