<html>
    <head>
        <meta charset="utf-8">
        <title>StoneSteps</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="theme-color" content="#333333">

		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/colors.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>css/materialize.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>css/styles.css" rel="stylesheet" type="text/css">

    </head>

	<body <?php //if($content == 'login') echo 'class="login"'; else if($content == 'signup') echo 'class="signup"'; ?>>
    
    <?php if($content != 'login' && $content != 'signup'): ?>
        <div class="navbar-fixed z-depth-1">
		 <nav role="navigation">
          <div class="nav-wrapper container">
            <a href="index.php" class="brand-logo"><b>Stone</b>Steps</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
              <li><form>
		        <div class="input-field">
		          <input id="search" type="search" required>
		          <label for="search"><i class="material-icons">search</i></label>
		          <i class="material-icons">close</i>
		        </div>
		      </form></li>
		      <li class="user-name"><a href="badges.html">Itzel Bareño</a></li>
		      <li><img class="circle responsive-img user-profile" src="http://placehold.it/50/0/eeeeee"></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
            	<div class="row">
            		<div class="col s12">
			          	<li><form>
		                    <a href="#">
		                    	<div class="input-field">
			                        <input id="search" type="search" placeholder="Search">
			                        <label for="search"><i class="material-icons">search</i></label>
					          		<i class="material-icons">close</i>
				          		</div>
		                    </a>
		                </form></li>
	            	</div>
            	</div>

                <div class="row valign-wrapper">
                	<div class="col s3 offset-s1">
                		<img class="circle responsive-img" src="http://placehold.it/50/0/eeeeee">
                	</div>
                	<div class="col s8">
                		<span class="box-title"><a href="#">Itzel Bareño</a></span>
                	</div>
            	</div>
            </ul>
          </div>
        </nav>
    </div>
    <?php endif; ?>

