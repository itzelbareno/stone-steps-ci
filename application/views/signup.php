  <div class="containerfull login-signup">
    <br><br>
    <h1 class="header center white-text brand-logo-main col s12"><b>Stone</b>Steps</h1>
    <br><br>
  </div>

  <div class="container">
    <div class="row center">
      <h5 class="header col s12 secondary-text">Don't mistake activity with achievement.</h5>
      <h6 class="header col s12 secondary-text light">John Wooden</h6>
    </div>

    <div class="row center">
      <?php 
        if (isset($_SESSION['error-user']))
          echo "Error: ".$_SESSION['error-user']['error']; 
      ?>
    </div>
    
    <div class="row">
      <!-- Empieza Segunda Columna -->
      <form  method="post" enctype="multipart/form-data" onsubmit="return checkPasswords()" action="<?php echo base_url(); ?>signup/receiveData" class="col s12 m6 push-m5 l5 push-l5" id="signupForm">
        
        <div class= "row">
          <div class="input-field secondary-text col s6">
            <input name="first_name" id="first_name" type="text" class="validate" required>
            <label for="first_name" class ="secondary-text">First Name</label>
          </div>
        
          <div class="input-field secondary-text col s6">
            <input name="middle_name" id="middle_name" type="text" class="validate">
            <label for="middle_name" class ="secondary-text">Middle Name</label>
          </div>
        </div>
    
        <div class= "row"> 
          <div class="input-field secondary-text">
            <input name="last_name" id="last_name" type="text" class="validate" required>
            <label for="last_name" class ="secondary-text">Last Name</label>
          </div>
        </div>
      
        <div class="row">
          <div class="input-field secondary-text">
            <input name="email" id="email" type="email" class="validate" required>
            <label for="email" class ="secondary-text">Email</label>
          </div>
        </div>
      
        <div class="row ">
          <div class="input-field secondary-text col s6">
            <input name="password" id="password" type="password" class="validate" required>
            <label for="password" class ="secondary-text">Password</label>
          </div>
      
          <div class="input-field secondary-text col s6">
            <input name="confirm_password" id="confirm_password" type="password" class="validate" required>
            <label for="password" class ="secondary-text">Confirm Password</label>
          </div>
        </div>
      </form>
      <!-- Termina Segunda Columna -->
  
      <!-- Empieza Primera Columna -->
      <div class="col s12 center m5 pull-m6 l4 pull-l4">
        <div class="row">
          <img  class="user" id="imagen_m" src="images/users/avatar.png">
        </div>
        <div class="row col s8 offset-s2 m12">
          <div class="file-field input-field">
            <div class="btn waves-effect dark-primary waves-light">
              <span><i class="material-icons ">perm_media add</i></span>
              <input type="file" form="signupForm" name="picture" onchange="document.getElementById('imagen_m').src = window.URL.createObjectURL(this.files[0])">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" placeholder="Upload Goal Photo">
            </div>
          </div>
        </div> 
      </div>  
      <!-- Termina Primera Columna -->


    </div> <!-- Row de Formulario/Foto -->
    
    <!-- Botones SignUp / Cancel --> 
    <div class="row">
      <div class="col center s12">
        <input type="submit" form="signupForm" id="signin-button" class="btn-main accent" value="Sign Up">
       </div>
    </div>
    
    <div class="row">
      <div class="col center s12">
        <a href="<?php echo base_url(); ?>" id="cancel-button" class="btn-main divider-back">
          Cancel
        </a>
      </div>
    </div>
      
  </div> <!-- Termina Container -->