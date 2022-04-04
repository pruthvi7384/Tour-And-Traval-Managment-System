<?php 
    // ============Top File Include============
        include('top.php');
    // ========X===Top File Include===X========
    
    // =============Variable Declartion=============
        $tour_package_name = '';
        $name = '';
        $email_id = '';
        $subject = '';
        $replay = '';

        $id = '';
    // =======X=====Variable Declartion====X========

    // ==========Get User Id Throw There Tour Package Detaile=========
        if(isset($_GET['id']) && $_GET['id']>0){
            $id=get_safe_value($_GET['id']);
            $row=mysqli_fetch_assoc(mysqli_query($con,"select * from tour_book where id='$id'"));
            $name = $row['name'];
            $email_id = $row['email_id'];

            $tour_details = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM tourpackages where id='".$row['tour_id']."'"));
            $tour_package_name = $tour_details['PackageName'];
        }

    // ======X===Get User Id Throw There Tour Package Detaile===X=====

    // ============Replay To Enquiry============
        if(isset($_POST['submit'])){
            $name = get_safe_value($_POST['name']);
            $email_id = get_safe_value($_POST['email']);
            $subject = get_safe_value($_POST['subject']);
            $replay = get_safe_value($_POST['replay']);

            $html="
                <h2 style=' text-align: center; color: #253745'><b style='color: #3fc8fd'>$name</b> Thank You ! <br> For Connecting With Us !, Your $tour_package_name Tour Package Booking Replay Message </h2>
                <div style=' text-align: center; color: #253745'>
                    $replay;
                </div>
            ";
            send_email($email_id,$html,'TMS ~ '.$subject.','.$tour_package_name.'Booking Replay');
            echo "<script>
                        alert('Reply sent successfully');
                  </script>";
        }
    // ========X===Replay To Enquiry===X========
   
?>
    <!-- -------------Contact Us Replay To User Form------------ -->
        <div class="row">
			<h1 class="grid_title ml10 ml15">Tour Booking Replay</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Tour Package Name</label>
                      <input type="text" class="form-control" placeholder="Name" name="tour_package_name" required value="<?php echo $tour_package_name ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Name</label>
                      <input type="text" class="form-control" placeholder="Name" name="name" required value="<?php echo $name ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Email Id</label>
                      <input type="text" class="form-control" placeholder="Email Id" name="email" required value="<?php echo $email_id ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Subject</label>
                      <input type="text" class="form-control" placeholder="Subject" name="subject" required >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3" required>Replay</label>
                      <textarea name="replay" id="details" class="form-control" placeholder="Enter Replay" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                    </form>
                </div>
              </div>
            </div>
		 </div>
    <!-- --------X----Contact Us Replay To User Form----X------- -->
<!-- ----------Footer Section Imported----------- -->
    <?php include('footer.php');?>
<!-- -----X----Footer Section Imported----X------ -->