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
        <title>PRODUCER WAREHOUSE - Product Category</title>
        <link rel="icon" href="img/Fevicon.png" type="image/png">
        <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
        <link rel="stylesheet" href="vendors/linericon/style.css">
        <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
        <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
        <link rel="stylesheet" href="vendors/nouislider/nouislider.min.css">

        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <!--================ Start Header Menu Area =================-->
        <?php 
            include 'includes/header.php';
        ?>
        <!--================ End Header Menu Area =================-->

        <!-- ================ Single Product Category Section start ================= -->
        <?php
            $product_category = $_GET['category'];

            $query_products = "SELECT * FROM users, products WHERE users.user_id = products.user_id AND products.product_category = '$product_category'";
            $result = mysqli_query($conn, $query_products);
            echo mysqli_error($conn);
        ?>  
        <section class="section-margin calc-60px">
            <div class="container">
                <div class="section-intro pb-60px">
                    <p>shop by category</p>
                    <h2><?php echo strtoupper($product_category) ?></h2>
                </div>
                <div class="row">
                    <?php
                        while ($row = mysqli_fetch_assoc($result)){
                    ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="card-img" src="uploads/<?php echo $row['product_folderName'].'/'.$row['product_image'] ?>" alt="">
                            </div>
                            <div class="card-body">
                                <p><?php echo $row['user_username'] ?></p>
                                <h4 class="card-product__title"><a href="product/<?php echo $row['product_id'] ?>/<?php echo $row['product_titleSlug'] ?>"><?php echo $row['product_title'] ?></a></h4>
                                <p class="card-product__price">R<?php echo $row['product_price'] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php 
                        }
                    ?>
                </div>
                <div class="align-items-center text-center">
                    <a class="button" href="home">Loading...</a>
                </div>
            </div>
        </section>
        <!-- ================ new beats section end ================= -->  

        <!--================ Start footer Menu Area =================-->
        <?php 
            include 'includes/footer.php';
        ?>
        <!--================ End footer Menu Area =================-->

        <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
        <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="vendors/skrollr.min.js"></script>
        <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="vendors/nice-select/jquery.nice-select.min.js"></script>
        <script src="vendors/nouislider/nouislider.min.js"></script>
        <script src="vendors/jquery.ajaxchimp.min.js"></script>
        <script src="vendors/mail-script.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
<?php 
    include "includes/bottom-cache.php";  
?>