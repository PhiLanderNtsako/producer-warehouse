<?php
    include "includes/config.php";
    session_start();

    $total_price = 0;
  
    if(isset($_SESSION['user_id'])){
  
        $user_id = $_SESSION['user_id'];
  
        $ins_order = "INSERT INTO orders (user_id, order_payment_status, order_date) VALUES('$user_id', 'Paid', Now())";
        mysqli_query($conn, $ins_order);
        $order_id = mysqli_insert_id($conn);
        echo mysqli_error($conn);
  
        foreach ($_SESSION['cart'] as $product) {
  
            $product_id = $product['product_id'];
  
            $total_price += $product["product_price"];
  
            $ins_order_items = "INSERT INTO order_items (order_id, product_id) VALUES('$order_id', '$product_id')";
            mysqli_query($conn, $ins_order_items);
            echo mysqli_error($conn);
        }
  
        $order_code = 'pw_o#'.$order_id;
        $query = "UPDATE orders SET order_code = '$order_code', order_total_price = '$total_price' WHERE order_id = $order_id";
        mysqli_query($conn, $query);
        echo mysqli_error($conn);

        $query_user = "SELECT * SET users WHERE user_id = $user_id";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $query_user));

        include 'includes/order-placed-mail.php';
        unset($_SESSION['cart']);
        unset($_SESSION['order']);
        $status = "Order Successfully Processed";
        //echo '<meta http-equiv="refresh" content="0; url= user_account.php">';
          
    }else{

        foreach ($_SESSION['order'] as $order) {
            $user_email = $order['user_email'];
            $user_phone = $order['user_phone'];
        }

        $check_user_email = "SELECT * FROM users WHERE user_email = '$user_email' LIMIT 1";
        $result = mysqli_query($conn, $check_user_email);
  
        if(!empty($row = mysqli_fetch_array($result))){
  
            if($row['user_email'] == $user_email) {

                $user_id = $row['user_id'];

                $ins_order = "INSERT INTO orders (user_id, order_payment_status, order_date) VALUES('$user_id', 'Paid', Now())";
                mysqli_query($conn, $ins_order);
                $order_id = mysqli_insert_id($conn);
                echo mysqli_error($conn);

                foreach ($_SESSION['cart'] as $product) {

                    $product_id = $product['product_id'];
                    $total_price += $product["product_price"];

                    $ins_order_items = "INSERT INTO order_items (order_id, product_id) VALUES('$order_id', '$product_id')";
                    mysqli_query($conn, $ins_order_items);
                    echo mysqli_error($conn);
                }

                $order_code = 'pw_o#'.$order_id;
                $query = "UPDATE orders SET order_code = '$order_code', order_total_price = '$total_price' WHERE order_id = $order_id";
                mysqli_query($conn, $query);
                echo mysqli_error($conn);

                include 'includes/order-placed-mail.php';
                unset($_SESSION['cart']);
                unset($_SESSION['order']);
                $status = "Order Successfully Processed";
                //echo '<meta http-equiv="refresh" content="0; url= user_account.php">';
            }
        }else{

            foreach ($_SESSION['order'] as $order) {

                $user_email = $order['user_email'];
                $user_phone = $order['user_phone'];
            }

            $insert_user = "INSERT INTO users(user_email, user_phone) VALUES('$user_email', '$user_phone')";
            mysqli_query($conn, $insert_user);
            $user_id = mysqli_insert_id($conn);
            echo mysqli_error($conn);

            $ins_order = "INSERT INTO orders (user_id, order_payment_status, order_date) VALUES('$user_id', 'Paid', Now())";
            mysqli_query($conn, $ins_order);
            $order_id = mysqli_insert_id($conn);
            echo mysqli_error($conn);

            foreach ($_SESSION['cart'] as $product) {

                $product_id = $product['product_id'];
                $total_price += $product["product_price"];

                $ins_order_items = "INSERT INTO order_items (order_id, product_id) VALUES('$order_id', '$product_id')";
                mysqli_query($conn, $ins_order_items);
                echo mysqli_error($conn);
            }

            $order_code = 'pw_o#'.$order_id;
            $query = "UPDATE orders SET order_code = '$order_code', order_total_price = '$total_price' WHERE order_id = $order_id";
            mysqli_query($conn, $query);
            echo mysqli_error($conn);

            include 'includes/order-placed-mail.php';
            unset($_SESSION['cart']);
            unset($_SESSION['order']);
            $status = "Order Successfully Processed";
            //echo '<meta http-equiv="refresh" content="0; url= user_account.php">';
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
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand logo_h" href="home"><img src="img/logo.png" alt="" height="70px"></a>
                </div>
            </nav>
        </div>
    </header>
    <!--================ End Header Menu Area =================-->
    <div class="alert alert-success alert-dismissible text-center">
        <strong><?php echo $status ?></strong>
    </div>
    <!-- ================ offer section start ================= --> 
    <section class="offer" id="parallax-1" data-anchor-target="#parallax-1" data-300-top="background-position: 20px 30px" data-top-bottom="background-position: 0 20px">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <div class="offer__content text-center">
                        <h3>Payment Succesful</h3>
                        <p>links were sent to your email. Page will reload in 15 seconds</p>
                        <?php
                            $query ="SELECT * FROM users INNER JOIN orders ON orders.user_id = users.user_id INNER JOIN order_items ON order_items.order_id = orders.order_id INNER JOIN products ON products.product_id = order_items.product_id WHERE orders.order_id = '$order_id'";
                            $result = mysqli_query($conn,$query);

                            while($row=mysqli_fetch_assoc($result)){
                        ?>
                        <h4><?php echo $row['product_title']?></h4>
                        <a class="button button--active mt-3 mt-xl-4" href="<?php echo 'uploads/'.$row['product_folderName'].'/'.$row['product_file']?>" download>DOWNLOAD</a><br><br>
                        <?php 
                            } 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ offer section end ================= -->  
  </main>

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


