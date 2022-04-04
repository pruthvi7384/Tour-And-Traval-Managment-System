<?php
    // ===========After Email Verification Is Done========
        if(isset($_GET['id']) && $_GET['id']>0){
            echo "<script>
                alert('Congractulation ! Your Email Id sussesfuly Verifed Please Login Now');
            </script>";
        }
    // ======X===After Email Verification Is Done===X=====
    
    // ============Include Header Components==========
        include('components/header.php');
    // ========X====Include Header Components===X======

    // =============Include NavBar Component===========
        include('components/NavBar.php');
    // =======X====Include NavBar Component====X=======

    // ==========Login Script Here========
        $email_id = '';
        $password ='';
        $msg = '';
        $type = '';
        $page='';

        if(isset($_GET['type']) && $_GET['type']!='' && isset($_GET['page']) && $_GET['page']!=''){
            $type = mysqli_escape_string($con,$_GET['type']);
            $page = mysqli_escape_string($con,$_GET['page']);
            if($type=='msg'){
                $msg = "<script>
                        alert(`Your Are Not Login Please Login Now For Access $page`);
                    </script>"; 
            }
        }

        if(isset($_POST['submit'])){
            $email_id = mysqli_escape_string($con,$_POST['email']);
            $password = mysqli_escape_string($con,$_POST['password']);
            $password = md5($password);
            $check = mysqli_query($con,"select * from user where email_id = '$email_id' AND password='$password' AND verification_status='1' AND status='1'");
            $res = mysqli_fetch_assoc($check);
            if(mysqli_num_rows($check)){
                $_SESSION['USER_LOGIN'] = 'yes';
                $_SESSION['USER_NAME'] = $res['name'];
                $_SESSION['USER_ID'] = $res['id'];
                redirect('index');
            }else{
                $msg = "<div class='alert alert-warning  alert-dismissible fade show' role='alert'>
                    Please Enter Correct Email Id And Password Or Verify Your Email Id</a>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }
    // ======X===Login Script Here===X=====
?>
    <!-- ---------------Login Form------------- -->
        <div class="container signup_form mt-4">
            <div class="row heading"  data-aos="fade-down">
                <h2>Login Now</h2>
                <p>Login Your Self</p>
            </div>
            <?php echo $msg; ?>
            <div class="row form_body mt-2">
                <div class="col-xl-6 mt-3" >
                    <form method="post" action="" data-aos="fade-right">
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">Enter Your Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Enter Your Password</label>
                        </div>
                        <p>Forgot Password ? <a href="<?php echo FRONT_SITE_PATH ?>/forgotpassword">Here</a></p>
                        <div class="contact_subit_btn mt-3 mb-3">
                            <button type="submit" name="submit" class="btn">LogIn Now</button>
                        </div>
                        <p style="text-align: center;">You are Not Signup,Please <a href="<?php echo FRONT_SITE_PATH; ?>/signup?a=7">signup Here</a>.</p>
                    </form>
                </div>
            </div>
        </div>
    <!-- ----------X----Login Form---X--------- -->
<?php
    // ============Include Footer Components==========
        include('components/footer.php');
    // =========X===Include Footer Components===X=======
?>