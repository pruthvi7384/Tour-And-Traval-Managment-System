<?php
session_start();
// ============Function.inc file include======
    include '../include.inc/function.inc.php';
// ========X===Function.inc file include==X===
unset( $_SESSION['ADMIN_LOGIN']);
redirect('admin_login?a=8');
?>