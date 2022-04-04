<?php
    // ============Include Header Components==========
        include('components/header.php');
    // ========X====Include Header Components===X======

    // =============Include NavBar Component===========
        include('components/NavBar.php');
    // =======X====Include NavBar Component====X=======

    // ===========Featch tour detailes=========
        $amount = '';
        $id_book = '';
        $id_toor = '';
        $amount = '';
        $email_id = '';
        $contact_number = '';
        $name = '';
        $tour_name = '';

        if(isset($_GET['id']) && $_GET['id']>0){
            $id_book=get_safe_value($_GET['id']);
            $row=mysqli_fetch_assoc(mysqli_query($con,"select * from tour_book where id='$id_book'"));
            $id_toor = $row['tour_id'];
            $email_id =  $row['email_id'];
            $contact_number =  $row['mobile_no'];
            $name =  $row['name'];

            $row_tour=mysqli_fetch_assoc(mysqli_query($con,"select * from tourpackages where id='$id_toor'"));

            $amount = $row_tour['PackagePrice'];
            $tour_name = $row_tour['PackageName'];
        }   
    // ======X====Featch tour detailes===X=====
?>
<!-- ----------Online Payment Tour Package Booking---------- -->
    <div class="online_payment mt-4">
        <div class="row">
            <h2>Tour Package Booking Amount Pay Online</h2>
            <p>Tour Package<span> <?php echo $tour_name ?> </span> Booking Amount (<span><?php echo $amount ?></span>) Pay Now</p>
        </div>
    </div>
    <div class="container signup_form">
        <div class="row form_body mt-2">
            <div class="col-xl-6 mt-3">
                <form method="post" action="" enctype="multipart/form-data" data-aos="fade-right">
                    <div class="form-floating mb-3">
                        <input type="text" value="<?php echo $id_book ?>" id="id" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                        <label for="floatingInput">Tour Booking ID</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" value="<?php echo $tour_name ?>" id="tour_name" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                        <label for="floatingInput">Tour Package Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" value="<?php echo $name ?>" id="name" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                        <label for="floatingInput">Booker Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" value="<?php echo $email_id ?>" id="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                        <label for="floatingInput">Booker Email Id</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" value="<?php echo $contact_number ?>" id="mobile_no" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                        <label for="floatingInput">Booker Contact Number</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number"  value="<?php echo $amount ?>" id="amount" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                        <label for="floatingInput">Tour Package Price Pay Online</label>
                    </div>
                    <div class="contact_subit_btn mt-3">
                        <button value="Pay Now" type="button" onClick="pay_now()" class="btn">Book Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- ------X---Online Payment Tour Package Booking---X------ -->

<!-- ---------------Pay Form----------------- -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        function pay_now(){
            var name=jQuery('#name').val();
            var email=jQuery('#email').val();
            var phone=jQuery('#mobile_no').val();
            var tour_amount=jQuery('#amount').val();
            var id = jQuery('#id').val();
            var tour_name = jQuery('#tour_name').val();
            var options = {
                "key": "rzp_test_JVUgsumzvjEx6L",
                "amount":tour_amount*100, 
                "currency": "INR",
                "name": "Tour Package Pay Online",
                "description": "Tour Package Pay Online",
                "image": "data:image/jpeg;base64,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",
                "handler": function (response){
                    jQuery.ajax({
                            type:'post',
                            url:'tour_payment_process.php',
                            data:"payment_id="+response.razorpay_payment_id+"&id="+id+"&tour_name="+tour_name+"&email="+email,
                            success:function(result){
                                window.location.href="ThankYouTour?id="+id;
                            }
                        });
                },
                "prefill": {
                    "name": name,
                    "email": email,
                    "contact": phone
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function (response){
                alert(response.error.reason);
            });
            rzp1.open();
        }
    </script>
<!-------------------Pay Script-------------------- -->
<?php
    // ============Include Footer Components==========
        include('components/footer.php');
    // ============Include Footer Components==========
?>