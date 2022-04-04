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
        $id_rental = '';
        $amount = '';
        $email_id = '';
        $contact_number = '';
        $name = '';
        $rental_name = '';

        if(isset($_GET['id']) && $_GET['id']>0){
            $id_book=get_safe_value($_GET['id']);
            $row=mysqli_fetch_assoc(mysqli_query($con,"select * from car_book where id='$id_book'"));
            $id_rental = $row['car_rental_id'];
            $email_id =  $row['email_id'];
            $contact_number =  $row['mobile_no'];
            $name =  $row['name'];

            $row_rental=mysqli_fetch_assoc(mysqli_query($con,"select * from carrentals where id='$id_rental'"));

            $amount = $row_rental['vehical_rental_price'];
            $rental_name = $row_rental['vehicle_name'];
        }   
    // ======X====Featch tour detailes===X=====
?>
<!-- ----------Online Payment Tour Package Booking---------- -->
    <div class="online_payment mt-4">
        <div class="row">
            <h2>Car Rental Booking Amount Pay Online</h2>
            <p>Car Rental <span> <?php echo $rental_name ?> </span> Booking Amount (<span><?php echo $amount ?></span>) Pay Now</p>
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
                        <input type="text" value="<?php echo $rental_name ?>" id="car_rental_name" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                        <label for="floatingInput">Car Rental Name</label>
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
                        <label for="floatingInput">Car Rental Price Pay Online</label>
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
            var carrental_name = jQuery('#car_rental_name').val();
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
                            url:'carrental_payment_process.php',
                            data:"payment_id="+response.razorpay_payment_id+"&id="+id+"&carrental_name="+carrental_name+"&email="+email,
                            success:function(result){
                                window.location.href="ThankYouCarRental?id="+id;
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