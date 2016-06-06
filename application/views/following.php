<div class="container">
	<div class="row">
		<div class="col s12">
		</div>
	</div>

	<?php 
		if($following!=false){
			for($i=0;$i<sizeof($following);$i++) {?>

			<?php if($i%2==0){ ?>
				<div class="row">
			<?php } ?>

		<div class="col s12 m6">
			<div class="card-panel grey lighten-5 z-depth-1">
	          	<div class="row valign-wrapper">
		            <div class="col s2">
		              <img src="<?php echo base_url(); ?>images/users/<?php echo $following[$i]['picture']; ?>" class="circle circle responsive-img"> <!-- notice the "circle" class -->
		            </div>
		            <div class="col s10">
		              <span class="box-title">
		                <a href="<?php echo base_url(); ?>user/user_profile/<?php echo $following[$i]['id']; ?>"><?php echo $following[$i]['name']; ?></a><br>
		              </span>
		              <span class="box-time">
		              	<?php echo $following[$i]['completedGoals']; ?> goals completed.
		              </span>
		            </div>
	        	</div>
		    </div>
		</div>

		<?php if($i%2==1){ ?>
			</div>
		<?php } ?>

	<?php 
			}
		}
		else{?>
			
		<div class="row center">
			<br><br>
			<img src="<?php echo base_url();?>/images/follow.png">
			<h1 class="header center secondary-text col s12">You should consider following someone...</h1>
		</div>
		<?php
		}
	?>

</div>