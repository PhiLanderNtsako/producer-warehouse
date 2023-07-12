<?php
    include "includes/top-cache.php";    
    include "includes/config.php";
    session_start();

    $_SESSION['rdurl'] = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <base href="http://localhost/projects/producerwarehouse/">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PRODUCERWAREHOUSE - Home</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">

  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<!--================ Start Header Menu Area =================-->
	<?php 
    	include 'includes/header.php';
  	?>
	<!--================ End Header Menu Area =================-->

  <main class="site-main">

     <!--================ PRODUCER WAREHOUSE STARTS =================-->
            <section class="hero-banner">
                <div class="container">
                    <div class="row no-gutters align-items-center pt-60px">
                        <div class="col-5 d-none d-sm-block">
                            <div class="hero-banner__img">
                                <img class="img-fluid" src="img/home/producer.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
                            <div class="hero-banner__content">
                                <h4>About us</h4>
                                <h1>PRODUCER WAREHOUSE</h1>
                                 <table class="order-rable">
              <tr>
                <td>
                  <p>

                    Producer warehouse as the name says "Warehouse",it is aplatform where local and upcoming producers will have the opportunity to sell beats, packs, plugins, loops and more. With producer warehouse you create an account and as a user you will be able to see what products you have sold. Producer warehouse was developed by Philander Malatji and Siyabonga Ngubeni who are both  Computer Science and Electronics graduates. Philander and Siyabonga are both engineers in different aspects of engineering. one  a engineer in sound and the other in network and Electronics. 
                    Producer warehouse as the name says "Warehouse",it is aplatform where local and upcoming producers will have the opportunity to sell beats, packs, plugins, loops and more. With producer warehouse you create an account and as a user you will be able to see what products you have sold. Producer warehouse was developed by Philander Malatji and Siyabonga Ngubeni who are both  Computer Science and Electronics graduates. Philander and Siyabonga are both engineers in different aspects of engineering. one  a engineer in sound and the other in network and Electronics.
                    Producer warehouse as the name says "Warehouse",it is aplatform where local and upcoming producers will have the opportunity to sell beats, packs, plugins, loops and more. With producer warehouse you create an account and as a user you will be able to see what products you have sold. Producer warehouse was developed by Philander Malatji and Siyabonga Ngubeni who are both  Computer Science and Electronics graduates. Philander and Siyabonga are both engineers in different aspects of engineering. one  a engineer in sound and the other in network and Electronics.
              
                  </p>
              </td>
              </tr>
            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--================ PRODUCERWAREHOUSE DETAILS ENDS =================-->
  </main>
  
  <!--================ Start footer Area  =================-->	
  <?php 
    	include 'includes/footer.php';
  	?>
	<!--================ End footer Area  =================-->

  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/skrollr.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="vendors/jquery.ajaxchimp.min.js"></script>
  <script src="vendors/mail-script.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
<?php 
    include "includes/bottom-cache.php";  
?>