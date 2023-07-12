<?php
    include "includes/top-cache.php";
    include "includes/config.php"; 

    session_start();

    if (!isset($_SESSION['user_id'])) {
        echo '<meta http-equiv="refresh" content="0; url= sign-in">';
    }

    $_SESSION['rdurl'] = $_SERVER['REQUEST_URI'];
    $session_timeout = 9000;

    if (!isset($_SESSION['last_visit'])) {
        $_SESSION['last_visit'] = time();
    }
    if ((time() - $_SESSION['last_visit']) > $session_timeout) {
        unset($_SESSION['user_id']);

        if (isset($_SESSION['rdurl'])) {
            echo '<meta http-equiv="refresh" content="0; url= '.$_SESSION['rdurl'].'">';
            exit;
        }
    }
    $_SESSION['last_visit'] = time();
    $total_price = 0.00;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <base href="http://localhost/projects/producerwarehouse/">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>PRODUCER WAREHOUSE - Sold Products</title>
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

            <!--================ Track Orders =================-->
            <?php
                $user_id = $_SESSION['user_id'];
          
                $sql ="SELECT * FROM users INNER JOIN products ON products.user_id = users.user_id INNER JOIN order_items ON order_items.product_id = products.product_id INNER JOIN orders ON order_items.order_id = orders.order_id WHERE users.user_id = '$user_id' AND order_payment_status ='Paid'";
                $result_set=mysqli_query($conn,$sql);
            ?>    
            <section class="cart_area">
                <div class="container">
                    <div class="section-intro pb-60px">
                        <p>Track your sold products</p>
                        <h2>Your <span class="section-intro__style">Sold Products</span></h2>
                    </div>
                    <div class="cart_inner">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">15% Fee</th>
                                        <th scope="col">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while ($row=mysqli_fetch_array($result_set)){ 
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img src="uploads/<?php echo $row['product_folderName'] ?>/<?php echo $row['product_image'] ?>" alt="" height="60px">
                                                </div>
                                                <div class="media-body">
                                                    <p><?php echo $row["product_title"]; ?><br><small><?php echo $row["order_date"]; ?> | <?php echo $row["order_code"]; ?></small></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h5><?php echo $row["product_category"]; ?></h5>
                                        </td>
                                        <td>
                                            <h5>R<?php echo $row["product_price"]; ?></h5>
                                        </td>
                                        <td>
                                            <h5><?php 
                                                  $fee = $row["product_price"] * (15 / 100);
                                                  echo number_format($fee, 2, '.', ' ');
                                            ?></h5>
                                        </td>
                                        <td>
                                            <h5><?php 
                                                  $subtotal = $row["product_price"] - $fee;
                                                  echo 'R'.number_format($subtotal, 2, '.', ' ');
                                            ?></h5>
                                        </td>
                                    </tr>
                                    <?php
                                        $total_price += $subtotal;
                                        }
                                    ?>
                                    <tr>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                            <a class="button button-hero" href="javascript:;">Withdraw</a>
                                        </td>
                                        <td>
                                            <h5>R<?php echo number_format($total_price, 2, '.', ' ');?></h5>
                                        </td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <!--================End Track Orders =================-->

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
