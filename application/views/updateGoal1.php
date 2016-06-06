<div class="section no-pad-bot" id="index-banner">
	<div class="container">
		
		<div class="row">
			<h1 class="header center secondary-text col s12">Ready to Commit?</h1>
			<h5 class="header center col s12 secondary-text"> Fill your goal info and start achieving! </h5>
		</div>
			
		<div class="row">
			<div class="col s12 center">
				<nav>
					<div class="nav-wrapper accent ">
						<a href="<?php  echo base_url();?>goal<?php if(isset($goalId))  echo "/update_goal/".$goalId; ?>" class="breadcrumb  white-text "><b>Details</b></a>
						<a href="<?php  echo base_url();?>goal<?php if(isset($goalId))  echo "/update_milestones/".$goalId; ?>" class="breadcrumb  grey-text text-lighten-3">Milestones</a>
						<a href="<?php  echo base_url();?>goal<?php if(isset($goalId))  echo "/update_pictures/".$goalId; ?>" class="breadcrumb  grey-text text-lighten-3">Photos</a>
					</div>
				</nav>
			</div>
		</div>
		
		<h6 class="header center col s12 secondary-text"> These are the basic information fields that you must fill to create your goal.  </h6>
      
		<div class="row">
		
			<form  id="form1" method="post" class="col s8 offset-s2 m6 offset-m3 l4 offset-l4" action="<?php echo base_url(); if(isset($goal)) echo "goal/save_goal/".$goalId ;else echo "goal/receiveDataNewGoal";?>" enctype="multipart/form-data">
				<div class="row center">
					<?php 
					if (isset($_SESSION['error-goal']))
						echo "Error: ".$_SESSION['error-goal']['error']; 
					?>
				</div>
				<div class= "row">
					<div class="input-field secondary-text col s12">
						<input name="goal_title" type="text" class="validate" value="<?php if (isset($goal)) echo $goal['title'];?>" required>
						<label for="goal_title" class ="dark-primary-text"> Goal Title</label>
					</div>
					<div class="input-field secondary-text col s12">
						<textarea name="goal_description" class="materialize-textarea"><?php if (isset($goal)) echo $goal['description'];?></textarea>
						<label for="goal_description" class= "dark-primary-text">Goal Description</label>
					</div>
		  
					<div class="input-field col s12 secondary-text" >
						<select class="icons" name="goal_type_id" required >
							<option value="" disabled <?php if (!isset($goal)) echo "selected";?>>Choose a Category</option>
							<option value="1" <?php if (isset($goal)&&$goal['goalTypeId']==1) echo "selected";?> data-icon="<?php echo base_url(); ?>images/art.png" class="left circle">Arts</option>
							<option value="2" <?php if (isset($goal)&&$goal['goalTypeId']==2) echo "selected";?> data-icon="<?php echo base_url(); ?>images/knowledge.png" class="left circle">Knowledge</option>
							<option value="3" <?php if (isset($goal)&&$goal['goalTypeId']==3) echo "selected";?> data-icon="<?php echo base_url(); ?>images/social.png" class="left circle">Social</option>
							<option value="4" <?php if (isset($goal)&&$goal['goalTypeId']==4) echo "selected";?> data-icon="<?php echo base_url(); ?>images/sport.png" class="left circle">Sports</option>
							<option value="5" <?php if (isset($goal)&&$goal['goalTypeId']==5) echo "selected";?> data-icon="<?php echo base_url(); ?>images/professional.png" class="left circle">Professional</option>
							<option value="6" <?php if (isset($goal)&&$goal['goalTypeId']==6) echo "selected";?> data-icon="<?php echo base_url(); ?>images/personal.png" class="left circle">Personal</option>
						</select>
						<label class="dark-primary-text">Goal Type</label>
					</div>
					<?php $this->load->helper('date');?>
					<div id="date-picker" class="section scrollspy secondary-text col s12">
						<label for="goal_startDate" class ="dark-primary-text">Start Date</label>
						<input name="start_date" value="<?php if(isset($goal)) echo  date("d F, Y",strtotime($goal['startDate']));else echo mdate("%d %F, %Y",time()); ?>" type="date" class="datepicker" id="goal_startDate">	
					</div>
			  
					<div id="date-picker" class="section scrollspy secondary-text col s12">
						<label for="goal_endDate" class ="dark-primary-text">Deadline</label>
						<input name="finishing_date" value="<?php if(isset($goal)) echo  date("d F, Y",strtotime($goal['finishingDate']));else echo mdate("%d %F, %Y",time()); ?>" type="date" class="datepicker" id="goal_endDate">
					</div>
				</div>
				<div class="row center">
					<div class="col s6 ">
						<input name="is_completed" type="checkbox" id="is_completed" <?php if (isset($goal)&&$goal['statusId']==3) echo "checked"; else echo "unchecked";?> />
						<label for="is_completed">Completed</label>
					</div>
					<div class="col s6 ">
						<input name="is_public" type="checkbox" id="is_public" <?php if (isset($goal)&&$goal['isPublic']==1) echo "checked"; else echo "unchecked";?> />
						<label for="is_public">Public</label>
					</div>
				</div>
				<div class="row ">
					<div class="col s12 ">
						<div id="date-picker" class="section scrollspy secondary-text">
							<label for="goal_completed_date" class ="dark-primary-text">Completed Date</label>
							<input name="completed_date" value="<?php if(isset($goal)){ if($goal['statusId']==3) echo  date("d F, Y",strtotime($goal['completedDate']));else echo "";}else echo mdate("%d %F, %Y",time()); ?>" type="date" class="datepicker " id="goal_endDate">
						</div>
					</div>
				</div>
			</form>
				
			<div class="row">
				<button type="submit" form="form1" id="create-button" class="btn-main accent waves-effect waves-light offset-s3 offset-m3 offset-l3 col s6 m6 l6">Save Goal</button>
			</div>
			<div class="row">
				<a href="<?php  echo base_url();?>goal<?php if(isset($goalId))  echo "/update_milestones/".$goalId; ?>" form="form1" id="next-button" class="btn-main primary-dark waves-effect waves-light offset-s3 offset-m3 offset-l3 col s6 m6 l6 ">Next Step</a>
			</div>
		</div>
			
    </div>
</div>