<?php
    include '../include.inc/db.inc.php';
    $id='';
    $msg ='';
    if (isset($_GET['id'])){
        $id = mysqli_escape_string($con,$_GET['id']);
        mysqli_query($con,"UPDATE admin SET verification_status='1' WHERE id='$id'");
        header("Location:admin_login?id=$id");
    }

?>