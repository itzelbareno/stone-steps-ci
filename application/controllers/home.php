<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Home extends CI_Controller {

		public function index()
		{
			$data['content'] = 'home';
			$this->load->view('structure/template', $data);
		}

		function goalone($goalId = "") {
			//Preparar información del objetivo
			$data['content']='goal';
			$this->load->view('structure/template',$data);
		}
	}
?>