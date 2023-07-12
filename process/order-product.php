<?php 
	session_start();
  	include "../includes/config.php";

if (isset($_POST['submit'])) {
	
	$user_fullName = mysqli_real_escape_string($conn,$_POST['user_fullName']);
	$user_username = mysqli_real_escape_string($conn,$_POST['user_username']);
	$user_phone = $_POST['user_phone'];
    $user_email = mysqli_real_escape_string($conn,$_POST['user_email']);
    $order_town_city = mysqli_real_escape_string($conn,$_POST['user_town_city']);
    $order_province = mysqli_real_escape_string($conn,$_POST['user_province']);
    $product_id = $_POST['product_id'];
    echo $selector = $_POST['selector'];

    $total_price = 0;

    if(isset($_SESSION['user_id'])){

        $user_id = $_SESSION['user_id'];

        $ins_order = "INSERT INTO orders (user_id, payment_status, order_date) VALUES('$user_id', 'Payment Pending', Now())";
        mysqli_query($conn, $ins_order);
	    $order_id = mysqli_insert_id($conn);
        echo mysqli_error($conn);

        foreach ($_SESSION["shopping_cart"] as $product) {

            $product_id = $product['product_id'];

            $total_price += $product["product_price"];

            $ins_order_items = "INSERT INTO order_items (order_id, product_id, user_email, order_town_city, order_province) VALUES('$order_id', '$product_id', '$user_email', '$order_town_city', '$order_province')";
            mysqli_query($conn, $ins_order_items);
            echo mysqli_error($conn);
        }

        $order_code = 'PW#' . $order_id;
        $query = "UPDATE orders SET order_code = '$order_code', order_total_price = '$total_price' WHERE order_id = $order_id";
        mysqli_query($conn, $query);
        echo mysqli_error($conn);

        include '../includes/order-placed-mail.php';
        unset($_SESSION["shopping_cart"]);
        //echo '<meta http-equiv="refresh" content="0; url= ">';
        
    }else{

        $check_user_email = "SELECT * FROM users WHERE user_email = '$user_email' LIMIT 1";
        $result = mysqli_query($conn, $check_user_email);

        if(!empty($row = mysqli_fetch_array($result))){

            if ($row['user_email'] == $user_email) {

                $user_id = $row['user_id'];

                $ins_order = "INSERT INTO orders (user_id, payment_status, order_date) VALUES('$user_id', 'Payment Pending', Now())";
                mysqli_query($conn, $ins_order);
                $order_id = mysqli_insert_id($conn);
                echo mysqli_error($conn);

                foreach ($_SESSION["shopping_cart"] as $product) {

                    $product_id = $product['product_id'];

                    $total_price += $product["product_price"];

                    $ins_order_items = "INSERT INTO order_items (order_id, product_id, user_email, order_town_city, order_province) VALUES('$order_id', '$product_id', '$user_email', '$order_town_city', '$order_province')";
                    mysqli_query($conn, $ins_order_items);
                    echo mysqli_error($conn);
                }

                $order_code = 'PW#' . $order_id;
                $query = "UPDATE orders SET order_code = '$order_code', order_total_price = '$total_price' WHERE order_id = $order_id";
                mysqli_query($conn, $query);
                echo mysqli_error($conn);

                include '../includes/order-placed-mail.php';
                unset($_SESSION["shopping_cart"]); 
                //echo '<meta http-equiv="refresh" content="0; url= ">';
            }
        }else{

            $insert_user = "INSERT INTO users(user_email) VALUES('$user_email')";
            mysqli_query($conn, $insert_user);
            $user_id = mysqli_insert_id($conn);
            echo mysqli_error($conn);

            $ins_order = "INSERT INTO orders (user_id, payment_status, order_date) VALUES('$user_id', 'Payment Pending', Now())";
            mysqli_query($conn, $ins_order);
            $order_id = mysqli_insert_id($conn);
            echo mysqli_error($conn);

            foreach ($_SESSION["shopping_cart"] as $product) {

                $product_id = $product['product_id'];

                $total_price += $product["product_price"];

                $ins_order_items = "INSERT INTO order_items (order_id, product_id, user_email, order_town_city, order_province) VALUES('$order_id', '$product_id', '$user_email', '$order_town_city', '$order_province')";
                mysqli_query($conn, $ins_order_items);
                echo mysqli_error($conn);
            }

            $order_code = 'PW#' . $order_id;
            $query = "UPDATE orders SET order_code = '$order_code', order_total_price = '$total_price' WHERE order_id = $order_id";
            mysqli_query($conn, $query);
            echo mysqli_error($conn);

            include '../includes/order-placed-mail.php';
            unset($_SESSION["shopping_cart"]);  
            //echo '<meta http-equiv="refresh" content="0; url= ">';

        }
    }

}
    
?>