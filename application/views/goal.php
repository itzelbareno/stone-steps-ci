
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
				<div class="row">
					<div class="col s12 center">
						<?php if($_SESSION['user']['id'] == $userId ) {?>					
						<a href="<?php echo base_url(); ?>/goal/delete_goal/<?php echo $goalInfo['id']; ?>" class="waves-effect waves-light btn red" method= "post">Delete Goal</a>
						<?php
						}
						?>
						<br><br>
					</div>
								
					<div class="collection left-align">
						<!-- Add a New Milestone -->
						<?php 
						if($_SESSION['user']['id'] == $userId ) { ?>
						<a href="<?php echo base_url(); ?>goal/update_milestones/<?php $id; ?>" class="collection-item waves-effect waves-light modal-trigger data-target=modal1">
							<div class="col s12 center"><span class="secondary-text">Add a New Milestone</span></div>
						</a>
						<?php 
						}
						?>
						
						<!-- Milestones List -->
						<?php
						if(isset($listMilestones)){
							for($i=0; isset($listMilestones) && $i<sizeof($listMilestones);$i++){ ?>
							<a href="#modal1" class="collection-item waves-effect waves-light modal-trigger data-target=modal1">
								<div class="col s9">
									<span class="text"><?php echo $listMilestones[$i]['title']; ?></span>
								</div>
								<div class="col s3">
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
						} 
						?>
						
						
					</div>
				</div>
				<?php
        }
        ?>
			</div>
		</div>

		<!--Fotos de Objetivo-->
		<div class="col s12 m8">
			<div class="container">	
				<div class="row">

					<div class="col s12 m4">
						<div class="card">
						    <div class="card-image waves-effect waves-block waves-light">
						    	<img class="materialboxed" src="http://placehold.it/150/0/eeeee">
						    </div>
						    <div>
						      <span class="activator card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
						    </div>
						    <div class="card-reveal">
						      <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>
						      <p class="image-caption">Cuando por fin logré tocar el intro de la canción.</p>
						    </div>
						</div>
					</div>

					<div class="col s12 m4">
						<div class="card">
						    <div class="card-image waves-effect waves-block waves-light">
						    	<img class="materialboxed" src="http://placehold.it/150/0/eeeee">
						    </div>
						    <div>
						      <span class="activator card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
						    </div>
						    <div class="card-reveal">
						      <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>
						      <p class="image-caption">Cuando por fin logré tocar el intro de la canción.</p>
						    </div>
						</div>
					</div>

					<div class="col s12 m4">
						<div class="card">
						    <div class="card-image waves-effect waves-block waves-light">
						    	<img class="materialboxed" src="http://placehold.it/150/0/eeeee">
						    </div>
						    <div>
						      <span class="activator card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
						    </div>
						    <div class="card-reveal">
						      <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>
						      <p class="image-caption">Cuando por fin logré tocar el intro de la canción.</p>
						    </div>
						</div>
					</div>

				</div>

				<div class="row">

					<div class="col s12 m4">
						<div class="card">
						    <div class="card-image waves-effect waves-block waves-light">
						    	<img class="materialboxed" src="http://placehold.it/150/0/eeeee">
						    </div>
						    <div>
						      <span class="activator card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
						    </div>
						    <div class="card-reveal">
						      <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>
						      <p class="image-caption">Cuando por fin logré tocar el intro de la canción.</p>
						    </div>
						</div>
					</div>

					<div class="col s12 m4">
						<div class="card">
						    <div class="card-image waves-effect waves-block waves-light">
						    	<img class="materialboxed" src="http://placehold.it/150/0/eeeee">
						    </div>
						    <div>
						      <span class="activator card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
						    </div>
						    <div class="card-reveal">
						      <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>
						      <p class="image-caption">Cuando por fin logré tocar el intro de la canción.</p>
						    </div>
						</div>
					</div>

					<div class="col s12 m4">
						<div class="card">
						    <div class="card-image waves-effect waves-block waves-light">
						    	<img class="materialboxed" src="http://placehold.it/150/0/eeeee">
						    </div>
						    <div>
						      <span class="activator card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
						    </div>
						    <div class="card-reveal">
						      <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>
						      <p class="image-caption">Cuando por fin logré tocar el intro de la canción.</p>
						    </div>
						</div>
					</div>

				</div>

				<div class="row">

					<div class="col s12 m4">
						<div class="card">
						    <div class="card-image waves-effect waves-block waves-light">
						    	<img class="materialboxed" src="http://placehold.it/150/0/eeeee">
						    </div>
						    <div>
						      <span class="activator card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
						    </div>
						    <div class="card-reveal">
						      <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>
						      <p class="image-caption">Cuando por fin logré tocar el intro de la canción.</p>
						    </div>
						</div>
					</div>

					<div class="col s12 m4">
						<div class="card">
						    <div class="card-image waves-effect waves-block waves-light">
						    	<img class="materialboxed" src="http://placehold.it/150/0/eeeee">
						    </div>
						    <div>
						      <span class="activator card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
						    </div>
						    <div class="card-reveal">
						      <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>
						      <p class="image-caption">Cuando por fin logré tocar el intro de la canción.</p>
						    </div>
						</div>
					</div>

					<div class="col s12 m4">
						<div class="card">
						    <div class="card-image waves-effect waves-block waves-light">
						    	<img class="materialboxed" src="http://placehold.it/150/0/eeeee">
						    </div>
						    <div>
						      <span class="activator card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
						    </div>
						    <div class="card-reveal">
						      <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>
						      <p class="image-caption">Cuando por fin logré tocar el intro de la canción.</p>
						    </div>
						</div>
					</div>

				</div>

				<div class="row">

					<div class="col s12 m4">
						<div class="card">
						    <div class="card-image waves-effect waves-block waves-light">
						    	<img class="materialboxed" src="http://placehold.it/150/0/eeeee">
						    </div>
						    <div>
						      <span class="activator card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
						    </div>
						    <div class="card-reveal">
						      <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>
						      <p class="image-caption">Cuando por fin logré tocar el intro de la canción.</p>
						    </div>
						</div>
					</div>

					<div class="col s12 m4">
						<div class="card">
						    <div class="card-image waves-effect waves-block waves-light">
						    	<img class="materialboxed" src="http://placehold.it/150/0/eeeee">
						    </div>
						    <div>
						      <span class="activator card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
						    </div>
						    <div class="card-reveal">
						      <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>
						      <p class="image-caption">Cuando por fin logré tocar el intro de la canción.</p>
						    </div>
						</div>
					</div>

					<div class="col s12 m4">
						<div class="card">
						    <div class="card-image waves-effect waves-block waves-light">
						    	<img class="materialboxed" src="http://placehold.it/150/0/eeeee">
						    </div>
						    <div>
						      <span class="activator card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
						    </div>
						    <div class="card-reveal">
						      <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>
						      <p class="image-caption">Cuando por fin logré tocar el intro de la canción.</p>
						    </div>
						</div>
					</div>

				</div>


			</div>	
		</div>

	</div><!--Row General-->
</div>