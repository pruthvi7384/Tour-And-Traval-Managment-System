<?php
    // ============Include Header Components==========
        include('components/header.php');
    // ========X====Include Header Components===X======

    // =============Include NavBar Component===========
        include('components/NavBar.php');
    // =======X====Include NavBar Component====X=======

    // ==========Php Variable Declartion===========
        $name ='';
        $email_id ='';
        $subject ='';
        $message ='';
        $type = '';
        $msg='';
    // =======X===Php Variable Declartion===X=======

    // ==========If user is login============
        if(isset($_SESSION['USER_LOGIN'])){
            $user_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM user WHERE id='".$_SESSION['USER_ID']."'")) ;
            $name = $user_data['name'];
            $email_id = $user_data['email_id'];
        }
    // ======X===If user is login===X========

    // ==========Send Email Or Contact Form Data Reciving==========
        if(isset($_POST['submit'])){
            $name = mysqli_escape_string($con,$_POST['name']);
            $email_id = mysqli_escape_string($con,$_POST['email']);
            $subject = mysqli_escape_string($con,$_POST['subject']);
            $message = mysqli_escape_string($con,$_POST['message']);
            
            mysqli_query($con,"INSERT INTO contact(name,email_id,subject,message) VALUES('$name','$email_id','$subject','$message')");
        
            $html="
                <h2 style=' text-align: center; color: #253745'><b style='color: #3fc8fd'>$name</b> Thank You ! <br> For Connecting With Us , Will Get Back To You Shortly !</h2>
            ";

            send_email($email_id,$html,'TMS ~ Contact');

            $msg = "<div class='text-center alert alert-info alert-dismissible fade show' role='alert'>
                    <strong>Thank You <strong> For Connecting With Us , Will Get Back To You Shortly !
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    // =====X===Send Email Or Contact Form Data Reciving====X======

    // ==========Featch All Packages Details=======
        $res = mysqli_query($con,"SELECT * FROM tourpackages WHERE status='1' ORDER BY added_on DESC");
    // =====X====Featch All Packages Details===X===

    // ==========Featch All Packages Details=======
         $res_car = mysqli_query($con,"SELECT * FROM carrentals WHERE status='1'");
    // =====X====Featch All Packages Details===X===
?>
<!-- --------------Home Page------------- -->
   <!-- -------------Home Baner------------- -->
        <div class="container-fluid home_banner">
            <div class="row p-3">
                <div class="col-xl-6 p-2" data-aos="fade-right">
                    <h1>Tours And Traval <span>Managment</span> System</h1>
                    <p>We provide the best services regarding tours , travel, and also car rental services in Jalgaon.</p>
                    <a href="<?php echo FRONT_SITE_PATH ?>/about?a=2"><button type="button" name="submit" class="btn">Read More...</button></a>
                </div>
                <div class="col-xl-4 text-center p-2" data-aos="fade-left">
                    <img class="img-responsive img-fluid"  src="<?php echo FRONT_SITE_PATH ?>/assets/about.png" alt="">
                </div>            
            </div>
        </div>
    <!-- ----------X---Home Baner---X---------- -->

    <!-- --------------Fetures------------ -->
        <div class="container-fluid mt-4 home_fetures">
            <div class="row heading" data-aos="fade-up">
                <h3>Features</h3>
                <p>Features of our TMS</p>
            </div>
            <div class="row fetures_cards mt-2">
                <div class="col-xl-2 feture_card" data-aos="fade-right" >
                    <i class="icon fa-brands fa-etsy"></i>
                    <h6>EASY TO USE</h6>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                </div>
                <div class="col-xl-2 feture_card" data-aos="fade-right">
                    <i class="icon fa-solid fa-c"></i>
                    <h6>MULTIPLE CHOOSES</h6>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                </div>
                <div class="col-xl-2 feture_card"  data-aos="fade-right">
                    <i class="icon fa-solid fa-o"></i>
                    <h6>ONLINE PAYMENT</h6>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                </div>
                <div class="col-xl-2 feture_card" data-aos="fade-right">
                    <i class="icon fa-solid fa-s"></i>
                    <h6>ENQUIRY / CONTACT SUPPORT</h6>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                </div>
            </div>
        </div>
    <!-- --------------Fetures------------ -->

    <!-- -----------------Sub Banner-------------- -->
        <div class="container-fluid home_sub_Banner mt-4 p-5">
            <div class="row" data-aos="fade-right">
                <h1>Every <span>Traval and Car Rental </span> Agency Moved Online, why not you?</h1>
                <p>In case your agency joins us please click the below button for registration.</p>
                <a href="<?php echo FRONT_SITE_PATH ?>/admin/admin_registration?a=7"><button type="button" name="submit" class="btn">Join As A Agency</button></a>
            </div>
        </div>
     <!-- ------------X---Sub Banner---X----------- -->

    <!-- --------------Tour Packages------------ -->
       <div class="container-fluid mt-4 home_fetures">
            <div class="row heading" data-aos="fade-up">
                <h3>Tour Packages</h3>
                <p>Recently Added Tour Packages</p>
            </div>
        </div>
        <div class="container tour_packages mt-2">
            <div class="row tour_packages_row">
                <?php
                    if(mysqli_num_rows($res)>0){
                        $i=1;
                        while($row=mysqli_fetch_assoc($res)){
                            if($i > 7){
                                break;
                            }
                ?>
                    <div class="col-xl-4 tour_package_card"  data-aos="fade-left">
                        <img src="<?php echo SITE_TOUR_IMAGE.$row['PackageImage']?>" alt="">
                        <div class="tour_details">
                            <h2 id="h2"><?php echo $row['PackageName'] ?></h2>
                            <h3 id="h3"><?php echo $row['PackageType'] ?></h3>
                            <h4 id="h4"><?php echo $row['PackageLocation'] ?></h4>
                            <h5 id="h5"><?php 
                                    $dateStr=strtotime($row['start_date']);
                                    echo date('d-m-Y',$dateStr);
                                ?> <span>To</span> 
                                <?php 
                                    $dateStr=strtotime($row['end_date']);
                                    echo date('d-m-Y',$dateStr);
                                ?>
                            </h5>
                            <h6 id="h6">&#8377; <span> <?php echo $row['PackagePrice'] ?>/-</span></h6>
                        </div>
                        <div class="tour_footer">
                            <ul>
                                <li><span><i class="fas fa-umbrella-beach"></i> </span> <?php echo $row['agency_name'] ?></li>
                                <li><span><i class="fas fa-comments"></i> </span> 
                                    <?php 
                                        // ===========Comment Featch Functionality========
                                            $sql_comment = mysqli_query($con,"SELECT * FROM comments_tour WHERE tour_package_id='".$row['id']."'");
                                            $comment_rows = mysqli_num_rows($sql_comment); 
                                        // ========X===Comment Featch Functionality===X====
                                        if($comment_rows < 10){ 
                                            echo '0'.$comment_rows;
                                        }else{
                                            echo $comment_rows;
                                        }
                                    ?>
                                </li>
                                <li><a href="<?php echo FRONT_SITE_PATH ?>/tourpackagedetaile?a=3&id=<?php echo $row['id'] ?>"><button class="btn">More Details</button></a></li>
                            </ul>
                        </div>
                    </div>
                <?php
                    $i++;
                    } } else { ?>
                    <div class="col-xl-12">
                        <p style="text-align: center; color: red; font-weight: bold;" >No Tour Packages found</td>
                    </div> 
                <?php } ?>
            </div>
            <div class="row see_more mt-3">
                <div class="col-xl-12 text-center">
                    <a href="<?php echo FRONT_SITE_PATH ?>/tourpackages?a=3"><button data-aos="fade-right" class="btn">See More..</button></a>
                </div>
            </div>
        </div>
    <!-- ------------X--Tour Packages---X---------------- -->

    <!-- ------------------Car Rentals----------------- -->
        <div class="container-fluid mt-4 home_fetures">
            <div class="row heading" data-aos="fade-up">
                <h3>Car Rentals</h3>
                <p>Recently Added Car Rental</p>
            </div>
        </div>
        <div class="container tour_packages mt-2">
            <div class="row tour_packages_row">
                <?php
                    if(mysqli_num_rows($res_car)>0){
                        $i = 1;
                        while($row_car=mysqli_fetch_assoc($res_car)){
                            if($i > 7){
                                break;
                            }
                ?>
                    <div class="col-xl-4 tour_package_card"  data-aos="fade-left">
                        <img src="<?php echo SITE_RENTAL_IMAGE.$row_car['image']?>" alt="">
                        <div class="tour_details">
                            <h2 id="h2"><?php echo $row_car['vehicle_name'] ?></h2>
                            <h3 id="h3"><?php echo $row_car['vehical_type'] ?></h3>
                            <h4 id="h4"><?php echo $row_car['location'] ?></h4>
                            <h6 id="h6">&#8377; <span> <?php echo $row_car['vehical_rental_price'] ?>/-</span> <b style="font-size:20px">Per Day</b></h6>
                        </div>
                        <div class="tour_footer">
                            <ul>
                                <li><span><i class="fas fa-umbrella-beach"></i> </span> <?php echo $row_car['company_name'] ?></li>
                                <li><span><i class="fas fa-comments"></i> </span> 
                                    <?php 
                                        // ===========Comment Featch Functionality========
                                            $sql_comment_car = mysqli_query($con,"SELECT * FROM comment_rental WHERE rental_id='".$row_car['id']."'");
                                            $comment_rows_car = mysqli_num_rows($sql_comment_car); 
                                        // ========X===Comment Featch Functionality===X====
                                        if($comment_rows_car < 10){ 
                                            echo '0'.$comment_rows_car;
                                        }else{
                                            echo $comment_rows_car;
                                        }
                                    ?>
                                </li>
                                <li><a href="<?php echo FRONT_SITE_PATH ?>/carrentaildetaile?a=4&id=<?php echo $row_car['id'] ?>"><button class="btn">More Details</button></a></li>
                            </ul>
                        </div>
                    </div>
                <?php
                    $i++;
                    } } else { ?>
                    <div class="col-xl-12">
                        <p style="text-align: center; color: red; font-weight: bold;" >No Car & Bike Rental found</td>
                    </div> 
                <?php } ?>
            </div>
            <div class="row see_more mt-3">
                <div class="col-xl-12 text-center">
                    <a href="<?php echo FRONT_SITE_PATH ?>/carrentals?a=4"><button data-aos="fade-right" class="btn">See More..</button></a>
                </div>
            </div>
        </div>
    <!-- ------------X-----Car Rentals----X----------- -->

    <!-- ----------------Contact Us---------- -->
        <div class="container-fluid mt-4 home_fetures">
            <div class="row heading" data-aos="fade-up">
                <h3>Get In Touch</h3>
                <p>Any Query Contact Now !</p>
            </div>
        </div>
        <div class="container mt-4 contact_form">
            <div class="row">
                <?php echo $msg; ?>
            </div>
            <div class="row contact_body">
                <div class="col-xl-6 contact_detaile">
                    <div class="contact_location" data-aos="fade-right">
                        <i class="fa-solid fa-location-dot"></i>
                        <p>Traval & Tour Managment System<br> SSBT COET, Jalgaon, Maharastra 425002</p>
                    </div>
                    <div class="other_contact">
                        <div class="contact_no" data-aos="fade-right">
                            <i class="fa-solid fa-phone"></i>
                            <p>+91-8668999010 | +91-7738356714</p>
                        </div>
                        <div class="contact_no" data-aos="fade-right">
                            <i class="fa-solid fa-envelope"></i>
                            <p>tour@tourmanagment.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 contact_form_body" data-aos="fade-left">
                    <form method="post" action="">
                        <div class="form-floating mb-3">
                            <input type="text" value="<?php echo $name ?>" name="name" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">Enter Your Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" value="<?php echo $email_id ?>" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">Enter Your Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="subject" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Enter Your Subject</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="message" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 150px" required></textarea>
                            <label for="floatingTextarea2">Enter Your Message</label>
                        </div>
                        <div class="contact_subit_btn mt-3">
                            <button type="submit" name="submit" class="btn">Contact Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- ---------X------Contact Us-----X---- -->

<!-- ---------X----Home Page---X--------- -->

   

<?php
    // ============Include Footer Components==========
        include('components/footer.php');
    // ============Include Footer Components==========
?>