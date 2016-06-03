<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Goal extends CI_Controller {

		function index() {
			//Preparar información del objetivo
			$data['content']='updateGoal1';
			$this->load->view('structure/template',$data);
		}

		function view($goalId) {
			//Preparar información del objetivo
			$data['content']='goal';
			$this->load->view('structure/template',$data);
		}

		function update_goal($goalId) {
			$data['content']='updateGoal1';
			//$data['goal'] = $this->model->getGoal($goalId);
			$this->load->view('structure/template',$data);
		}

		function update_milestones($goalId) {
			$data['content']='updateGoal2';
			$this->load->view('structure/template',$data);
		}

		function update_pictures($goalId) {
			$data['content']='updateGoal3';
			$this->load->view('structure/template',$data);
		}


	}
?>