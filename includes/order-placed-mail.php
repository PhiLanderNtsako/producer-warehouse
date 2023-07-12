<?php
    if(isset($_SESSION['user_id'])){

        $to = $row['user_email'];
        $from = "info@producerwarehouse.co.za";
        $name = $row['user_username'];
        $csubject = "Producer Warehouse - Order $order_code Placed";
        //$number = $_REQUEST['number'];
        $cmessage = '<h2>An order with Order Code '.$order_code. ' was successfully processed</h2><br>

            <p>This email does not display all the products ordered.</p>

            <h2>Order Product Details</h2><br>
            <p>Product Title:  ' . $product['product_title'] . '</p>
            <p>Product Category:  '.$product['product_category'].'</p>
            <p>Product Pricing:  '. $product['product_pricing'].'</p>
            <p>Product Price:  R'.$product['product_price'].'</p><br>

            <h2>Order User Details</h2><br>
            <p>Email:  '.$row['user_email'].'</p>
            <p>Phone:  '.$row['user_phone'].'</p>

            <p><a href="user-account.php">View Order </a></p>

            <p>PRODUCER WAREHOUSE.</p>';

        $headers = "From: $from";
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: ". $from . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $subject = "Producer Warehouse - Order $order_code Placed";

        $logo = 'img/logo.png';
        $link = 'index.php';

        $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Producer Warehouse</title></head><body>";
        $body .= "<table style='width: 100%;'>";
        $body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
        $body .= "<a href='{$link}'><img src='{$logo}' alt=''></a><br><br>";
        $body .= "</td></tr></thead><tbody><tr>";
        $body .= "<td style='border:none;'><strong>Name:</strong> {$name}</td>";
        $body .= "<td style='border:none;'><strong>Email:</strong> {$from}</td>";
        $body .= "</tr>";
        $body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$csubject}</td></tr>";
        $body .= "<tr><td></td></tr>";
        $body .= "<tr><td colspan='2' style='border:none;'>{$cmessage}</td></tr>";
        $body .= "</tbody></table>";
        $body .= "</body></html>";

        $send = mail($to, $subject, $body, $headers);
    }else {
        $to = $user_email;
        $from = "info@producerwarehouse.co.za";
        $name = $row['user_username'];
        $csubject = "Producer Warehouse - Order $order_code Placed";
        //$number = $_REQUEST['number'];
        $cmessage = '<h2>An order with Order Code '.$order_code. ' was successfully processed</h2><br>

            <p>This email does not display all the products ordered.</p>

            <h2>Order Product Details</h2><br>
            <p>Product Title:  ' . $product['product_title'] . '</p>
            <p>Product Category:  '.$product['product_category'].'</p>
            <p>Product Pricing:  '. $product['product_pricing'].'</p>
            <p>Product Price:  R'.$product['product_price'].'</p><br>

            <h2>Order User Details</h2><br>
            <p>Email:  '.$user_email.'</p>
            <p>Phone:  '.$user_phone.'</p>

            <p><a href="user-account.php">View Order </a></p>

            <p>PRODUCER WAREHOUSE.</p>';

        $headers = "From: $from";
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: ". $from . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $subject = "Producer Warehouse - Order $order_code Placed";

        $logo = 'img/logo.png';
        $link = 'index.php';

        $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Producer Warehouse</title></head><body>";
        $body .= "<table style='width: 100%;'>";
        $body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
        $body .= "<a href='{$link}'><img src='{$logo}' alt=''></a><br><br>";
        $body .= "</td></tr></thead><tbody><tr>";
        $body .= "<td style='border:none;'><strong>Name:</strong> {$name}</td>";
        $body .= "<td style='border:none;'><strong>Email:</strong> {$from}</td>";
        $body .= "</tr>";
        $body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$csubject}</td></tr>";
        $body .= "<tr><td></td></tr>";
        $body .= "<tr><td colspan='2' style='border:none;'>{$cmessage}</td></tr>";
        $body .= "</tbody></table>";
        $body .= "</body></html>";

        $send = mail($to, $subject, $body, $headers);
    }               

?>