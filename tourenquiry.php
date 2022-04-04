<?php
    // ============Include Header Components==========
        include('components/header.php');
    // ========X====Include Header Components===X======

    // =============Include NavBar Component===========
        include('components/NavBar.php');
    // =======X====Include NavBar Component====X=======

    // =========Enquiry Data Submit==========
        $tour_id = '';
        $name = '';
        $email_id = '';
        $subject = '';
        $message = '';
        $msg ='';
        $tourname = '';
        $admin_id = '';
        // ==============Get Tour Id From URL============
            if(isset($_GET['id']) && $_GET['id']>0){
                $tour_id=get_safe_value($_GET['id']);
                $row=mysqli_fetch_assoc(mysqli_query($con,"select * from tourpackages where id='$tour_id'"));
                $tourname = $row['PackageName'];
                $admin_id = $row['admin_id'];
            }   
        // =========X====Get Tour Id From URL====X========

        // ==========If user is login============
            if(isset($_SESSION['USER_LOGIN'])){
                $user_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM user WHERE id='".$_SESSION['USER_ID']."'")) ;
                $name = $user_data['name'];
                $email_id = $user_data['email_id'];
            }
        // ======X===If user is login===X========

        if(isset($_POST['submit'])){
            $name = mysqli_escape_string($con,$_POST['name']);
            $email_id = mysqli_escape_string($con,$_POST['email']);
            $subject = mysqli_escape_string($con,$_POST['subject']);
            $message = mysqli_escape_string($con,$_POST['message']);
           
            mysqli_query($con,"INSERT INTO enquiry_tour(tour_id,admin_id,name,email_id,subject,message) VALUES('$tour_id','$admin_id','$name','$email_id','$subject','$message')");

            $html="
                <h2 style=' text-align: center; color: #253745'><b style='color: #3fc8fd'>$tourname</b> Tour Package Enquiry</h2>
                <h3 style=' text-align: center; color: #737A80'><strong>Thank You <strong> For Connecting With Us , Will Get Back To You Shortly !</h3>
            ";

            send_email($email_id,$html,'TMS ~ Tour Package Enquiry');
            $msg = "<div class='text-center alert alert-info alert-dismissible fade     show' role='alert'>
                    <strong>Thank You <strong> For Connecting With Us , Will Get Back To You Shortly !
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
    // =====X===Enquiry Data Submit===X======
?>
<!-- -------------Enquiry Form--------------- -->
    <div class="container signup_form mt-4">
        <div class="row heading" data-aos="fade-down">
            <h2><?php echo $tourname; ?> <span style="color: #253745"> Package Enquiry</span></h2>
            <p>Any Dout's Enquiry Now</p>
        </div>
        <?php echo $msg; ?>
        <div class="row form_body mt-2">
            <div class="col-xl-6 mt-3">
                <form method="post" action="" data-aos="fade-right">
                    <div class="form-floating mb-3">
                        <input type="text" value="<?php echo $name ?>" name="name" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                        <label for="floatingInput">Enter Your Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" value="<?php echo $email_id ?>" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                        <label for="floatingInput">Enter Your Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="subject" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                        <label for="floatingInput">Enter Your Subject</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="message" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 150px" required></textarea>
                        <label for="floatingTextarea2">Enter Your Enquiry Details</label>
                    </div>
                    <div class="contact_subit_btn mt-3">
                        <button type="submit" name="submit" class="btn">Enquiry Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- --------X---Enquiry Form---X----------- -->
<?php
    // ============Include Footer Components==========
        include('components/footer.php');
    // =========X===Include Footer Components===X=======
?>