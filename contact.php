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
?>

    <div class="container mt-4 contact_form">
        <div class="row heading" data-aos="fade-down">
            <h2>Get In Touch</h2>
            <p>Any Query Contact Now !</p>
        </div>
    </div>
    <!-- ---------------Contact Us Form----------- -->
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
    <!-- -----------X----Contact Us Form-----X------ -->
<?php
    // ============Include Footer Components==========
        include('components/footer.php');
    // =========X===Include Footer Components===X=======
?>