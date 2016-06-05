

<div class="container">
	<div class="row">
		<div class="container pinned">
			<div class="row">
				<div class="col s12">
			        <ul class="tabs">
				        <li class="tab col s1"><a class="active" href="#following">Following</a></li>
				        <li class="tab col s1"><a href="#category1">Art</a></li>
				        <li class="tab col s1"><a href="#category2">Knowledge</a></li>
				        <li class="tab col s1"><a href="#category3">Social</a></li>
				        <li class="tab col s1"><a href="#category4">Sport</a></li>
				        <li class="tab col s1"><a href="#category5">Professional</a></li>
				        <li class="tab col s1"><a href="#category6">Personal</a></li>
			        </ul>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
	</div>	

	<div class="row">
		<!-- TAB 1 -->
	    <div id="following" class="col s12">
	    	<?php for($i=0; $nf_following!=false && $i<sizeof($nf_following); $i++):?>

	    	<!-- ----------CREATE GOAL----------- -->
	    	<?php if($nf_following[$i]['type'] == 0):?>
	    	<div class="col s12 m8 offset-m2 l6 offset-l3">
		    	<div class="card-panel grey lighten-5 z-depth-1">
		          	<div class="row valign-wrapper">
			            <div class="col s2">
			              <img src="<?php echo base_url(); ?>images/users/<?php echo $nf_following[$i]['userPicture']; ?>" class="circle responsive-img z-depth-1">
			            </div>
			            <div class="col s10">
			              <span class="box-title">
			                <a href="<?php echo base_url(); ?>user/user_profile/<?php echo $nf_following[$i]['userId']; ?>"><?php echo $nf_following[$i]['userName']; ?></a> created a goal.<br>
			              </span>
			              <span class="box-time">
			              	<?php echo $nf_following[$i]['date']; ?>
			              </span>
			            </div>
		        	</div>

		        	<div class="row valign-wrapper">
		          		<div class="col s4">
		          		</div> 
		          		<div class="col s4 center align">
		      				<a href="<?php echo base_url(); ?>goal/view/<?php echo $nf_following[$i]['userId']; ?>/<?php echo $nf_following[$i]['goalId']; ?>"><img src="<?php echo base_url(); ?>images/<?php echo $nf_following[$i]['categoryPicture']; ?>" class="circle responsive-img z-depth-1"></a>
		          		</div>
		          		<div class="col s4">
		          		</div>
		          	</div>

		          	<div class="row valign-wrapper">
		          		<div class="col s12 center align">
			              <span class="box-content">
			              	<b>Goal title:</b> <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $nf_following[$i]['userId']; ?>/<?php echo $nf_following[$i]['goalId']; ?>"><?php echo $nf_following[$i]['goalTitle']; ?></a><br>
			              	<b>Deadline:</b> <?php echo $nf_following[$i]['goalDeadline']; ?><br>
			              	<b>Status:</b> <?php echo ucwords($nf_following[$i]['goalStatus']); ?>
			              </span>
			            </div>
			           
		          	</div>

		          	
		        </div>
		    </div>
			<?php endif; ?>

			<!-- ----------CREATE MILESTONE----------- -->
		    <?php if($nf_following[$i]['type'] == 1): ?>
		    <div class="col s12 m8 offset-m2 l6 offset-l3">
		    	<div class="card-panel grey lighten-5 z-depth-1">
		          	<div class="row valign-wrapper">
			            <div class="col s2">
			              <img src="<?php echo base_url(); ?>images/users/<?php echo $nf_following[$i]['userPicture']; ?>" class="circle responsive-img z-depth-1">
			            </div>
			            <div class="col s10">
			              <span class="box-title">
			                <a href="<?php echo base_url(); ?>user/user_profile/<?php echo $nf_following[$i]['userId']; ?>"><?php echo $nf_following[$i]['userName']; ?></a> created a milestone.<br>
			              </span>
			              <span class="box-time">
			              	<?php echo $nf_following[$i]['date']; ?>
			              </span>
			            </div>
		        	</div>

		          	<div class="row valign-wrapper">
		          		<div class="col s12 center align">
			              <span class="box-content">
			              	<b>Milestone title:</b> <?php echo $nf_following[$i]['milestoneTitle']; ?><br>
			              	<b>Goal title:</b> <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $nf_following[$i]['userId']; ?>/<?php echo $nf_following[$i]['goalId']; ?>"><?php echo $nf_following[$i]['goalTitle']; ?></a><br>
			              	<b>Goal deadline:</b> <?php echo $nf_following[$i]['goalDeadline']; ?><br>
			              	<b>Goal status:</b> <?php echo ucwords($nf_following[$i]['goalStatus']); ?>
			              </span>
			            </div>
			           
		          	</div>
		        </div>
		    </div>
		    <?php endif; ?>

		    <!-- ----------UPDATE GOAL----------- -->
		    <?php if($nf_following[$i]['type'] == 2): ?>
	    	<div class="col s12 m8 offset-m2 l6 offset-l3">
		    	<div class="card-panel grey lighten-5 z-depth-1">
		          	<div class="row valign-wrapper">
			            <div class="col s2">
			              <img src="<?php echo base_url(); ?>images/users/<?php echo $nf_following[$i]['userPicture']; ?>" class="circle responsive-img z-depth-1">
			            </div>
			            <div class="col s10">
			              <span class="box-title">
			                <a href="<?php echo base_url(); ?>user/user_profile/<?php echo $nf_following[$i]['userId']; ?>"><?php echo $nf_following[$i]['userName']; ?></a> updated a goal status.<br>
			              </span>
			              <span class="box-time">
			              	<?php echo $nf_following[$i]['date']; ?>
			              </span>
			            </div>
		        	</div>

		        	<div class="row valign-wrapper">
		          		<div class="col s4">
		          		</div> 
		          		<div class="col s4 center align">
		      				<a href="<?php echo base_url(); ?>goal/view/<?php echo $nf_following[$i]['userId']; ?>/<?php echo $nf_following[$i]['goalId']; ?>"><img src="<?php echo base_url(); ?>images/<?php echo $nf_following[$i]['categoryPicture']; ?>" class="circle responsive-img z-depth-1"></a>
		          		</div>
		          		<div class="col s4">
		          		</div>
		          	</div>

		          	<div class="row valign-wrapper">
		          		<div class="col s12 center align">
			              <span class="box-content">
			              	<b>Goal title:</b> <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $nf_following[$i]['userId']; ?>/<?php echo $nf_following[$i]['goalId']; ?>"><?php echo $nf_following[$i]['goalTitle']; ?></a><br>
			              	<b>Deadline:</b> <?php echo $nf_following[$i]['goalDeadline']; ?><br>
			              	<b>Status:</b> <?php echo ucwords($nf_following[$i]['goalStatus']); ?>
			              </span>
			            </div>
			           
		          	</div>	
		        </div>
		    </div>
			<?php endif; ?>

			<!-- ----------UPDATE MILESTONE----------- -->
			<?php if($nf_following[$i]['type'] == 3): ?>
	    	<div class="col s12 m8 offset-m2 l6 offset-l3">
		    	<div class="card-panel grey lighten-5 z-depth-1">
		          	<div class="row valign-wrapper">
			            <div class="col s2">
			              <img src="<?php echo base_url(); ?>images/users/<?php echo $nf_following[$i]['userPicture']; ?>" class="circle responsive-img z-depth-1">
			            </div>
			            <div class="col s10">
			              <span class="box-title">
			                <a href="<?php echo base_url(); ?>user/user_profile/<?php echo $nf_following[$i]['userId']; ?>"><?php echo $nf_following[$i]['userName']; ?></a> updated a milestone status.<br>
			              </span>
			              <span class="box-time">
			              	<?php echo $nf_following[$i]['date']; ?>
			              </span>
			            </div>
		        	</div>
		          	<div class="row valign-wrapper">
		          		<div class="col s12 center align">
			              <span class="box-content">
			              	<b>Milestone title:</b> <?php echo $nf_following[$i]['milestoneTitle']; ?><br>
			              	<b>Goal title:</b> <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $nf_following[$i]['userId']; ?>/<?php echo $nf_following[$i]['goalId']; ?>"><?php echo $nf_following[$i]['goalTitle']; ?></a><br>
			              	<b>Goal deadline:</b> <?php echo $nf_following[$i]['goalDeadline']; ?><br>
			              	<b>Milestone status:</b> <?php echo ucwords($nf_following[$i]['milestoneStatus']); ?>
			              </span>
			            </div>
		          	</div>
		        </div>
		    </div>
			<?php endif; ?>

			<!-- ----------ADD PICTURE----------- -->
			<?php if($nf_following[$i]['type'] == 4): ?>
	    	<div class="col s12 m8 offset-m2 l6 offset-l3">
		    	<div class="card-panel grey lighten-5 z-depth-1">
		          	<div class="row valign-wrapper">
			            <div class="col s2">
			              <img src="<?php echo base_url(); ?>images/users/<?php echo $nf_following[$i]['userPicture']; ?>" class="circle responsive-img z-depth-1">
			            </div>
			            <div class="col s10">
			              <span class="box-title">
			                <a href="<?php echo base_url(); ?>user/user_profile/<?php echo $nf_following[$i]['userId']; ?>"><?php echo $nf_following[$i]['userName']; ?></a> updated a milestone status.<br>
			              </span>
			              <span class="box-time">
			              	<?php echo $nf_following[$i]['date']; ?>
			              </span>
			            </div>
		        	</div>
		        	<div class="row valign-wrapper">
		          		<div class="col s12 center align">
			              <span class="box-content">
			              	<b>Goal title:</b> <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $nf_following[$i]['userId']; ?>/<?php echo $nf_following[$i]['goalId']; ?>"><?php echo $nf_following[$i]['goalTitle']; ?></a><br>
			              	<b>Goal deadline:</b> <?php echo $nf_following[$i]['goalDeadline']; ?><br>
			              </span>
			            </div>
		          	</div>
		          	<div class="row valign-wrapper">
		          		<div class="col s12 center-align">
			              <img src="<?php echo base_url(); ?>images/goals/<?php echo $nf_following[$i]['pictureName']; ?>" class="responsive-img">
			            </div>
		          	</div>
		        </div>
		    </div>
			<?php endif; ?>


			<!-- ----------FOLLOWING----------- -->

			<?php if($nf_following[$i]['type'] == 5): ?>
	    	<div class="col s12 m8 offset-m2 l6 offset-l3">
		    	<div class="card-panel grey lighten-5 z-depth-1">
		          	<div class="row valign-wrapper">
			            <div class="col s2">
			              <img src="<?php echo base_url(); ?>images/users/<?php echo $nf_following[$i]['userPicture']; ?>" class="circle responsive-img z-depth-1">
			            </div>
			            <div class="col s10">
			              <span class="box-title">
			                <a href="<?php echo base_url(); ?>user/user_profile/<?php echo $nf_following[$i]['userId']; ?>"><?php echo $nf_following[$i]['userName']; ?></a> started following someone.<br>
			              </span>
			              <span class="box-time">
			              	<?php echo $nf_following[$i]['date']; ?>
			              </span>
			            </div>
		        	</div>

		        	<div class="row valign-wrapper">
		          		<div class="col s4">
		          		</div> 
		          		<div class="col s4 center align">
		      				<a href="<?php echo base_url(); ?>user/user_profile/<?php echo $nf_following[$i]['followingId']; ?>"><img src="<?php echo base_url(); ?>images/users/<?php echo $nf_following[$i]['followingPicture']; ?>" class="circle responsive-img z-depth-1"></a>
		          		</div>
		          		<div class="col s4">
		          		</div>
		          	</div>

		          	<div class="row valign-wrapper">
		          		<div class="col s12 center align">
			              <span class="box-content">
			              	<b><a class="text" href="<?php echo base_url(); ?>user/user_profile/<?php echo $nf_following[$i]['followingId']; ?>"><?php echo $nf_following[$i]['followingName']; ?></a><br>
			              </span>
			            </div>
		          	</div>
		        </div>
		    </div>
			<?php endif; ?>

			<?php 
			endfor; 
			?>

			<?php if($nf_following==false){ ?>
				You should start making some friends...
			<?php } ?>

	    </div>

	    <!-- ---------- CATEGORIES ----------- -->
	    <!-- ---------- CATEGORIES ----------- -->
	    <!-- ---------- CATEGORIES ----------- -->

	    <?php for ($j=1; $j<=6 ; $j++) {?>
	    <div id="category<?php echo $j; ?>" class="col s12">
	    	<?php for($i=0; $nf_category[$j]!=false && $i<sizeof($nf_category[$j]); $i++):?>

	    	<!-- ----------CREATE GOAL----------- -->
	    	<?php if($nf_category[$j][$i]['type'] == 0):?>
	    	<div class="col s12 m8 offset-m2 l6 offset-l3">
		    	<div class="card-panel grey lighten-5 z-depth-1">
		          	<div class="row valign-wrapper">
			            <div class="col s2">
			              <img src="<?php echo base_url(); ?>images/users/<?php echo $nf_category[$j][$i]['userPicture']; ?>" class="circle responsive-img z-depth-1">
			            </div>
			            <div class="col s10">
			              <span class="box-title">
			                <a href="<?php echo base_url(); ?>user/user_profile/<?php echo $nf_category[$j][$i]['userId']; ?>"><?php echo $nf_category[$j][$i]['userName']; ?></a> created a goal.<br>
			              </span>
			              <span class="box-time">
			              	<?php echo $nf_category[$j][$i]['date']; ?>
			              </span>
			            </div>
		        	</div>

		        	<div class="row valign-wrapper">
		          		<div class="col s4">
		          		</div> 
		          		<div class="col s4 center align">
		      				<a href="<?php echo base_url(); ?>goal/view/<?php echo $nf_category[$j][$i]['userId']; ?>/<?php echo $nf_category[$j][$i]['goalId']; ?>"><img src="<?php echo base_url(); ?>images/<?php echo $nf_category[$j][$i]['categoryPicture']; ?>" class="circle responsive-img z-depth-1"></a>
		          		</div>
		          		<div class="col s4">
		          		</div>
		          	</div>

		          	<div class="row valign-wrapper">
		          		<div class="col s12 center align">
			              <span class="box-content">
			              	<b>Goal title:</b> <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $nf_category[$j][$i]['userId']; ?>/<?php echo $nf_category[$j][$i]['goalId']; ?>"><?php echo $nf_category[$j][$i]['goalTitle']; ?></a><br>
			              	<b>Deadline:</b> <?php echo $nf_category[$j][$i]['goalDeadline']; ?><br>
			              	<b>Status:</b> <?php echo ucwords($nf_category[$j][$i]['goalStatus']); ?>
			              </span>
			            </div>
			           
		          	</div>

		          	
		        </div>
		    </div>
			<?php endif; ?>

			<!-- ----------CREATE MILESTONE----------- -->
		    <?php if($nf_category[$j][$i]['type'] == 1): ?>
		    <div class="col s12 m8 offset-m2 l6 offset-l3">
		    	<div class="card-panel grey lighten-5 z-depth-1">
		          	<div class="row valign-wrapper">
			            <div class="col s2">
			              <img src="<?php echo base_url(); ?>images/users/<?php echo $nf_category[$j][$i]['userPicture']; ?>" class="circle responsive-img z-depth-1">
			            </div>
			            <div class="col s10">
			              <span class="box-title">
			                <a href="<?php echo base_url(); ?>user/user_profile/<?php echo $nf_category[$j][$i]['userId']; ?>"><?php echo $nf_category[$j][$i]['userName']; ?></a> created a goal.<br>
			              </span>
			              <span class="box-time">
			              	<?php echo $nf_category[$j][$i]['date']; ?>
			              </span>
			            </div>
		        	</div>

		          	<div class="row valign-wrapper">
		          		<div class="col s12 center align">
			              <span class="box-content">
			              	<b>Milestone title:</b> <?php echo $nf_category[$j][$i]['milestoneTitle']; ?><br>
			              	<b>Goal title:</b> <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $nf_category[$j][$i]['userId']; ?>/<?php echo $nf_category[$j][$i]['goalId']; ?>"><?php echo $nf_category[$j][$i]['goalTitle']; ?></a><br>
			              	<b>Goal deadline:</b> <?php echo $nf_category[$j][$i]['goalDeadline']; ?><br>
			              	<b>Goal status:</b> <?php echo ucwords($nf_category[$j][$i]['goalStatus']); ?>
			              </span>
			            </div>
			           
		          	</div>
		        </div>
		    </div>
		    <?php endif; ?>

		    <!-- ----------UPDATE GOAL----------- -->
		    <?php if($nf_category[$j][$i]['type'] == 2): ?>
	    	<div class="col s12 m8 offset-m2 l6 offset-l3">
		    	<div class="card-panel grey lighten-5 z-depth-1">
		          	<div class="row valign-wrapper">
			            <div class="col s2">
			              <img src="<?php echo base_url(); ?>images/users/<?php echo $nf_category[$j][$i]['userPicture']; ?>" class="circle responsive-img z-depth-1">
			            </div>
			            <div class="col s10">
			              <span class="box-title">
			                <a href="<?php echo base_url(); ?>user/user_profile/<?php echo $nf_category[$j][$i]['userId']; ?>"><?php echo $nf_category[$j][$i]['userName']; ?></a> updated a goal status.<br>
			              </span>
			              <span class="box-time">
			              	<?php echo $nf_category[$j][$i]['date']; ?>
			              </span>
			            </div>
		        	</div>

		        	<div class="row valign-wrapper">
		          		<div class="col s4">
		          		</div> 
		          		<div class="col s4 center align">
		      				<a href="<?php echo base_url(); ?>goal/view/<?php echo $nf_category[$j][$i]['userId']; ?>/<?php echo $nf_category[$j][$i]['goalId']; ?>"><img src="<?php echo base_url(); ?>images/<?php echo $nf_category[$j][$i]['categoryPicture']; ?>" class="circle responsive-img z-depth-1"></a>
		          		</div>
		          		<div class="col s4">
		          		</div>
		          	</div>

		          	<div class="row valign-wrapper">
		          		<div class="col s12 center align">
			              <span class="box-content">
			              	<b>Goal title:</b> <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $nf_category[$j][$i]['userId']; ?>/<?php echo $nf_category[$j][$i]['goalId']; ?>"><?php echo $nf_category[$j][$i]['goalTitle']; ?></a><br>
			              	<b>Deadline:</b> <?php echo $nf_category[$j][$i]['goalDeadline']; ?><br>
			              	<b>Status:</b> <?php echo ucwords($nf_category[$j][$i]['goalStatus']); ?>
			              </span>
			            </div>
			           
		          	</div>	
		        </div>
		    </div>
			<?php endif; ?>

			<!-- ----------UPDATE MILESTONE----------- -->
			<?php if($nf_category[$j][$i]['type'] == 3): ?>
	    	<div class="col s12 m8 offset-m2 l6 offset-l3">
		    	<div class="card-panel grey lighten-5 z-depth-1">
		          	<div class="row valign-wrapper">
			            <div class="col s2">
			              <img src="<?php echo base_url(); ?>images/users/<?php echo $nf_category[$j][$i]['userPicture']; ?>" class="circle responsive-img z-depth-1">
			            </div>
			            <div class="col s10">
			              <span class="box-title">
			                <a href="<?php echo base_url(); ?>user/user_profile/<?php echo $nf_category[$j][$i]['userId']; ?>"><?php echo $nf_category[$j][$i]['userName']; ?></a> updated a milestone status.<br>
			              </span>
			              <span class="box-time">
			              	<?php echo $nf_category[$j][$i]['date']; ?>
			              </span>
			            </div>
		        	</div>
		          	<div class="row valign-wrapper">
		          		<div class="col s12 center align">
			              <span class="box-content">
			              	<b>Milestone title:</b> <?php echo $nf_category[$j][$i]['milestoneTitle']; ?><br>
			              	<b>Goal title:</b> <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $nf_category[$j][$i]['userId']; ?>/<?php echo $nf_category[$j][$i]['goalId']; ?>"><?php echo $nf_category[$j][$i]['goalTitle']; ?></a><br>
			              	<b>Goal deadline:</b> <?php echo $nf_category[$j][$i]['goalDeadline']; ?><br>
			              	<b>Milestone status:</b> <?php echo ucwords($nf_category[$j][$i]['milestoneStatus']); ?>
			              </span>
			            </div>
		          	</div>
		        </div>
		    </div>
			<?php endif; ?>

			<!-- ----------ADD PICTURE----------- -->
			<?php if($nf_category[$j][$i]['type'] == 4): ?>
	    	<div class="col s12 m8 offset-m2 l6 offset-l3">
		    	<div class="card-panel grey lighten-5 z-depth-1">
		          	<div class="row valign-wrapper">
			            <div class="col s2">
			              <img src="<?php echo base_url(); ?>images/users/<?php echo $nf_category[$j][$i]['userPicture']; ?>" class="circle responsive-img z-depth-1">
			            </div>
			            <div class="col s10">
			              <span class="box-title">
			                <a href="<?php echo base_url(); ?>user/user_profile/<?php echo $nf_category[$j][$i]['userId']; ?>"><?php echo $nf_category[$j][$i]['userName']; ?></a> updated a milestone status.<br>
			              </span>
			              <span class="box-time">
			              	<?php echo $nf_category[$j][$i]['date']; ?>
			              </span>
			            </div>
		        	</div>
		        	<div class="row valign-wrapper">
		          		<div class="col s12 center align">
			              <span class="box-content">
			              	<b>Goal title:</b> <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $nf_category[$j][$i]['userId']; ?>/<?php echo $nf_category[$j][$i]['goalId']; ?>"><?php echo $nf_category[$j][$i]['goalTitle']; ?></a><br>
			              	<b>Goal deadline:</b> <?php echo $nf_category[$j][$i]['goalDeadline']; ?><br>
			              </span>
			            </div>
		          	</div>
		          	<div class="row valign-wrapper">
		          		<div class="col s12 center-align">
			              <img src="<?php echo base_url(); ?>images/goals/<?php echo $nf_category[$j][$i]['pictureName']; ?>" class="responsive-img">
			            </div>
		          	</div>
		        </div>
		    </div>
			<?php endif; ?>

			<?php 
			endfor; 
			?>

			<?php if($nf_category[$j]==false){ ?>
				You should start making some friends...
			<?php } ?>
	    </div>
	    <?php } ?>

	</div>
</div>