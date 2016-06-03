<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Login extends CI_Controller {

		public function index(){
			$data['content']='login';
			$this->load->view('structure/template',$data);
		}
		
		public function receiveData(){
			$data['email'] = $_POST['email'];
			$data['password'] = $_POST['password'];
			
			$result = $this->model->logIn($data['user']);
			
			if($result === true){
				redirect(base_url());
			}
			else{
				$data['error']=$result;
				$this->session->set_flashdata('error-user', $data);
				redirect(base_url().'login');
			}
		}
	}
?>