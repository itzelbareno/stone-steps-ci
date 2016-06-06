<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Home extends CI_Controller {

		public function index() {
			$data['nf_following'] = $this->model->getNewsFeedFollowing();
			for($i=0; isset($data['nf_following']) && $i < sizeof($data['nf_following']); $i++){
				$flag=0;
				for($j=0;  $j < sizeof($data['nf_following'])-$i-1; $j++){
					if($data['nf_following'][$j]['id'] < $data['nf_following'][$j+1]['id']){
						$aux = $data['nf_following'][$j];
						$data['nf_following'][$j] = $data['nf_following'][$j+1];
						$data['nf_following'][$j+1] = $aux;
						$flag = 1;
					}
				}
				if($flag==0){
					break;
				}
			}
			
			for($i=1;$i<=6;$i++){
				$data['nf_category'][$i] = $this->model->getNewsFeedByCategory($i);	
			}
			$data['content'] = 'home';
			$this->load->view('structure/template', $data);
		}
	}
?>