<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Signup extends CI_Controller {

		public function index(){
			$data['content']='signup';
			$this->load->view('structure/template',$data);
		}

		public function receiveData(){
			$data['user']['first_name'] = $_POST['first_name'];
			$data['user']['middle_name'] = $_POST['middle_name'];
			$data['user']['last_name'] = $_POST['last_name'];
			$data['user']['email'] = $_POST['email'];
			$data['user']['password'] = $_POST['password'];
			$data['user']['picture'] = $_FILES['picture'];

			$result = $this->model->signUp($data['user']);
			if($result === true){
				redirect(base_url());
			}
			else{
				$data['error']=$result;
				$this->session->set_flashdata('error-user', $data);
				redirect(base_url()/'signup');
			}
		}
		
		public function checkPasswords() {
			$pass1 = document.getElementById("password").value;
			$pass2 = document.getElementById("confirm_password").value;
			$ok = true;
			if ($pass1 != $pass2) {
				alert("Passwords Do not match");
				//document.getElementById("password").style.borderColor = "#E34234";
				//document.getElementById("confirm_password").style.borderColor = "#E34234";
				$ok = false;
			}
			return $ok;
		}
		

	}
?>