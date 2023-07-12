<?php

    $user_id = $_SESSION['user_id'];

    $query_user = "SELECT * FROM users WHERE user_id = '$user_id'";
    $results = mysqli_query($conn,$query_user);
    $row = mysqli_fetch_assoc($results);

    $to = $row['user_email'];
    $from = "info@producerwarehouse.co.za";
    $name = $row['user_username'];
    $csubject = "Producer Warehouse - Product $product_code Placed";
    //$number = $_REQUEST['number'];
    $cmessage = '<h2>Product '.$product_code. ' was successfully Uploaded</h2><br>

        <h2>Product Details</h2><br>
        <p>Product Title:  '.$product_title.'</p>
        <p>Product Category:  '.$product_category.'</p>
        <p>Product Pricing:  '.$product_pricing.'</p>
        <p>Product Price:  R'.$product_price.'</p><br>
        <p>Product Price:  R'.$product_description.'</p><br>

        <img src='{$upload_dir.'/'.$product_image_name};' height="100px">
        
        <p><a href="">View Product </a></p>

        <p>Your product wont be available to the store until it verified. Verification may take 3 - 4 days. An email will be sent when the product is verified.</p>

        <p>PRODUCER WAREHOUSE.</p>';

    $headers = "From: $from";
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: ". $from . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $subject = "Producer Warehouse - Product $product_code Uploaded";

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
?>