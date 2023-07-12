<?php
    include "includes/top-cache.php";  
    include "includes/config.php";
    session_start();

    $_SESSION['rdurl'] = $_SERVER['REQUEST_URI'];
    $status = "";

    if (isset($_POST['action']) && $_POST['action'] == "clear") {
        $status = "Your Cart Is Cleared";
        unset($_SESSION['cart']);
        unset($_SESSION['order']);
    }
    if (isset($_POST['action']) && $_POST['action'] == "remove") {

        if (!empty($_SESSION['cart'])) {

            foreach ($_SESSION['cart'] as $key => $value) {

                if ($_POST['code'] == $key) {

                    unset($_SESSION['cart'][$key]);
                    $status = "Product Removed From Your Cart";
                }
                if (empty($_SESSION['cart'])) {
                    unset($_SESSION['cart']);
                    unset($_SESSION['order']);
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <base href="http://localhost/projects/producerwarehouse/">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Producer Warehouse - Cart</title>
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
            if ((isset($_POST['action']) && $_POST['action'] == "clear") || (isset($_POST['action']) && $_POST['action'] == "remove")) {
                echo'
                <div class="alert alert-success alert-dismissible text-center">
                    <strong> '.$status.'</strong>
                </div>';
            }
        ?>
        <!--================ End Header Menu Area =================-->

        <!--================ Cart Area =================-->
        <?php
            if (isset($_SESSION['cart'])) {

            $total_price = 0;
        ?>
            <section class="cart_area">
                <div class="container">
                    <div class="section-intro pb-60px">
                    <?php
                        if (!empty($_SESSION['cart'])) {
                            $cart_count = count(array_keys($_SESSION['cart']));
                    ?>
                        <p>you have (<?php echo $cart_count ?>) products in...</p>
                        <h2>Your <span class="section-intro__style">Cart</span></h2>
                    <?php 
                        }
                    ?>
                    </div>
                    <div class="cart_inner">
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
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img src="uploads/<?php echo $product['product_folderName'].'/'.$product['product_image'] ?>" alt="" height="50px">
                                                </div>
                                                <div class="media-body">
                                                    <p><?php echo $product["product_title"]; ?><br><small><?php echo $product["user_username"]; ?></small></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h5><?php echo $product["product_category"]; ?></h5>
                                        </td>
                                        <td>
                                            <h5>R<?php echo $product["product_price"]; ?></h5>
                                        </td>
                                        <td>
                                            <form method='post' action='' id='form'>
                                                <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                                                <input type='hidden' name='action' value="remove" />
                                                <div class="col-md-12 form-group">
                                                    <button type="submit" name="send" class="button button-tracking">Delete</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                    $total_price += $product['product_price'];
                                    }
                                ?>  
                                    <tr class="bottom_button">
                                        <td>
                                            <h5>Subtotal</h5>
                                        </td>
                                        <td></td>
                                        <td>
                                            <h5>R<?php echo number_format($total_price, 2, '.', ' ') ?></h5>
                                        </td>
                                        <td>
                                            <form method='post' action='' id='clear-form'>
                                                <input type='hidden' name='action' value="clear">
                                                <a class="button" href="javascript:;" onclick="document.getElementById('clear-form').submit();">Clear</a>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="out_button_area">
                                        <td class="d-none-l"></td>
                                        <td class=""></td>
                                        <td></td>
                                        <td>
                                            <div class="checkout_btn_inner d-flex align-items-center">
                                                <a class="gray_btn" href="home">Continue Shopping</a>
                                                <a class="primary-btn ml-2" href="checkout">Checkout</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }else{
        ?>
            <section class="cart_area">
                <div class="container">
                    <div class="section-intro pb-60px">
                        <p>you have (0) products in cart</p>
                        <h2>Your <span class="section-intro__style">Cart is empty</span></h2>
                        <table class="table">
                            <tbody>
                                <tr class="out_button_area">
                                    <td class="d-none-l"></td>
                                    <td class=""></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="checkout_btn_inner d-flex align-items-center">
                                            <a class="gray_btn" href="home">Continue Shopping</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        <?php 
            }
        ?>    
        <!--================End Cart Area =================-->

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
