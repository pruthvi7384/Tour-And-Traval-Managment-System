<?php
    function pr($arr){
        echo '<pre>';
        print_r($arr);
    }

    function prx($arr){
        echo '<pre>';
        print_r($arr);
        die();
    }

// ======For Mysql_escap_string function=======
    function get_safe_value($str){
        global $con;
        $str=mysqli_real_escape_string($con,$str);
        return $str;
    }
// ====X==For Mysql_escap_string function==X=====

// ============Redireact Page One Page To Unother==============
    function redirect($link){
        ?>
        <script>
        window.location.href='<?php echo $link?>';
        </script>
        <?php
        die();
    }
// =========X==Redireact Page One Page To Unother==X=============

// =============Email Sending Function=============
    function send_email($email,$html,$subject){
        $mail=new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host="smtp.gmail.com";
        $mail->Port=587;
        $mail->SMTPSecure="tls";
        $mail->SMTPAuth=true;
        $mail->Username="pruthvirajrajput305@gmail.com";
        $mail->Password="Pruthvi@7384";
        $mail->SetFrom("pruthvirajrajput305@gmail.com");
        $mail->addAddress($email);
        $mail->IsHTML(true);
        $mail->Subject=$subject;
        $mail->Body=$html;
        $mail->SMTPOptions=array('ssl'=>array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>false
        ));
        if($mail->send()){
            // echo "done";
        }else{
            // echo "Error occur";
        }
    }
// =========X===Email Sending Function===X==========
?>