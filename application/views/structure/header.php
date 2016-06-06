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

    <body>
    
    <?php if($content != 'login' && $content != 'signup'): ?>
        <ul id="dropdown1" class="dropdown-content">
            <li><a class="dark-primary-text" href="<?php echo base_url(); ?>following">Following</a></li>
            <li><a class="dark-primary-text" href="<?php echo base_url(); ?>goal">+ Goal</a></li>
            <li class="divider"></li>
            <li><a class="dark-primary-text" href="<?php echo base_url(); ?>logout">Log Out</a></li>
        </ul>

        <div class="navbar-fixed z-depth-1">
         <nav role="navigation">
          <div class="nav-wrapper container">
            <a href="<?php echo base_url(); ?>" class="brand-logo"><b>Stone</b>Steps</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            
            <ul class="right hide-on-med-and-down">
              <li><form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>search/">
                <div class="input-field">
                  <input name="name" id="search" type="search" required>
                  <label for="search"><i class="material-icons">search</i></label>
                  <i class="material-icons">close</i>
                </div>
              </form></li>
              <li class="user-name"><a href="<?php echo base_url(); ?>user"><?php echo $_SESSION['user']['firstName'];?></a></li>
              <li><img class="circle responsive-img user-profile" src="<?php echo base_url(); ?>images/users/<?php echo $_SESSION['user']['picture']; ?>"></li>
              <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="large material-icons">arrow_drop_down</i></a></li>
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
                        <img class="circle responsive-img" src="<?php echo base_url(); ?>images/users/<?php echo $_SESSION['user']['picture']; ?>">
                    </div>
                    <div class="col s8">
                        <span class="box-title"><a href="#"><?php echo $_SESSION['user']['firstName']?></a></span>
                    </div>
                </div>


                <div class="row">
                    <div class="col s3 offset-s1">
                        <span class="text"><i class="material-icons">supervisor_account</i></span>
                    </div>
                    <div class="col s8">
                        <span class="box-title"><a href="<?php echo base_url(); ?>following">Following</a></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col s3 offset-s1">
                        <span class="text"><i class="material-icons">add</i></span>
                    </div>
                    <div class="col s8">
                        <span class="box-title"><a href="<?php echo base_url(); ?>goal">Add a goal</a></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col s3 offset-s1">
                        <span class="text"><i class="material-icons">lock</i></span>
                    </div>
                    <div class="col s8">
                        <span class="box-title"><a href="<?php echo base_url(); ?>logout">Log Out</a></span>
                    </div>
                </div>


            </ul>
          </div>
        </nav>
    </div>
    <?php endif; ?>
