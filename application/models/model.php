<?php
	class Model extends CI_Model {

		function __construct() {
			parent::__construct();
		}

		//LOGIN, SIGNUP, HEADER

		//Devuelve True si el usuario fue dado de alta exitosamente.
		//Devuelve el error si no se pudo dar de alta al usuario.
		//userData['first_name']
		//userData['last_name']
		//userData['middle_name']
		//userData['password']
		//userData['email']
		//userData['picture']
		function signUp($userData) {
			if($this->db->where(array('email'=>$userData['email']))->get('users')->num_rows()==0){
				if($userData['picture'] == ""){
					$userData['picture'] = 'avatar.png';
				}
				
					$id = $this->db->select_max('user_id')->get('users')->row()->user_id;
					$id++;
					$userData['user_id'] = $id;
	            	if($this->db->insert('users',$userData)){
						return true;
                	}
                	else
                		return "Your signup process couldn't be accomplished, please try again later.";
            }
            else
            	return 'That email account is already in use. Please try another one or log into that account.';
		}
		
		function nextId(){
			$id = $this->db->select_max('user_id')->get('users')->row()->user_id;
			$id++;
			return $id;
		}

		function logIn($user, $password) {
			$where=array('email'=>$user,'password'=>$password);
            $userResults = $this->db->where($where)->get('users');
			if($userResults->num_rows()>0){
                $user=$userResults->row();
                $data['id']= $user->user_id;
				$data['firstName']= $user->first_name;
                $data['middleName']= $user->middle_name;
				$data['lastName']= $user->last_name;
				$data['email']= $user->email;
				$data['picture']= $user->picture;
				return $data;
			}
			else{
				return false;
			}
		}
		
/*		
		function logIn($user, $password) {
			$where=array('email'=>$user,'password'=>$password);
            $userResults = $this->db->where($where)->get('users');
			if($userResults->num_rows()>0){
                $user=$userResults->row();
                $data['id']= $user->user_id;
				$data['firstName']= $user->first_name;
                $data['middleName']= $user->middle_name;
				$data['lastName']= $user->last_name;
				$data['email']= $user->email;
				$data['password']=$user->password;
				$data['picture']= $user->picture;
				$this->setUser($data);
				return $data;
			}
			else{
				return false;
			}
		}
*/

		function logOut() {
			session_destroy();
		}

		function setUser($userData) {
			$_SESSION['user']['id']=$userData['id'];
			$_SESSION['user']['firstName']=$userData['firstName'];
			$_SESSION['user']['middleName']=$userData['middleName'];
			$_SESSION['user']['lastName']=$userData['lastName'];
			$_SESSION['user']['email']=$userData['email'];
			$_SESSION['user']['picture']=$userData['picture'];
		}

		function getUserName(){
			return $_SESSION['user']['firstName'].' '.$_SESSION['user']['lastName'];
		}

		function getUserPicture(){
			return $_SESSION['user']['picture'];
		}

		function getFollowing($userId) {
			$this->db->select('users.user_id as id,users.first_name as firstName,users.last_name as lastName, users.middle_name as middleName, users.picture as picture');
            $this->db->from('following');
            $this->db->join('users','users.user_id=following.user_following_id');
            $usersResults = $this->db->where(array('following.user_id'=>$userId))->get()->result();
            for($i=0; sizeof($usersResults)>0 && $i<sizeof($usersResults) ;$i++){
                $users[$i]['id']= $usersResults[$i]->id;
                $users[$i]['name']= $usersResults[$i]->firstName.' '.$usersResults[$i]->middleName.' '.$usersResults[$i]->lastName;
                $users[$i]['completedGoals']= $this->getCompletedGoals($usersResults[$i]->id);
                $users[$i]['picture']= $usersResults[$i]->picture;
            }
            if(sizeof($usersResults)>0)
            	return $users;
			else
				return false;	
		}
		
		function isFollowing($userId,$userFollowId){
			if(sizeof($this->db->where(array('user_id'=>$userId,'user_following_id'=>$userFollowId))->get('following')->result())>0)
				return true;
			return false;
		}

		function startFollowing($userId,$userFollowId){
			if($this->db->insert('following',array('user_id'=>$userId,'user_following_id'=>$userFollowId))) {
				$newsFeed['news_type_id'] = 5;
				$newsFeed['user_id'] = $userId;
				$newsFeed['object_id'] = $userFollowId;
				$this->load->helper('date');
				$newsFeed['created_date'] = mdate("%Y-%m-%d",time());
				$this->addNewsFeed($newsFeed);
				return true;
			}
			else
				return false;
		}

		function stopFollowing($userId,$userFollowId){
			$this->db->where(array('user_id'=>$userId,'user_following_id'=>$userFollowId))->delete('following');
		}

		function getCompletedGoals($userId){
			return sizeof($this->db->where(array('user_id'=>$userId,'status_id'=>3))->get('goals')->result());
		}
		
		function getPendingGoals($userId){
			return sizeof($this->db->where(array('user_id'=>$userId,'status_id'=>2))->get('goals')->result());
		}

		function changeUserPicture($userId, $pictureName){
			$data['picture']=$pictureName;
			$this->db->where(array('user_id'=>$userId))->update('users',$data);
		}
		
		
		//USER

		function getUser($userId) {
			$user = $this->db->where(array('user_id'=>$userId))->get('users')->row();
			if(isset($user->user_id)){
				$data['id']=$user->user_id;
				$data['firstName']=$user->first_name;
				$data['middleName']=$user->middle_name;
				$data['lastName']=$user->last_name;
				$data['email']=$user->email;
				$data['picture']=$user->picture;
				return $data;
			}
			else{
				return false;
			}
		}
		
		function getGoals($userId){
			$goals = $this->db->where(array('user_id'=>$userId, 'status_id !='=>0))->get('goals')->result();
			for($i=0; sizeof($goals)>0 && $i<sizeof($goals) ;$i++){
				$data[$i]['id']=$goals[$i]->goal_id;
				$data[$i]['title']=$goals[$i]->title;
				$data[$i]['description']=$goals[$i]->description;
				$data[$i]['userId']=$goals[$i]->user_id;
				$data[$i]['goalTypeId']=$goals[$i]->goal_type_id;
				$data[$i]['statusId']=$goals[$i]->status_id;
				$data[$i]['statusName']=$this->getStatusName($goals[$i]->status_id);
				$data[$i]['creationDate']=$goals[$i]->creation_date;
				$data[$i]['startDate']=$goals[$i]->start_date;
				$data[$i]['completedDate']=$goals[$i]->completed_date;
				$data[$i]['finishingDate']=$goals[$i]->finishing_date;
				$data[$i]['lastUpdateDate']=$goals[$i]->last_update_date;
				$data[$i]['isPublic']=$goals[$i]->is_public;
            }
			if(sizeof($goals)>0){
            	return $data;
            }
            else{
            	return false;
            }
		}
		//GOAL
		function getGoal($goalId){
			$goal = $this->db->where(array('goal_id'=>$goalId))->get('goals')->row();
			if($goal!=false){
				$data['id']=$goal->goal_id;
				$data['title']=$goal->title;
				$data['description']=$goal->description;
				$data['userId']=$goal->user_id;
				$data['goalTypeId']=$goal->goal_type_id;
				$data['goalTypePicture']=$this->getCategory($goal->goal_type_id)['picture'];
				$data['statusName']=$this->getStatusName($goal->status_id);
				$data['statusId']=$goal->status_id;
				$data['creationDate']=$goal->creation_date;
				$data['startDate']=$goal->start_date;
				$data['completedDate']=$goal->completed_date;
				$data['finishingDate']=$goal->finishing_date;
				$data['lastUpdateDate']=$goal->last_update_date;
				$data['isPublic']=$goal->is_public;
				return $data;
			}
			else{
				return false;
			}
		}
		function getMilestone($milestoneId){
			$milestone = $this->db->where(array('milestone_id'=>$milestoneId))->get('milestones')->row();
			if(isset($milestone->milestone_id)){
				$data['id']=$milestone->milestone_id;
				$data['goalId']=$milestone->goal_id;
				$data['title']=$milestone->title;
				$data['statusId']=$milestone->status_id;
				$data['completedDate']=$milestone->completed_date;
				return $data;
			}
			else{
				return false;
			}
		}
		function getPicture($pictureId){
			$picture = $this->db->where(array('picture_id'=>$pictureId))->get('goals_pictures')->row();
			if(isset($picture->picture_id)){
				$data['id']=$picture->picture_id;
				$data['goalId']=$picture->goal_id;
				$data['name']=$picture->name;
				$data['caption']=$picture->caption;
				return $data;
			}
			else{
				return false;
			}
		}
		function getMilestones($goalId){
			$milestones = $this->db->where(array('goal_id'=>$goalId, 'status_id !='=>0))->get('milestones')->result();
			for($i=0; sizeof($milestones)>0 && $i<sizeof($milestones) ;$i++){
				$data[$i]['id']=$milestones[$i]->milestone_id;
				$data[$i]['goalId']=$milestones[$i]->goal_id;
				$data[$i]['title']=$milestones[$i]->title;
				$data[$i]['statusId']=$milestones[$i]->status_id;
				$data[$i]['completedDate']=$milestones[$i]->completed_date;
            }
            if(sizeof($milestones)>0){
            	return $data;
            }
            else{
            	return false;
            }
		}
		function getGoalPictures($goalId){
			$pictures = $this->db->where(array('goal_id'=>$goalId))->get('goals_pictures')->result();
			for($i=0; sizeof($pictures)>0 && $i<sizeof($pictures) ;$i++){
				$data[$i]['id']=$pictures[$i]->picture_id;
				$data[$i]['goalId']=$pictures[$i]->goal_id;
				$data[$i]['name']=$pictures[$i]->name;
				$data[$i]['caption']=$pictures[$i]->caption;
            }
            if(sizeof($pictures)>0){
            	return $data;
            }
            else{
            	return false;
            }
		}
		function getCategoryName($category){
			return $this->db->where(array('type_id'=>$category))->get('goal_type')->row()->name;
		}
		function getCategory($categoryId){
			$type = $this->db->where(array('type_id'=>$categoryId))->get('goal_type')->row();
			if($type!=false){
				$category['id'] = $type->type_id;
				$category['name'] = $type->name;
				$category['picture'] = $type->icon;
				return $category;
			}
			return false;
		}
		function getStatusName($status){
			return $this->db->where(array('status_id'=>$status))->get('status')->row()->name;
		}
		//ADD, UPDATE, DELETE GOAL
		function addGoal($userId,$data){
			if($this->db->insert('goals',$data)) {
				$newGoalId = $this->db->insert_id();
				$newsFeed['news_type_id'] = 0;
				$newsFeed['user_id'] = $userId;
				$newsFeed['object_id'] = $newGoalId;
				$this->load->helper('date');
				$newsFeed['created_date'] = mdate("%Y-%m-%d",time());
				$this->addNewsFeed($newsFeed);
				return $newGoalId;
			}
			else
				return false;
			//Add to news feed
		}
		function updateGoal($userId,$data, $goalId){
			$oldGoal = $this->getGoal($goalId);
			if($this->db->where(array('goal_id'=>$goalId))->update('goals',$data)){
				if($data['status_id'] != $oldGoal['statusId']){
					$newsFeed['news_type_id'] = 2;
					$newsFeed['user_id'] = $userId;
					$newsFeed['object_id'] = $goalId;
					$this->load->helper('date');
					$newsFeed['created_date'] = mdate("%Y-%m-%d",time());
					$this->addNewsFeed($newsFeed);
				}
				return true;
			}
			//Add to news feed if status was updated
		}
		function deleteGoal($goalId){
			$data['status_id'] = 0;
			$this->db->where(array('goal_id'=>$goalId))->update('goals',$data);
			return true;
			//eliminar news feed
		}
		function addMilestone($userId,$data){
			if($this->db->insert('milestones',$data)) {
				$newMilestoneId = $this->db->insert_id();
				$newsFeed['news_type_id'] = 1;
				$newsFeed['user_id'] = $userId;
				$newsFeed['object_id'] = $newMilestoneId;
				$this->load->helper('date');
				$newsFeed['created_date'] = mdate("%Y-%m-%d",time());
				$this->addNewsFeed($newsFeed);
				return $newMilestoneId;
			}
			else
				return false;
		}
		function updateMilestone($userId,$data, $milestoneId){			
			$oldMilestone = $this->getMilestone($milestoneId);
			if($this->db->where(array('milestone_id'=>$milestoneId))->update('milestones',$data)) {
				if($data['status_id'] != $oldMilestone['statusId']){
					$newsFeed['news_type_id'] = 3;
					$newsFeed['user_id'] = $userId;
					$newsFeed['object_id'] = $milestoneId;
					$this->load->helper('date');
					$newsFeed['created_date'] = mdate("%Y-%m-%d",time());
					$this->addNewsFeed($newsFeed);
				}
				return true;
			}
			//Add to news feed if status was updated
		}
		function deleteMilestone($milestoneId){
			$data['status_id'] = 0;
			$this->db->where(array('milestone_id'=>$milestoneId))->update('milestones',$data);
			return true;
			//eliminar news feed
		}
		function addGoalPicture($userId, $data){
			if($this->db->insert('goals_pictures',$data)) {
				$newPictureId = $this->db->insert_id();
				$newsFeed['news_type_id'] = 4;
				$newsFeed['user_id'] = $userId;
				$newsFeed['object_id'] = $newPictureId;
				$this->load->helper('date');
				$newsFeed['created_date'] = mdate("%Y-%m-%d",time());
				$this->addNewsFeed($newsFeed);
				return $newPictureId;
			}
			else
				return false;
		}
		function updateGoalPicture($pictureId,$data){
			$this->db->where(array('picture_id'=>$pictureId))->update('goals_pictures',$data);
			return true;
			//Add to news feed if status was updated
		}
		function deleteGoalPicture($pictureId){
			$picture = $this->getPicture($pictureId);
			unlink(base_url().'images/goals/'.$picture['name']);
			$this->db->where(array('picture_id'=>$pictureId))->delete('goals_pictures');
			//$data['goal_id'] = 0;
			//$this->db->where(array('picture_id'=>$pictureId))->update('goals_pictures',$data);
			return true;
		}
		/*function uploadGoalPicture($picture, $goalId){
			$id = $this->db->select_max('picture_id')->get('goals_pictures')->row()->picture_id;
			$id++;
			$dir="./images/goals/";            
			$type = explode('/',$picture['type']);
			$type = $type[1];
			if($type == 'jpeg')
				$type = 'jpg';
			$name = $id.'.'.$type;
			$config['upload_path']=$dir;
			$config['allowed_types']='jpg|png';
			$config['file_name']=$name;
			$this->load->library('upload',$config);
            $this->upload->initialize($config);
            $this->upload->overwrite = true;
			if(!$this->upload->do_upload('name')){
				echo $this->upload->display_errors();
				return false;
			}
			else{
				list($width, $height) = getimagesize($dir.''.$name);
				$config['source_image']=$dir.''.$name;
				$config['maintain_ratio']=TRUE;
				$config['width'] = 640;
				$config['height'] = 480;
				$this->load->library('image_lib',$config);
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
                return $name;                                
			}
		}
		*/
		function nextPictureId(){
			$id = $this->db->select_max('picture_id')->get('goals_pictures')->row()->picture_id;
			$id++;
			return $id;			
		}
		//NEWS FEED
		function getNewsFeedFollowing($userId){
			$following = $this->getFollowing($userId);
			$c = 0;
			for($i=0; sizeof($following)>0 && $i<sizeof($following); $i++){
				$followingNews = $this->getNewsFeedFromUser($following[$i]['id']);
				for($j=0; $followingNews!=false && $j<sizeof($followingNews); $j++){
					$data[$c] = $followingNews[$j];
					$c++;
				} 
			}
			if(isset($data)){
				return $data;
			}
			else{
				return false;
			}
		}
		function getNewsFeedFromUser($userId){
			$newsFeed = $this->db->where(array('user_id'=>$userId))->get('news_feed')->result();
			$c = 0;
			for($i=0; sizeof($newsFeed)>0 && $i<sizeof($newsFeed) ;$i++){
				$item = $newsFeed[$i]; 
				switch($item->news_type_id){
					case 0: //created goal
						$goal = $this->getGoal($item->object_id);
						if($goal['statusId']!=0&&$goal['isPublic']!=0){
							$user = $this->getUser($item->user_id);
							$data[$c]['id'] = $item->news_feed_id;
							$data[$c]['type'] = 0;
							$date = timespan(strtotime($item->created_date), now()) . ' ago';
							$date = explode(',', $date)[0];
							$data[$c]['date'] = $date.' ago';
							$data[$c]['userName'] = $user['firstName'].' '.$user['lastName'];
							$data[$c]['userId'] = $user['id'];
							$data[$c]['userPicture'] = $user['picture'];
							$data[$c]['goalId'] = $goal['id'];
							$data[$c]['goalTitle'] = $goal['title'];
							$data[$c]['goalStatus'] = $this->getStatusName($goal['statusId']);
							$data[$c]['goalDescription'] = $goal['description'];
							$data[$c]['goalDeadline'] = $goal['finishingDate'];
							$category = $this->getCategory($goal['goalTypeId']);
							$data[$c]['categoryName'] = $category['name'];
							$data[$c]['categoryPicture'] = $category['picture'];
							$c++;
						}
					break;
					case 1: //created milestone
						$milestone = $this->getMilestone($item->object_id);
						if($milestone['statusId']!=0){
							$goal = $this->getGoal($milestone['goalId']);
							$user = $this->getUser($item->user_id);
							if($goal['statusId']!=0&&$goal['isPublic']!=0){
								$data[$c]['id'] = $item->news_feed_id;
								$data[$c]['type'] = 1;
								$date = timespan(strtotime($item->created_date), now()) . ' ago';
								$date = explode(',', $date)[0];
								$data[$c]['date'] = $date.' ago';
								$data[$c]['userName'] = $user['firstName'].' '.$user['lastName'];
								$data[$c]['userId'] = $user['id'];
								$data[$c]['userPicture'] = $user['picture'];
								$data[$c]['goalId'] = $goal['id'];
								$data[$c]['goalTitle'] = $goal['title'];
								$data[$c]['goalStatus'] = $this->getStatusName($goal['statusId']);
								$data[$c]['milestoneTitle'] = $milestone['title'];
								$data[$c]['milestoneStatus'] = $this->getStatusName($milestone['statusId']);
								$data[$c]['goalDeadline'] = $goal['finishingDate'];
								$category = $this->getCategory($goal['goalTypeId']);
								$data[$c]['categoryName'] = $category['name'];
								$data[$c]['categoryPicture'] = $category['picture'];
								$c++;
							}
						}
					break;
					case 2: //updated goal status
						$goal = $this->getGoal($item->object_id);
						if($goal['statusId']!=0&&$goal['isPublic']!=0){
							$user = $this->getUser($item->user_id);
							$data[$c]['id'] = $item->news_feed_id;
							$data[$c]['type'] = 2;
							$date = timespan(strtotime($item->created_date), now()) . ' ago';
							$date = explode(',', $date)[0];
							$data[$c]['date'] = $date.' ago';
							$data[$c]['userName'] = $user['firstName'].' '.$user['lastName'];
							$data[$c]['userId'] = $user['id'];
							$data[$c]['userPicture'] = $user['picture'];
							$data[$c]['goalId'] = $goal['id'];
							$data[$c]['goalTitle'] = $goal['title'];
							$data[$c]['goalStatus'] = $this->getStatusName($goal['statusId']);
							$data[$c]['goalDeadline'] = $goal['finishingDate'];
							$category = $this->getCategory($goal['goalTypeId']);
							$data[$c]['categoryName'] = $category['name'];
							$data[$c]['categoryPicture'] = $category['picture'];
							$c++;
						}
					break;
					case 3: //updated milestone status
						$milestone = $this->getMilestone($item->object_id);
						if($milestone['statusId']!=0){
							$goal = $this->getGoal($milestone['goalId']);
							$user = $this->getUser($item->user_id);
							if($goal['statusId']!=0&&$goal['isPublic']!=0){
								$data[$c]['id'] = $item->news_feed_id;
								$data[$c]['type'] = 3;
								$date = timespan(strtotime($item->created_date), now()) . ' ago';
								$date = explode(',', $date)[0];
								$data[$c]['date'] = $date.' ago';
								$data[$c]['userName'] = $user['firstName'].' '.$user['lastName'];
								$data[$c]['userId'] = $user['id'];
								$data[$c]['userPicture'] = $user['picture'];
								$data[$c]['goalId'] = $goal['id'];
								$data[$c]['goalTitle'] = $goal['title'];
								$data[$c]['goalStatus'] = $this->getStatusName($goal['statusId']);
								$data[$c]['milestoneTitle'] = $milestone['title'];
								$data[$c]['milestoneStatus'] = $this->getStatusName($milestone['statusId']);
								$data[$c]['goalDeadline'] = $goal['finishingDate'];
								$category = $this->getCategory($goal['goalTypeId']);
								$data[$c]['categoryName'] = $category['name'];
								$data[$c]['categoryPicture'] = $category['picture'];
								$c++;
							}
						}
					break;
					case 4: //added picture
						$picture = $this->getPicture($item->object_id);
						if($picture != false){
							$goal = $this->getGoal($picture['goalId']);
							$user = $this->getUser($item->user_id);
							//echo $item->news_feed_id;
							if($goal['statusId']!=0&&$goal['isPublic']!=0){
								$data[$c]['id'] = $item->news_feed_id;
								$data[$c]['type'] = 4;
								$date = timespan(strtotime($item->created_date), now()) . ' ago';
								$date = explode(',', $date)[0];
								$data[$c]['date'] = $date.' ago';
								$data[$c]['userName'] = $user['firstName'].' '.$user['lastName'];
								$data[$c]['userId'] = $user['id'];
								$data[$c]['userPicture'] = $user['picture'];
								$data[$c]['goalId'] = $goal['id'];
								$data[$c]['goalTitle'] = $goal['title'];
								$data[$c]['goalStatus'] = $this->getStatusName($goal['statusId']);
								$data[$c]['goalDeadline'] = $goal['finishingDate'];
								$data[$c]['pictureName'] = $picture['name'];
								$data[$c]['pictureId'] = $picture['id'];
								$data[$c]['pictureCaption'] = $picture['caption'];
								$category = $this->getCategory($goal['goalTypeId']);
								$data[$c]['categoryName'] = $category['name'];
								$data[$c]['categoryPicture'] = $category['picture'];
								$c++;
							}
						}
					break;
					case 5: //user started following
						$following = $this->getUser($item->object_id);
						$user = $this->getUser($item->user_id);
						$data[$c]['id'] = $item->news_feed_id;
						$data[$c]['type'] = 5;
						$date = timespan(strtotime($item->created_date), now()) . ' ago';
						$date = explode(',', $date)[0];
						$data[$c]['date'] = $date.' ago';
						$data[$c]['userName'] = $user['firstName'].' '.$user['lastName'];
						$data[$c]['userId'] = $user['id'];
						$data[$c]['userPicture'] = $user['picture'];
						$data[$c]['followingName'] = $following['firstName'].' '.$following['middleName'].' '.$following['lastName'];
						$data[$c]['followingPicture'] = $following['picture'];
						$data[$c]['followingId'] = $following['id'];
						$c++;
					break;
				}
			}
			if(sizeof($newsFeed)>0)
				return $data;
			else
				return false;
		}
		function getNewsFeedByCategory($userId,$categoryId){
			//Created goal
			$this->db->select('nf.news_feed_id as news_feed_id, 
							   nf.news_type_id as news_type_id, 
							   nf.created_date as created_date, 
							   nf.object_id as object_id, 
							   nf.user_id as user_id');
	        $this->db->from('news_feed AS nf');
	        $this->db->join('users','nf.user_id=users.user_id');
	        $this->db->join('goals','nf.object_id=goals.goal_id');
	        $newsFeed = $this->db->where(array('nf.news_type_id'=>0, 'goals.goal_type_id'=>$categoryId,'goals.is_public'=>1, 'goals.status_id !='=>0, 'users.user_id !='=>$userId))->get()->result();
	        for($i=0; sizeof($newsFeed)>0 && $i<sizeof($newsFeed) ;$i++){
	        	$item = $newsFeed[$i];
	        	$goal = $this->getGoal($item->object_id);
				$user = $this->getUser($item->user_id);
				$data[$i]['id'] = $item->news_feed_id;
				$data[$i]['type'] = $item->news_type_id;
				$date = timespan(strtotime($item->created_date), now()) . ' ago';
				$date = explode(',', $date)[0];
				$data[$i]['date'] = $date.' ago';
				$data[$i]['userName'] = $user['firstName'].' '.$user['lastName'];
				$data[$i]['userId'] = $user['id'];
				$data[$i]['userPicture'] = $user['picture'];
				$data[$i]['goalId'] = $goal['id'];
				$data[$i]['goalTitle'] = $goal['title'];
				$data[$i]['goalStatus'] = $this->getStatusName($goal['statusId']);
				$data[$i]['goalDescription'] = $goal['description'];
				$data[$i]['goalDeadline'] = $goal['finishingDate'];
				$category = $this->getCategory($goal['goalTypeId']);
				$data[$i]['categoryName'] = $category['name'];
				$data[$i]['categoryPicture'] = $category['picture'];
	        }
	        //Created milestone
			$this->db->select('nf.news_feed_id as news_feed_id, 
							   nf.news_type_id as news_type_id, 
							   nf.created_date as created_date, 
							   nf.object_id as object_id, 
							   nf.user_id as user_id');
	        $this->db->from('news_feed AS nf');
	        $this->db->join('users','nf.user_id=users.user_id');
	        $this->db->join('milestones','nf.object_id=milestones.milestone_id');
	        $this->db->join('goals','nf.object_id=milestones.goal_id');
	        $newsFeed = $this->db->where(array('nf.news_type_id'=>1, 'goals.goal_type_id'=>$categoryId, 'goals.is_public'=>1,'goals.status_id !='=>0, 'milestones.status_id !='=>0, 'users.user_id !='=>$userId))->get()->result();
	        for($i=0; sizeof($newsFeed)>0 && $i<sizeof($newsFeed) ;$i++){
	        	$item = $newsFeed[$i];
				$milestone = $this->getMilestone($item->object_id);
				$goal = $this->getGoal($milestone['goalId']);
				$user = $this->getUser($item->user_id);
				$data[$i]['id'] = $item->news_feed_id;
				$data[$i]['type'] = $item->news_type_id;
				$date = timespan(strtotime($item->created_date), now()) . ' ago';
				$date = explode(',', $date)[0];
				$data[$i]['date'] = $date.' ago';
				$data[$i]['userName'] = $user['firstName'].' '.$user['lastName'];
				$data[$i]['userPicture'] = $user['picture'];
				$data[$i]['userId'] = $user['id'];
				$data[$i]['goalId'] = $goal['id'];
				$data[$i]['goalTitle'] = $goal['title'];
				$data[$i]['goalStatus'] = $this->getStatusName($goal['statusId']);
				$data[$i]['milestoneTitle'] = $milestone['title'];
				$data[$i]['goalDeadline'] = $goal['finishingDate'];
				$category = $this->getCategory($goal['goalTypeId']);
				$data[$i]['categoryName'] = $category['name'];
				$data[$i]['categoryPicture'] = $category['picture'];
	        }
	        //Updated goal status
	        $this->db->select('nf.news_feed_id as news_feed_id, 
							   nf.news_type_id as news_type_id, 
							   nf.created_date as created_date, 
							   nf.object_id as object_id, 
							   nf.user_id as user_id');
	        $this->db->from('news_feed AS nf');
	        $this->db->join('users','nf.user_id=users.user_id');
	        $this->db->join('goals','nf.object_id=goals.goal_id');
	        $newsFeed = $this->db->where(array('nf.news_type_id'=>2, 'goals.goal_type_id'=>$categoryId,'goals.status_id !='=>0,  'goals.is_public'=>1,'users.user_id !='=>$userId))->get()->result();
	        for($i=0; sizeof($newsFeed)>0 && $i<sizeof($newsFeed) ;$i++){
	        	$item = $newsFeed[$i];
	        	$goal = $this->getGoal($item->object_id);
				$user = $this->getUser($item->user_id);
				$data[$i]['id'] = $item->news_feed_id;
				$data[$i]['type'] = $item->news_type_id;
				$date = timespan(strtotime($item->created_date), now()) . ' ago';
				$date = explode(',', $date)[0];
				$data[$i]['date'] = $date.' ago';
				$data[$i]['userName'] = $user['firstName'].' '.$user['lastName'];
				$data[$i]['userId'] = $user['id'];
				$data[$i]['userPicture'] = $user['picture'];
				$data[$i]['goalId'] = $goal['id'];
				$data[$i]['goalTitle'] = $goal['title'];
				$data[$i]['goalStatus'] = $this->getStatusName($goal['statusId']);
				$data[$i]['goalDescription'] = $goal['description'];
				$data[$i]['goalDeadline'] = $goal['finishingDate'];
				$category = $this->getCategory($goal['goalTypeId']);
				$data[$i]['categoryName'] = $category['name'];
				$data[$i]['categoryPicture'] = $category['picture'];
	        }
	        //Updated milestone status
	        $this->db->select('nf.news_feed_id as news_feed_id, 
							   nf.news_type_id as news_type_id, 
							   nf.created_date as created_date, 
							   nf.object_id as object_id, 
							   nf.user_id as user_id');
	        $this->db->from('news_feed AS nf');
	        $this->db->join('users','nf.user_id=users.user_id');
	        $this->db->join('milestones','nf.object_id=milestones.milestone_id');
	        $this->db->join('goals','nf.object_id=milestones.goal_id');
	        $newsFeed = $this->db->where(array('nf.news_type_id'=>3, 'goals.goal_type_id'=>$categoryId,  'goals.is_public'=>1,'goals.status_id !='=>0, 'milestones.status_id !='=>0, 'users.user_id !='=>$userId))->get()->result();
	        for($i=0; sizeof($newsFeed)>0 && $i<sizeof($newsFeed) ;$i++){
				$item = $newsFeed[$i];
				$milestone = $this->getMilestone($item->object_id);
				$goal = $this->getGoal($milestone['goalId']);
				$user = $this->getUser($item->user_id);
				$data[$i]['id'] = $item->news_feed_id;
				$data[$i]['type'] = $item->news_type_id;
				$date = timespan(strtotime($item->created_date), now()) . ' ago';
				$date = explode(',', $date)[0];
				$data[$i]['date'] = $date.' ago';
				$data[$i]['userName'] = $user['firstName'].' '.$user['lastName'];
				$data[$i]['userId'] = $user['id'];
				$data[$i]['userPicture'] = $user['picture'];
				$data[$i]['goalId'] = $goal['id'];
				$data[$i]['goalTitle'] = $goal['title'];
				$data[$i]['goalStatus'] = $this->getStatusName($goal['statusId']);
				$data[$i]['milestoneTitle'] = $milestone['title'];
				$data[$i]['milestoneStatus'] = $this->getStatusName($milestone['statusId']);
				$data[$i]['goalDeadline'] = $goal['finishingDate'];
				$category = $this->getCategory($goal['goalTypeId']);
				$data[$i]['categoryName'] = $category['name'];
				$data[$i]['categoryPicture'] = $category['picture'];
	        }
	        //Added picture
	        $this->db->select('nf.news_feed_id as news_feed_id, 
							   nf.news_type_id as news_type_id, 
							   nf.created_date as created_date, 
							   nf.object_id as object_id, 
							   nf.user_id as user_id');
	        $this->db->from('news_feed AS nf');
	        $this->db->join('users','nf.user_id=users.user_id');
	        $this->db->join('goals_pictures','nf.object_id=goals_pictures.picture_id');
	        $this->db->join('goals','goals_pictures.goal_id=goals.goal_id','left');
	        $newsFeed = $this->db->where(array('nf.news_type_id'=>4, 'goals.goal_type_id'=>$categoryId, 'goals.is_public'=>1,'goals.status_id !='=>0, 'users.user_id !='=>$userId))->get()->result();
	        for($i=0; sizeof($newsFeed)>0 && $i<sizeof($newsFeed) ;$i++){
	        	$item = $newsFeed[$i];
	        	$picture = $this->getPicture($item->object_id);
				$goal = $this->getGoal($picture['goalId']);
				$user = $this->getUser($item->user_id);
				$data[$i]['id'] = $item->news_feed_id;
				$data[$i]['type'] = $item->news_type_id;
				$date = timespan(strtotime($item->created_date), now()) . ' ago';
				$date = explode(',', $date)[0];
				$data[$i]['date'] = $date.' ago';
				$data[$i]['userName'] = $user['firstName'].' '.$user['lastName'];
				$data[$i]['userId'] = $user['id'];
				$data[$i]['userPicture'] = $user['picture'];
				$data[$i]['goalId'] = $goal['id'];
				$data[$i]['goalTitle'] = $goal['title'];
				$data[$i]['goalStatus'] = $this->getStatusName($goal['statusId']);
				$data[$i]['goalDeadline'] = $goal['finishingDate'];
				$data[$i]['pictureName'] = $picture['name'];
				$data[$i]['pictureId'] = $picture['id'];
				$data[$i]['pictureCaption'] = $picture['caption'];
				$category = $this->getCategory($goal['goalTypeId']);
				$data[$i]['categoryName'] = $category['name'];
				$data[$i]['categoryPicture'] = $category['picture'];
	        }
			
			if(isset($data)>0)
				return $data;
			else
				return false;
		}
		function addNewsFeed($data){
			$this->db->insert('news_feed',$data);
			return true;
		}	
		
		function search($keyword){
			$searchResults = $this->db->query("SELECT * FROM users WHERE concat(first_name,middle_name,last_name) LIKE '%".$keyword."%';")->result_array();;
            for($i=0; isset($searchResults) && $i<sizeof($searchResults) ;$i++){
                $users[$i]['id']= $searchResults[$i]['user_id'];
                $users[$i]['name']= $searchResults[$i]['first_name'].' '.$searchResults[$i]['middle_name'].' '.$searchResults[$i]['last_name'];
                $users[$i]['completedGoals']= $this->getCompletedGoals($searchResults[$i]['user_id']);
                $users[$i]['picture']= $searchResults[$i]['picture'];
            }
            if(sizeof($searchResults)>0)
            	return $users;
			else
				return false;
		}		
		
	}
?>