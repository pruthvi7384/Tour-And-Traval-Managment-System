<?php 
include('top.php');
if($_SESSION['ADMIN_ROLE']=='0'){
	redirect('tours');
}
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=get_safe_value($_GET['type']);
	$id=get_safe_value($_GET['id']);
	if($type=='delete'){
		mysqli_query($con,"delete from contact where id='$id'");
		redirect('contact_us');
	}
}

$sql="SELECT * FROM contact ORDER BY contactdate DESC";
$res=mysqli_query($con,$sql);

?>
        <!-- ------------Contct Details Display Table----------- -->
          <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Contact Us</h1>
              <div class="row grid_box">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Replay</th>
                            <th>Contact Date</th>
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
                                        $dateStr=strtotime($row['contactdate']);
                                        echo date('d-m-Y',$dateStr);
                                      ?>
                                </td>
                                <td>
                                  <a href="contact_us_replay?id=<?php echo $row['id']?>"><label class="m-1 badge badge-success hand_cursor">Replay</label></a>&nbsp;
                                  <a href="?id=<?php echo $row['id']?>&type=delete"><label class="m-1 badge badge-danger delete_red hand_cursor">Delete</label></a>
                                </td>
                              
                            </tr>
                          <?php 
                          $i++;
                          } } else { ?>
                          <tr>
                            <td colspan="8">No Contact Data Found</td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
				        </div>
              </div>
            </div>
          </div>
        <!-- ------X-----Contct Details Display Table---X------- -->
        
<?php include('footer.php');?>