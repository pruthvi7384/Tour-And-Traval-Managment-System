<?php 
// ===========Admin Top File include===========
    include('top.php');
// =======X===Admin Top File include===X=======

// ========If Admin Not Login or Admin is system admin========
    if(!isset($_SESSION['ADMIN_LOGIN'])){
        redirect('admin_login?a=8');
    }
    if($_SESSION['ADMIN_ROLE']=='0'){
        redirect('tours');
    }
// ====X===If Admin Not Login or Admin is system admin===X====
?>

<!-- ----------Dashboard Page--------- -->
    <div class="row">
        <div class="col-md-6 col-lg-3 grid-margin stretch-card text-center">
        <div class="card">
            <div class="card-body">
                <?php
                    $total_users = mysqli_num_rows(mysqli_query($con,"select * from user where verification_status='1'"));
                ?>
            <h1 class="font-weight-light mb-4">
                <?php echo $total_users; ?>
            </h1>
            <div class="d-flex flex-wrap align-items-center">
                <div>
                <h4 class="font-weight-normal">TOTAL USERS</h4>
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-6 text-center col-lg-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <?php
                    $total_Agency = mysqli_num_rows(mysqli_query($con,"select * from admin where verification_status='1' and role='0'"));
                ?>
            <h1 class="font-weight-light mb-4">
                <?php echo $total_Agency; ?>
            </h1>
            <div class="d-flex flex-wrap align-items-center">
                <div>
                <h4 class="font-weight-normal">TOTAL AGENCYS</h4>
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card text-center">
        <div class="card">
            <?php
                $total_tours_packages = mysqli_num_rows(mysqli_query($con,"select * from tourpackages where status= '1'"));
            ?>
            <div class="card-body">
            <h1 class="font-weight-light mb-4">
                <?php echo $total_tours_packages;?>
            </h1>
            <div class="d-flex flex-wrap align-items-center">
                <div>
                <h4 class="font-weight-normal">TOTAL TOUR PACKAGES</h4>
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card text-center">
        <div class="card">
            <?php
                $total_car_rental = mysqli_num_rows(mysqli_query($con,"select * from carrentals where status='1'"));
            ?>
            <div class="card-body">
            <h1 class="font-weight-light mb-4">
                    <?php echo $total_car_rental; ?>
            </h1>
            <div class="d-flex flex-wrap align-items-center">
                <div>
                <h4 class="font-weight-normal">TOTAL CAR RENTAL</h4>
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card text-center">
        <div class="card">
            <div class="card-body">
                <?php 
                    $total_tour_enquery =mysqli_num_rows(mysqli_query($con,"select * from enquiry_tour"));
                ?>
            <h1 class="font-weight-light mb-4">
                <?php echo $total_tour_enquery; ?>
            </h1>
            <div class="d-flex flex-wrap align-items-center">
                <div>
                <h4 class="font-weight-normal">TOTAL TOUR PACKAGES ENQUIRY</h4>
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card text-center">
        <div class="card">
            <div class="card-body">
            <?php 
                $total_car_rental_enquiry = mysqli_num_rows(mysqli_query($con,"select * from rental_enquiry"));
            ?>
            <h1 class="font-weight-light mb-4">
                    <?php echo $total_car_rental_enquiry; ?>
            </h1>
            <div class="d-flex flex-wrap align-items-center">
                <div>
                <h4 class="font-weight-normal">TOTAL CAR RENTAL ENQUIRY</h4>
                </div>
            </div>
            </div>
        </div>  
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card text-center">
            <div class="card">
                <div class="card-body">
                <?php 
                    $total_tour_booked = mysqli_num_rows(mysqli_query($con,"select * from tour_book"));
                ?>
                <h1 class="font-weight-light mb-4">
                        <?php echo $total_tour_booked ; ?>
                </h1>
                <div class="d-flex flex-wrap align-items-center">
                    <div>
                    <h4 class="font-weight-normal">TOTAL TOUR BOOKED</h4>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card text-center">
            <div class="card">
                <div class="card-body">
                <?php 
                    $total_car_booked = mysqli_num_rows(mysqli_query($con,"select * from car_book"));
                ?>
                <h1 class="font-weight-light mb-4">
                        <?php echo $total_car_booked ; ?>
                </h1>
                <div class="d-flex flex-wrap align-items-center">
                    <div>
                    <h4 class="font-weight-normal">TOTAL TOUR BOOKED</h4>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card text-center">
            <div class="card">
                <div class="card-body">
                <?php 
                    $total_contact = mysqli_num_rows(mysqli_query($con,"select * from contact"));
                ?>
                <h1 class="font-weight-light mb-4">
                        <?php echo $total_contact ; ?>
                </h1>
                <div class="d-flex flex-wrap align-items-center">
                    <div>
                    <h4 class="font-weight-normal">TOTAL CONTACTS</h4>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
<!-- ------X---Dashboard Page--X------ -->

<!-- -----------Foter File Included---------- -->
    <?php include('footer.php');?>
<!-- ------X----Foter File Included----X----- -->