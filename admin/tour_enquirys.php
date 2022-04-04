<?php 
  // =============Include Top File===========
    include('top.php');
  // =============Include Top File===========

  // ============Delete Tours Package Enquiry==============
    if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
      $type=get_safe_value($_GET['type']);
      $id=get_safe_value($_GET['id']);
      if($type=='delete'){
        mysqli_query($con,"delete from enquiry_tour where id='$id'");
        redirect('tour_enquirys');
      }
    }
  // ========X===Delete Tours Package Enquiry===X==========

  // ============Featch Data Tours Packages Enquiry============
      $sql="SELECT * FROM enquiry_tour WHERE admin_id='".$_SESSION['ADMIN_ID']."' ORDER BY added_on DESC";
      $res = mysqli_query($con,$sql);
  // =======X====Featch Data Tours Packages Enquiry===X========

?>
        <!-- ------------Tour Package Enquiry Details Display Table----------- -->
          <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Tours Packages Enquiry</h1>
              <div class="row grid_box">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Tour Package Name</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Replay</th>
                            <th>Enquiry Date</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(mysqli_num_rows($res)>0){
                            $i=1;
                            while($row=mysqli_fetch_assoc($res)){
                        ?>
                            <tr>
                                <td><?php echo $i?></td>
                                <td>
                                  <?php   
                                    $tour_details = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM tourpackages where id='".$row['tour_id']."'"));
                                    echo $tour_details['PackageName'];
                                  ?>
                                </td>
                                <td><?php echo $row['name']?></td>
                                <td><?php echo $row['email_id']?></td>
                                <td><?php echo $row['subject']?></td>
                                <td><?php echo $row['message']?></td>
                                <td>
                                  <?php 
                                    if($row['replay'] == ''){
                                      echo 'Not Replay';
                                    }else{
                                      echo $row['replay'];
                                    }
                                  ?>
                                </td>
                                <td>
                                      <?php 
                                        $dateStr=strtotime($row['added_on']);
                                        echo date('d-m-Y',$dateStr);
                                      ?>
                                </td>
                                <td>
                                  <a href="tour_inquiry_replay?id=<?php echo $row['id']?>"><label class="m-1 badge badge-success hand_cursor">Replay</label></a>
                                  <a href="?id=<?php echo $row['id']?>&type=delete"><label class="m-1 badge badge-danger delete_red hand_cursor">Delete</label></a>
                                </td>
                              
                            </tr>
                          <?php 
                          $i++;
                          } } else { ?>
                          <tr>
                            <td colspan="8">No Tour Enquiry Data Found</td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
				        </div>
              </div>
            </div>
          </div>
        <!-- ------X-----Tour Package Enquiry Details Display Table---X------- -->
        
<?php include('footer.php');?>