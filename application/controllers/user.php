<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class User extends CI_Controller {

		public function index()
		{
			$user = $this->model->getUser($_SESSION['user']['id']);
			$data['id'] = $_SESSION['user']['id'];
			$data['firstName'] = $user['firstName'];
			$data['middleName'] = $user['middleName'];
			$data['lastName'] = $user['lastName'];
			$data['email'] = $user['email'];
			$data['picture'] = $user['picture'];
			
			$completedGoals = $this->model->getCompletedGoals($_SESSION['user']['id']);
			$data['completed'] = $completedGoals;
			
			$pendingGoals = $this->model->getPendingGoals($_SESSION['user']['id']);
			$data['pending'] = $pendingGoals;
			
			$listGoals = $this->model->getGoals($_SESSION['user']['id']);
			for($i=0; $listGoals!=false && $i<sizeof($listGoals);$i++){
				$data['listGoals'][$i]['title'] = $listGoals[$i]['title'];
				$data['listGoals'][$i]['id'] = $listGoals[$i]['id'];
				$data['listGoals'][$i]['statusId'] = $listGoals[$i]['statusId'];
			}
						
			$data['content'] = 'user';			
			$this->load->view('structure/template', $data);
		}
		
		public function user_profile($userId)
		{
			$user = $this->model->getUser($userId);
			$data['id'] = $userId;
			$data['firstName'] = $user['firstName'];
			$data['middleName'] = $user['middleName'];
			$data['lastName'] = $user['lastName'];
			$data['email'] = $user['email'];
			$data['picture'] = $user['picture'];
			
			$completedGoals = $this->model->getCompletedGoals($userId);
			$data['completed'] = $completedGoals;
			
			$pendingGoals = $this->model->getPendingGoals($userId);
			$data['pending'] = $pendingGoals;
			
			$listGoals = $this->model->getGoals($userId);
			for($i=0; $listGoals!=false && $i<sizeof($listGoals);$i++){
				$data['listGoals'][$i]['title'] = $listGoals[$i]['title'];
				$data['listGoals'][$i]['id'] = $listGoals[$i]['id'];
				$data['listGoals'][$i]['statusId'] = $listGoals[$i]['statusId'];
			}
			
			$isFollowing = $this->model->isFollowing($userId);
			$data['isFollowing'] = $isFollowing;
			
			$data['content'] = 'user';			
			$this->load->view('structure/template', $data);
		}
		
		public function startFollowing($userId){
			$this->model->startFollowing($userId);
			redirect(base_url()."user/user_profile/".$userId);
		}
		
		public function stopFollowing($userId){
			$this->model->stopFollowing($userId);
			redirect(base_url()."user/user_profile/".$userId);
		}
			
	}
?>