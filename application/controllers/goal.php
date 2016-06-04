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
			$data['goal'] = $this->model->getGoal($goalId);  
			if($data['goal']===false)
				redirect(base_url().'goal');
			$this->load->view('structure/template',$data);
		}

		function update_milestones($goalId) {
			$data['content']='updateGoal2';
			$data['milestones']=$this->model->getMilestones($goalId);
			if($data['milestones']===false)
			redirect(base_url().'goal');
			
			$this->load->view('structure/template',$data);
		}

		function update_pictures($goalId) {
			$data['content']='updateGoal3';
			$this->load->view('structure/template',$data);
		}
		function receiveDataNewGoal(){
			$this->load->helper('date');
			$data['goal']['title'] = $_POST['goal_title'];
			$data['goal']['description'] = $_POST['goal_description'];
			$data['goal']['user_id'] =$_SESSION['user']['id'];
			$data['goal']['goal_type_id'] = $_POST['goal_type_id'];
			if($_POST['is_completed'])
				$data['goal']['status_id'] = 3;
			else
				$data['goal']['status_id'] = 2;
				
			$data['goal']['creation_date'] = mdate("%Y-%m-%d",time());
			$data['goal']['start_date'] = date("Y-m-d", strtotime($_POST['start_date']));
			if($_POST['is_completed']){
				$data['goal']['completed_date'] = date("Y-m-d", strtotime($_POST['completed_date']));
			}
			else{
				$data['goal']['completed_date'] = "";
			}
			$data['goal']['finishing_date'] = date("Y-m-d", strtotime($_POST['finishing_date']));
			$data['goal']['last_update_date'] = mdate("%Y-%m-%d",time());
			if($_POST['is_public'])
				$data['goal']['is_public'] = true;
			else
				$data['goal']['is_public'] = false;

			
			$result = $this->model->addGoal($data['goal']);
			if($result === false){
				$data['error']="Error: Could not create goal at the moment, please try again later.";
				$this->session->set_flashdata('error-goal', $data);
				redirect(base_url().'goal');
			}
			else{
				redirect(base_url().'goal/update_goal/'.$result);
			}
			
		}


	}
?>