<?php
    // ============Include Header Components==========
        include('components/header.php');
    // ========X====Include Header Components===X======

    // =============Include NavBar Component===========
        include('components/NavBar.php');
    // =======X====Include NavBar Component====X=======
?>

<!-- -------------About Us Page-------------- -->
    <div class="container about_us mt-4">
        <div class="row heading" data-aos="fade-down">
            <h2>Welcome !</h2>
            <p>About Us</p>
        </div>
        <div class="row sub_heading mt-2">
            <h4 data-aos="fade-up">About Traval & Tour Managment System</h4>
            <div class="col-xl-6 mt-3 text-center" data-aos="fade-right">
                <img  src="<?php echo FRONT_SITE_PATH ?>/assets/about.png" alt="">
            </div>
            <div class="col-xl-6 mt-3" data-aos="fade-left">
            <p><span><i class="fa-solid fa-quote-left"></i></span> The Tours and Travel Management System is a web based application. The main purpose of “Tours and travels management system” is to provide a convenient way for a customer to book hotels, vehicle or whole package to tour purposes. The objective of this project is to develop a system that automates the processes and activities of a travel agency. In this project, We will make an easier task of searching places and for booking facilities. In the present system a customer has to approach various agencies to find details of places and to book tickets. This often requires a lot of time and effort. We provide approach skills to critically examine how a tourist visits and its ability to operate in an appropriate way when dealing with the consequences of tourism, locally, regionally, and nationally including visitor security and ecological influences. It is tedious for a customer to plan a particular journey and have it executed properly. The project ‘Tours and Travels Management System’ is developed to replace the currently existing system, which helps in keeping records of the customer details of destination as well as payment received. <span><i class="fa-solid fa-quote-right"></i></span></p>
            </div>
        </div>
        <div class="row about_values mt-4" data-aos="fade-up">
            <h4>Meet Our Developer Team</h4>
        </div>
    </div>
    <!-- ---------Our Team Section------------>
        <?php include('pagesComponents/team.php'); ?>
    <!-- ------X---Our Team Section---X--------->
<!-- ------------X---About Us---X----------- -->

<?php
    // ============Include Footer Components==========
        include('components/footer.php');
    // =========X===Include Footer Components===X=======
?>
