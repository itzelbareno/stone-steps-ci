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
			
			if($_POST['password'] == $_POST['confirm_password']){
				if($_FILES['picture']['name'] == ""){
					$data['user']['picture'] = "";
				}
				else{
					$data['user']['picture'] = $_FILES['picture'];	
				}			

				$result = $this->model->signUp($data['user']);
				if($result === true){
					redirect(base_url());
				}
				else{
					$data['error']=$result;
					$this->session->set_flashdata('error-user', $data);
					redirect(base_url().'signup');
				}	
			}
			else{
				$data['error']="Passwords do not match.";
				$this->session->set_flashdata('error-user', $data);
				redirect(base_url().'signup');
			}	
		}
	}
?>