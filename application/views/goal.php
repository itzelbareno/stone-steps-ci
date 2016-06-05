<div class="container">
	<div class="row">
		<br>
	</div>

	<div class="row">
		<!--Info general del objetivo -->
		<div class="col s12 m4">
			<div class="container-90">
				<div class="row center-align">
					<?php 
					switch($goalInfo['goalTypeId']){
						case 1: //Arts?>
							<img class="goal-picture user" src="<?php echo base_url(); ?>images/art.png"><?php
							break;
						case 2: //Knowledge?>
							<img class="goal-picture user" src="<?php echo base_url(); ?>images/knowledge.png"><?php
							break;
						case 3: //Social?>
							<img class="goal-picture user" src="<?php echo base_url(); ?>images/social.png"><?php
							break;
						case 4: //Sport?>
							<img class="goal-picture user" src="<?php echo base_url(); ?>images/sport.png"><?php
							break;
						case 5: //Professional?>
							<img class="goal-picture user" src="<?php echo base_url(); ?>images/professional.png"><?php
							break;
						case 6: //Personal?>
							<img class="goal-picture user" src="<?php echo base_url(); ?>images/personal.png"><?php
							break;
					}?>
				</div>
				
				<div class="row center-align">
					<span class="goal-title"><?php echo $goalInfo['title']; ?></span>
				</div>
				
				<div class="row">
					<span class="goal-content"><b>Status: </b><?php echo $goalInfo['status']; ?></span>
				</div>
				
				<div class="row">
					<?php echo $goalInfo['description']; ?>
				</div>

				<div class="row">
					<span class="goal-content"><b>Start date: </b><?php echo date("d F, Y",strtotime($goalInfo['startDate'])); ?></span>
				</div>

				<div class="row">
					<span class="goal-content">
						<!-- 2 -> Pending // 3 -> Completed -->
						<?php 
						if($goalInfo['statusId'] == 2){?>
							<b>Deadline: </b><?php echo date("d F, Y",strtotime($goalInfo['finishingDate'])); 
						}
						else if($goalInfo['statusId'] == 3){?>
							<b>Finished Date: </b><?php echo date("d F, Y",strtotime($goalInfo['completedDate']));
						}
						?>
					</span>
				</div>
			
				<div class="row">
					<span class="goal-content"><b>Last update: </b><?php echo date("d F, Y",strtotime($goalInfo['lastUpdateDate'])); ?></span>
				</div>
				
				<?php 
				if(isset($listMilestones) || $_SESSION['user']['id'] == $userId ) {?> 
				<div class="row"><!-- Row mediano -->
					<div class="col s12 center"><!-- boton delete goal -->
						<?php if($_SESSION['user']['id'] == $userId ) {?>					
						<a href="<?php echo base_url(); ?>goal/delete_goal/<?php echo $goalInfo['id']; ?>" class="waves-effect waves-light btn red" method= "post">Delete Goal</a>
						<?php
						}
						?>
						<br><br>
					</div>
					
					<!-- Switch -->
					<?php
					if(!isset($listMilestones) && $_SESSION['user']['id'] == $userId){ //Perfil Propio - No Milestones?>
							<div class="collection s12 left-align">
								<a href="<?php echo base_url(); ?>goal/update_milestones/<?php echo $goalInfo['id']; ?>" class="collection-item waves-effect waves-light modal-trigger data-target=modal1">
									<div class="col s12 center"><span class="secondary-text">Add a New Milestone</span></div>
								</a>
							</div>					
					<?php
					}
					else if(isset($listMilestones) && $_SESSION['user']['id'] == $userId){ //Perfil Propio -  Milestones?>
						<div class="collection s12 left-align">
								<a href="<?php echo base_url(); ?>goal/update_milestones/<?php echo $goalInfo['id']; ?>" class="collection-item waves-effect waves-light modal-trigger data-target=modal1">
									<div class="col s12 center"><span class="secondary-text">Add a New Milestone</span></div>
								</a>
								
								<?php
								for($i=0; isset($listMilestones) && $i<sizeof($listMilestones);$i++){?>
									<a href="#modal<?php echo $i; ?>" class="collection-item waves-effect waves-light modal-trigger data-target=modal<?php echo $i; ?>">
										<div class="col s9">
											<span class="text"><?php echo $listMilestones[$i]['title']; ?></span>
										</div>
										<div class="col s3 right-align">
											<?php 
											switch($listMilestones[$i]['statusId'])
											{
												case 2:?>
													<span class="badge text">Pending</span><?php
													break;
												case 3:?>
													<span class="badge accent-text">Completed</span><?php
													break;
											}
											?>
										</div>
									</a>
								<?php
								}
								?>	
								
							</div>
					<?php
					}
					else if(isset($listMilestones) && $_SESSION['user']['id'] != $userId){ //Perfil Ajeno -  Milestones?>
						<div class="collection s12 left-align">
						<?php
							for($i=0; isset($listMilestones) && $i<sizeof($listMilestones);$i++){?>
								<a class="collection-item waves-effect waves-light">
									<div class="col s9">
										<span class="text"><?php echo $listMilestones[$i]['title']; ?></span>
									</div>
									<div class="col s3 right-align">
										<?php 
										switch($listMilestones[$i]['statusId'])
										{
											case 2:?>
												<span class="badge text">Pending</span><?php
												break;
											case 3:?>
												<span class="badge accent-text">Completed</span><?php
												break;
										}
										?>
									</div>
								</a>
							<?php
							}
							?>
						</div>
					<?php
					}
					?>
					
					
				</div> <!--Row Mediano -->
				<?php
        }
        ?>
				
			</div> <!-- <div class="container-90"> -->
		</div>

		<!--Fotos de Objetivo-->
		<div class="col s12 m8">
			<div class="container">	
				<div class="row">
					<?php for($i=0;isset($goalPictures[$i]['name'])&&$i<sizeof($goalPictures,0);$i++) {?>
						<div class="col s12 m6 l3 center ">
							<div class="row">
								<img class=" materialboxed goal-image" width="480" src="/stone-steps-ci/images/goals/<?php echo $goalPictures[$i]['name']; ?>">
							</div>
							<div class="row">
								<label class ="dark-primary-text">"<?php echo $goalPictures[$i]['caption'];?>"</label>
							</div>
							<div class="row">
							<a href="#modal<?php echo $i;?>" id="create-button" class="btn-main dark-primary waves-effect waves-light modal-trigger data-target=modal<?php echo $i;?> offset-s3 offset-m3 offset-l3 col s6 m6 l6 ">Edit Photo</a>
							</div>
						</div>
						<div class="col s0 m0 l0 center "><br></div>
					<?php } ?>
				</div>
			</div>	
		</div>

	</div><!--Row General-->
	
		<!-- Modal Structure -->
		<?php if(isset($listMilestones) && $_SESSION['user']['id'] == $userId) { 
			for($i=0;$i<sizeof($listMilestones);$i++): ?>
			<div id="modal<?php echo $i; ?>" class="modal">
				<form  id="form<?php echo $i; ?>" method="post" class="col s8 offset-s2 m6 offset-m3 l4 offset-l4" action="<?php  echo base_url();?>goal/save_milestone2/<?php echo $listMilestones[$i]['id']; ?>" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="row">
							<div class="col s12 m8">
								<div class="input-field secondary-text col s10 m10 l10">
								<br>
									<input id="goal_title" name="milestone_title2" type="text" class="validate" value="<?php echo $listMilestones[$i]['title']; ?>">
									<label for="goal_title" class ="dark-primary-text">Milestone Title</label>
								</div>
							</div>

							<div class="col s12 m4">
								<p>Status:</p>
								<form action="#">
								<div class="row">
									<div class="row col s2 center">
										<input type="checkbox" name="is_completed2" id="public_checkbox<?php echo $i; ?>" <?php if($listMilestones[$i]['statusId']==3) echo 'checked';?> />
										<label for="public_checkbox<?php echo $i; ?>">Completed</label>  <!-- --> 
									</div>
								</div>
								</form>
							</div>
						</div>

						<div class="row ">
							<div class="col center s12 ">
								<a href="<?php  echo base_url();?>goal/delete_milestone2/<?php echo $listMilestones[$i]['id']; ?>" class=" modal-action modal-close waves-effect waves-light btn grey" method="post">Delete</a>
								<input type="submit" class=" modal-action modal-close waves-effect waves-green btn primary-dark" value="Save">		
							</div>
						</div>
					</div>
				</form>
			</div>
		<?php endfor; }?>
</div>