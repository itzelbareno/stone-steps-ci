  
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
							<a href="<?php  echo base_url();?>goal<?php if(isset($goalId))  echo "/update_milestones/".$goalId; ?>" class="breadcrumb  grey-text text-lighten-3 ">Milestones</a>
							<a href="<?php  echo base_url();?>goal<?php if(isset($goalId))  echo "/update_pictures/".$goalId; ?>" class="breadcrumb  white-text text"><b>Photos</b></a>
							
						</div>
					</nav>
				</div>
			</div>
		
		
			<h6 class="header center col s12 secondary-text"> Upload photos that have relation with your goal, include photos that evidence your progress to your friends!  </h6>
      
			<div class="row">
				<form  id="form1" method="post" class="col s8 offset-s2 m6 offset-m3 l4 offset-l4" action="<?php echo base_url(); ?>goal/receiveDataNewPicture/<?php echo $goalId; ?>" enctype="multipart/form-data">
					<div class="row center">
						<?php 
							if (isset($_SESSION['error-goal']))
								echo "Error: ".$_SESSION['error-goal']['error']; 
						?>
					</div>
					<div class="row">
						<div class="input-field secondary-text col s12">
							<input name="caption" id="pic_caption" type="text" class="validate">
							<label for="pic_caption" class ="dark-primary-text">Caption</label>
						</div>
					</div>
					<div class="file-field input-field">
						<div class="btn waves-effect dark-primary waves-light">
							<span><i class="material-icons ">perm_media add</i></span>
							<input type="file" name="name"  >
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text" placeholder="Upload Goal Photo">
						</div>
					</div>
				</form>
			</div>

			<div class="row">
				<div class="col s12 m4 offset-m4">
					<input type="submit" form="form1" id="create-button" class="btn-main dark-primary waves-effect waves-light offset-s3 offset-m3 offset-l3 col s6 m6 l6 " value="Upload" />
				</div>
			</div>
			
			
			
			
			
			<?php for($i=0;$i<sizeof($goalPictures);$i++) {?>
		<!-- Modal Structure -->
			<div id="modal<?php echo ($i);?>" class="modal ">
				<form  id="formSave<?php echo $i; ?>" method="post" action="<?php echo base_url(); ?>goal/saveGoalPicture/<?php echo $goalPictures[$i]['id']; ?>" enctype="multipart/form-data">
					<div class="modal-content center ">
						<div class="row">
							<div class="input-field secondary-text ">
								<input id="goal_title<?php echo ($i);?>" type="text" name="piccaption" value="<?php echo $goalPictures[$i]['caption'];?>" >
								<label for="goal_title<?php echo ($i);?>" class ="dark-primary-text ">Caption</label>
							</div>
						</div>
						<div class="row ">
								<img class=" responsive-img " width="300" src="/stone-steps-ci/images/goals/<?php echo $goalPictures[$i]['name']; ?>">
						</div>
						<div class="row ">
							<div class="col center s6 "><!--- hola Delete y Save regresar con goal id--->						
								<a href="<?php  echo base_url();?>goal/deleteGoalPicture/<?php echo $goalPictures[$i]['id']; ?>" class=" modal-action modal-close waves-effect waves-light btn grey" method="post">Delete</a>
							</div>	

							<div class="col center s6 ">
								<input type="submit" form="formSave<?php echo $i; ?>" name="save" class="btn-main dark-primary modal-action modal-close waves-effect waves-green  col s6 m6 l6 " value="Save" />	
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- End Modal -->
			<?php }?>
			
			
			
			<!--<div>
			
  
			<div class="carousel">
				<a class="carousel-item modal-trigger data-target=modal1" href="#modal1"><img src="http://placehold.it/470/0/eeeee"></a>
				<a class="carousel-item modal-trigger data-target=modal1" href="#modal1"><img src="images/w2.jpg"></a>
				<a class="carousel-item modal-trigger data-target=modal1" href="#modal1"><img src="images/w3.jpg"></a>
				<a class="carousel-item modal-trigger data-target=modal1" href="#modal1"><img src="images/w4.jpg"></a>
				<a class="carousel-item modal-trigger data-target=modal1" href="#modal1"><img src="images/w5.jpg"></a>
			</div>
			</div>
			-->
		
			
		<div class="row ">
			
			<?php for($i=0;isset($goalPictures[$i]['name'])&&$i<sizeof($goalPictures,0);$i++) {?>
			<div class="col s5 m3 l2 center ">
				<div class="row">
					<img class=" materialboxed responsive-img " width="470" src="/stone-steps-ci/images/goals/<?php echo $goalPictures[$i]['name']; ?>">
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
      
