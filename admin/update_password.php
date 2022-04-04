<?php
    // ==============Database File Included==============
        require_once '../include.inc/db.inc.php';
    // ==========X===Database File Included===X==========
 
    // ===========Constant File Include=========
        include_once("../include.inc/constant.php");
    // =======X===Constant File Include===X=====
 
    // ============Function.inc file include======
        include '../include.inc/function.inc.php';
    // ========X===Function.inc file include==X===

    // ===========Update Password========
        $id='';
        $password ='';
        $password1 ='';
        $msg ='';
        if(isset($_GET['id']) && $_GET['id']>0){
                $id= get_safe_value($_GET['id']);
        }
        if(isset($_POST['submit'])){
                $password1 =get_safe_value($_POST['password1']);
                $password =get_safe_value($_POST['password']);
                if($password1==$password){
                    $password = md5($password);
                    mysqli_query($con,"UPDATE admin SET password='$password' WHERE id='$id'");
                    echo "<script>
                        alert('Your Password Change Successfuly !');
                    </script>";
                    redirect('admin_login');
                }else{
                    $msg = "<div class='alert alert-warning  alert-dismissible fade show' role='alert'>
                        Your Password is not match please try to enter same password !
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
        }
   // =======X====Update Password====X====
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
    <title><?php echo ADMIN_PANAL; ?> ~ Agency Forgot Password</title>
</head>
<body>
    <!-- ---------------Update Password Page------------- -->
        <div class="container signup_form mt-4">
            <div class="row heading" data-aos="fade-down">
                <h2>Update Password Now</h2>
                <p>Change Password Now</p>
            </div>
            <?php echo $msg; ?>
            <div class="row form_body mt-2">
                <div class="col-xl-6 mt-3">
                    <form method="post" action="" data-aos="fade-right">
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Enter Your Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password1" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Re-Enter Your Password</label>
                        </div>
                        <div class="contact_subit_btn mt-3 mb-3">
                            <button type="submit" name="submit" class="btn">Change Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- ----------X----Update Password Page---X--------- -->

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