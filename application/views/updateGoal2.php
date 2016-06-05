
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
							<a href="<?php  echo base_url();?>goal<?php if(isset($goalId))  echo "/update_goal/".$goalId; ?>" class="breadcrumb  grey-text text-lighten-3">Details</a>
							<a href="<?php  echo base_url();?>goal<?php if(isset($goalId))  echo "/update_milestones/".$goalId; ?>" class="breadcrumb  white-text "><b>Milestones</b></a>
							<a href="<?php  echo base_url();?>goal<?php if(isset($goalId))  echo "/update_pictures/".$goalId; ?>" class="breadcrumb  grey-text text-lighten-3">Photos</a>
						</div>
					</nav>
				</div>
			</div>
  
      
	  <h6 class="header center col s12 secondary-text"> Break down your goal into small, short-term steps. Each one of these brings you closer to fulfilling your objective.   </h6>

			<!--Modal Add-->
			<div id="modaladd" class="modal">
				<!---<form action="welcome_get.php" method="post">-->
				<form  id="formadd" method="post" class="col s8 offset-s2 m6 offset-m3 l4 offset-l4" action="<?php  echo base_url();?>goal/create_milestone/<?php echo $goalId; ?>" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="row">
							<div class="col s12 m8">
								<div class="input-field secondary-text col s6 m6 l6">
								<br>
									<input id="goal_title" name="milestone_title" type="text" class="validate">
									<label for="goal_title" class ="dark-primary-text">Milestone Title</label>
								</div>
							</div>

							<div class="col s12 m4">
								<p>Status:</p>
								<!--<form action="#">-->
								<div class="row">
									<div class="row col s6 center">
										<input type="checkbox" name="is_completed" id="completed_checkbox" />
										<label for="completed_checkbox">Completed</label>  <!-- --> 
									</div>
								</div>
								<!--</form>-->
							</div>
						</div>
						<div class="row ">
							<div class="col center s12 ">
								<a href="#!" class=" modal-action modal-close waves-effect waves-light btn grey" method="post">Cancel</a>
								<input type="submit" id="formadd" class=" modal-action modal-close waves-effect waves-green btn primary-dark" value="Save">				
							</div>
						</div>
					</div>					
				</form>
			  </div>
		
			  <!-- Modal Structure -->
		<?php if($milestones!=false) { for($i=0;$i<sizeof($milestones);$i++): ?>
			<div id="modal<?php echo $i; ?>" class="modal">
				<form  id="form<?php echo $i; ?>" method="post" class="col s8 offset-s2 m6 offset-m3 l4 offset-l4" action="<?php  echo base_url();?>goal/save_milestone/<?php echo $milestones[$i]['id']; ?>" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="row">
							<div class="col s12 m8">
								<div class="input-field secondary-text col s10 m10 l10">
								<br>
									<input id="goal_title" name="milestone_title2" type="text" class="validate" value="<?php if($milestones!=false) echo $milestones[$i]['title']; ?>">
									<label for="goal_title" class ="dark-primary-text">Milestone Title</label>
								</div>
							</div>

							<div class="col s12 m4">
								<p>Status:</p>
								<!--<form action="#">-->
								<div class="row">
									<div class="row col s2 center">
										<input type="checkbox" name="is_completed2" id="public_checkbox<?php echo $i; ?>" <?php if($milestones!=false) if($milestones[$i]['statusId']==3) echo 'checked';?> />
										<label for="public_checkbox<?php echo $i; ?>">Completed</label>  <!-- --> 
									</div>
								</div>
								<!--</form>-->
							</div>
						</div>

						<div class="row ">
							<div class="col center s12 ">
								<a href="<?php  echo base_url();?>goal/delete_milestone/<?php echo $milestones[$i]['id']; ?>" class=" modal-action modal-close waves-effect waves-light btn grey" method="post">Delete</a>
								<input type="submit" form="form<?php echo $i; ?>" class="modal-action modal-close waves-effect waves-green btn primary-dark" value="Save">		
							</div>
						</div>
					</div>
				</form>
			</div>
		<?php endfor; }?>
			  

				<div class="row">
					 <div class="col s10 offset-s1">
						<div class="collection">
							<a href="#modaladd" class="collection-item waves-effect waves-light modal-trigger data-target=modal1 secondary-text center">Add a New Milestone<span class="badge"></span></a>					
							
							<?php if($milestones!=false) { for($i=0;$i<sizeof($milestones);$i++): ?>
								<a href="#modal<?php echo $i;?>" class="collection-item waves-effect waves-light modal-trigger data-target=modal<?php echo $i;?>"> 
									<?php echo $milestones[$i]['title']?>  
									<span class="badge <?php if($milestones[$i]['statusId']==2) echo 'grey-text'; else echo 'accent-text'; ?>"> 
										<?php echo ucwords($this->model->getStatusName($milestones[$i]['statusId'])) ?>
									</span>
								</a>
							<?php endfor; } ?>		
						</div>
					</div>
				</div>
				
				<div class="row">
					<a href="<?php  echo base_url();?>goal<?php if(isset($goalId))  echo "/update_pictures/".$goalId; ?>" form="form1" id="next-button" class="btn-main primary-dark waves-effect waves-light offset-s3 offset-m3 offset-l3 col s6 m6 l6 ">Next Step</a>
				</div>
				<div class="row">
					<a href="<?php echo base_url(); ?>goal<?php if(isset($goalId)) echo "/view/".$_SESSION["user"]["id"]."/".$goalId; ?>" id="create-button" class="btn-main grey waves-effect waves-light offset-s3 offset-m3 offset-l3 col s6">Back to goal</a>
				</div>
	</div>
	</div>
