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
     

    <div class="col-lg-12">
      <div class="order_box">
        <h4 class="billing-title"><b>Frequently Asked Questions</b></h4>
          <p>
            <ol type = "1">
              <li>
                <b>
                    WHAT IS PRODUCER WAREHOUSE..?
                </b>
              </li>  
            
              <p>
                   Producer Warehouse is platform developed with an aim to help upcoming producers to upload and sell the work they do which may include instrumentals, drum kits, midi loops,drum loops, melody loops, plugins and daw templates.
              </p>
              <li>
                 <b>
                    WHAT IS PRODUCER WAREHOUSE..?
                 </b>
              </li> 
              <p>
                  For you to upload your work at producer warehouse you need to create an account with us <a href ="sign-up" > here</a>. 
              </p>
              <li>
                  <b>
                    WHO CAN CREATE AN ACCOUNT WITH PRODUCER WAREHOUSE..?
                  </b>
              </li>
              <p>
                  Everyone who wishes to create an account with us can gladly do so, but there are different types of users. We have buyers and sellers. Therefor you can either create an account as a buyer or a seller
                   <ol type ="a">
                     <li>
                      <b> BUYERS </b>
                     </li>
                     <p>
                        If you register as a buyer that mean you will only have access to account which will enable you to see how many products you have oerderd/ bought.
                     </p>
                     <li>
                      <b> SELLERS </b>
                     </li>
                     <p>
                       If you register as a seller that mean you will have access to account and upload which will enable you to see how many products you have sold and you will also be able to upload new products to sell.
                     </p>

                   </ol>  
              </p>
              <li>
                  <b>
                    IF I AM REGISTERED AS A USER, DO I PAY A FEE TO PRODUCER WAREHOUSE..?
                  </b>
              </li>
              <p>
                  No, The only time you pay at Producer warehouse is when your products have been sold and you only an amount of 15% from the Product selling price.
              </p>


            <ol>
          </p>       
      </div>
    </div>

    

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