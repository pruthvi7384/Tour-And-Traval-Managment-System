<?php 
    // =========Top components include========
        include('top.php');
    // =====X===Top components include===X====

    // =======Condiction For Agency and admin========
        $condition ='';
        $condition1 ='';
        if($_SESSION['ADMIN_ROLE']=='0'){
            $condition=" and tourpackages.admin_id='".$_SESSION['ADMIN_ID']."'" ;
            $condition1=" and admin_id='".$_SESSION['ADMIN_ID']."'" ;
        }   
    // ===X===Condiction For Agency and admin===X====
    
    // ==========Tour Package Added Functionality==========
        $msg="";
        $admin_id="";
        $agency_name='';
        $PackageName="";
        $PackageType ='';
        $PackageLocation="";
        $PackagePrice="";
        $PackageImage="";
        $PackageFetures = "";
        $start_date = "";
        $end_date="";
        $type="";
        $id="";
        $image_status='required';
        $image_error="";
        $status="";

        // ==========Get Id From URL For Edit Tour Package Detailes===========
            if(isset($_GET['id']) && $_GET['id']>0){
                $id=get_safe_value($_GET['id']);
                $row=mysqli_fetch_assoc(mysqli_query($con,"select * from tourpackages where id='$id' $condition1"));
                $PackageName=$row['PackageName'];
                $PackageType=$row['PackageType'];
                $PackageLocation=$row['PackageLocation'];
                $PackagePrice=$row['PackagePrice'];
                $PackageImage=$row['PackageImage'];
                $PackageFetures=$row['PackageFetures'];
                $start_date = $row['start_date'];
                $end_date = $row['end_date'];
                $image_status='';
                $agency_name =$row['agency_name'];
                $admin_id = $row['admin_id'];
                $status = $row['status'];
            }
        // ======X===Get Id From URL For Edit Tour Package Detailes====X======

        // =============Send Tour Package Data In Database===========
            if(isset($_POST['submit'])){
                $PackageName=get_safe_value($_POST['tour_package_name']);
                $PackageType=get_safe_value($_POST['tour_package_type']);
                $PackageLocation=get_safe_value($_POST['tour_package_location']);
                $PackagePrice=get_safe_value($_POST['price']);
                $PackageFetures=get_safe_value($_POST['tour_detail']);
                $start_date=get_safe_value($_POST['start_date']);
                $end_date=get_safe_value($_POST['end_date']);
            
                if($id==''){
                    $sql="select * from tourpackages where PackageName='$PackageName' $condition1";
                }else{
                    $sql="select * from tourpackages where PackageName='$PackageName' and id!='$id' $condition1";
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
                            move_uploaded_file($_FILES['image']['tmp_name'],SERVER_TOUR_IMAGE.$image);
                            mysqli_query($con,"insert into tourpackages(admin_id,PackageName,PackageType,PackageLocation,PackagePrice,PackageImage,PackageFetures,start_date,end_date,agency_name,status) values('$admin_id','$PackageName','$PackageType','$PackageLocation','$PackagePrice','$image','$PackageFetures','$start_date','$end_date','$agency_name','1')");

                            redirect('tours');
                        }
                    }else{
                        if($_FILES['image']['type']==''){
                            mysqli_query($con,"UPDATE tourpackages SET PackageName='$PackageName', PackageType='$PackageType',PackageLocation='$PackageLocation',PackagePrice='$PackagePrice',PackageImage='$PackageImage',PackageFetures='$PackageFetures',start_date='$start_date',end_date='$end_date',agency_name='$agency_name',status='$status' WHERE id='$id'");
                            redirect('tours');
                        }else 
                            if($type!='image/jpeg' && $type!='image/png'){
                            $image_error="Invalid image format please select png/jpeg format";
                            }else{
                            $sql = mysqli_fetch_assoc(mysqli_query($con,"select * from tourpackages where id='$id'"));
                            $old_image = unlink(SERVER_TOUR_IMAGE.$sql['PackageImage']);
                            $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                            move_uploaded_file($_FILES['image']['tmp_name'],SERVER_TOUR_IMAGE.$image);
                            mysqli_query($con,"UPDATE tourpackages SET PackageName='$PackageName', PackageType='$PackageType',PackageLocation='$PackageLocation',PackagePrice='$PackagePrice',PackageImage='$image',PackageFetures='$PackageFetures',start_date='$start_date',end_date='$end_date',agency_name='$agency_name',status='$status' WHERE id='$id'");
                            redirect('tours');
                            }
                        }
                    }
            }
        // =========X===Send Tour Package Data In Database===X=======
?>

    <!-- -----------Manage Tour Package------------- -->
        <div class="row">
			<h1 class="grid_title ml10 ml15">Tour Package</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
					<div class="form-group">
                      <label for="exampleInputName1">Tour Package Name</label>
                      <input type="text" class="form-control" placeholder="Enter Tour Package Name" name="tour_package_name" required value="<?php echo $PackageName?>">
					  <div class="error mt8"><?php echo $msg?></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Tour Package Type</label>
                      <input type="text" class="form-control" placeholder="Enter Tour Package Type" name="tour_package_type" required value="<?php echo $PackageType?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Tour Package Location</label>
                      <input type="text" class="form-control" placeholder="Enter Tour Package Location" name="tour_package_location" required value="<?php echo $PackageLocation?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Tour Package Price</label>
                      <input type="number" class="form-control" placeholder="Enter Tour Package Price" name="price" required value="<?php echo $PackagePrice?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Tour Start Date</label>
                      <input type="date" class="form-control" placeholder="Select Tour Start Date" name="start_date" required value="<?php echo $start_date?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Tour End Date</label>
                      <input type="date" class="form-control" placeholder="Select Tour End Date" name="end_date" required value="<?php echo $end_date?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3" required>Tour Package Details</label>
                      <textarea name="tour_detail" id="details" class="form-control" placeholder="Enter Tour Package Details"><?php echo $PackageFetures?></textarea>
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail3">Tour Package Image</label>
                      <input type="file" class="form-control" placeholder="Select Tour Package Image" name="image" <?php echo $image_status?>>
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