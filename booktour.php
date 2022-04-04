<?php
    // ============Include Header Components==========
        include('components/header.php');
    // ========X====Include Header Components===X======

    // =============Include NavBar Component===========
        include('components/NavBar.php');
    // =======X====Include NavBar Component====X=======

    // ========If User Is Not Login==========
        if(!isset($_SESSION['USER_LOGIN'])){
            echo "<script>
                        alert('Your Not Login First Login Then Book Tour Package');
                </script>";
            redirect('login?a=8');
        }
    // ====X===If User Is Not Login==X======

    // ============PHP Date Submiting Variable Decleration===========
        $tourpackagename = '';
        $admin_id = '';
        $tour_id = '';
        $user_id = '';
        $email_id = '';
        $mobile_no = '';
        $address = '';
        $name = '';
        $id_proof_no = '';
        $image = '';

        $msg = '';
        $image_error='';
        $type = '';
    // ========X===PHP Date Submiting Variable Decleration===X=======

     // ==============Get Tour Id From URL============
        if(isset($_GET['id']) && $_GET['id']>0){
            $tour_id=get_safe_value($_GET['id']);
            $row=mysqli_fetch_assoc(mysqli_query($con,"select * from tourpackages where id='$tour_id'"));
            $tourpackagename = $row['PackageName'];
            $admin_id = $row['admin_id'];
        }   
    // =========X====Get Tour Id From URL====X========

    // =============Book Tour Package===========
        if(isset($_POST['submit'])){
            $email_id = mysqli_escape_string($con,$_POST['email']);
            $mobile_no = mysqli_escape_string($con,$_POST['mobile_no']);
            $address = mysqli_escape_string($con,$_POST['address']);
            $name = mysqli_escape_string($con,$_POST['name']);
            $id_proof_no = mysqli_escape_string($con,$_POST['id_number']);

            $user_id = $_SESSION['USER_ID'];

            $type=$_FILES['image']['type'];

            if($type!='image/jpeg' && $type!='image/png'){
                $image_error="Invalid image format please select png/jpeg format";
            }else{
                $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],SERVER_TOUR_BOOK_IMAGE.$image);

                mysqli_query($con,"insert into tour_book(tour_id,admin_id,user_id,email_id,mobile_no,address,name,id_proof_no,id_proof,payment_status) values('$tour_id','$admin_id','$user_id','$email_id','$mobile_no','$address','$name','$id_proof_no','$image','Pending')");

                $id = mysqli_insert_id($con);
                
                $html="
                    <h2 style=' text-align: center; color: #253745'><b style='color: #3fc8fd'>$tourpackagename</b> Tour Package Booking Payment</h2>
                    <h3 style=' text-align: center; color: #737A80'><strong>Thank You <strong> For Booking This Tour Package Please Pay Online For Confirm Your Ticket  !</h3>
                    <p style='text-align: center; color: #737A80'>Click The Link For Online Pyment <b>".FRONT_SITE_PATH."/tourbookonlinepyment?id=".$id."</b></p>";

                send_email($email_id,$html,'TMS ~ Tour Package Booking Online Pyment');
                $msg = "<div class='text-center alert alert-info alert-dismissible    fade show' role='alert'>
                    <strong>Thank You <strong> For Booking Tour Package With Us , Please Check Your Email Id For Online Pyment and After Pyment Your Ticket Is Confirmed !
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
                // redirect('tours');
            }
        }
    // =========X===Book Tour Package===X=======
?>
    <!-- -------------Tour Package Book Form--------------- -->
        <div class="container signup_form mt-4">
            <div class="row heading" data-aos="fade-down">
                <h2><?php echo $tourpackagename; ?> <span style="color: #253745"> Tour Package Book Now</span></h2>
                <p>Tour Package Book Now</p>
            </div>
            <?php echo $msg; ?>
            <div class="row form_body mt-2">
                <div class="col-xl-6 mt-3">
                    <form method="post" action="" enctype="multipart/form-data" data-aos="fade-right">
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">Enter Booker Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">Enter Booker Email Id</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="mobile_no" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">Enter Booker Contact Number</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="address" placeholder="" id="floatingTextarea2" style="height: 150px" required></textarea>
                            <label for="floatingTextarea2">Enter Booker Address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="id_number" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">Enter Booker Aadhar Number</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="file" name="image" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">Choose Booker Aadhar Image</label>
                        </div>
                        <p style="color: red; font-weight: bold"><?php echo $image_error ?></p>
                        <div class="contact_subit_btn mt-3">
                            <button type="submit" name="submit" class="btn">Book Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- --------X---Tour Package Book Form---X----------- -->

<?php
    // ============Include Footer Components==========
        include('components/footer.php');
    // =========X===Include Footer Components===X=======
?>