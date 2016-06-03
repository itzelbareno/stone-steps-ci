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
    
    <div class="row">
      
      <form method ="post" action="<?php echo base_url(); ?>login/receiveData" id="loginForm">
        
        <div class="col s8 offset-s2 m6 offset-m3 l4 offset-l4">
          <?php 
            if (isset($_SESSION['error-user']))
              echo "Error: ".$_SESSION['error-user']['error'];
          ?>
          <div class="input-field secondary-text">
            <input name="emai" type="email" class="validate" value="<?php if(isset($_SESSION['error-user'])) echo $_SESSION['error-user']['email']; ?>" required>
            <label for="email" class ="secondary-text">Email</label>
          </div>
        </div>
        
        <div class="row col s8 offset-s2 m6 offset-m3 l4 offset-l4">
          <div class="input-field secondary-text">
            <input name="password" type="password" class="validate" required>
            <label for="password" class ="secondary-text">Password</label>
          </div>
        </div>
                
      </form>
      
      <div class="row">
        <input type="submit" form="loginForm" id="login-button" class="btn-main accent col s8 offset-s2 m6 offset-m3 l4 offset-l4" value="Log In">   
      </div>
      <div class="row">
        <a href="<?php echo base_url(); ?>signup" id="signin-button" class="btn-main dark-primary col s8 offset-s2 m6 offset-m3 l4 offset-l4">Sign Up</a>
      </div>
    </div>
  </div> <!-- container -->
