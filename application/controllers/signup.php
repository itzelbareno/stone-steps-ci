<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Signup extends CI_Controller {

		public function index(){
			$data['content']='signup';
			$this->load->view('structure/template',$data);
		}
	}
?>