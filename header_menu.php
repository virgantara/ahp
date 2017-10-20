<header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo $baseurl;?>/index.php" class="navbar-brand"><b>AHP</b>Cloud Services</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo $baseurl;?>/index.php">Home <span class="sr-only">(current)</span></a></li>
            <!-- <li></li> -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo $baseurl;?>/cloudharmony.php">Cloud Harmony</a></li>
                <li><a href="<?php echo $baseurl;?>/chsvc.php">Cloud Harmony Services</a></li>
                <li><a href="<?php echo $baseurl;?>/chava.php">Cloud Harmony Availability</a></li>
                <li><a href="#">Criteria</a></li>
                <li><a href="<?php echo $baseurl;?>/provider.php">Provider</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo $baseurl;?>/admin.php">Base URL</a></li>
                
                <!-- <li class="divider"></li>
                <li><a href="#">One more separated link</a></li> -->
              </ul>
            </li>
          </ul>
          <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
            </div>
          </form>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            
         
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <!-- <img src="<?php echo $baseurl;?>/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <!-- <span class="hidden-xs">Alexander Pierce</span> -->
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <!-- <li class="user-header">
                  <img src="<?php echo $baseurl;?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                  <p>
                    Alexander Pierce - Web Developer
                    <small>Member since Nov. 2012</small>
                  </p>
                </li> -->
                <!-- Menu Body -->
                <!-- <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </div>
                   /.row 
                </li> -->
                <!-- Menu Footer-->
               <!--  <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li> -->
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>