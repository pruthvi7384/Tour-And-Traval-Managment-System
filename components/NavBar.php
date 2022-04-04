<?php
    // ========Navbar Active Coding Here=========
        $nav_id = '';
        if(isset($_GET['a'])){
            $nav_id = $_GET['a'];
        }else{
          $nav_id = "";
        }
        if($nav_id=='' || $nav_id=='1'){
          $classAc1='active';
        }elseif($nav_id=='2'){
          $classAc2='active';
        }elseif($nav_id=='3'){
          $classAc3='active';
        }elseif($nav_id=='4'){
          $classAc4='active';
        }elseif($nav_id=='5'){
          $classAc5='active';
        }elseif($nav_id=='6'){
          $classAc6='active';
        }elseif($nav_id=='7'){
          $classAc7='active';
        }elseif($nav_id=='8'){
          $classAc8='active';
        }
    // ======X==Navbar Active Coding Here==X=======
?>

<!-- ----------------------------  Navigation ---------------------------------------------- -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo FRONT_SITE_PATH ?>?a=1">
              <img src="<?php echo FRONT_SITE_PATH ?>/assets/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse nav_menu navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link <?php echo $classAc1 ?>" href="<?php echo FRONT_SITE_PATH ?>?a=1">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link <?php echo $classAc2 ?>" href="<?php echo FRONT_SITE_PATH ?>/about?a=2">About Us</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link <?php echo $classAc3 ?>" href="<?php echo FRONT_SITE_PATH ?>/tourpackages?a=3">Tour Pakages</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link <?php echo $classAc4 ?>" href="<?php echo FRONT_SITE_PATH ?>/carrentals?a=4">Car Rentals</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link <?php echo $classAc6 ?>" href="<?php echo FRONT_SITE_PATH ?>/contact?a=6">Contact Us</a>
                    </li>
                    <?php if(!isset($_SESSION['USER_LOGIN'])){?>
                      <li class="nav-item">
                        <a class="nav-link <?php echo $classAc7 ?>" href="<?php echo FRONT_SITE_PATH ?>/signup?a=7">Sign Up</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link <?php echo $classAc8 ?>" href="<?php echo FRONT_SITE_PATH ?>/login?a=8">Log In</a>
                      </li>
                    <?php }else{?>
                      <li>
                          <div class="dropdown">
                            <a class="nav-link active" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                              Welcome <b style="color: #253745"><?php echo $_SESSION['USER_NAME']; ?></b> <span><i class="fas fa-caret-down"></i></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              <li><a class="dropdown-item" href="<?php echo FRONT_SITE_PATH ?>/tourpackageshistory">Tour Packages History</a></li>
                              <li><a class="dropdown-item" href="<?php echo FRONT_SITE_PATH ?>/carrentalhistory">Car Rentals History</a></li>
                              <li><a class="dropdown-item" href="<?php echo FRONT_SITE_PATH ?>/logout">LogOut</a></li>
                            </ul>
                          </div>
                      </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </nav>
<!-- ------------x---------------  Navigation --------------------------x------------------- -->