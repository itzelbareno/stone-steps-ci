<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Search extends CI_Controller {

		public function index() {
			$data['searchResults'] = $this->model->search($_POST['name']); 
			$data['content']='search';
			$this->load->view('structure/template',$data);
		}
	}
?>