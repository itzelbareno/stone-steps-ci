<div class="container">
    <br><br>
    
    <div class="row">  
      <div class = "col s12 m4 center"><!--Columna Izquierda-->
        <div class="container-90">
        <div class="row">
          <img class="materialboxed user" src="<?php echo base_url();?>images/users/<?php echo $picture;?>">
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
        
        <div class="row">
            <div class="collection left-align">
              <?php if( $_SESSION['user']['id'] == $id ) { ?>
                <a href="#modal1" class="collection-item waves-effect waves-light modal-trigger data-target=modal1">
                  <div class="col s12 center">
                    <a href="<?php echo base_url(); ?>goal"><span class="secondary-text">Add new goal</span></a>
                  </div>
                </a>
              <?php
              }
              ?>
              
              <?php 
                for($i=0; $i<sizeof($listGoals);$i++): ?>
                  <a href="#modal1" class="collection-item waves-effect waves-light modal-trigger data-target=modal1">
                    <div class="col s9">
                      <span class="text"><?php echo $listGoals[$i]['title']; ?></span>
                    </div>
                    <div class="col s3">
                      <?php 
                        switch($listGoals[$i]['statusId'])
                        {
                          case 2:?>
                            <span class="badge text">Pending</span><?php
                            break;
                          case 3:?>
                            <span class="badge accent-text">Completed</span><?php
                            break;
                        }?>                      
                    </div>
                  </a>
              <?php endfor; ?>
              
            </div>
          </div>
        </div>
      </div>
      
      
      <div class="col s12 m8"><!--Columna Derecha-->
        <div class="container">
        <div class="row">
          <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row valign-wrapper">
                  <div class="col s2">
                    <img src="<?php echo base_url();?>images/knowledge.png" class="image-card">
                  </div>
                  <div class="col s10">
                    <span class="box-title">
                      <a href="#">Graduarme summa cum laude </a>was added.<br>
                    </span>
                  </div>
              </div>
                <div class="row valign-wrapper">
                  <div class="col s12">
                    <span class="box-content">
                      <a href="#">Deadline: Thursday, June 30, 2016</a><br>
                      Según mi promedio, puedo graduarme con mérito académico pero debo mantener el promedio por lo que queda del semestre. Así que debo mantener un promedio final de al menos 98.
                    </span>
                  </div>
                </div>
            </div>
        </div>
        
        <div class="row">
          <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row valign-wrapper">
                  <div class="col s2">
                    <img src="<?php echo base_url();?>images/personal.png" class="image-card">
                  </div>
                  <div class="col s10">
                    <span class="box-title">
                      <a href="#">Leer 12 libros en un año</a> was updated. <br>
                    </span>
                  </div>
              </div>
                <div class="row valign-wrapper">
                  <div class="col s12">
                    <span class="box-content">
                      <a href="#">Deadline: Saturday, December 31, 2016</a><br>
                      Quiero leer al menos 12 libros en un año. Con suerte, espero leer al menos un libro por mes..<br>
                    </span>
                  </div>
                </div>
            </div>
        </div>
        
        <div class="row">
          <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row valign-wrapper">
                  <div class="col s2">
                    <img src="<?php echo base_url();?>images/sports.png" class="image-card">
                  </div>
                  <div class="col s10">
                    <span class="box-title">
                      <a href="#">Levantar 20lb de brazo</a> was accomplished.<br>
                    </span>
                  </div>
              </div>
                <div class="row valign-wrapper">
                  <div class="col s12">
                    <span class="box-content">
                      <a href="#">Date Accomplished: Friday, May 20, 2016</a><br>
                      Deadline: Saturday, May 21, 2016<br><br>
                      Estaré entrenando brazo, y mi meta es llegar a levantar 20 lb, actualmente solamente levanto 10 lb y espero aumentar este peso con el tiempo.
                    </span>
                  </div>
                </div>
            </div>
        </div> 
        
          
      </div> <!-- segunda columna -->
      </div>
    </div>  <!-- row general -->  
    
  </div> <!-- container -->