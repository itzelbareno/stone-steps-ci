<div class="container">
  <br><br>

  <!----- Modal Picture -->
<div id="modalPicture" class="modal col s6 offset-s2">
	<form  id="changePictureForm" method="post" action="<?php echo base_url(); ?>user/change_picture" enctype="multipart/form-data">
		<div class="modal-content">
      <div class = "col s12 center">
        <!-- Preview Imagen -->
        <div class="row">
          <img  class="user" id="imagenPerfil" name="imagenPerfil" src="<?php echo base_url();?>images/users/<?php echo $picture;?>">
        </div>
        
        <!-- Cargar Imagen -->
        <div class="row">
          <div class = "col s6 offset-s3">
            <div class="file-field input-field">
              <div class="btn waves-effect dark-primary waves-light">
                <span><i class="material-icons ">perm_media add</i></span>
                <input type="file" form="changePictureForm" name="picture" onchange="document.getElementById('imagenPerfil').src = window.URL.createObjectURL(this.files[0])">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Upload Goal Photo">
              </div>
            </div>
          </div>
        </div>

        <!-- Botones Submit  | Cancel -->
        <div class="row ">
          <div class="col center s12 ">
            <a href="#!" class="modal-action modal-close waves-effect waves-light btn grey" method="post">Cancel</a>
            <button type="submit" form="changePictureForm" class="modal-action modal-close waves-effect waves-green btn primary-dark">Save</button>		
          </div>
        </div>
        
			</div>
		</div>
	</form>
</div>
<!----- Termina Modal -->

  <div class="row"> <!-- Row General -->
    <div class = "col s12 m4 center"><!--Columna Izquierda-->
      <div class="container-90">
        <div class="row">
          <div class="show-image">
            <img class="materialboxed user z-depth-1" src="<?php echo base_url();?>images/users/<?php echo $picture;?>">
            <?php if($id == $_SESSION['user']['id']){?>
            <a href="#modalPicture" class="modal-trigger data-target=modal1"><i class = "accent-text material-icons">edit</i></a>
            <?php
            }
            ?>
          </div>
        </div>
        
        <div class="row">
          <h4><?php echo $firstName." ".$middleName." ".$lastName;?></h4>
        </div>
        
        <div class="row">
          <?php if( $_SESSION['user']['id'] != $id && !$isFollowing) { ?>
            <a href="<?php echo base_url(); ?>user/startFollowing/<?php echo $id;?>" class="waves-effect waves-light btn" method= "post">Follow</a> 
          <?php
          }
          else if ( $_SESSION['user']['id'] != $id && $isFollowing){?>
            <a href="<?php echo base_url(); ?>user/stopFollowing/<?php echo $id;?>" class="waves-effect waves-light btn" method= "post">Unfollow</a>
          <?php
          }
          ?>          
        </div>
        
        <div class="row">
          <i class = "material-icons">email</i> <?php echo $email;?>
        </div>
        <div class="row">
          <i class = "material-icons">done</i><?php echo $completed;?> Accomplished Goals 
        </div>
        <div class="row">
          <i class = "material-icons">schedule</i><?php echo $pending;?> Pending Goals 
        </div>  
        
        <br>
        
        <?php
          if(isset($listGoals) || $_SESSION['user']['id'] == $id ) { ?>
          <div class="row">
            <div class="collection left-align">
              <?php
              if($_SESSION['user']['id'] == $id ) { ?>
              <!-- Add New Goal -->
              <a href="<?php echo base_url(); ?>goal" class="collection-item waves-effect waves-light modal-trigger data-target=modal1">
                <div class="col s12 center"><span class="secondary-text">Add new goal</span></div>
              </a>
              <?php 
              }
              ?>

              <!-- List of Goals -->
              <?php
              if(isset($listGoals)){
                for($i=0; isset($listGoals) && $i<sizeof($listGoals);$i++){ ?>                
                  <a href="<?php echo base_url(); ?>goal/view/<?php echo $id; ?>/<?php echo $listGoals[$i]['id']; ?>" class="collection-item waves-effect waves-light modal-trigger data-target=modal1">
                    <div class="col s9">
                      <span class="text"><?php echo $listGoals[$i]['title']; ?></span>
                    </div>
                    <div class="col s3">
                      <span class="badge <?php if($listGoals[$i]['statusId']==2) echo 'grey-text'; else echo 'accent-text';  ?>"><?php echo $listGoals[$i]['statusName']; ?></span>                 
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
      </div> <!-- Container-90 -->
    </div><!--Columna Izquierda-->
    
    <div class="col s12 m8"><!--Columna Derecha-->
      <div class="container"> <!-- Container2 -->

        <?php for($i=0; $nf_user!=false && $i<sizeof($nf_user); $i++):?>

        <!-- ----------CREATE GOAL----------- -->
        <?php if($nf_user[$i]['type'] == 0):?>
          <div class="card-panel grey lighten-5 z-depth-1">
            <div class="row valign-wrapper">
              <div class="col s2">
                <a href="<?php echo base_url(); ?>goal/view/<?php echo $id; ?>/<?php echo $nf_user[$i]['goalId']; ?>"><img src="<?php echo base_url(); ?>images/<?php echo $nf_user[$i]['categoryPicture']; ?>" class="circle responsive-img z-depth-1"></a>
              </div>
              <div class="col s10">
                <span class="box-title">
                  <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $id; ?>/<?php echo $nf_user[$i]['goalId']; ?>"><?php echo $nf_user[$i]['goalTitle']; ?> </a> was created as a goal.<br>
                </span>
                <span class="box-time">
                  <?php echo $nf_user[$i]['date']; ?>
                </span>
              </div>
            </div>

            <div class="row valign-wrapper">
              <div class="col s12">
                <span class="box-content">
                  <b>Goal title:</b> <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $id; ?>/<?php echo $nf_user[$i]['goalId']; ?>"><?php echo $nf_user[$i]['goalTitle']; ?> </a> <br>
                  <b>Deadline:</b> <?php echo $nf_user[$i]['goalDeadline']; ?><br>
                  <b>Status:</b> <?php echo ucwords($nf_user[$i]['goalStatus']); ?><br>
                  <p><?php echo $nf_user[$i]['goalDescription']; ?></p>
                </span>
              </div>
            </div>

                
          </div>
      <?php endif; ?>

      <!-- ----------CREATE MILESTONE----------- -->
        <?php if($nf_user[$i]['type'] == 1): ?>
          <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row valign-wrapper">
                  <div class="col s2">
                    <a href="<?php echo base_url(); ?>goal/view/<?php echo $id; ?>/<?php echo $nf_user[$i]['goalId']; ?>"><img src="<?php echo base_url(); ?>images/<?php echo $nf_user[$i]['categoryPicture']; ?>" class="circle responsive-img z-depth-1"></a>
                  </div>
                  <div class="col s10">
                    <span class="box-title">
                      <?php echo $nf_user[$i]['milestoneTitle']; ?> was added to <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $id; ?>/<?php echo $nf_user[$i]['goalId']; ?>"><?php echo $nf_user[$i]['goalTitle']; ?> </a><br>
                    </span>
                    <span class="box-time">
                      <?php echo $nf_user[$i]['date']; ?>
                    </span>
                  </div>
                </div>

                <div class="row valign-wrapper">
                  <div class="col s12 center align">
                    <span class="box-content">
                      <b>Milestone title:</b> <?php echo $nf_user[$i]['milestoneTitle']; ?><br>
                      <b>Goal title:</b> <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $id; ?>/<?php echo $nf_user[$i]['goalId']; ?>"><?php echo $nf_user[$i]['goalTitle']; ?></a><br>
                      <b>Goal deadline:</b> <?php echo $nf_user[$i]['goalDeadline']; ?><br>
                      <b>Goal status:</b> <?php echo ucwords($nf_user[$i]['goalStatus']); ?>
                    </span>
                  </div>
                 
                </div>
            </div>
        <?php endif; ?>

        <!-- ----------UPDATE GOAL----------- -->
        <?php if($nf_user[$i]['type'] == 2): ?>
          <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row valign-wrapper">
                  <div class="col s2">
                    <a href="<?php echo base_url(); ?>goal/view/<?php echo $id; ?>/<?php echo $nf_user[$i]['goalId']; ?>"><img src="<?php echo base_url(); ?>images/<?php echo $nf_user[$i]['categoryPicture']; ?>" class="circle responsive-img z-depth-1"></a>
                  </div>
                  <div class="col s10">
                    <span class="box-title">
                      <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $id; ?>/<?php echo $nf_user[$i]['goalId']; ?>"><?php echo $nf_user[$i]['goalTitle']; ?> </a> status was updated.<br>
                    </span>
                    <span class="box-time">
                      <?php echo $nf_user[$i]['date']; ?>
                    </span>
                  </div>
                </div>

                <div class="row valign-wrapper">
                  <div class="col s12 center align">
                    <span class="box-content">
                      <b>Goal title:</b> <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $id; ?>/<?php echo $nf_user[$i]['goalId']; ?>"><?php echo $nf_user[$i]['goalTitle']; ?></a><br>
                      <b>Deadline:</b> <?php echo $nf_user[$i]['goalDeadline']; ?><br>
                      <b>Status:</b> <?php echo ucwords($nf_user[$i]['goalStatus']); ?>
                    </span>
                  </div>
                 
                </div>  
            </div>
      <?php endif; ?>

      <!-- ----------UPDATE MILESTONE----------- -->
      <?php if($nf_user[$i]['type'] == 3): ?>
          <div class="card-panel grey lighten-5 z-depth-1">
              <div class="row valign-wrapper">
                <div class="col s2">
                  <a href="<?php echo base_url(); ?>goal/view/<?php echo $id; ?>/<?php echo $nf_user[$i]['goalId']; ?>"><img src="<?php echo base_url(); ?>images/<?php echo $nf_user[$i]['categoryPicture']; ?>" class="circle responsive-img z-depth-1"></a>
                </div>
                <div class="col s10">
                  <span class="box-title">
                    <?php echo $nf_user[$i]['milestoneTitle']; ?> status was updated in goal <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $id; ?>/<?php echo $nf_user[$i]['goalId']; ?>"><?php echo $nf_user[$i]['goalTitle']; ?> </a><br>
                  </span>
                  <span class="box-time">
                    <?php echo $nf_user[$i]['date']; ?>
                  </span>
                </div>
              </div>
                <div class="row valign-wrapper">
                  <div class="col s12 center align">
                    <span class="box-content">
                      <b>Milestone title:</b> <?php echo $nf_user[$i]['milestoneTitle']; ?><br>
                      <b>Goal title:</b> <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $id; ?>/<?php echo $nf_user[$i]['goalId']; ?>"><?php echo $nf_user[$i]['goalTitle']; ?></a><br>
                      <b>Goal deadline:</b> <?php echo $nf_user[$i]['goalDeadline']; ?><br>
                      <b>Milestone status:</b> <?php echo ucwords($nf_user[$i]['milestoneStatus']); ?>
                    </span>
                  </div>
                </div>
            </div>
      <?php endif; ?>

      <!-- ----------ADD PICTURE----------- -->
      <?php if($nf_user[$i]['type'] == 4): ?>
          <div class="card-panel grey lighten-5 z-depth-1">
              <div class="row valign-wrapper">
                <div class="col s2">
                  <a href="<?php echo base_url(); ?>goal/view/<?php echo $id; ?>/<?php echo $nf_user[$i]['goalId']; ?>"><img src="<?php echo base_url(); ?>images/<?php echo $nf_user[$i]['categoryPicture']; ?>" class="circle responsive-img z-depth-1"></a>
                </div>
                <div class="col s10">
                  <span class="box-title">
                    A picture was added to <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $id; ?>/<?php echo $nf_user[$i]['goalId']; ?>"><?php echo $nf_user[$i]['goalTitle']; ?> </a><br>
                  </span>
                  <span class="box-time">
                    <?php echo $nf_user[$i]['date']; ?>
                  </span>
                </div>
              </div>
              <div class="row valign-wrapper">
                  <div class="col s12 center align">
                    <span class="box-content">
                      <b>Goal title:</b> <a class="dark-primary-text" href="<?php echo base_url(); ?>goal/view/<?php echo $id; ?>/<?php echo $nf_user[$i]['goalId']; ?>"><?php echo $nf_user[$i]['goalTitle']; ?></a><br>
                      <b>Goal deadline:</b> <?php echo $nf_user[$i]['goalDeadline']; ?><br>
                    </span>
                  </div>
                </div>
                <div class="row valign-wrapper">
                  <div class="col s12 center-align">
                    <img src="<?php echo base_url(); ?>images/goals/<?php echo $nf_user[$i]['pictureName']; ?>" class="responsive-img">
                  </div>
                </div>
            </div>
      <?php endif; ?>


      <!-- ----------FOLLOWING----------- -->

      <?php if($nf_user[$i]['type'] == 5): ?>
          <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row valign-wrapper">
                  <div class="col s2">
                    <img src="<?php echo base_url(); ?>images/users/<?php echo $nf_user[$i]['userPicture']; ?>" class="circle responsive-img z-depth-1">
                  </div>
                  <div class="col s10">
                    <span class="box-title">
                      <a href="<?php echo base_url(); ?>user/user_profile/<?php echo $nf_user[$i]['userId']; ?>"><?php echo $nf_user[$i]['userName']; ?></a> started following someone.<br>
                    </span>
                    <span class="box-time">
                      <?php echo $nf_user[$i]['date']; ?>
                    </span>
                  </div>
              </div>

              <div class="row valign-wrapper">
                  <div class="col s4">
                  </div> 
                  <div class="col s4 center align">
                  <a href="<?php echo base_url(); ?>user/user_profile/<?php echo $nf_user[$i]['followingId']; ?>"><img src="<?php echo base_url(); ?>images/users/<?php echo $nf_user[$i]['followingPicture']; ?>" class="circle responsive-img z-depth-1"></a>
                  </div>
                  <div class="col s4">
                  </div>
                </div>

                <div class="row valign-wrapper">
                  <div class="col s12 center align">
                    <span class="box-content">
                      <b><a class="text" href="<?php echo base_url(); ?>user/user_profile/<?php echo $nf_user[$i]['followingId']; ?>"><?php echo $nf_user[$i]['followingName']; ?></a><br>
                    </span>
                  </div>
                </div>
            </div>
      <?php endif; ?>

      <?php 
      endfor; 
      ?>

      <?php if($nf_user==false){ ?>
        You should start making some friends...
      <?php } ?>
    
      </div> <!-- Container2 -->
    </div> <!-- Columna Derecha -->
  </div>  <!-- row general -->  
    
</div> <!-- container -->