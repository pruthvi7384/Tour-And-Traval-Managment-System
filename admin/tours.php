<?php 
// ===========Top Header File Component Include==============
    include('top.php');
// =======X===Top Header File Component Include===X==========

// =============Tour Added By Condition===========
    $condition ='';
    $condition1 ='';
    if($_SESSION['ADMIN_ROLE']=='0'){
        $condition=" where tourpackages.admin_id='".$_SESSION['ADMIN_ID']."'" ;
        $condition1=" and admin_id='".$_SESSION['ADMIN_ID']."'" ;
    }
// ==========X==Tour Added By Condition==X========

    $oldImage ='';
    if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
        $type=get_safe_value($_GET['type']);
        $id=get_safe_value($_GET['id']);
        // ============Active / Deactive Tour Packages============
            if($type=='active' || $type=='deactive'){
                $status=1;
                if($type=='deactive'){
                    $status=0;
                }
                mysqli_query($con,"update tourpackages set status='$status' where id='$id' $condition1 ");
                redirect('tours');
            }
        // ========X===Active / Deactive Tour Packages==X=========

        // =================Remove Tour Package===============
            if($type == 'delete'){
                $res = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM tourpackages  WHERE id='$id' $condition1"));
                $oldImage = $res['PackageImage'];
                mysqli_query($con,"DELETE FROM tourpackages WHERE id='$id'");
                unlink(SERVER_TOUR_IMAGE.$oldImage);
                redirect('tours');
            }
        // ============X====Remove Tour Package=====X=========
    }

    // ===========Featch Tours Packages  Detailes From Database=========
        $sql="select * from tourpackages $condition order by id desc";
        $res=mysqli_query($con,$sql);
    // ========X==Featch Tours Packages  Detailes From Database===X=====
?>

    <!-- ------------Tour Packags-------------- -->
        <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Tours Packages</h1>
			  <a href="manage_tour_package" class="add_link">Add Tour Package</a>
			  <div class="row grid_box">
				
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Type</th>
							<th>Image</th>
                            <th>Location</th>
                            <th>Price</th>
							<th>Start Date</th>
                            <th>End Date</th>
                            <th>Agency Name</th>
							<th>Added On</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                            if(mysqli_num_rows($res)>0){
                            $i=1;
                            while($row=mysqli_fetch_assoc($res)){
						?>
						<tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $row['PackageName']?></td>
                            <td><?php echo $row['PackageType']?></td>
							<td><a target="_blank" href="<?php echo SITE_TOUR_IMAGE.$row['PackageImage']?>"><img src="<?php echo SITE_TOUR_IMAGE.$row['PackageImage']?>"/></a></td>
                            <td><?php echo $row['PackageLocation']?></td>
                            <td><?php echo $row['PackagePrice']?></td>
                            <td>
                                <?php 
                                    $dateStr=strtotime($row['start_date']);
                                    echo date('d-m-Y',$dateStr);
                                ?>
							</td>
                            <td>
                                <?php 
                                    $dateStr=strtotime($row['end_date']);
                                    echo date('d-m-Y',$dateStr);
                                ?>
							</td>
                            <td><?php echo $row['agency_name']?></td>
							<td>
                                <?php 
                                    $dateStr=strtotime($row['added_on']);
                                    echo date('d-m-Y',$dateStr);
                                ?>
							</td>
							<td>
                                <a href="manage_tour_package?id=<?php echo $row['id']?>&type=view"><label class="m-1 badge badge-primary hand_cursor">View</label></a>
								<a href="manage_tour_package?id=<?php echo $row['id']?>&type=edit"><label class="m-1 badge badge-success hand_cursor">Edit</label></a>&nbsp;
								<?php
								if($row['status']==1){
								?>
								    <a href="?id=<?php echo $row['id']?>&type=deactive"><label class="m-1 badge badge-danger hand_cursor">Active</label></a>
								<?php
								}else{
								?>
								    <a href="?id=<?php echo $row['id']?>&type=active"><label class="m-1 badge badge-info hand_cursor">Deactive</label></a>
								<?php
								}
								
								?>
								<a href="?id=<?php echo $row['id']?>&type=delete"><label class="m-1 badge badge-danger delete_red hand_cursor">Delete</label></a>
                               
							</td>
                        </tr>
                        <?php 
						$i++;
						} } else { ?>
						<tr>
							<td style="text-align: center;" colspan="11">No Tour Packages data found</td>
						</tr>
						<?php } ?>
                      </tbody>
                    </table>
                  </div>
				</div>
              </div>
            </div>
        </div>
    <!-- ------X-----Tour Packags----X--------- -->
<!------------Footer Component Include-----------  -->
    <?php include('footer.php');?>
<!--------X----Footer Component Include----X-------  -->