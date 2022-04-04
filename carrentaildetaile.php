<?php
    // ============Include Header Components==========
        include('components/header.php');
    // ========X====Include Header Components===X======

    // =============Include NavBar Component===========
        include('components/NavBar.php');
    // =======X====Include NavBar Component====X=======

    // =======Get Car Rental Id From URL And Featch Data========
        $id='';

        if(isset($_GET['id']) && $_GET['id']>0){
            $id=get_safe_value($_GET['id']);
            $row=mysqli_fetch_assoc(mysqli_query($con,"select * from carrentals where id='$id'"));
        }   
    // ====X===Get Car Rental Id From URL And Featch Data===X=====

    // =============Comment Send Functionality==========
        $name = '';
        $email_id = '';
        $comment = '';
        // ==========If user is login============
            if(isset($_SESSION['USER_LOGIN'])){
                $user_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM user WHERE id='".$_SESSION['USER_ID']."'")) ;
                $name = $user_data['name'];
                $email_id = $user_data['email_id'];
            }
        // ======X===If user is login===X========

        if(isset($_POST['submit'])){
            $name = mysqli_escape_string($con,$_POST['name']);
            $email_id = mysqli_escape_string($con,$_POST['email']);
            $comment = mysqli_escape_string($con,$_POST['comment']);

            // ===========Insert Comment In Database========
                mysqli_query($con,"INSERT INTO comment_rental(rental_id,name,email_id,comment) VALUES('$id','$name','$email_id','$comment')");
                redirect('carrentaildetaile?id='.$id.'&a=4');
            // =======X==Insert Comment In Database==X=====
        }

    // =========X===Comment Send Functionality===X======

    // ===========Comment Featch Functionality========
        $sql_comment = mysqli_query($con,"SELECT * FROM comment_rental WHERE rental_id='$id' order by comment_on desc");
    // ========X===Comment Featch Functionality===X====
?>
<!-- ----------Tour Package detailes--------------- -->
    <div class="container tour_detail mt-4">
        <div class="row heading"  data-aos="fade-down">
                <h2>Rental<span> <?php echo $row['vehicle_name']; ?></span> Detailes</h2>
        </div>
        <div class="row details_body mt-2">
            <div class="col-xl-8">
                <img src="<?php echo SITE_RENTAL_IMAGE.$row['image']?>" alt=""  data-aos="fade-left">
                <div class="details">
                    <h2 data-aos="fade-left" id="h2"><?php echo $row['vehicle_name']; ?></h2>
                    <h3  data-aos="fade-left" id="h3"><?php echo $row['vehical_type']; ?> (Offered By <?php echo $row['company_name'] ?>)</h3>
                    <h4  data-aos="fade-left" id="h4"><?php echo $row['location']; ?></h4>
                    <h6  data-aos="fade-left" id="h6">&#8377; <span> <?php echo $row['vehical_rental_price']; ?>/-</span> <b style="font-size:20px">Per Day</b></h6>
                </div>
                <div class="more_detailes"  data-aos="fade-right">
                    <?php echo $row['details']; ?>
                </div>
                <div class="book">
                    <a href="<?php echo FRONT_SITE_PATH ?>/bookcar?a=4&id=<?php echo $row['id'] ?>"><button  data-aos="fade-right" class="btn">Book Now</button></a>
                    <a href="<?php echo FRONT_SITE_PATH ?>/carrentalenquiry?a=4&id=<?php echo $row['id'] ?>"><button  data-aos="fade-left" class="btn">Any Doubt Ask Here (Enquiry)</button></a>
                </div>
            </div>
        </div>
    </div>
<!-- ------X---Tour Package detailes----X---------- -->

<!-- ----------Tour Package Comments----------- -->
    <div class="container comments mt-2">
        <div class="row heading"  data-aos="fade-left">
            <?php   
                // =======Total Comments Calulate=====
                $comment_rows = mysqli_num_rows($sql_comment); 
            ?>
            <h3><span>
                <?php  
                    if($comment_rows < 10){ 
                        echo '0'.$comment_rows;
                    }else{
                        echo $comment_rows;
                    }
                ?>
            </span> Comments</h3>
        </div>
        <div class="row">
            <?php 
                if(mysqli_num_rows($sql_comment) > 0){
                    while($res_comments = mysqli_fetch_assoc($sql_comment)){ 
            ?>
                <div class="col-xl-8">
                    <?php
                        if($res_comments['email_id']!=$email_id){
                    ?>
                        <div class="comments_display"  data-aos="fade-left">
                            <h3><?php echo $res_comments['name']; ?></h3>
                            <h4>
                                <?php 
                                    $dateStr=strtotime($res_comments['comment_on']);
                                    echo date('d-m-Y',$dateStr);
                                ?>
                            </h4>
                            <p><span><i class="fa-solid fa-quote-left"></i></span> <?php echo $res_comments['comment']; ?> <span><i class="fa-solid fa-quote-right"></i></span></p>
                        </div>
                    <?php }else{?>
                        <div class="comments_display  login"  data-aos="fade-right">
                            <h3><?php echo $res_comments['name']; ?></h3>
                            <h4>
                                <?php 
                                    $dateStr=strtotime($res_comments['comment_on']);
                                    echo date('d-m-Y',$dateStr);
                                ?>
                            </h4>
                            <p><span><i class="fa-solid fa-quote-left"></i></span> <?php echo $res_comments['comment']; ?> <span><i class="fa-solid fa-quote-right"></i></span></p>
                        </div>
                    <?php } ?>
                </div>
            <?php
                } }else{
            ?>  
                <div class="col-xl-8">
                    <p style="text-align: center; color: red; font-weight: bold;" >No Comments Found !</td>
                </div>
            <?php } ?>
            <div class="col-xl-4 comment_form"  data-aos="fade-right">
                <form method="post" action="">
                    <div class="form-floating mb-3">
                        <input type="text" value="<?php echo $name; ?>" name="name" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Enter Your Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" value="<?php echo $email_id; ?>" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Enter Your Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="comment" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 150px"></textarea>
                        <label for="floatingPassword">Enter Your Comment</label>
                    </div>
                    <div class="contact_subit_btn mt-3">
                        <button type="submit" name="submit" class="btn">Comment Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- --------X--Tour Package Comments---X-------- -->
<?php
    // ============Include Footer Components==========
        include('components/footer.php');
    // =========X===Include Footer Components===X=======s
?>