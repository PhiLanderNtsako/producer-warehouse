    <?php
        //include "includes/top-cache.php"; 
        include "includes/config.php";
        session_start();

        $_SESSION['rdurl'] = $_SERVER['REQUEST_URI'];

        if (isset($_POST['submit'])) {

            $user_email = mysqli_real_escape_string($conn,$_POST['user_email']);
            $user_phone = $_POST['user_phone'];
            $code = $user_email.$user_phone;;
            
            $orderArray = array(
                $code => array(
               'code' => $code,
               'user_email' => $user_email,
               'user_phone' => $user_phone,
               )
           );

            if(empty($_SESSION['order'])) {

                $_SESSION['order'] = $orderArray;
                $status = "Product is added to your cart!";
            }else {

                $array_keys = array_keys($_SESSION['order']);
                if(in_array($code,$array_keys)) {
    
                    $status = "Product is already added to your cart!";	
                }
            }
        }
        if (isset($_POST['action']) && $_POST['action'] == "edit") {

            array_walk($_SESSION['order'], function (&$key){
                $key['user_email'] = $_POST['user_email'];
                $key['user_phone'] = $_POST['user_phone'];
            });
            $status = "Billing details updated";	
        }   

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <base href="http://localhost/projects/producerwarehouse/">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>PRODUCERWAREHOUSE - confirmation</title>
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

        <!--================Order Details Area =================-->

        <section class="order_details section-margin--small">
            <div class="container">
                <?php
                    if (isset($_SESSION['cart']) && isset($_SESSION['order'])) {
                    $total_price = 0;
                ?>
                <div class="row mb-5">
                    <div class="col-md-6 col-xl-6 mb-6 mb-xl-0">
                        <div class="confirmation-card">
                            <h3 class="billing-title">Billing Details</h3>
                            <table class="order-rable">
                                <?php
                                    foreach ($_SESSION['order'] as $orders) {
                                ?>
                                <tr>
                                    <td>Order number</td>
                                    <td>: <?php echo $orders['user_email'] ?></td>
                                </tr>
                                <tr>
                                    <td>Date</td>
                                    <td>: <?php echo $orders['user_phone'] ?></td>
                                </tr>
                                <?php
                                    }   
                                ?>
                            </table>
                        </div>
                        <?php
                            if (isset($_POST['action']) && $_POST['action'] == "edit") {
                                echo'
                                    <div class="alert alert-success alert-dismissible text-center">
                                        <strong> '.$status.'</strong>
                                    </div>';
                            }         
                        ?>
                    </div>
                    <div class="col-md-6 col-xl-6 mb-6 mb-xl-0">
                        <div class="confirmation-card">
                            <h3 class="billing-title">Edit Billing Details</h3>
                            <?php
                                foreach ($_SESSION['order'] as $order) {
                            ?>
                            <form class="row contact_form" action="confirmation" method="post">
                                <table class="order-rable">
                                    <tr>
                                        <div class="col-md-6 form-group p_star">
                                            <input type="email" class="form-control" name="user_email" value="<?php echo $order['user_email'] ?>">
                                        </div>
                                        <div class="col-md-6 form-group p_star">
                                            <input type="tel" class="form-control" name="user_phone" value="<?php echo $order['user_phone'] ?>">
                                        </div>
                                        <input type='hidden' name='code' value="<?php echo $order['code']; ?>" />
                                        <input type='hidden' name='action' value="edit" />
                                        <button type="submit" name="submit" class="button button-paypal">Edit </button>
                                    </tr>
                                </table>
                            </form>
                            <?php
                                }   
                            ?>
                        </div>
                    </div>
                </div>
                <div class="order_details_table">
                    <h2>Cart Details</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($_SESSION['cart'] as $product) {
                                ?>
                                <tr>
                                    <td>
                                        <p><?php echo $product['product_title'] ?></p>
                                    </td>
                                    <td>
                                        <h5><?php echo $product['product_category'] ?></h5>
                                    </td>
                                    <td>
                                        <p>R<?php echo $product['product_price'] ?></p>
                                    </td>
                                </tr>
                                <?php 
                                    $total_price += $product['product_price'];
                                    }
                                ?>
                                <tr>
                                    <td>
                                        <h4>Total</h4>
                                    </td>
                                    <td>
                                        <h5></h5>
                                    </td>
                                    <td>
                                        <h4>R<?php echo number_format($total_price, 2, '.', ' ') ?></h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><br>
                <div class="billing_details">
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="row contact_form" action="payment-successful" method="post">
                                <!-- Hidden -->
                                <input type="hidden" name="cmd" value="_paynow">
                                <input type="hidden" name="receiver" value="13583702">
                                <input type="hidden" name="item_name" value="<?php echo $product['product_title'] ?>">
                                <input type="hidden" name="amount" value="<?php echo $total_price?>">
                                <input type="hidden" name="item_description" value="<?php echo $order['user_email'].' - '.$order['user_phone'] ?>">
                                <input type="hidden" name="return_url" value="payment-successful">
                                <input type="hidden" name="cancel_url" value="payment-cancelled">
                                <div class="col-md-12 form-group">
                                    <div class="creat_account">
                                        <input type="checkbox" name="agreement" id="f-option2" required>
                                        <label for="f-option2">I agree to the Terms & Conditions and Privacy Policy.</label>
                                    </div>
                                    <div class="check_title">
                                        
                                        <h2><img src="img/product/payfast.png" alt="" height="40px"> After clicking "Proceed To Payment", you will be redirected to PayFast to complete your purchase securely.</h2>
                                    </div><br>
                                    <div class="text-center">
                                        <button type="submit" name="submit" class="button button-paypal">Proceed to Payment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
            </div>
        </section>
        <!--================End Order Details Area =================-->


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
        //include "includes/bottom-cache.php";  
    ?>
