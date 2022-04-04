<?php
    // ============Include Header Components==========
        include('components/header.php');
    // ========X====Include Header Components===X======

    // =============Include NavBar Component===========
        include('components/NavBar.php');
    // =======X====Include NavBar Component====X=======

    // ============Forgot Password Link Send Email Id================
        $email = '';
        $msg='';
        if(isset($_POST['submit'])){
            $email = mysqli_escape_string($con,$_POST['email']);
            $check = mysqli_query($con,"SELECT * FROM user WHERE email_id='$email'");

            if(mysqli_num_rows($check)==0){
                $msg = "<div class='alert alert-warning  alert-dismissible fade show' role='alert'>
                            You Are Not Register Please <a href='admin/admin_registration'> SIGNUP NOW </a>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
            }else{
                $sql = mysqli_fetch_assoc($check);
                $id= $sql['id'];
                $html=FRONT_SITE_PATH."/update_password?id=".$id;
                send_email($email,$html,'TMS (User) ~ Forgot Password');
                echo "<script>
                        alert('Forget Password Link Shared Your Email Id ');
                    </script>";
            }
        }
    // ========X====Forgot Password Link Send Email Id====X============
?>      
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
<?php
    // ============Include Footer Components==========
        include('components/footer.php');
    // ============Include Footer Components==========
?>

    