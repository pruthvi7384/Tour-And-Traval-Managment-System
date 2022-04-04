<?php
    // ============Include Header Components==========
        include('components/header.php');
    // ========X====Include Header Components===X======

    // =============Include NavBar Component===========
        include('components/NavBar.php');
    // =======X====Include NavBar Component====X=======

    // ==========Featch All Packages Details=======
        $res = mysqli_query($con,"SELECT * FROM carrentals WHERE status='1'");
    // =====X====Featch All Packages Details===X===
?>
<!-- ----------------Tour Packages Display------------------ -->
    <div class="container tour_packages mt-4">
        <div class="row heading" data-aos="fade-down">
            <h2>Car Rentals</h2>
            <p>We offered Cars & Bikes Rentals</p>
        </div>
        <div class="row tour_packages_row">
            <?php
                if(mysqli_num_rows($res)>0){
                    while($row=mysqli_fetch_assoc($res)){
            ?>
                <div class="col-xl-4 tour_package_card"  data-aos="fade-left">
                    <img src="<?php echo SITE_RENTAL_IMAGE.$row['image']?>" alt="">
                    <div class="tour_details">
                        <h2 id="h2"><?php echo $row['vehicle_name'] ?></h2>
                        <h3 id="h3"><?php echo $row['vehical_type'] ?></h3>
                        <h4 id="h4"><?php echo $row['location'] ?></h4>
                        <h6 id="h6">&#8377; <span> <?php echo $row['vehical_rental_price'] ?>/-</span> <b style="font-size:20px">Per Day</b></h6>
                    </div>
                    <div class="tour_footer">
                        <ul>
                            <li><span><i class="fas fa-umbrella-beach"></i> </span> <?php echo $row['company_name'] ?></li>
                            <li><span><i class="fas fa-comments"></i> </span> 
                                <?php 
                                    // ===========Comment Featch Functionality========
                                        $sql_comment = mysqli_query($con,"SELECT * FROM comment_rental WHERE rental_id='".$row['id']."'");
                                        $comment_rows = mysqli_num_rows($sql_comment); 
                                    // ========X===Comment Featch Functionality===X====
                                    if($comment_rows < 10){ 
                                        echo '0'.$comment_rows;
                                    }else{
                                        echo $comment_rows;
                                    }
                                ?>
                            </li>
                            <li><a href="<?php echo FRONT_SITE_PATH ?>/carrentaildetaile?a=4&id=<?php echo $row['id'] ?>"><button class="btn">More Details</button></a></li>
                        </ul>
                    </div>
                </div>
            <?php
                } } else { ?>
                <div class="col-xl-12">
                    <p style="text-align: center; color: red; font-weight: bold;" >No Car & Bike Rental found</td>
                </div> 
            <?php } ?>
        </div>
    </div>
<!-- ----------X-----Tour Packages Display-----X------------ -->
<?php
    // ============Include Footer Components==========
        include('components/footer.php');
    // =========X===Include Footer Components===X=======
?>