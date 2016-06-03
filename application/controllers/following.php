<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Following extends CI_Controller {

		public function index() {
			$data['content']='following';
			$data['following']=$this->model->getFollowing();
			$this->load->view('structure/template',$data);
		}
	}
?>