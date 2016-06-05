<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Home extends CI_Controller {

		public function index() {
			$data['nf_following'] = $this->model->getNewsFeedFollowing();
			for($i=1;$i<=6;$i++){
				$data['nf_category'][$i] = $this->model->getNewsFeedByCategory($i);	
			}
			$data['content'] = 'home';
			$this->load->view('structure/template', $data);
		}
	}
?>