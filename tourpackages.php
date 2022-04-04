<?php
    // ============Include Header Components==========
        include('components/header.php');
    // ========X====Include Header Components===X======

    // =============Include NavBar Component===========
        include('components/NavBar.php');
    // =======X====Include NavBar Component====X=======

    // ==========Featch All Packages Details=======
        $res = mysqli_query($con,"SELECT * FROM tourpackages WHERE status='1' ORDER BY added_on DESC");
    // =====X====Featch All Packages Details===X===
?>
<!-- ----------------Tour Packages Display------------------ -->
    <div class="container tour_packages mt-4">
        <div class="row heading" data-aos="fade-down">
            <h2>Tour Packages</h2>
            <p>We offered tour packages</p>
        </div>
        <div class="row tour_packages_row">
            <?php
                if(mysqli_num_rows($res)>0){
                    while($row=mysqli_fetch_assoc($res)){
            ?>
                <div class="col-xl-4 tour_package_card"  data-aos="fade-left">
                    <img src="<?php echo SITE_TOUR_IMAGE.$row['PackageImage']?>" alt="">
                    <div class="tour_details">
                        <h2 id="h2"><?php echo $row['PackageName'] ?></h2>
                        <h3 id="h3"><?php echo $row['PackageType'] ?></h3>
                        <h4 id="h4"><?php echo $row['PackageLocation'] ?></h4>
                        <h5 id="h5"><?php 
                                $dateStr=strtotime($row['start_date']);
                                echo date('d-m-Y',$dateStr);
                            ?> <span>To</span> 
                            <?php 
                                $dateStr=strtotime($row['end_date']);
                                echo date('d-m-Y',$dateStr);
                            ?>
                        </h5>
                        <h6 id="h6">&#8377; <span> <?php echo $row['PackagePrice'] ?>/-</span></h6>
                    </div>
                    <div class="tour_footer">
                        <ul>
                            <li><span><i class="fas fa-umbrella-beach"></i> </span> <?php echo $row['agency_name'] ?></li>
                            <li><span><i class="fas fa-comments"></i> </span> 
                                <?php 
                                    // ===========Comment Featch Functionality========
                                        $sql_comment = mysqli_query($con,"SELECT * FROM comments_tour WHERE tour_package_id='".$row['id']."'");
                                        $comment_rows = mysqli_num_rows($sql_comment); 
                                    // ========X===Comment Featch Functionality===X====
                                    if($comment_rows < 10){ 
                                        echo '0'.$comment_rows;
                                    }else{
                                        echo $comment_rows;
                                    }
                                ?>
                            </li>
                            <li><a href="<?php echo FRONT_SITE_PATH ?>/tourpackagedetaile?a=3&id=<?php echo $row['id'] ?>"><button class="btn">More Details</button></a></li>
                        </ul>
                    </div>
                </div>
            <?php
                } } else { ?>
                <div class="col-xl-12">
                    <p style="text-align: center; color: red; font-weight: bold;" >No Tour Packages found</td>
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