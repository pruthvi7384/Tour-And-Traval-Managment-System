<?php
    // ============Include Header Components==========
        include('components/header.php');
    // ========X====Include Header Components===X======

    // =============Include NavBar Component===========
        include('components/NavBar.php');
    // =======X====Include NavBar Component====X=======

    // =========Signup Data Submit==========
        $email_id = '';
        $mobile_no = '';
        $name = '';
        $password = '';
        $password1 = '';
        $msg ='';
        if(isset($_POST['submit'])){
            $name = mysqli_escape_string($con,$_POST['name']);
            $email_id = mysqli_escape_string($con,$_POST['email']);
            $mobile_no = mysqli_escape_string($con,$_POST['number']);
            $password = mysqli_escape_string($con,$_POST['password']);
            $password1 = mysqli_escape_string($con,$_POST['passwordcheack']);
            if($password != $password1){
                $msg = "<div class='alert alert-warning  alert-dismissible fade show' role='alert'>
                    Your Password is not match please try to enter same password !
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
                
            }else{
                $password = md5($password);


                $check = mysqli_query($con,"SELECT * FROM user WHERE email_id='$email_id'");
    
                if(mysqli_num_rows($check)>0){
                    $msg = "<div class='alert' role='alert'>
                                You Are Alrady Register Please <a href='login'> LOGIN NOW </a>
                            </div>";
                }else{
                    mysqli_query($con,"INSERT INTO user(email_id,mobile_no,name,	password,verification_status,status) VALUES('$email_id','$mobile_no','$name','$password','0','1')");
                    $id = mysqli_insert_id($con);
                    mysqli_query($con,"INSERT INTO user_profile(user_id) VALUES('$id')");
                    $html=FRONT_SITE_PATH."/verify?id=".$id;
                    send_email($email_id,$html,'TMS ~ Verify Email Id');
                    echo "<script>
                            alert('Thank you for register. Please check your email id, to verify your account');
                        </script>";
                }
            }
        }
    // =====X===Signup Data Submit===X======
?>
<!-- -------------SignUp Form--------------- -->
    <div class="container signup_form mt-4">
        <div class="row heading" data-aos="fade-down">
            <h2>Signup Now</h2>
            <p>Register Your Self</p>
        </div>
        <?php echo $msg; ?>
        <div class="row form_body mt-2">
            <div class="col-xl-6 mt-3">
                <form method="post" action="" data-aos="fade-right">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                        <label for="floatingInput">Enter Your Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                        <label for="floatingInput">Enter Your Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="number" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                        <label for="floatingInput">Enter Your Mobile Number</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword">Enter Your Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="passwordcheack" placeholder="Leave a comment here" id="floatingTextarea2" required>
                        <label for="floatingTextarea2">Re-Enter Your Password</label>
                    </div>
                    <div class="contact_subit_btn mt-3 mb-3">
                        <button type="submit" name="submit" class="btn">SignUp Now</button>
                    </div>
                    <p style="text-align: center;">You are Alrady Signup,Please <a href="<?php echo FRONT_SITE_PATH; ?>/login?a=8">Login Here</a>.</p>
                </form>
            </div>
        </div>
    </div>
<!-- --------X---SignUp Form---X----------- -->
<?php
    // ============Include Footer Components==========
        include('components/footer.php');
    // =========X===Include Footer Components===X=======
?>