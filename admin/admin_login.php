<?php
    // ==========After Email Verification Is Done========
        if(isset($_GET['id']) && $_GET['id']>0){
            echo "<script>
                alert('Congractulation ! Your Email Id sussesfuly Verifed Please Login Now');
            </script>";
        }
    // =======X===After Email Verification Is Done===X====

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

    session_start();
    // ==============Database File Included==============
        require_once '../include.inc/db.inc.php';
    // ==========X===Database File Included===X==========

    // ===========Constant File Include=========
        include_once("../include.inc/constant.php");
    // =======X===Constant File Include===X=====

    // ============Function.inc file include======
        include '../include.inc/function.inc.php';
    // ========X===Function.inc file include==X===

    // =========PHP Mailer file imported for email sending=======
        include('../smtp/PHPMailerAutoload.php');
    // =====X===PHP Mailer file imported for email sending===X===

    // ============Admin Is Login=========
        if(isset($_SESSION['ADMIN_LOGIN'])){
            redirect('index');
        }
    // =======X===Admin Is Login===X=====
    
    // =============Agency Login Functionality============
        $email_id = '';
        $password ='';
        $msg = '';

        if(isset($_POST['submit'])){
            $email_id = mysqli_escape_string($con,$_POST['email']);
            $password = mysqli_escape_string($con,$_POST['password']);
            $password = md5($password);
            $check = mysqli_query($con,"select * from admin where email_id = '$email_id' AND password='$password' AND verification_status='1' AND status='1'");
            $res = mysqli_fetch_assoc($check);
            if(mysqli_num_rows($check)){
                $_SESSION['ADMIN_LOGIN'] = 'yes';
                $_SESSION['ADMIN_NAME'] = $res['agency_name'];
                $_SESSION['ADMIN_ID'] = $res['id'];
                $_SESSION['ADMIN_ROLE'] = $res['role'];
                header('Location:index');
            }else{
                $msg = "<div class='alert alert-warning  alert-dismissible fade show' role='alert'>
                    Please Enter Correct Email Id And Password Or Verify Your Email Id</a>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }
    // =========X===Agency Login Functionality====X========
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ---------Website Fevicon--------- -->
    <!-- <link href="./assets/favicion.png" rel="icon" type="image/x-icon" /> -->
    <!-- ---------------Animation-------------- -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- ---------Boostrap Css CDN--------- -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- ------------External Style Sheet------------- -->
    <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH ?>/style/style.css"/>
    <!-- --------Font Awsome CDN for Icon inseting-------- -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- ----------Title of the website---------- -->
    <title><?php echo ADMIN_PANAL; ?> ~ Agency Login</title>
</head>
<body>
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
                                <li><a class="dropdown-item" href="<?php echo FRONT_SITE_PATH ?>/profile">Profile</a></li>
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
    <!-- ---------------Login Form------------- -->
        <div class="container signup_form mt-4">
            <div class="row heading" data-aos="fade-down">
                <h2>Login Now</h2>
                <p>Login as a travel and car rental agency</p>
            </div>
            <?php echo $msg; ?>
            <div class="row form_body mt-2">
                <div class="col-xl-6 mt-3">
                    <form method="post" action="" data-aos="fade-right">
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">Enter Your Agency Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Enter Your Agency Password</label>
                        </div>
                        <p>Forgot Password ? <a href="<?php echo FRONT_SITE_PATH ?>/admin/forgot_password">Here</a></p>
                        <div class="contact_subit_btn mt-3 mb-3">
                            <button type="submit" name="submit" class="btn">LogIn Now</button>
                        </div>
                        <p style="  text-align: center;">You are Not Signup,Please <a href="<?php echo FRONT_SITE_PATH; ?>/admin/admin_registration?a=8">SignUp Here</a></p>
                    </form>
                </div>
            </div>
        </div>
    <!-- ----------X----Login Form---X--------- -->
    
    <!-- ----------------Footer------------- -->
        <div class="container-fluid footer mt-5">
            <div class="row">
                <div class="col-xl-3 footer_social">
                    <div class="footer_logo">
                        <a href="<?php echo FRONT_SITE_PATH ?>?a=1"><img src="<?php echo FRONT_SITE_PATH ?>/assets/logo.png" alt=""></a>
                    </div>
                    <div class="footer_paragraph">
                        <p>We provide the best services regarding tours, travel, and also car rental services in Jalgaon.</p>
                    </div>
                    <div class="social_icons">
                        <ul>
                            <li>
                                <a href="<?php echo FRONT_SITE_PATH ?>?a=1"><i class="fa-brands fa-youtube"></i></a>
                            </li>
                            <li>
                                <a href="<?php echo FRONT_SITE_PATH ?>?a=1"><i class="fa-brands fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="<?php echo FRONT_SITE_PATH ?>?a=1"><i class="fa-brands fa-facebook-f"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 footer-links">
                    <h3>Quick Links</h3>
                    <div class="links">
                        <ul>
                            <li>
                                <a href="<?php echo FRONT_SITE_PATH ?>?a=1">Home</a>
                            </li>
                            <li>
                                <a href="<?php echo FRONT_SITE_PATH ?>/about?a=2">About Us</a>
                            </li>
                            <li>
                                <a href="<?php echo FRONT_SITE_PATH ?>/product?a=3">Tour Pakages</a>
                            </li>
                            <li>
                                <a href="<?php echo FRONT_SITE_PATH ?>/carrentals?a=4">Car Rentals</a>
                            </li>
                            <li>
                                <a href="<?php echo FRONT_SITE_PATH ?>/contact?a=6">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 footer-links">
                    <h3>Useful Links</h3>
                    <div class="links">
                        <ul>
                            <li>
                                <a href="<?php echo FRONT_SITE_PATH ?>/admin/admin_registration">Register as a travel and car rental agency</a>
                            </li>
                            <li>
                                <a href="<?php echo FRONT_SITE_PATH ?>?a=1">Terms and Conditions</a>
                            </li>
                            <li>
                                <a href="<?php echo FRONT_SITE_PATH ?>?a=1">Disclaimer</a>
                            </li>
                            <li>
                                <a href="<?php echo FRONT_SITE_PATH ?>?a=1">Support</a>
                            </li>
                            <li>
                                <a href="<?php echo FRONT_SITE_PATH ?>?a=1">FAQ</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 footer-contact">
                    <h3>Contact With Us</h3>
                    <div class="footer-contact-links">
                        <ul>
                            <li>
                            <span><i class="fa-solid fa-envelope"></i></span> tour@tourmanagment.com
                            </li>
                            <li>
                                <span><i class="fa-solid fa-phone"></i> +91-8668999010 | +91-7738356714</span>
                            </li>
                            <li>
                                <span><i class="fa-solid fa-location-dot"></i></span>Traval & Tour Managment System<br> SSBT COET, Jalgaon, Maharastra 425002
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row developer">
                <div class="col-xl-12">
                    <p>Traval & Tour Managment System © 2022</p>
                    <p id="name"><span>Designed By </span> ~ <a target="_blank" href="https://pruthvirajrajput.great-site.net/">Pruthviraj Rajput</a></p>
                </div>
            </div>
        </div>
    <!-- -------------X---Footer---X---------- -->

    <!-- ---------Bootstrap Bundle with Popper CDN is include--------- -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- ------------------External Script Link---------- -->
    <script src="./js/script.js"></script>
    <!-- --------AOC  Script------- -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            offset: 150,
            duration: 1000,
        });
    </script>
</body>
</html>
</body>
</html>
