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
				else{
					$userData['picture'] = $this->uploadUserPicture($userData['picture']);
				}
				
				if($userData['picture'] != false){
					$id = $this->db->select_max('user_id')->get('users')->row()->user_id;
					$id++;
					$userData['user_id'] = $id;
	            	$userData['password'] = sha1($userData['password']);
	            	if($this->db->insert('users',$userData)){
	                	if($this->logIn($userData['email'],$userData['password'])){
	                		return true;
	                	}
	                	else
	                		return "Your account was created successfully but you couldn't be logged in at the moment. Please try again later.";
                	}
                	else
                		return "Your signup process couldn't be accomplished, please try again later.";
            	}
            	else
            		return "Your picture couldn't be uploaded, please try again at another time.";
            }
            else
            	return 'That email account is already in use. Please try another one or log into that account.';
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
				$this->setUser($data);
				return true;
			}
			else{
				return "Wrong Email or Password, please try again.";
			}
		}

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

		function getFollowing() {
			$this->db->select('users.user_id as id,users.first_name as firstName,users.last_name as lastName, users.middle_name as middleName, users.picture as picture');
            $this->db->from('following');
            $this->db->join('users','users.user_id=following.user_following_id');
            $usersResults = $this->db->where(array('following.user_id'=>$_SESSION['user']['id']))->get()->result();
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
		
		function isFollowing($user_id){
			if(sizeof($this->db->where(array('user_id'=>$_SESSION['user']['id'],'user_following_id'=>$user_id))->get('following')->result())>0)
				return true;
			return false;
		}

		function startFollowing($userId){
			$this->db->insert('following',array('user_id'=>$_SESSION['user']['id'],'user_following_id'=>$userId));
			return true;
		}

		function stopFollowing($userId){
			$this->db->where(array('user_id'=>$_SESSION['user']['id'],'user_following_id'=>$userId))->delete('following');
		}

		function getCompletedGoals($userId){
			return sizeof($this->db->where(array('user_id'=>$userId,'status_id'=>3))->get('goals')->result());
		}
		
		function getPendingGoals($userId){
			return sizeof($this->db->where(array('user_id'=>$userId,'status_id'=>2))->get('goals')->result());
		}

		function uploadUserPicture($file){
			$id = $this->db->select_max('user_id')->get('users')->row()->user_id;
			$id++;

			$dir="./images/users/";            
			$type = explode('/',$file['type']);
			$type = $type[1];
			if($type == 'jpeg')
				$type = 'jpg';
			$name = $id.'.'.$type;
			$config['upload_path']=$dir;
			$config['allowed_types']='jpg|png';
			$config['file_name']=$name;
			$this->load->library('upload',$config);
            $this->upload->initialize($config);
			if(!$this->upload->do_upload('picture')){
				echo $this->upload->display_errors();
				return false;
			}
			else{
				list($width, $height) = getimagesize($dir.''.$name);
				$config['source_image']=$dir.''.$name;
				$config['maintain_ratio']=FALSE;
				if($width>$height){
    				$config['width'] = $height;
    				$config['height'] = $height;
    				$config['x_axis'] = (($width / 2) - ($config['width'] / 2));
				}
				else{
					$config['height'] = $width;
    				$config['width'] = $width;
   					$config['y_axis'] = (($height / 2) - ($config['height'] / 2));
				}

				$this->load->library('image_lib',$config);
				$this->image_lib->initialize($config);
				$this->image_lib->crop();

				$config['source_image']=$dir.''.$name;
				$config['maintain_ratio']=TRUE;
				$config['width'] = 300;
				$config['height'] = 300;
				$config['master_dim']='width';
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				/*$config['x_axis']=0;
				$config['y_axis']=0;
				$config['maintain_ratio']=FALSE;*/
				                
                
                return $name;                                
			}
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
			$goals = $this->db->where(array('user_id'=>$userId))->get('goals')->result();
			for($i=0; sizeof($goals)>0 && $i<sizeof($goals) ;$i++){
				$data[$i]['id']=$goals[$i]->goal_id;
				$data[$i]['title']=$goals[$i]->title;
				$data[$i]['description']=$goals[$i]->description;
				$data[$i]['userId']=$goals[$i]->user_id;
				$data[$i]['goalTypeId']=$goals[$i]->goal_type_id;
				$data[$i]['statusId']=$goals[$i]->status_id;
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
			if(isset($goal->goal_id)){
				$data['id']=$goal->goal_id;
				$data['title']=$goal->title;
				$data['description']=$goal->description;
				$data['userId']=$goal->user_id;
				$data['goalTypeId']=$goal->goal_type_id;
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
				$data['completedDate']=$milestone->completedDate;
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
				$data['name']=$picture->picture_name;
				$data['caption']=$picture->picture_caption;
				return $data;
			}
			else{
				return false;
			}
		}

		function getMilestones($goalId){
			$milestones = $this->db->where(array('goal_id'=>$goalId))->get('milestones')->result();
			for($i=0; sizeof($milestones)>0 && $i<sizeof($milestones) ;$i++){
				$data[$i]['id']=$milestones[$i]->milestone_id;
				$data[$i]['goalId']=$milestones[$i]->goal_id;
				$data[$i]['title']=$milestones[$i]->title;
				$data[$i]['statusId']=$milestones[$i]->status_id;
				$data[$i]['completedDate']=$milestones[$i]->completedDate;
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

		function getStatusName($status){
			return $this->db->where(array('status_id'=>$status))->get('status')->row()->name;
		}

		//ADD, UPDATE, DELETE GOAL

		function addGoal($data){
			if($this->db->insert('goals',$data)) {
				$newGoalId = $this->db->insert_id();
				$newsFeed['news_type_id'] = 0;
				$newsFeed['user_id'] = $_SESSION['user']['id'];
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

		function updateGoal($data, $goalId){
			$oldGoal = $this->getGoal($goalId);
			if($this->db->where(array('goal_id'=>$goalId))->update('goals',$data)){
				if($data['status_id'] != $oldGoal['statusId']){
					$newsFeed['news_type_id'] = 2;
					$newsFeed['user_id'] = $_SESSION['user']['id'];
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

		function addMilestone($data){
			if($this->db->insert('milestones',$data)) {
				$newMilestoneId = $this->db->insert_id();
				$newsFeed['news_type_id'] = 1;
				$newsFeed['user_id'] = $_SESSION['user']['id'];
				$newsFeed['object_id'] = $newMilestoneId;
				$this->load->helper('date');
				$newsFeed['created_date'] = mdate("%Y-%m-%d",time());
				$this->addNewsFeed($newsFeed);
				return $newMilestoneId;
			}
			else
				return false;
		}

		function updateMilestone($data, $milestoneId){			
			$oldMilestone = $this->getMilestone($milestoneId);
			if($this->db->where(array('milestone_id'=>$milestoneId))->update('milestones',$data)) {
				if($data['status_id'] != $oldMilestone['statusId']){
					$newsFeed['news_type_id'] = 3;
					$newsFeed['user_id'] = $_SESSION['user']['id'];
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

		function addGoalPicture($data){
			$data['name'] = $this->uploadGoalPicture($data['name'],$data['goal_id']);
			if($this->db->insert('goals_pictures',$data)) {
				$newPictureId = $this->db->insert_id();
				$newsFeed['news_type_id'] = 4;
				$newsFeed['user_id'] = $_SESSION['user']['id'];
				$newsFeed['object_id'] = $newPictureId;
				$this->load->helper('date');
				$newsFeed['created_date'] = mdate("%Y-%m-%d",time());
				$this->addNewsFeed($newsFeed);
				return $newGoalId;
			}
			else
				return false;
		}

		function updateGoalPicture($data, $pictureId){
			$this->db->where(array('picture_id'=>$pictureId))->update('goals_pictures',$data);
			return true;
			//Add to news feed if status was updated
		}

		function deleteGoalPicture($pictureId){
			//baja logica
			return true;
		}

		function uploadGoalPicture($picture, $goalId){
			$subId = sizeof($this->db->where(array('goal_id'=>$goalId))->get('goals_pictures')->result());
			$dir="./images/goals/";            
			$type = explode('/',$file['type']);
			$type = $type[1];
			if($type == 'jpeg')
				$type = 'jpg';
			$name = $goalId.'_'.$subId.'.'.$type;
			$config['upload_path']=$dir;
			$config['allowed_types']='jpg|png';
			$config['file_name']=$name;
			$this->load->library('upload',$config);
            $this->upload->initialize($config);
			if(!$this->upload->do_upload('picture')){
				echo $this->upload->display_errors();
				return false;
			}
			else{
				list($width, $height) = getimagesize($dir.''.$name);
				$config['source_image']=$dir.''.$name;
				$config['maintain_ratio']=TRUE;
				$config['width'] = 640;
				$config['height'] = 480;
				$this->image_lib->clear();
				$this->load->library('upload',$config);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
                return $name;                                
			}
		}

		//NEWS FEED

		function getNewsFeedFollowing(){
			$following = $this->getFollowing();
			$c = 0;
			for($i=0; sizeof($following)>0 && $i<sizeof($following); $i++){
				$followingNews = $this->getNewsFeedFromUser($following[$i]['id']);
				for($j=0; sizeof($followingNews)>0 && $j<sizeof($followingNews); $j++){
					$data[$c] = $followingNews[$j];
					$c++;
				} 
			}
			if(sizeof($data)>0){
				return $data;
			}
			else{
				return false;
			}
		}


		function getNewsFeedFromUser($userId){
			$newsFeed = $this->db->where(array('user_id'=>$userId))->get('news_feed')->result();
			for($i=0; sizeof($newsFeed)>0 && $i<sizeof($newsFeed) ;$i++){
				$item = $newsFeed[$i]; 
				switch($item->news_type_id){
					case 0: //created goal
						$goal = $this->getGoal($item->object_id);
						$user = $this->getUser($item->user_id);
						$data[$i]['id'] = $item->news_feed_id;
						$data[$i]['type'] = 0;
						$data[$i]['date'] = $item->creation_date;
						$data[$i]['userName'] = $user['name'];
						$data[$i]['userId'] = $user['id'];
						$data[$i]['goalId'] = $goal['id'];
						$data[$i]['goalTitle'] = $goal['title'];
						$data[$i]['goalStatus'] = $this->getStatusName($goal['status']);
						$data[$i]['goalDescription'] = $goal['description'];
						$data[$i]['goalDeadline'] = $goal['deadline'];
					break;

					case 1: //created milestone
						$milestone = $this->getMilestone($item->object_id);
						$goal = $this->getGoal($milestone['goal_id']);
						$user = $this->getUser($item->user_id);
						$data[$i]['id'] = $item->news_feed_id;
						$data[$i]['type'] = 1;
						$data[$i]['date'] = $item->creation_date;
						$data[$i]['userName'] = $user['name'];
						$data[$i]['userId'] = $user['id'];
						$data[$i]['goalId'] = $goal['id'];
						$data[$i]['goalTitle'] = $goal['title'];
						$data[$i]['goalStatus'] = $this->getStatusName($goal['status']);
						$data[$i]['milestoneTitle'] = $milestone['title'];
						$data[$i]['milestoneStatus'] = $this->getStatusName($milestone['status']);
						$data[$i]['goalDeadline'] = $goal['deadline'];
					break;

					case 2: //updated goal status
						$goal = $this->getGoal($item->object_id);
						$user = $this->getUser($item->user_id);
						$data[$i]['id'] = $item->news_feed_id;
						$data[$i]['type'] = 2;
						$data[$i]['date'] = $item->creation_date;
						$data[$i]['userName'] = $user['name'];
						$data[$i]['userId'] = $user['id'];
						$data[$i]['goalId'] = $goal['id'];
						$data[$i]['goalTitle'] = $goal['title'];
						$data[$i]['goalStatus'] = $this->getStatusName($goal['status']);
						$data[$i]['goalDeadline'] = $goal['deadline'];
					break;

					case 3: //updated milestone status
						$milestone = $this->getMilestone($item->object_id);
						$goal = $this->getGoal($milestone['goal_id']);
						$user = $this->getUser($item->user_id);
						$data[$i]['id'] = $item->news_feed_id;
						$data[$i]['type'] = 3;
						$data[$i]['date'] = $item->creation_date;
						$data[$i]['userName'] = $user['name'];
						$data[$i]['userId'] = $user['id'];
						$data[$i]['goalId'] = $goal['id'];
						$data[$i]['goalTitle'] = $goal['title'];
						$data[$i]['goalStatus'] = $this->getStatusName($goal['status']);
						$data[$i]['milestoneTitle'] = $milestone['title'];
						$data[$i]['milestoneStatus'] = $this->getStatusName($milestone['status']);
						$data[$i]['goalDeadline'] = $goal['deadline'];
					break;

					case 4: //added picture
						$picture = $this->getPicture($item->object_id);
						$goal = $this->getGoal($picture['goalId']);
						$user = $this->getUser($item->user_id);
						$data[$i]['id'] = $item->news_feed_id;
						$data[$i]['type'] = 4;
						$data[$i]['date'] = $item->creation_date;
						$data[$i]['userName'] = $user['name'];
						$data[$i]['userId'] = $user['id'];
						$data[$i]['goalId'] = $goal['id'];
						$data[$i]['goalTitle'] = $goal['title'];
						$data[$i]['goalStatus'] = $this->getStatusName($goal['status']);
						$data[$i]['goalDeadline'] = $goal['deadline'];
						$data[$i]['pictureName'] = $picture['name'];
						$data[$i]['pictureId'] = $picture['id'];
						$data[$i]['pictureCaption'] = $picture['caption'];
					break;

					case 5: //user started following
						$following = $this->getUser($item->object_id);
						$user = $this->getUser($item->user_id);
						$data[$i]['id'] = $item->news_feed_id;
						$data[$i]['type'] = 5;
						$data[$i]['date'] = $item->creation_date;
						$data[$i]['userName'] = $user['name'];
						$data[$i]['userId'] = $user['id'];
						$data[$i]['followingName'] = $following['firstName'].' '.$following['lastName'];
						$data[$i]['followingId'] = $following['id'];
					break;
				}
			}

			if(sizeof($newsFeed)>0)
				return $data;
			else
				return false;
		}

		function getNewsFeedByCategory($category){

			//Created goal
			$this->db->select('nf.news_feed_id as news_feed_id, 
							   nf.news_type_id as news_type_id, 
							   nf.creation_date as creation_date, 
							   nf.object_id as object_id, 
							   nf.user_id as user_id');
	        $this->db->from('news_feed AS nf');
	        $this->db->join('users','nf.user_id=users.user_id');
	        $this->db->join('goals','nf.object_id=goals.goal_id');
	        $newsFeed = $this->db->where(array('nf.news_type_id'=>0, 'goals.goal_type_id'=>$category))->get()->result();
	        for($i=0; sizeof($newsFeed)>0 && $i<sizeof($newsFeed) ;$i++){
	        	$item = $newsFeed[$i];
	        	$goal = $this->getGoal($item->object_id);
				$user = $this->getUser($item->user_id);
				$data[$i]['id'] = $item->news_feed_id;
				$data[$i]['type'] = $item->news_type_id;
				$data[$i]['date'] = $item->creation_date;
				$data[$i]['userName'] = $user['name'];
				$data[$i]['userId'] = $user['id'];
				$data[$i]['goalId'] = $goal['id'];
				$data[$i]['goalTitle'] = $goal['title'];
				$data[$i]['goalStatus'] = $this->getStatusName($goal['status']);
				$data[$i]['goalDescription'] = $goal['description'];
				$data[$i]['goalDeadline'] = $goal['deadline'];
	        }

	        //Created milestone
			$this->db->select('nf.news_feed_id as news_feed_id, 
							   nf.news_type_id as news_type_id, 
							   nf.creation_date as creation_date, 
							   nf.object_id as object_id, 
							   nf.user_id as user_id');
	        $this->db->from('news_feed AS nf');
	        $this->db->join('users','nf.user_id=users.user_id');
	        $this->db->join('milestones','nf.object_id=milestones.milestone_id');
	        $this->db->join('goals','nf.object_id=milestones.goal_id');
	        $newsFeed = $this->db->where(array('nf.news_type_id'=>1, 'goals.goal_type_id'=>$category))->get()->result();
	        for($i=0; sizeof($newsFeed)>0 && $i<sizeof($newsFeed) ;$i++){
	        	$milestone = $this->getMilestone($item->object_id);
				$goal = $this->getGoal($milestone['goal_id']);
				$user = $this->getUser($item->user_id);
				$data[$i]['id'] = $item->news_feed_id;
				$data[$i]['type'] = $item->news_type_id;
				$data[$i]['date'] = $item->creation_date;
				$data[$i]['userName'] = $user['name'];
				$data[$i]['userId'] = $user['id'];
				$data[$i]['goalId'] = $goal['id'];
				$data[$i]['goalTitle'] = $goal['title'];
				$$data[$i]['goalStatus'] = $this->getStatusName($goal['status']);
				$data[$i]['milestoneTitle'] = $milestone['title'];
				$data[$i]['goalDeadline'] = $goal['deadline'];
	        }

	        //Updated goal status
	        $this->db->select('nf.news_feed_id as news_feed_id, 
							   nf.news_type_id as news_type_id, 
							   nf.creation_date as creation_date, 
							   nf.object_id as object_id, 
							   nf.user_id as user_id');
	        $this->db->from('news_feed AS nf');
	        $this->db->join('users','nf.user_id=u.user_id');
	        $this->db->join('goals','nf.object_id=g.goal_id');
	        $newsFeed = $this->db->where(array('nf.news_type_id'=>2, 'goals.goal_type_id'=>$category))->get()->result();
	        for($i=0; sizeof($newsFeed)>0 && $i<sizeof($newsFeed) ;$i++){
	        	$item = $newsFeed[$i];
	        	$goal = $this->getGoal($item->object_id);
				$user = $this->getUser($item->user_id);
				$data[$i]['id'] = $item->news_feed_id;
				$data[$i]['type'] = $item->news_type_id;
				$data[$i]['date'] = $item->creation_date;
				$data[$i]['userName'] = $user['name'];
				$data[$i]['userId'] = $user['id'];
				$data[$i]['goalId'] = $goal['id'];
				$data[$i]['goalTitle'] = $goal['title'];
				$data[$i]['goalStatus'] = $this->getStatusName($goal['status']);
				$data[$i]['goalDescription'] = $goal['description'];
				$data[$i]['goalDeadline'] = $goal['deadline'];
	        }

	        //Updated milestone status
	        $this->db->select('nf.news_feed_id as news_feed_id, 
							   nf.news_type_id as news_type_id, 
							   nf.creation_date as creation_date, 
							   nf.object_id as object_id, 
							   nf.user_id as user_id');
	        $this->db->from('news_feed AS nf');
	        $this->db->join('users','nf.user_id=users.user_id');
	        $this->db->join('milestones','nf.object_id=milestones.milestone_id');
	        $this->db->join('goals','nf.object_id=milestones.goal_id');
	        $newsFeed = $this->db->where(array('nf.news_type_id'=>3, 'goals.goal_type_id'=>$category))->get()->result();
	        for($i=0; sizeof($newsFeed)>0 && $i<sizeof($newsFeed) ;$i++){
	        	$milestone = $this->getMilestone($item->object_id);
				$goal = $this->getGoal($milestone['goal_id']);
				$user = $this->getUser($item->user_id);
				$data[$i]['id'] = $item->news_feed_id;
				$data[$i]['type'] = $item->news_type_id;
				$data[$i]['date'] = $item->creation_date;
				$data[$i]['userName'] = $user['name'];
				$data[$i]['userId'] = $user['id'];
				$data[$i]['goalId'] = $goal['id'];
				$data[$i]['goalTitle'] = $goal['title'];
				$data[$i]['goalStatus'] = $this->getStatusName($goal['status']);
				$data[$i]['milestoneTitle'] = $milestone['title'];
				$data[$i]['milestoneStatus'] = $this->getStatusName($milestone['status']);
				$data[$i]['goalDeadline'] = $goal['deadline'];
	        }

	        //Added picture
	        $this->db->select('nf.news_feed_id as news_feed_id, 
							   nf.news_type_id as news_type_id, 
							   nf.creation_date as creation_date, 
							   nf.object_id as object_id, 
							   nf.user_id as user_id');
	        $this->db->from('news_feed AS nf');
	        $this->db->join('users','nf.user_id=u.user_id');
	        $this->db->join('goals_pictures','nf.object_id=goals_pictures.picture_id');
	        $this->db->join('goals','goals_pictures.goal_id=goals.goal_id');
	        $newsFeed = $this->db->where(array('nf.news_type_id'=>4, 'goals.goal_type_id'=>$category))->get()->result();
	        for($i=0; sizeof($newsFeed)>0 && $i<sizeof($newsFeed) ;$i++){
	        	$item = $newsFeed[$i];
	        	$picture = $this->getPicture($item->object_id);
				$goal = $this->getGoal($picture['goalId']);
				$user = $this->getUser($item->user_id);
				$data[$i]['id'] = $item->news_feed_id;
				$data[$i]['type'] = $item->news_type_id;
				$data[$i]['date'] = $item->creation_date;
				$data[$i]['userName'] = $user['name'];
				$data[$i]['userId'] = $user['id'];
				$data[$i]['goalId'] = $goal['id'];
				$data[$i]['goalTitle'] = $goal['title'];
				$data[$i]['goalStatus'] = $this->getStatusName($goal['status']);
				$data[$i]['goalDeadline'] = $goal['deadline'];
				$data[$i]['pictureName'] = $picture['name'];
				$data[$i]['pictureId'] = $picture['id'];
				$data[$i]['pictureCaption'] = $picture['caption'];
	        }
			
			if(sizeof($data)>0)
				return $data;
			else
				return false;
		}

		function addNewsFeed($data){
			$this->db->insert('news_feed',$data);
			return true;
		}
	}
?>