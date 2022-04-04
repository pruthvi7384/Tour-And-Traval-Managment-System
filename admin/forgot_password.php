<?php
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

    // ============Forgot Password Link Send Email Id================
        $email = '';
        $msg='';
        if(isset($_POST['submit'])){
            $email = mysqli_escape_string($con,$_POST['email']);
            $check = mysqli_query($con,"SELECT * FROM admin WHERE email_id='$email'");

            if(mysqli_num_rows($check)==0){
                $msg = "<div class='alert alert-warning  alert-dismissible fade show' role='alert'>
                            You Are Not Register Please <a href='admin_registration'> SIGNUP NOW </a>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
            }else{
                $sql = mysqli_fetch_assoc($check);
                $id= $sql['id'];
                $html=FRONT_SITE_PATH."/admin/update_password?id=".$id;
                send_email($email,$html,'TMS (Agency) ~ Forgot Password');
                echo "<script>
                        alert('Forget Password Link Shared Your Email Id ');
                    </script>";
            }
        }
    // ========X====Forgot Password Link Send Email Id====X============
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
    <title><?php echo SITE_NAME; ?> ~ Agency Forgot Password</title>
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
 
    <!-- ---------------Forgot Password Form------------- -->
        <div class="container signup_form mt-4">
            <div class="row heading" data-aos="fade-down">
                <h2>Forgot Password</h2>
                <p>Forgot your password</p>
            </div>
            <?php echo $msg; ?>
            <div class="row form_body mt-2">
                <div class="col-xl-6 mt-3">
                    <form method="post" action="" data-aos="fade-right">
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">Enter Your Email Id for Forgot Password </label>
                        </div>
                        <div class="contact_subit_btn mt-3">
                            <button type="submit" name="submit" class="btn">Send Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- ----------X----Forgot Password Form---X--------- -->

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