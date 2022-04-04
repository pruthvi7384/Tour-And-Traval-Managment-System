<?php 
	// ==========Include Top file==========
		include('top.php');
	// =====X====Include Top file====X=====

	// ========If Admin Not Login or Admin is system admin========
		if(!isset($_SESSION['ADMIN_LOGIN'])){
			redirect('admin_login');
		}
		if($_SESSION['ADMIN_ROLE']=='0'){
			redirect('tours');
		}
	// ====X===If Admin Not Login or Admin is system admin===X====

	// ============Active / Deactive User Functionality==========
		if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
			$type=get_safe_value($_GET['type']);
			$id=get_safe_value($_GET['id']);
			if($type=='active' || $type=='deactive'){
				$status=1;
				if($type=='deactive'){
					$status=0;
				}
				mysqli_query($con,"update admin set status='$status' where id='$id'");
				redirect('vendores');
			}
		}
	// ========X===Active / Deactive User Functionality===X======

	// ==========Featch all agency data from agency database==============
		$sql=mysqli_query($con,"select * from admin where role='0' order by id desc");
	// =======X===Featch all agency data from agency database===X==========
?>
  		<div class="card">
            <div class="card-body">
              <h1 class="grid_title">Agency Master</h1>
			  <div class="row grid_box">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
							<th>#</th>
                            <th>Name</th>
                            <th>Email Id</th>
							<th>Mobile Number</th>
							<th>Email Verification Status</th>
                            <th>Added On</th>
							<th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
					  	<?php 
							if(mysqli_num_rows($sql)>0){
							$i=1;
							while($row=mysqli_fetch_assoc($sql)){
						?>
						<tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $row['agency_name']?></td>
							<td><?php echo $row['email_id']?></td>
							<td><?php echo $row['mobile_no']?></td>
							<td>
								<?php
									if($row['verification_status']==1){
								?>
									<label class="badge badge-danger hand_cursor">Verified</label>
								<?php
									}else{
								?>
									<label class="badge badge-info hand_cursor">Pending</label>
								<?php
									}	
								?>
							</td>
							<td>
								<?php 
									$dateStr=strtotime($row['register_on']);
									echo date('d-m-Y',$dateStr);
								?>
							</td>
							<td>
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
							</td>
                        </tr>
                        <?php 
						$i++;
						} } else { ?>
						<tr>
							<td style="text-align: center;" colspan="7">No Agency data found</td>
						</tr>
						<?php } ?>
                      </tbody>
                    </table>
                  </div>
				</div>
              </div>
            </div>
        </div>
        
<?php include('footer.php');?>