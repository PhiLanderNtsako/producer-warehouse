<?php
    include "includes/top-cache.php";
    include "includes/config.php"; 
    session_start();
    
    $_SESSION['rdurl'] = $_SERVER['REQUEST_URI'];

    if (empty($_SESSION['cart'])) {
        echo '<meta http-equiv="refresh" content="0; url= cart">'; 
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <base href="http://localhost/projects/producerwarehouse/">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>PRODUCERWAREHOUSE - Checkout</title>
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

        <!--================ Checkout Area If User Logged In Start =================-->
        <section class="checkout_area section-margin--small">
            <div class="container">
                <?php
                    if (isset($_SESSION['cart'])) {
                    $total_price = 0;
                ?>
                <div class="col-lg-12">
                    <div class="order_box">
                        <h2>Your Cart</h2>
                        <ul class="list">
                            <li>
                                <a href="javascript:;"><h4>Product <span>Total</span></h4></a>
                            </li>
                            <?php
                                foreach ($_SESSION['cart'] as $product) {
                            ?>
                            <li>
                                <a href="javascript:;"><?php echo $product['product_title'] ?><span class="middle"></span> <span class="last">R<?php echo $product['product_price'] ?></span></a>
                            </li>
                            <?php $total_price += $product["product_price"];
                                } 
                            ?>
                        </ul><hr>
                        <ul class="list list_2">
                            <li>
                                <a href="javascript:;">Total <span>R<?php echo $total_price ?></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>        
        <?php
            }
            if (isset($_SESSION['user_id'])) {

            $product_id = $product['product_id'];
            $user_id = $_SESSION['user_id'];

            $sql = "SELECT * FROM products, users WHERE users.user_id = '$user_id' AND products.product_id = '$product_id'";
            $result_set = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result_set);
        ?>
        <section class="checkout_area section-margin--small">
            <div class="container">
                <div class="returning_customer">
                    <div class="check_title">
                        <h2><?php echo $row['user_username'] ?> - <?php echo $row['user_email'] ?></h2><br>
                    </div>
                    <form class="row contact_form" action="process/logout.php" method="post">
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="button button-login">Logout</button>
                        </div>
                    </form>
                </div>
                <div class="billing_details">
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="row contact_form" action="confirmation" method="post">
                                <div>
                                    <!-- Hidden -->
                                    <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
                                    <input type="hidden" name="product_title" value="<?php echo $row['product_title'] ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $row['product_price'] ?>">
                                    <input type="hidden" name="total_price" value="<?php echo $total_price ?>">
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="email" class="form-control" name="user_email" value="<?php echo $row['user_email'] ?>" readonly>
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="tel" class="form-control" name="user_phone" value="<?php echo $row['user_phone'] ?>" readonly>
                                </div><br>
                                <div class="col-md-12 form-group">
                                    <div class="text-center">
                                        <button type="submit" name="submit" class="button button-paypal">Proceed to Payment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================ End Checkout Area If User Logged In =================-->

        <!--================ Checkout Area Start =================-->
        <?php
            }else { 
        ?> 
        <section class="checkout_area section-margin--small">
            <div class="container">
                <div class="returning_customer">
                    <div class="check_title">
                        <h2>If You have shopped with us before, Login below for fast checkout. If not continue to billing section</h2><br>
                    </div>
                    <form class="row contact_form" action="sign-in" method="post">
                        <div class="col-md-6 form-group p_star">
                            <input type="email" class="form-control" placeholder="Your Email" id="user_email" name="user_email" pattern="[A-z0-9.]+@[A-z]+\.[A-z.]+" required>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="password" class="form-control" placeholder="Password" id="password" name="user_password" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" name="submit" class="button button-login">Login</button>
                            <div class="creat_account">
                            <a class="lost_pass" href="#">Lost your password?</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="billing_details">
                    <div class="row">
                        <div class="col-lg-12">
                        <h3>Billing Details</h3>
                        <form class="row contact_form" action="confirmation" method="post">
                            <div>
                                <!-- Hidden -->
                                <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>">
                                <input type="hidden" name="product_title" value="<?php echo $product['product_title'] ?>">
                                <input type="hidden" name="product_price" value="<?php echo $product['product_price'] ?>">
                                <input type="hidden" name="total_price" value="<?php echo $total_price ?>">
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="email" class="form-control" placeholder="Email" id="user_email" name="user_email" pattern="[A-z0-9.]+@[A-z]+\.[A-z.]+" required>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="tel" class="form-control" placeholder="Phone No." id="user_phone" name="user_phone" pattern="[0-9]{10}" required>
                            </div><br>
                            <div class="col-md-12 form-group">
                                <div class="text-center">
                                    <button type="submit" name="submit" class="button button-paypal">Proceed to Payment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <?php 
            }
        ?>
        <!--================ End Checkout Area =================-->

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
