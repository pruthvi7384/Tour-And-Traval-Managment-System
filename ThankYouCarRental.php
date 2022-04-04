<?php
    // ===========Site path constant variable Imported============
            include('include.inc/constant.php');
    // =========X==Site path constant variable Imported==X==========

    // ===========Database Include==========
        include('include.inc/db.inc.php');
    // ======X====Database Include===X======

    // ===========Php var=========
        $id = '';

        $data = '';
    // =======X===Php var===X=====
   
    // ============Get Tou Paymet Information From Id=========
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = mysqli_query($con,"SELECT * FROM car_book WHERE id= '$id'");
            $data = mysqli_fetch_assoc($sql);
            $rental_det = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM carrentals WHERE id = '".$data['car_rental_id']."'"));
            $agency_det = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM admin WHERE id = '".$rental_det['admin_id']."'"));
        }
    // ========X===Get Tou Paymet Information From Id===X=====
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS ~ <?php echo $rental_det['vehicle_name'] ?></title>
    <!-- Google Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Roboto:ital,wght@0,400;0,500;0,700;1,500&display=swap" rel="stylesheet">
    <!--X- Google Font -X-->

    <!-- Font Awsome Icon CDN -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!--X- Font Awsome Icon CDN -X-->
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        ul{
            list-style-type: none;
        }
        a{
            text-decoration:none;
        }
        body{
            font-family: 'Roboto', sans-serif;
        }
        .container{
            width: 100%;
            padding:25px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .border{
            border:2px solid #3fc8fd;
            padding: 50px 70px;
        }
        .heading{
            text-align: center;
        }
        .heading .logo a{
            font-size:35px;
            color:#3fc8fd;
            font-weight:700;
        }
        .heading .logo h3{
            margin-top:8px;
            color:#ACB1B4;
            font-weight:700;
        }
        .d-flex{
            display: flex;
        }
        .justify-content{
            justify-content:space-between;
        }
        .center{
            align-items:center;
        }
        .donationSlipDody{
            margin-top:25px;
        }
        .donationSlipDody .donate_info_heading ul li{
            margin: 8px 0px;
            font-size:18px;
            color:#253745;
            padding:0px 0px 5px 0px;
            font-weight:700;
        }
        .donationSlipDody .donate_info ul li{
            margin: 8px 0px;
            font-size:18px;
            color:#02121E;
            padding:0px 0px 5px 15px;
            font-weight:700;
        }
        .footer{
            margin-top:25px;
            border-top:1px solid #3fc8fd;
            padding:25px;
        }
        .footer .logo{
            text-align:center;
        }
        .footer .logo a{
            font-size:25px;
            color:#3fc8fd;
            font-weight:700;
        }
        .footer .logo p {
            padding:5px 0px;
            color: #
        }
        .footer .logo p  i{
            color:#3fc8fd;
        }
        .footer .logo p a{
            font-size:18px;
        }
        .print{
            margin-top:10px;
            margin-bottom:10px;
        }
        .print .btn{
            padding:10px;
            font-size: 16px;
            background-color:#3fc8fd;
            color:#FFFFFF;
            border:none;
            outline:none;
            border-radius:5px;
            cursor:pointer;
            font-weight: 600;
        }
        .pl-2{
            padding-left:20px;
        }
    </style>
</head>
<body>
    <!-- Donation Slip -->
        <div class="container d-flex">
            <div class="print">
                <a href="<?php echo FRONT_SITE_PATH; ?>/index?a=1"><button type="button" class="btn">Back</button></a> <button type="button" class="btn pl-2" onclick="window.print()">Print Slip Now</button>
            </div>
            <div class="border">
                <div class="heading">
                    <div class="logo">
                        <a href="index.php">TMS <span>Payment Receipt</span> </a>
                        <h3>Thank You For Connecting With Us !</h3>
                    </div>
                </div>
                <div class="donationSlipDody d-flex justify-content center">
                    <div class="donate_info_heading">
                        <ul>
                            <li>
                                Car Rental Booking Id : 
                            </li>
                            <li>
                                Car Rental Name : 
                            </li>
                            <li>
                                Car Rental Provide Agency Name : 
                            </li>
                            <li>
                               Car Rental Amount :
                            </li>
                            <li>
                                Payment Id : 
                            </li>
                            <li>
                                Payment Status : 
                            </li>
                            <li>
                                Name : 
                            </li>
                            <li>
                                Email Id : 
                            </li>
                            <li>
                                Contact Number :
                            </li>
                            <li>
                                Booking Date :
                            </li>
                        </ul>
                    </div>
                    <div class="donate_info">
                        <ul>
                            <li>
                                <?php echo $data['id']; ?>
                            </li>
                            <li>
                                 <?php echo $rental_det['vehicle_name']; ?>
                            </li>
                            <li>
                                <?php echo $agency_det['agency_name']; ?>
                            </li>
                            <li>
                                <?php echo $rental_det['vehical_rental_price'] ?> &#8377;
                            </li>
                            <li>
                                <?php echo $data['payment_id'] ?>
                            </li>
                            <li>
                                <?php echo $data['payment_status'] ?>
                            </li>
                            <li>
                                <?php echo $data['name'] ?>
                            </li>
                            <li>
                                <?php echo $data['email_id'] ?>
                            </li>
                            <li>
                                <?php echo $data['mobile_no'] ?>
                            </li>
                            <li>
                                <?php echo date("d F Y h : i : s", strtotime($data['book_on'])) ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="footer">
                    <div class="logo">
                        <p><a href="#"><?php echo FRONT_SITE_PATH ?></a></p>
                        <p><i class="fas fa-map-marker-alt"></i> <span>12, Pune, Maharastra, India</span></p>
                        <p><i class="fas fa-phone-volume"></i> <span>+91 0000 00000</span></p>
                        <p><i class="far fa-envelope"></i> <span>example@tms.com</span></p>
                    </div>
                </div>
            </div>
            <div class="print">
                    <button type="button" class="btn" onclick="window.print()">Print Slip Now</button>
            </div>
        </div>
    <!-- Donation Slip -->
</body>
</html>