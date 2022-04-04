<?php 
  // =============Include Top File===========
    include('top.php');
  // =============Include Top File===========

  // ==========Remove Tour Package Book===========
      $id = '';
      $oldImage = '';
      $type = '';
      if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
          $id=get_safe_value($_GET['id']);
          $type=get_safe_value($_GET['type']);
          if($type == 'cancel'){
            $res = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM tour_book  WHERE id='$id'"));
            $oldImage = $res['id_proof'];
            mysqli_query($con,"DELETE FROM tour_book WHERE id='$id'");
            unlink(SERVER_TOUR_BOOK_IMAGE.$oldImage);
            redirect('tourBooking');
          }

          if($type == 'ticket'){
            mysqli_query($con,"UPDATE tour_book SET status='1' WHERE id = '$id'");
            $email_id = $res['email_id'];
            $tour_det = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM tourpackages WHERE id = '".$res['tour_id']."'"));
            $tour_name = $tour_det['PackageName'];
            $html="
            <h2 style=' text-align: center; color: #253745'><b style='color: #3fc8fd'>$tour_name</b> Tour Package Ticket Issued.</h2>
            <h3 style=' text-align: center; color: #737A80'><strong>Thank You <strong> For Booking This Tour Package Our Team Issue Your Ticket As A Ticket Access Payment Recipt!</h3>
            <p style='text-align: center; color: #737A80'>Click The Link For Download Online Payment Reciept <b>".FRONT_SITE_PATH."/ThankYouCarTour?id=".$id."</b></p>";
            send_email($email_id,$html,'TMS ~ Tour Package Booking Ticket');
            redirect('tourBooking');
          }
         
      }
   // ======X===Remove Tour Package Book===X=======

  // ============Tour Packages Booked============
      $sql = mysqli_query($con,"SELECT * FROM tour_book WHERE admin_id='".$_SESSION['ADMIN_ID']."' ORDER BY book_at DESC");
  // ============Tour Packages Booked============

?>
        <!-- ------------Tour Package Enquiry Details Display Table----------- -->
          <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Tours Packages Booked</h1>
              <div class="row grid_box">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Booking Id</th>
                            <th>Package Name</th>
                            <th>Package Id</th>
                            <th>Name</th>
                            <th>Email Id</th>
                            <th>Contact No</th>
                            <th>Id Number</th>
                            <th>Id Proof</th>
                            <th>Payment Id</th>
                            <th>Payment Status</th>
                            <th>Ticket Status</th>
                            <th>Booking Date</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                              if(mysqli_num_rows($sql) > 0){
                                  $i = 1;
                                  while($row = mysqli_fetch_assoc($sql)){
                                      $tour_det = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM tourpackages WHERE id='".$row['tour_id']."'"));
                                      $agency_det = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM admin WHERE id='".$row['admin_id']."'"));
                          ?>
                            <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo $row['id']?></td>
                                <td><?php echo $tour_det['PackageName']?></td>
                                <td><?php echo $tour_det['id']?></td>
                                <td><?php echo $row['name']?></td>
                                <td><?php echo $row['email_id']?></td>
                                <td><?php echo $row['mobile_no']?></td>
                                <td><?php echo $row['id_proof_no']?></td>
                                <td><a target="_blank" href="<?php echo SITE_TOUR_BOOK_IMAGE.$row['id_proof']?>"><img src="<?php echo SITE_TOUR_BOOK_IMAGE.$row['id_proof']?>"/></a></td>
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
                                <td>
                                      <?php 
                                        $dateStr=strtotime($row['book_at']);
                                        echo date('d-m-Y',$dateStr);
                                      ?>
                                </td>
                                <td>
                                    <a target="_blank" href="<?php echo FRONT_SITE_PATH ?>/tourpackagedetaile?id=<?php echo $tour_det['id'] ?>"><label class="m-1 badge badge-primary hand_cursor">Details</label></a><br>
                                    <a href="<?php echo FRONT_SITE_PATH ?>/admin/tourbookingreplay?id=<?php echo $row['id'] ?>"><label class="m-1 badge badge-info hand_cursor">Replay</label></a><br>
                                    <?php if($row['payment_status'] == 'Pending'){ ?>
                                        <a href="?id=<?php echo $row['id'] ?>&type=cancel"><label class="m-1 badge badge-danger delete_red hand_cursor">Cancel</label></a><br>
                                    <?php } ?>
                                    <?php if($row['payment_status'] != 'Pending'){ ?>
                                        <a target="_blank" href="<?php echo FRONT_SITE_PATH ?>/ThankYouTour?id=<?php echo $row['id'] ?>"><label class="m-1 badge badge-success hand_cursor">Download Payment Recipt</label></a><br>
                                    <?php } ?>
                                    <?php if($row['status'] == 0){ ?>
                                      <a href="?id=<?php echo $row['id'] ?>&type=ticket"><label class="m-1 badge badge-primary hand_cursor">Issue Ticket</label></a><br>
                                    <?php } ?>
                                    <?php if($row['status'] != '0'){ ?>
                                        <a  target="_blank" href="<?php echo FRONT_SITE_PATH ?>/ThankYouTour?id=<?php echo $row['id'] ?>"><label class="m-1 badge badge-info hand_cursor">Download Ticket</label></a>
                                    <?php } ?>
                                </td>
                            </tr>
                          <?php
                              $i++;
                                  }
                              }else{
                          ?>
                              <tr>
                                  <td colspan="12">No Tour Packages Booked</td>
                              </tr>
                          <?php
                              }
                          ?>
                      </tbody>
                    </table>
                  </div>
				        </div>
              </div>
            </div>
          </div>
        <!-- ------X-----Tour Package Enquiry Details Display Table---X------- -->
        
<?php include('footer.php');?>