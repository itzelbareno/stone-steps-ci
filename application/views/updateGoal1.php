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
							<a href="goalsABC1.php" class="breadcrumb  white-text "><b>Details</b></a>
							<a href="goalsABC2.php" class="breadcrumb  grey-text text-lighten-3 ">Milestones</a>
							<a href="goalsABC3.php" class="breadcrumb  grey-text text-lighten-3">Photos</a>
						</div>
					</nav>
				</div>
			</div>
		
		<h6 class="header center col s12 secondary-text"> These are the basic information fields that you must fill to create your goal.  </h6>
      
		<div class="row">
		
			<form  action="#" class="col s8 offset-s2 m6 offset-m3 l4 offset-l4">
				<div class= "row">
					<div class="input-field secondary-text col s12">
						<input id="goal_title" type="text" class="validate">
						<label for="goal_title" class ="dark-primary-text">Goal  Title</label>
					</div>
					<div class="input-field secondary-text col s12">
						<textarea id="goal_description" class="materialize-textarea"></textarea>
						<label for="goal_description" class= "dark-primary-text">Goal Description</label>
					</div>
		  
					<div class="input-field col s12 secondary-text">
						<select class="icons">
							<option value="" disabled selected>Choose a Category</option>
							<option value="1" data-icon="<?php echo base_url(); ?>images/sports.png" class="left circle">Sports</option>
							<option value="2" data-icon="<?php echo base_url(); ?>images/knowledge.png" class="left circle">Knowledge</option>
							<option value="3" data-icon="<?php echo base_url(); ?>images/arts.png" class="left circle">Arts</option>
							<option value="4" data-icon="<?php echo base_url(); ?>images/professional.png" class="left circle">Professional</option>
							<option value="5" data-icon="<?php echo base_url(); ?>images/social.png" class="left circle">Social</option>
							<option value="6" data-icon="<?php echo base_url(); ?>images/personal.png" class="left circle">Personal</option>
						</select>
						<label>Goal Type</label>
					</div>
  
					<div id="date-picker" class="section scrollspy secondary-text col s12">
						<label for="goal_startDate" class ="dark-primary-text">Start Date</label>
						<input data-value="yyyy/mm/dd" type="date" class="datepicker" id="goal_startDate">
					</div>
			  
					<div id="date-picker" class="section scrollspy secondary-text col s12">
						<label for="goal_endDate" class ="dark-primary-text">End Date</label>
						<input data-value="yyyy/mm/dd" type="date" class="datepicker" id="goal_endDate">
					</div>
				</div>
				<div class="row col s12 center">
					<input type="checkbox" id="public_checkbox" />
					<label for="public_checkbox">Public</label>
				</div>
				
				
      
			</form>
			<div class="row">
					<a href="goalsABC2.php" id="next-button" class="btn-main primary-dark waves-effect waves-light offset-s3 offset-m3 offset-l3 col s6 m6 l6 ">Next Step</a>
				</div>
				<div class="row">
					<a href="index.php" id="create-button" class="btn-main accent waves-effect waves-light offset-s3 offset-m3 offset-l3 col s6 m6 l6 ">Save Goal</a>
				</div>
		</div>
    </div>
</div>