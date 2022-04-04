<?php
    // ============Include Header Components==========
        include('components/header.php');
    // ========X====Include Header Components===X======

    // =============Include NavBar Component===========
        include('components/NavBar.php');
    // =======X====Include NavBar Component====X=======

    // ==========Remove Tour Package Book===========
        $id = '';
        $oldImage = '';
        if(isset($_GET['id']) && $_GET['id']>0){
            $id=get_safe_value($_GET['id']);
            $res = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM tour_book  WHERE id='$id'"));
            $oldImage = $res['id_proof'];
            mysqli_query($con,"DELETE FROM tour_book WHERE id='$id'");
            unlink(SERVER_TOUR_BOOK_IMAGE.$oldImage);
            redirect('tourpackageshistory');
        }
    // ======X===Remove Tour Package Book===X=======

    // ============Tour Packages History============
        $sql = mysqli_query($con,"SELECT * FROM tour_book WHERE user_id='".$_SESSION['USER_ID']."' ORDER BY book_at DESC");
    // ============Tour Packages History============
?>
<!-- ----------Tour Packages History---------- -->
    <div class="container table_body mt-4">
        <div class="row heading">
            <h2>Welcome <span><?php echo $_SESSION['USER_NAME'] ?></span></h2>
            <p>Your Tour Packages History</p>
        </div>
        <div class="row mt-2 table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Agency Name</th>
                        <th scope="col">Booking Id</th>
                        <th scope="col">Package Name</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Package Price</th>
                        <th scope="col">Payment Id</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Ticket Status</th>
                        <th scope="col">Booking Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    <?php
                        if(mysqli_num_rows($sql) > 0){
                            $i = 1;
                            while($row = mysqli_fetch_assoc($sql)){
                                $tour_det = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM tourpackages WHERE id='".$row['tour_id']."'"));
                                $agency_det = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM admin WHERE id='".$row['admin_id']."'"));
                    ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $agency_det['agency_name'] ?></td>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $tour_det['PackageName'] ?></td>
                            <td><?php 
                                        $dateStr=strtotime($tour_det['start_date']);
                                        echo date('d-m-Y',$dateStr);
                                      ?>
                            </td>
                            <td><?php 
                                        $dateStr=strtotime($tour_det['end_date']);
                                        echo date('d-m-Y',$dateStr);
                                      ?>
                            </td>
                            <td><?php echo $tour_det['PackagePrice'] ?> &#8377;</td>
                            <td>
                                <?php 
                                    if($row['payment_status'] == 'Pending'){
                                        echo "<p style='color: red; font-weight: bold'>NA</p>";
                                    }else{
                                        echo $row['payment_id'];
                                    }
                                ?>
                            </td>
                            <td><?php echo $row['payment_status'] ?></td>
                            <td>
                                <?php 
                                    if($row['status'] == 0){
                                        echo "<p style='color: red; font-weight: bold'>Not Issued</p>";
                                    }else{
                                        echo 'Issued';
                                    }
                                ?>
                            </td>
                            <td><?php 
                                        $dateStr=strtotime($row['book_at']);
                                        echo date('d-m-Y',$dateStr);
                                      ?>
                            </td>
                            <td>
                                <a class="text-primary" style="font-weight: bold" href="<?php echo FRONT_SITE_PATH ?>/tourpackagedetaile?id=<?php echo $row['id'] ?>">Details</a><br>
                                <?php if($row['payment_status'] == 'Pending'){ ?>
                                    <a class="text-danger" style="font-weight: bold" href="?id=<?php echo $row['id'] ?>">Cancel</a><br>
                                    <a class="text-success" style="font-weight: bold" href="<?php echo FRONT_SITE_PATH ?>/tourbookonlinepyment?id=<?php echo $row['id'] ?>">Pay Now</a><br>
                                <?php } ?>
                                <?php if($row['payment_status'] != 'Pending'){ ?>
                                    <a class="text-success" style="font-weight: bold" target="_blank" href="<?php echo FRONT_SITE_PATH ?>/ThankYouTour?id=<?php echo $row['id'] ?>">Download Payment Reciept</a><br>
                                <?php } ?>
                                <?php if($row['status'] != '0'){ ?>
                                    <a class="text-info" style="font-weight: bold" target="_blank" href="<?php echo FRONT_SITE_PATH ?>/tourpackagedetaile?id=<?php echo $row['id'] ?>">Download Ticket</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php
                        $i++;
                            }
                        }else{
                    ?>
                        <tr>
                            <td colspan="12" style=" text-align: center; font-weight: bold; color: red">No Tour Packages Booked</td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<!-- -------X--Tour Packages History--X------- -->
<?php
    // ============Include Footer Components==========
        include('components/footer.php');
    // =========X===Include Footer Components===X=======s
?>