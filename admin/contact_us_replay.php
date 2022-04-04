<?php 
    // ============Top File Include============
        include('top.php');
    // ========X===Top File Include===X========

    // ========If Agency Login Then Redirect To Tours Packages Page=========
        if($_SESSION['ADMIN_ROLE']=='0'){
            redirect('tours');
        }
    // ====X===If Agency Login Then Redirect To Tours Packages Page===X=====
    
    // =============Variable Declartion=============
        $name = '';
        $email_id = '';
        $subject = '';
        $message = '';
        $replay = '';

        $id = '';
    // =======X=====Variable Declartion====X========

    // ==========Get User Id Throw There Contact Detaile=========
        if(isset($_GET['id']) && $_GET['id']>0){
            $id=get_safe_value($_GET['id']);
            $row=mysqli_fetch_assoc(mysqli_query($con,"select * from contact where id='$id'"));
            $name = $row['name'];
            $email_id = $row['email_id'];
            $subject = $row['subject'];
            $message = $row['message'];
            $replay = $row['replay'];
        }

    // ======X===Get User Id Throw There Contact Detaile===X=====

    // ============Replay To Contact============
        if(isset($_POST['submit'])){
            $name = get_safe_value($_POST['name']);
            $email_id = get_safe_value($_POST['email']);
            $subject = get_safe_value($_POST['subject']);
            $message = get_safe_value($_POST['message']);
            $replay = get_safe_value($_POST['replay']);

            mysqli_query($con,"UPDATE contact SET replay='$replay' WHERE id='$id'");
        
            $html="
                <h2 style=' text-align: center; color: #253745'><b style='color: #3fc8fd'>$name</b> Thank You ! <br> For Connecting With Us !, Your Contact Details And Replay Mentioned Below </h2>
                <div>
                    <ul style='list-style-type: none'>
                        <li style='font-size: 18px'><b style='color: #253745'>Name: </b> <b style='color: #02121E'>$name</b></li>
                        <li style='font-size: 18px'><b style='color: #253745'>Email Id: </b> <b style='color: #02121E'>$email_id</b></li>
                        <li style='font-size: 18px'><b style='color: #253745'>Subject: </b> <b style='color: #02121E'>$subject</b></li>
                        <li style='font-size: 18px'><b style='color: #253745'>Message: </b> <b style='color: #02121E'>$message</b></li>
                        <li ><b style='font-size: 18px; color: #253745'>Replay: </b> <b style='font-size: 18px;color:red'>$replay</b></li>
                    </ul>
                </div>
            ";
            send_email($email_id,$html,'TMS ~ Contact Replay');
            echo "<script>
                        alert('Reply sent successfully');
                    </script>";
        }
    // ========X===Replay To Contact===X========
   
?>
    <!-- -------------Contact Us Replay To User Form------------ -->
        <div class="row">
			<h1 class="grid_title ml10 ml15">Contact Us Replay</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post">
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
                      <input type="text" class="form-control" placeholder="Subject" name="subject" required value="<?php echo $subject ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3" required>Message</label>
                      <textarea name="message" class="form-control" placeholder="Message"><?php echo $message; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3" required>Replay</label>
                      <textarea name="replay" id="details" class="form-control" placeholder="Enter Replay" required><?php echo $replay?></textarea>
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