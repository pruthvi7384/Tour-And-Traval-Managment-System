<?php 
    // =========Top components include========
        include('top.php');
    // =====X===Top components include===X====

    // =======Condiction For Agency and admin========
        $condition ='';
        $condition1 ='';
        if($_SESSION['ADMIN_ROLE']=='0'){
            $condition=" and carrentals.admin_id='".$_SESSION['ADMIN_ID']."'" ;
            $condition1=" and admin_id='".$_SESSION['ADMIN_ID']."'" ;
        }   
    // ===X===Condiction For Agency and admin===X====
    
    // ==========Tour Package Added Functionality==========
        $msg="";
        $admin_id="";
        $vehicle_name='';
        $vehical_type="";
        $vehical_rental_price ='';
        $details="";
        $location="";
        $image="";
        $type="";
        $id="";
        $image_status='required';
        $image_error="";
        $status="";
        $agency_name ='';

        // ==========Get Id From URL For Edit Tour Package Detailes===========
            if(isset($_GET['id']) && $_GET['id']>0){
                $id=get_safe_value($_GET['id']);
                $row=mysqli_fetch_assoc(mysqli_query($con,"select * from carrentals where id='$id' $condition1"));
                $vehicle_name=$row['vehicle_name'];
                $vehical_type=$row['vehical_type'];
                $vehical_rental_price=$row['vehical_rental_price'];
                $details=$row['details'];
                $location=$row['location'];
                $image=$row['image'];
                $image_status='';
                $agency_name ='';
                $admin_id = $row['admin_id'];
                $status = $row['status'];
            }
        // ======X===Get Id From URL For Edit Tour Package Detailes====X======

        // =============Send Tour Package Data In Database===========
            if(isset($_POST['submit'])){
                $vehicle_name=get_safe_value($_POST['vehicle_name']);
                $vehical_type=get_safe_value($_POST['vehical_type']);
                $vehical_rental_price=get_safe_value($_POST['vehical_rental_price']);
                $details=get_safe_value($_POST['details']);
                $location=get_safe_value($_POST['location']);
            
                if($id==''){
                    $sql="select * from carrentals where vehicle_name='$vehicle_name' $condition1";
                }else{
                    $sql="select * from carrentals where vehicle_name='$vehicle_name' and id!='$id' $condition1";
                }	
                if(mysqli_num_rows(mysqli_query($con,$sql))>0){
                    $msg="Tour Package already added";
                }else{
                    $type=$_FILES['image']['type'];
                    if($id==''){
                        $agency_name = $_SESSION['ADMIN_NAME'];
                        $admin_id = $_SESSION['ADMIN_ID'];

                        if($type!='image/jpeg' && $type!='image/png'){
                            $image_error="Invalid image format please select png/jpeg format";
                        }else{
                            $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                            move_uploaded_file($_FILES['image']['tmp_name'],SERVER_RENTAL_IMAGE.$image);
                            mysqli_query($con,"insert into carrentals(admin_id,vehicle_name,vehical_type,	vehical_rental_price,image,company_name,details,status,location) values('$admin_id','$vehicle_name','$vehical_type','$vehical_rental_price','$image','$agency_name','$details','1','$location')");

                            redirect('carrental');
                        }
                    }else{
                        if($_FILES['image']['type']==''){
                            mysqli_query($con,"UPDATE carrentals SET vehicle_name='$vehicle_name', vehical_type='$vehical_type',vehical_rental_price='$vehical_rental_price',company_name='$agency_name',image='$image',details='$details',status='$status' WHERE id='$id'");
                            redirect('carrental');
                        }else 
                            if($type!='image/jpeg' && $type!='image/png'){
                            $image_error="Invalid image format please select png/jpeg format";
                            }else{
                            $sql = mysqli_fetch_assoc(mysqli_query($con,"select * from carrentals where id='$id'"));
                            $old_image = unlink(SERVER_RENTAL_IMAGE.$sql['image']);
                            $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                            move_uploaded_file($_FILES['image']['tmp_name'],SERVER_RENTAL_IMAGE.$image);
                            mysqli_query($con,"UPDATE carrentals SET vehicle_name='$vehicle_name', vehical_type='$vehical_type',vehical_rental_price='$vehical_rental_price',company_name='$agency_name',image='$image',details='$details',status='$status' WHERE id='$id'");
                            redirect('carrental');
                            }
                        }
                    }
            }
        // =========X===Send Tour Package Data In Database===X=======
?>

    <!-- -----------Manage Tour Package------------- -->
        <div class="row">
			<h1 class="grid_title ml10 ml15">Car & Bike Rental</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
					<div class="form-group">
                      <label for="exampleInputName1">Car Or Bike Name</label>
                      <input type="text" class="form-control" placeholder="Enter Car or Bike Name" name="vehicle_name" required value="<?php echo $vehicle_name?>">
					  <div class="error mt8"><?php echo $msg?></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Vehical Type</label>
                      <input type="text" class="form-control" placeholder="Enter Car or Bike Rental Type" name="vehical_type" required value="<?php echo $vehical_type?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Location</label>
                      <input type="text" class="form-control" placeholder="Enter Bike Care Pickup Location" name="location" required value="<?php echo $location?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Price Per Day Rental</label>
                      <input type="number" class="form-control" placeholder="Enter Rental Per Day Price" name="vehical_rental_price" required value="<?php echo $vehical_rental_price?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3" required>Car or Bike Renatl Details</label>
                      <textarea name="details" id="details" class="form-control" placeholder="Enter Car or Bike Rental Details"><?php echo $details?></textarea>
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail3">Car or Bike Image</label>
                      <input type="file" class="form-control" placeholder="Select Car Or Bike  Image" name="image" <?php echo $image_status?>>
					  <div class="error mt8"><?php echo $image_error?></div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
		</div>
	<!-- ------X----Manage Tour Package----X-------- -->	

<!-- ---------Footer Component Include------------- -->
    <?php include('footer.php');?>
<!-- -----X---Footer Component Include-----X------- -->