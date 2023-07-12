<?php 

    $to = $user_email;
    $from = "info@producerwarehouse.co.za";
    $name = $user_username;
    $csubject = "Producer Warehouse User Account Verification";
    //$number = $_REQUEST['number'];
    $cmessage = '<h2>Account registration and verification for '.$user_email.'</h2><br>

        <p>Click The Link Below To Confirm Your Email and Verify Your User Account</p>$user_email

        <p><a href="process/user_verification.php?code='.$verification_code.'&email='.$user_email.'">Verify Here </a></p>

        <p>Or Copy and Paste this link on your browser</p>

        <p><a href="user_verification.php?code='.$verification_code.'&email='.$user_email.'">user_verification.php?code='.$verification_code.'&email='.$user_email.'</a></p>

        <p>IF YOU DID NOT REQUEST THIS ACTION OR YOU DID NOT SIGN UP FOR PRODUCER WAREHOUSE IGNORE THIS EMAIL.</p>';

    $headers = "From: $from";
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: ". $from . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $subject = "Producer Warehouse User Account Verification.";

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