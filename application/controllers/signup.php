<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Signup extends CI_Controller {

		public function index(){
			$data['content']='signup';
			$this->load->view('structure/template',$data);
		}

		public function receiveData(){
			$data['first_name'] = $_POST['first_name'];
			$data['middle_name'] = $_POST['middle_name'];
			$data['last_name'] = $_POST['last_name'];
			$data['email'] = $_POST['email'];
			$data['password'] = $_POST['password'];
			$data['picture'] = $_POST['file'];
			$this->model->signUp($data);
			redirect(base_url());
		}
	}
?>