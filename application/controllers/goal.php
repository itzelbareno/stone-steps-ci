<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Goal extends CI_Controller {

		function index() {
			//Preparar información del objetivo
			$data['content']='updateGoal1';
			$this->load->view('structure/template',$data);
		}

		function view($userId=0, $goalId=0) {
			//Preparar información del objetivo
			
			$data['userId'] = $userId;
			$goalInfo = $this->model->getGoal($goalId);
			$data['goalInfo'] = $goalInfo;
			if($data['goalInfo']['statusId'] == 2){
				$data['goalInfo']['status']	= 'Pending';	
			}
			else if($data['goalInfo']['statusId'] == 3){
				$data['goalInfo']['status']	= 'Completed';	
			}
			
			$listMilestones = $this->model->getMilestones($goalInfo['id']);	
				
			for($i=0; $listMilestones!=false && $i<sizeof($listMilestones);$i++){
				$data['listMilestones'][$i]['title'] = $listMilestones[$i]['title'];
				$data['listMilestones'][$i]['id'] = $listMilestones[$i]['id'];
				$data['listMilestones'][$i]['statusId'] = $listMilestones[$i]['statusId'];
			}
			
			$data['goalPictures'] = $this->model->getGoalPictures($goalInfo['id']);
			$data['content']='goal';
			$this->load->view('structure/template',$data);
		}

		function update_goal($goalId) {
			$data['content']='updateGoal1';
			$data['goalId']=$goalId;
			$data['goal'] = $this->model->getGoal($goalId);
			if($data['goal']===false) redirect(base_url().'goal');
			if($data['goal']['userId']!=$_SESSION['user']['id']) redirect(base_url());
			$this->load->view('structure/template',$data);
		}
		
		function delete_goal($goalId){
			$this->model->deleteGoal($goalId);
			redirect(base_url().'user/');
		}

		function update_milestones($goalId) {
			$data['content']='updateGoal2';
			$data['goalId']=$goalId;
			$data['milestones']=$this->model->getMilestones($goalId);
			$data['goal'] = $this->model->getGoal($goalId);
			if($data['goal']['userId']!=$_SESSION['user']['id']) redirect(base_url());			

			$this->load->view('structure/template',$data);
		}

		function update_pictures($goalId) {
			$data['goalPictures']=$this->model->getGoalPictures($goalId);
			$data['goalId']=$goalId;
			$data['content']='updateGoal3';
			$this->load->view('structure/template',$data);
		}

		function save_goal($goalId){
			$goal['goal_id']=$goalId;
			$goal['title'] = $_POST['goal_title'];
			$goal['description'] = $_POST['goal_description'];
			$goal['user_id'] =$_SESSION['user']['id'];
			$goal['goal_type_id'] = $_POST['goal_type_id'];
			if($_POST['is_completed'])
				$goal['status_id'] = 3;
			else
				$goal['status_id'] = 2;
				
			
			$goal['creation_date'] = mdate("%Y-%m-%d",time());
			$goal['start_date'] = date("Y-m-d", strtotime($_POST['start_date']));
			if($_POST['is_completed']){
				$goal['completed_date'] = date("Y-m-d", strtotime($_POST['completed_date']));
			}
			else{
				$goal['completed_date'] = "";
			}
			$goal['finishing_date'] = date("Y-m-d", strtotime($_POST['finishing_date']));
			$goal['last_update_date'] = mdate("%Y-%m-%d",time());
			if($_POST['is_public'])
				$goal['is_public'] = true;
			else
				$goal['is_public'] = false;
			
			$result = $this->model->updateGoal($goal,$goalId);
			if($result === false){
				$goal['error']="Error: Could not create goal at the moment, please try again later.";
				$this->session->set_flashdata('error-goal', $data);
				redirect(base_url().'goal/update_goal/'.$goalId);
			}
			else{
				redirect(base_url().'goal/update_goal/'.$goalId);
			}	
		}
		
		function save_milestone($milestoneId){
			$ms= $this->model->getMilestone($milestoneId);
			$milestone['milestone_id']=$ms['id'];
			$milestone['goal_id']=$ms['goalId'];
			$milestone['title']=$_POST['milestone_title2'];
			if($_POST['is_completed2'])
				$milestone['status_id'] = 3;
			else
				$milestone['status_id'] = 2;	
			$milestone['completed_date']=$ms['completedDate'];
			$result = $this->model->updateMilestone($milestone, $milestoneId);
			
			
			if($result === false){
				$data['error']="Error: Could not create milestone at the moment, please try again later.";
				$this->session->set_flashdata('error-milestone', $data);
				redirect(base_url().'goal');
			}
			else{
				redirect(base_url().'goal/update_milestones/'.$ms['goalId']);
			}		
		}
		
		function save_milestone2($milestoneId){
			$ms= $this->model->getMilestone($milestoneId);
			$milestone['milestone_id']=$ms['id'];
			$milestone['goal_id']=$ms['goalId'];
			$milestone['title']=$_POST['milestone_title2'];
			if($_POST['is_completed2'])
				$milestone['status_id'] = 3;
			else
				$milestone['status_id'] = 2;	
			$milestone['completed_date']=$ms['completedDate'];
			$result = $this->model->updateMilestone($milestone, $milestoneId);
			
			if($result === false){
				$data['error']="Error: Could not create milestone at the moment, please try again later.";
				$this->session->set_flashdata('error-milestone', $data);
				redirect(base_url().'goal');
			}
			else{
				redirect(base_url().'goal/view/'.$_SESSION['user']['id'].'/'.$ms['goalId']);
			}		
		}
		
		function create_milestone($goalId){
			$milestone['goal_id'] = $goalId;
			$milestone['title'] = $_POST['milestone_title'];
			if($_POST['is_completed'])
				$milestone['status_id'] = 3;
			else
				$milestone['status_id'] = 2;
			$milestone['completed_date'] = mdate("%Y-%m-%d",time());
					
			$result = $this->model->addMilestone($milestone);
						
			if($result === false){
				$data['error']="Error: Could not create milestone at the moment, please try again later.";
				$this->session->set_flashdata('error-milestone', $data);
				redirect(base_url().'goal');
			}
			else{
				redirect(base_url().'goal/update_milestones/'.$goalId);
			}			
		}
		
		function delete_milestone($milestoneId){
			$ms= $this->model->getMilestone($milestoneId);
			$this->model->deleteMilestone($milestoneId);
			redirect(base_url().'goal/update_milestones/'.$ms['goalId']);
		}
		
		function delete_milestone2($milestoneId){
			$ms= $this->model->getMilestone($milestoneId);
			$this->model->deleteMilestone($milestoneId);
			redirect(base_url().'goal/view/'.$_SESSION['user']['id'].'/'.$ms['goalId']);
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

		function saveGoalPicture($pictureId){
			$gp= $this->model->getPicture($pictureId);
			$goalPicture['picture_id']=$gp['id'];
			$goalPicture['goal_id']=$gp['goalId'];
			$goalPicture['name']=$gp['name'];
			$goalPicture['caption']=$_POST['piccaption'];
			
			$result = $this->model->updateGoalPicture($goalPicture, $pictureId);			
			
			if($result === false){
				$data['error']="Error: Could not create goalPicture at the moment, please try again later.";
				$this->session->set_flashdata('error-goalPicture', $data);
				redirect(base_url().'goal');
			}
			else{
				redirect(base_url().'goal/update_pictures/'.$gp['goalId']);
			}	
		}
		
		function deleteGoalPicture($pictureId){
			$pic= $this->model->getPicture($pictureId);
			$this->model->deleteGoalPicture($pictureId);
			redirect(base_url().'goal/update_pictures/'.$pic['goalId']);
		}
		function receiveDataNewPicture($goalId){
			if($_POST['caption']!="" && $_FILES['name']!=""){
				print_r($_POST['caption']);
				print_r($_FILES['name']);
				$picture['goal_id'] =$goalId ;
				$picture['caption'] = $_POST['caption'];
				$picture['name'] = $_FILES['name'];
				
				$result = $this->model->addGoalPicture($picture);
				if($result === false){
					$data['error']="Error: Could not update picture at the moment, please try again later.";
					$this->session->set_flashdata('error-goal', $data);
					redirect(base_url().'goal/update_pictures/'.$goalId);
				}
				else{
					$data['error']="";
					redirect(base_url().'goal/update_pictures/'.$goalId);
				}
			}
			else{
				redirect(base_url().'goal/update_pictures/'.$goalId);	
			}
		}

		
	}
?>


