<?php
    include "includes/top-cache.php"; 
    include "includes/config.php"; 
    session_start();

    if (!isset($_SESSION['user_id'])) {
        echo '<meta http-equiv="refresh" content="0; url= sign-in">';
    }

    $_SESSION['rdurl'] = $_SERVER['REQUEST_URI'];
    $session_timeout = 3600;

    if (!isset($_SESSION['last_visit'])) {
        $_SESSION['last_visit'] = time();
    }
    if ((time() - $_SESSION['last_visit']) > $session_timeout) {
        unset($_SESSION['user_id']);
    }

    $_SESSION['last_visit'] = time();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <base href="http://localhost/projects/producerwarehouse/">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>PRODUCER WAREHOUSE - User Account</title>
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

            <?php
                $user_id = $_SESSION['user_id'];

                $query = "SELECT * FROM users WHERE user_id = '$user_id' AND user_type = 'Seller'";
                $result = mysqli_query($conn, $query);

                if ($row = mysqli_fetch_assoc($result)){

                    $user_id = $_SESSION['user_id'];
          
                    $query_products = "SELECT * FROM users, products WHERE users.user_id = '$user_id' AND products.user_id = users.user_id ORDER BY products.product_id DESC";
                    $result_set = mysqli_query($conn,$query_products);
            ?>
            <!--================ Uploaded Products =================-->
            <section class="cart_area">
                <div class="container">
                    <div class="section-intro pb-60px">
                        <p>uploaded products</p>
                        <h2>Your <span class="section-intro__style">Products</span></h2>
                    </div>
                    <div class="cart_inner">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Verification</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while ($row=mysqli_fetch_assoc($result_set)) 
                                        { 
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img src="uploads/<?php echo $row['product_folderName'].'/'.$row['product_image'] ?>" alt="" height="60px">
                                                </div>
                                                <div class="media-body">
                                                    <p><?php echo $row["product_title"]; ?><br><small><?php echo $row["product_date"]; ?></small></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h5>
                                                <?php echo $row["product_category"]; ?><br>
                                                <small><?php echo $row["product_pricing"]; ?></small>
                                            </h5>
                                        </td>
                                        <td>
                                            <h5>R<?php echo $row["product_price"]; ?></h5>
                                        </td>
                                        <td>
                                            <h5><?php echo $row["product_description"]; ?></h5>
                                        </td>
                                        <?php
                                            if($row['product_verification'] == 'Verified'){
                                        ?>
                                        <td>
                                            <a class="button button-hero" href="order-details/<?php echo $row['order_id']?>"><i class="ti-shopping-cart"></i></a>
                                        </td>
                                        <?php
                                            }else{
                                        ?>
                                        <td>
                                        <h5><?php echo $row["product_verification"]; ?></h5>
                                        </td>
                                        <?php
                                            }
                                        ?>         
                                    </tr>
                                    <?php
                                        }
                                    ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <?php
                }
            ?>    
            <!--================End Uploaded Products =================-->

            <!--================ Track Orders =================-->
            <?php
                $user_id = $_SESSION['user_id'];
          
                $query_orders = "SELECT * FROM users, orders WHERE users.user_id = '$user_id' AND orders.user_id = users.user_id ORDER BY orders.order_id DESC";
                $result_set = mysqli_query($conn,$query_orders);
            ?>    
            <section class="cart_area">
                <div class="container">
                    <div class="section-intro pb-60px">
                        <p>bought products</p>
                        <h2>Your <span class="section-intro__style">Orders</span></h2>
                    </div>
                    <div class="cart_inner">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Payment Status</th>
                                        <th scope="col">Order Items</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while ($row=mysqli_fetch_assoc($result_set)){ 
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="media-body">
                                                    <p>Order: <?php echo $row["order_code"]; ?><br><small><?php echo $row["order_date"]; ?></small></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h5>R<?php echo $row["order_total_price"]; ?></h5>
                                        </td>
                                        <td>
                                            <h5>Paid</h5>
                                        </td>
                                        <td>
                                            <a class="button button-hero" href="order-details/<?php echo $row['order_id']?>">Details</a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?> 
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
