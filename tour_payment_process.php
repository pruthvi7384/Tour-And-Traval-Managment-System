<?php
    // ============Database Connection Included===========
        include 'include.inc/db.inc.php';
    // ========X===Database Connection Included===X=======

    // ============Import Email SMTP Folder==========
        include('smtp/PHPMailerAutoload.php');
    // =========X==Import Email SMTP Folder==X=======

    // ============Import Function.inc===============
        include('include.inc/function.inc.php');
    // ======W=X===Import Function.inc===X===========

    // ===========Site path constant variable Imported============
        include('./include.inc/constant.php');
    // =========X==Site path constant variable Imported==X==========

    // =============Payment Status Update==========
        if(isset($_POST['payment_id']) && isset($_POST['id']) && isset($_POST['tour_name']) && isset($_POST['email'])){
            $payment_id=$_POST['payment_id'];
            $id = $_POST['id'];
            $tour_name = $_POST['tour_name'];
            $email_id = $_POST['email'];
            mysqli_query($con,"update tour_book set payment_status='Completed',payment_id='$payment_id' where id='$id'");

            $html="
                    <h2 style=' text-align: center; color: #253745'><b style='color: #3fc8fd'>$tour_name</b> Tour Package Booking Payment Successfully</h2>
                    <h3 style=' text-align: center; color: #737A80'><strong>Thank You <strong> For Booking This Tour Package Our Team Issue Your Ticket As Soon As Possiable !</h3>
                    <p style='text-align: center; color: #737A80'>Click The Link For Download Online Payment Reciept <b>".FRONT_SITE_PATH."/ThankYouCarRental?id=".$id."</b></p>";

                send_email($email_id,$html,'TMS ~ Tour Package Booking Successfully');
        }
    // ==========X==Payment Status Update==X=======
?>