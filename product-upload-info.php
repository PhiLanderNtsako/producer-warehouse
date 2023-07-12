<?php
    include "includes/top-cache.php";
    include "includes/config.php";  
    session_start();

    $_SESSION['rdurl'] = $_SERVER['REQUEST_URI'];

    if (!isset($_SESSION['user_id'])) {

        echo '<meta http-equiv="refresh" content="0; url= http://localhost/projects/producerwarehouse/login">';
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    
        <meta charset="UTF-8">
        <base href="http://localhost/projects/producerwarehouse/">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>PRODUCER WAREHOUSE- Upload Product Info</title>
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
        
        <!--================ Choose Product Category Area =================-->
        <section class="login_box_area section-margin">
            <div class="container">
                <div class="section-intro pb-60px">
                    <p>Upload your product</p>
                    <h2>Choose Category Type</h2>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="login_box_img">
                            <div class="hover">
                                <h3>Beats</h3><br>
                                <p>
                                    Producer Warehouse Beats License types - Free License and Exclusive License.<br>
                                    <strong>Free License</strong> - Beats which are free and only include an mp3 file inside.<br>
                                    <strong>Exclusive License</strong> - Beats which are sold and only to one person/customer, once it is purchased it will be removed from the warehouse. The zip file must have *mp3, wav and project bones* of the beat.<br>
                                </p>
                                <a class="button button-account" href="upload-product/category/beats">Upload Your Beat</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="login_box_img">
                            <div class="hover">
                                <h3>Sample Packs, Plugins or Templates</h3><br>
                                <p>
                                    Sample Packs - *Drum Kits, Midi Loops, Drum Loops, Melody Loops*.<br>
                                    <strong>Free License</strong> - Free to every user.<br>
                                    <strong>Premium License</strong> - Products which are sold at a certain price and they are not exclusive to anyone.<br>
                                    Products must be in a Zip file and specify what is included inside the file in the product description when uploading.<br>
                                </p>
                                <a class="button button-account" href="upload-product/category/others">Upload Your Product</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================ Choose Product Category Area =================-->

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
