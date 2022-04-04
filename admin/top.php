<?php
  session_start();
  // ============Import Email SMTP Folder==========
      include('../smtp/PHPMailerAutoload.php');
  // =========X==Import Email SMTP Folder==X=======

  // ==============Database File Included==============
      require_once '../include.inc/db.inc.php';
  // ==========X===Database File Included===X==========

  // ===========Constant File Include=========
      include_once("../include.inc/constant.php");
  // =======X===Constant File Include===X=====

  // ============Function.inc file include======
      include '../include.inc/function.inc.php';
  // ========X===Function.inc file include==X===

  $curStr=$_SERVER['REQUEST_URI'];
  $curArr=explode('/',$curStr);
  $cur_path=$curArr[count($curArr)-1];

  // ==========Agency Is Not Login Then Redirect to login page=========
    if(!isset($_SESSION['ADMIN_LOGIN'])){
      redirect('admin_login');
    }
  // ======X===Agency Is Not Login Then Redirect to login page===X=====

  // =========Page Title Change According Activity Page Open======
    $page_title='';
    if($cur_path=='' || $cur_path=='index'){
      $page_title='Dashboard';
    }else if($cur_path=='user'){
      $page_title = 'Users';
    }else if($cur_path=='agency'){
      $page_title = 'Tour and Car Rental Agencys';
    }else if($cur_path=='tours' || $cur_path=='manage_tour_package'){
      $page_title = 'Tours Packages';
    }else if($cur_path=='carrental' || $cur_path=='manage_carrental'){
      $page_title = 'Car and Bike Rental';
    }else if($cur_path=='contact_us' || $cur_path=='contact_us_replay'){
      $page_title = 'Contact Us';
    }else if($cur_path=='tour_enquirys' || $cur_path=='tour_inquiry_replay'){
      $page_title = 'Tour Package Enquiry';
    }else if($cur_path=='carrental_enquiry' || $cur_path=='carrental_inquiry_replay'){
      $page_title = 'Car Rental Enquiry';
    }else if($cur_path == 'tourBooking' || $cur_path == 'tourbookingreplay'){
      $page_title = 'Tour Packages Book';
    }else if($cur_path == 'carrentalBooking' || $cur_path == 'carRentalbookingreplay'){
      $page_title = 'Car Rental Book';
    }
  // =====X===Page Title Change According Activity Page Open===Xs==

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo ADMIN_PANAL; ?> <?php echo $page_title?></title>
  <!-- Font Awsome Icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--X- Font Awsome Icon -X-->
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="sidebar-light">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
        <ul class="navbar-nav mr-lg-2 d-none d-lg-flex">
          <li class="nav-item nav-toggler-item">
            <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
          </li>
          
        </ul>
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index"></a>
          <a class="navbar-brand brand-logo-mini" href="index"></a>
        </div>
        <ul class="navbar-nav navbar-nav-right">
          
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <span class="nav-profile-name text-primary" style="font-weight: bold">Welcome ! <?php echo $_SESSION['ADMIN_NAME']?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          
          <li class="nav-item nav-toggler-item-right d-lg-none">
            <button class="navbar-toggler align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </li>
        </ul>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
        <!-- ---------Condition Of Agency Login------------ -->
          <?php if($_SESSION['ADMIN_ROLE']!='0'){ ?>
            <li class="nav-item">
              <a class="nav-link" href="index">
              <i class="fa fa-dashcube" aria-hidden="true"></i> &nbsp;
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="user">
              <i class="fa fa-users" aria-hidden="true"></i>
                <span class="menu-title">Users</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="agency">
              <i class="fa fa-building" aria-hidden="true"></i>
                <span class="menu-title">Agency</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact_us">
              <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                <span class="menu-title">Contact</span>
              </a>
            </li>
          <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="tours">
              <i class="fa fa-umbrella" aria-hidden="true"></i>
                <span class="menu-title">Tours Packages</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="carrental">
              <i class="fa fa-car" aria-hidden="true"></i>
                <span class="menu-title">Car & Bikes Rentals</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tourBooking">
              <i class="fa fa-umbrella" aria-hidden="true"></i>
                <span class="menu-title">Tour Package Booking</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="carrentalBooking">
              <i class="fa fa-car" aria-hidden="true"></i>
                <span class="menu-title">Car Rental Booking</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tour_enquirys">
              <i class="fa fa-umbrella" aria-hidden="true"></i>
                <span class="menu-title">Tours Package Enquiry</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="carrental_enquiry">
              <i class="fa fa-car" aria-hidden="true"></i>
                <span class="menu-title">Car Rental Enquiry</span>
              </a>
            </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">