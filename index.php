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

        <title>PRODUCER WAREHOUSE - Home</title>
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

            <!--================ Trending Product start =================-->
            <section class="hero-banner">
                <div class="container">
                    <div class="row no-gutters align-items-center pt-60px">
                        <?php
                            $query_products = "SELECT * FROM users, products WHERE users.user_id = products.user_id AND product_category = 'beats' ORDER BY RAND() LIMIT 1";
                            $result = mysqli_query($conn, $query_products);
                            $row = mysqli_fetch_assoc($result);
                        ?>
                        <div class="col-5 d-none d-sm-block">
                            <div class="hero-banner__img">
                                <img class="img-fluid" src="uploads/<?php echo $row['product_folderName'].'/'.$row['product_image'] ?>" alt="">
                            </div>
                        </div>
                        <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
                            <div class="hero-banner__content">
                                <h1>Trending Product</h1>
                                <h4><?php echo $row['product_title'] ?></h4>
                                <a class="button button-hero" href="product/<?php echo $row['product_id']?>/<?php echo $row['product_titleSlug']?>">Grab It!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--================ Trending Product start =================-->

            <!--================ Hero Carousel start =================-->
            <section class="section-margin mt-0">
                <div class="owl-carousel owl-theme hero-carousel">
                    <?php 
                        $result = mysqli_query($conn,"SELECT * FROM products ORDER BY Rand() LIMIT 4");
                        while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <div class="hero-carousel__slide">
                        <img src="uploads/<?php echo $row['product_folderName'].'/'.$row['product_image'] ?>" alt="" class="img-fluid">
                        <a href="product/<?php echo $row['product_id']?>/<?php echo $row['product_titleSlug']?>" class="hero-carousel__slideOverlay">
                            <h3><?php echo $row['product_title'] ?></h3>
                            <p>R<?php echo $row['product_price'] ?></p>
                        </a>
                    </div>
                    <?php
                        }
                    ?>    
                </div>
            </section>
            <!--================ Hero Carousel end =================-->

            <!-- ================ New Products Section Start ================= -->
            <section class="section-margin calc-60px">
                <div class="container">
                    <div class="section-intro pb-60px">
                        <p>Fresh From The Stu!</p>
                        <h2>New <span class="section-intro__style">Products</span></h2>
                    </div>
                    <div class="row">
                    <?php
                        $query_products = "SELECT * FROM users, products WHERE users.user_id = products.user_id ";
                        $result = mysqli_query($conn, $query_products);

                        while ($row = mysqli_fetch_assoc($result)){
                    ?>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="card text-center card-product">
                                <div class="card-product__img">
                                    <img class="card-img" src="uploads/<?php echo $row['product_folderName'].'/'.$row['product_image'] ?>" alt="">
                                </div>
                                <div class="card-body">
                                    <p><?php echo $row['user_username'] ?></p>
                                    <h4 class="card-product__title">
                                        <a href="product/<?php echo $row['product_id']?>/<?php echo $row['product_titleSlug']?>"><?php echo $row['product_title'] ?></a>
                                    </h4>
                                    <p class="card-product__price">R<?php echo $row['product_price'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php 
                        }   
                    ?>
                    </div>
                </div>
            </section>
            <!-- ================ New Product Section end ================= -->

            <!-- ================ Sign-Up Ad Section start ================= -->
            <section class="offer" id="parallax-1" data-anchor-target="#parallax-1" data-300-top="background-position: 20px 30px" data-top-bottom="background-position: 0 20px">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5">
                            <div class="offer__content text-center">
                                <h3>PRODUCER WAREHOUSE</h3>
                                <h4>Become A Seller!</h4>
                                <p>Create a beat, make drum kits, save midi loops, share templates and register an account as seller, start uploading, and sell.</p>
                                <a class="button button--active mt-3 mt-xl-4" href="sign-up ">Sign Up</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ================ Sign-Up Ad Section end ================= -->

            <!-- ================ Product Categories Carousel 1 start ================= -->
            <section class="section-margin calc-60px">
                <div class="container">
                    <div class="section-intro pb-60px">
                        <p>browse producer warehouse products</p>
                        <h2>Product <span class="section-intro__style">Categories</span></h2>
                    </div>
                    <div class="owl-carousel owl-theme" id="bestSellerCarousel">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="img-fluid" src="img/home/bg-1.png" alt="">
                            </div>
                            <div class="card-body">
                                <h4 class="card-product__title"><a href="product-category/beats">BEATS</a></h4>
                            </div>
                        </div>
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="img-fluid" src="img/home/bg-4.png" alt="">
                            </div>
                            <div class="card-body">
                                <h4 class="card-product__title"><a href="product-category/drum-kits">DRUM KITS</a></h4>
                            </div>
                        </div>
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="img-fluid" src="img/home/bg-7.png" alt="">
                            </div>
                            <div class="card-body">
                                <h4 class="card-product__title"><a href="product-category/midi-loops">MIDI PACKS</a></h4>
                            </div>
                        </div>
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="img-fluid" src="img/home/bg-6.png" alt="">
                            </div>
                            <div class="card-body">
                                <h4 class="card-product__title"><a href="product-category/vst-plugins">VST PLUGINS</a></h4>
                            </div>
                        </div>
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="img-fluid" src="img/home/bg-4.png" alt="">
                            </div>
                            <div class="card-body">
                                <h4 class="card-product__title"><a href="product-category/drum-loops">DRUM LOOPS</a></h4>
                            </div>
                        </div>
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="img-fluid" src="img/home/bg-5.png" alt="">
                            </div>
                            <div class="card-body">
                                <h4 class="card-product__title"><a href="product-category/melody-loops">MELODY LOOPS</a></h4>
                            </div>
                        </div>
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="img-fluid" src="img/home/bg-2.png" alt="">
                            </div>
                            <div class="card-body">
                                <h4 class="card-product__title"><a href="product-category/daw-templates">DAW TEMPLATES</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ================ Product Categories Carousel 1 end ================= -->   

            <!-- ================ Subscribe section start ================= -->
            <section class="subscribe-position">
                <div class="container">
                    <div class="subscribe text-center">
                        <h3 class="subscribe__title">Join Our Newsletter</h3>
                        <p>Subscribe and be the first to know about Producer Warehouse updates</p>
                        <div id="mc_embed_signup">
                            <form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="subscribe-form form-inline mt-5 pt-1">
                                <div class="form-group ml-sm-auto">
                                    <input class="form-control mb-1" type="email" name="subscriber_email" placeholder="Enter your email" required>
                                    <div class="info"></div>
                                </div>
                                <button class="button button-subscribe mr-auto mb-1" type="submit" name="submit">Subscribe Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ================ Subscribe section end ================= -->

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