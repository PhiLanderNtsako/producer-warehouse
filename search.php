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
        <title>PRODUCER WAREHOUSE - Search</title>
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

        <?php 
        if (!empty($_GET['keyword'])) {

            $keyword = mysqli_real_escape_string($conn,$_GET['keyword']);

            $sql = "SELECT * FROM products INNER JOIN users ON users.user_id = products.user_id WHERE product_title LIKE '%$keyword%'  OR product_pricing LIKE '%$keyword%' OR product_category LIKE '%$keyword%' OR product_price LIKE '%$keyword%' OR user_username LIKE '%$keyword%'";
            $result = mysqli_query($conn,$sql);
            $queryResult = mysqli_num_rows($result);
        ?>

        <!-- ================ Single Product Category Section start ================= -->
        <section class="section-margin calc-60px">
            <div class="container">
                <div class="section-intro pb-60px">
                    <p><?php echo $queryResult ?> results found for</p>
                    <h2>"<?php echo $keyword ?>"</h2>    
                </div>
                <div class="row">
                    <?php
                        if ($queryResult > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {

                            $user_id = $row['user_id'];
                            $result2 = mysqli_query($conn,"SELECT * FROM users WHERE users.user_id = '$user_id'");
                            $row2 = mysqli_fetch_assoc($result2);
                    ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="card-img" src="uploads/<?php echo $row['product_folderName'].'/'.$row['product_image'] ?>" alt="">
                            </div>
                            <div class="card-body">
                                <p><?php echo $row2['user_username'] ?></p>
                                <h4 class="card-product__title"><a href="product/<?php echo $row['product_id']?>/<?php echo $row['product_titleSlug']?>"><?php echo $row['product_title'] ?></a></h4>
                                <p class="card-product__price">R<?php echo $row['product_price'] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }else{
                            echo '  
                                <div class="align-items-center text-center">
                                    <a class="button" href="home">Continue Shopping</a>
                                </div>
                            ';
                        }
                    ?>
                </div>
            </div>
        </section>
        <?php 
            }else{
        ?>
        <section class="section-margin calc-60px">
            <div class="container">
                <div class="section-intro pb-60px">
                    <p>No Results Found</p>
                    <h2>for "<?php echo $keyword ?>"</h2>    
                </div>
            </div>
        </section>    
            <?php 
            }
        ?>
            <!-- ================ Subscribe section end ================= -->
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
