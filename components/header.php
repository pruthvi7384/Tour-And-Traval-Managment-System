<?php
    // ========For Chrome Sesion Storage php session start=======
     session_start();
    // =====X==For Chrome Sesion Storage php session start==X====
    
    // ============Import Email SMTP Folder==========
        include('./smtp/PHPMailerAutoload.php');
    // =========X==Import Email SMTP Folder==X=======

    // ============Import Function.inc===============
        include('./include.inc/function.inc.php');
    // ======W=X===Import Function.inc===X===========

    // ===========Site path constant variable Imported============
        include('./include.inc/constant.php');
    // =========X==Site path constant variable Imported==X==========

    // ===========Database Include==========
        include('./include.inc/db.inc.php');
    // ======X====Database Include===X======
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
    <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH ?>/style/chat.css"/>
    <!-- --------Font Awsome CDN for Icon inseting-------- -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- ----------Title of the website---------- -->
    <title><?php echo SITE_NAME; ?></title>
</head>
<body>