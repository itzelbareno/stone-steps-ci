<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Action extends CI_Controller {
	   function signUp($firstName="", $middleName="", $lastName="", $email="", $password="", $picture="") {
			$data['first_name'] = rawurldecode($firstName);
			$data['middle_name'] = rawurldecode($middleName);
			$data['last_name'] = rawurldecode($lastName);
			$data['email'] = rawurldecode($email);
			$data['password'] = rawurldecode($password);
			$data['picture'] = rawurldecode($picture);
			//print_r($data);
			$result=$this->model->signUp($data);
			if($result===true||$result===false)
				echo $result; 
			else
				echo json_encode($result);
		}
		
		function nextId(){
			echo json_encode($this->model->nextId());
		}

	   function logIn($email="", $password="") {
			echo json_encode($this->model->logIn(rawurldecode($email),rawurldecode($password)));
		}					
												
		function getFollowing($userId) {
			echo json_encode($this->model->getFollowing(rawurldecode($userId)));
		}
		
		function isFollowing($user_id,$userFollowId){
			echo $this->model->isFollowing(rawurldecode($user_id),rawurldecode($userFollowId));
		}

		function startFollowing($userId="",$userFollowId=""){
			echo json_encode($this->model->startFollowing(rawurldecode($userId),rawurldecode($userFollowId)));
		}
		
		function stopFollowing($userId="",$userFollowId=""){
			echo $this->model->stopFollowing(rawurldecode($userId),rawurldecode($userFollowId));
		}		

		function getCompletedGoals($userId){
			echo json_encode($this->model->getCompletedGoals(rawurldecode($userId)));
		}
		
		function getPendingGoals($userId){
			echo json_encode($this->model->getPendingGoals(rawurldecode($userId)));
		}
		
		//function uploadUserPicture($file){
			//echo json_encode($this->model->uploadUserPicture(rawurldecode($file)));
		//}

		//function deleteUserPicture(){
			//echo json_encode($this->model->deleteUserPicture();
		//}
		
		function changeUserPicture($userId="",$pictureName=""){
			echo json_encode($this->model->changeUserPicture(rawurldecode($userId), rawurldecode($pictureName)));
		}			
		
		function getUser($userId) {
			echo json_encode($this->model->getUser(rawurldecode($userId)));
		}
		
		function getGoals($userId){
			echo json_encode($this->model->getGoals(rawurldecode($userId)));
		}
		function getGoal($goalId){
			echo json_encode($this->model->getGoal(rawurldecode($goalId)));
		}
		
		function getMilestone($milestoneId){
			echo json_encode($this->model->getMilestone(rawurldecode($milestoneId)));
		}
		function getPicture($pictureId){
			echo json_encode($this->model->getPicture(rawurldecode($pictureId)));
		}
		
		function getMilestones($goalId){
			echo json_encode($this->model->getMilestones(rawurldecode($goalId)));
		}
		function getGoalPictures($goalId){
			echo json_encode($this->model->getGoalPictures(rawurldecode($goalId)));
		}
		function nextPictureId(){
			echo json_encode($this->model->nextPictureId());
		}
		
		function getCategoryName($category){
			echo json_encode($this->model->getCategoryName(rawurldecode($categoryId)));
		}
		function getCategory($categoryId){
			$result=$this->model->getCategory(rawurldecode($categoryId));
			if($result===true||$result===false)
				echo $result; 
			else
				echo json_encode($result);			
		}		
		
		function getStatusName($status){
			echo json_encode($this->model->getStatusName(rawurldecode($status)));
		}

		function addGoal($title="",$description="",$user_id="", $goal_type_id="",$status_id="",$creation_date="",$start_date="",$completed_date="",$finishing_date="",$last_update_date="",$is_public=""){		
			$data['title'] = rawurldecode($title);
			$data['description'] = rawurldecode($description);
			$data['user_id'] = rawurldecode($user_id);
			$data['goal_type_id'] = rawurldecode($goal_type_id);
			$data['status_id'] = rawurldecode($status_id);
			$data['creation_date']= rawurldecode($creation_date);
			$data['start_date'] = rawurldecode($start_date);
			$data['completed_date'] = rawurldecode($completed_date);
			$data['finishing_date'] = rawurldecode($finishing_date);
			$data['last_update_date'] = rawurldecode($last_update_date);
			$data['is_public'] = rawurldecode($is_public);			
			
			$array['result']=$this->model->addGoal(rawurldecode($user_id),$data);
			echo json_encode($array['result']);
		}
		
		
		
		
		
		////////////////////////////////////////////////////////////////////////
		function updateGoal($goal_id=0,$title=0,$description=0,$userId=0,$goal_type_id=0,$status_id=0,$creation_date=0,$start_date=0, $completed_date=0,$finishing_date=0,$last_update_date=0,$is_public=0){
			if(rawurldecode($goal_id)!=0)
				$data['goal_id']=rawurldecode($goal_id);
			if(rawurldecode($title)!=0)
				$data['title']=rawurldecode($title);
			if(rawurldecode($description)!=0)
				$data['description']=rawurldecode($description);
			if(rawurldecode($userId)!=0)
				$data['user_id']=rawurldecode($userId);
			if(rawurldecode($goal_type_id)!=0)
				$data['goal_type_id']=rawurldecode($goal_type_id);
			if(rawurldecode($status_id)!=0)
				$data['status_id']=rawurldecode($status_id);
			if(rawurldecode($creation_date)!=0)
				$data['creation_date']=rawurldecode($creation_date);
			if(rawurldecode($start_date)!=0)
				$data['start_date']=rawurldecode($start_date);
			if(rawurldecode($is_completed)!=0)
				$data['is_completed']=rawurldecode($is_completed);
			if(rawurldecode($completed_date)!=0)
				$data['completed_date']=rawurldecode($completed_date);
			if(rawurldecode($finishing_date)!=0)
				$data['finishing_date']=rawurldecode($finishing_date);
			if(rawurldecode($last_update_date)!=0)
				$data['last_update_date']=rawurldecode($last_update_date);
			if(rawurldecode($is_public)!=0)
				$data['is_public']=rawurldecode($is_public);
			
			$array['result']=$this->model->updateGoal($userId,$data,rawurldecode($goal_id));
			echo json_encode($array['result']);
		}

				
		function deleteGoal($goalId){
			echo json_encode($this->model->deleteGoal(rawurldecode($goalId)));
		}

		
		function addMilestone($userId,$goal_id,$title,$status_id,$completed_date){
			$data['goal_id']=rawurldecode($goal_id);
			$data['title']=rawurldecode($title);
			$data['status_id']=rawurldecode($status_id);
			$data['completed_date']=rawurldecode($completed_date);	
			$array['result']=$this->model->addMilestone(rawurldecode($userId),$data);
			echo json_encode($array['result']);
		}		
		
		function updateMilestone($userId, $milestone_id=0,$goal_id=0,$title="",$status_id=0,$completed_date=0){			
			if(rawurldecode($milestone_id)!=0)
				$data['milestone_id']=rawurldecode($milestone_id);
			if(rawurldecode($goal_id)!=0)
				$data['goal_id']=rawurldecode($goal_id);
			if(rawurldecode($title)!="")
				$data['title']=rawurldecode($title);
			if(rawurldecode($status_id)!=0)
				$data['status_id']=rawurldecode($status_id);
			if(rawurldecode($completed_date)!=0)
				$data['completed_date']=rawurldecode($completed_date);
			
			$array['result']=$this->model->updateMilestone(rawurldecode($userId),$data,rawurldecode($milestone_id));
			echo json_encode($array['result']);
		}


		function deleteMilestone($milestoneId){
			echo json_encode($this->model->deleteMilestone(rawurldecode($milestoneId)));
		}


		function addGoalPicture($userId="",$goal_id="",$caption="",$name=""){
			$data['goal_id']=rawurldecode($goal_id);
			$data['name']=rawurldecode($name);
			$data['caption']=rawurldecode($caption);
			
			//$array['result']=$this->model->addGoalPicture(rawurldecode($userId),$data);
			echo json_encode($this->model->addGoalPicture(rawurldecode($userId),$data));				
		}

		function updateGoalPicture($picture_id=0,$goal_id=0,$name="",$caption=""){
			if(rawurldecode($picture_id)!=0)
				$data['picture_id']=rawurldecode($picture_id);
			if(rawurldecode($goal_id)!=0)
				$data['goal_id']=rawurldecode($goal_id);
			if(rawurldecode($name)!="")
				$data['name']=rawurldecode($name);
			if(rawurldecode($caption)!="")
				$data['caption']=rawurldecode($caption);
			
			$array['result']=$this->model->updateGoalPicture(rawurldecode($picture_id),$data);
			echo json_encode($array['result']);
		}
		
		function deleteGoalPicture($pictureId){
			echo json_encode($this->model->deleteGoalPicture(rawurldecode($pictureId)));
		}

		function getNewsFeedFollowing($userId){
			echo json_encode($this->model->getNewsFeedFollowing($userId));
		}
			
		function getNewsFeedFromUser($userId){
			echo json_encode($this->model->getNewsFeedFromUser(rawurldecode($userId)));
		}
		
		function getNewsFeedByCategory($userId="",$categoryId=""){
			echo json_encode($this->model->getNewsFeedByCategory(rawurldecode($userId),rawurldecode($categoryId)));
			
		}
		
		function addNewsFeed($user_id="",$news_type_id="",$object_id="",$created_date=""){
			$data['user_id']=rawurldecode($user_id);
			$data['news_type_id']=rawurldecode($news_type_id);
			$data['object_id']=rawurldecode($object_id);
			$data['completed_date']=rawurldecode($created_date);
					
			$array['result']=$this->model->addNewsFeed($data);
			echo json_encode($array['result']);
		}

		function search($keyword){
			echo json_encode($this->model->search(rawurldecode($keyword)));
		}
		
		
	}
?>


