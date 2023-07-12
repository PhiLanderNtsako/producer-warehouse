<?php 
	
  	session_start();
  	
  	include "includes/config.php";

  	$errors = array();
  	if (isset($_POST['submit'])) {

        $user_type = mysqli_real_escape_string($conn,$_POST['user_type']);
        $user_firstName = mysqli_real_escape_string($conn,$_POST['user_firstName']);
        $user_lastName = mysqli_real_escape_string($conn,$_POST['user_lastName']);
        $user_username = mysqli_real_escape_string($conn,$_POST['user_username']);
		$user_phone = $_POST['user_phone'];
		$user_password = mysqli_real_escape_string($conn,$_POST['user_password']);
		$password_verification = mysqli_real_escape_string($conn,$_POST['password_verification']);
		$user_email = mysqli_real_escape_string($conn,$_POST['firstName']);

		if ($user_password != $password_verification) {
			array_push($errors, " Passwords do not match.");
		}

	    $user_check_query = "SELECT * FROM users WHERE user_email = '$user_email' LIMIT 1";
	    $result = mysqli_query($conn, $user_check_query);
	    $user = mysqli_fetch_assoc($result);

        if($user) {

        	if ($user['user_email'] === $user_email) {

        		$unique_id = uniqid();
        		$rand_start = mt_rand(1,5);
                $verification_code = substr($unique_id, $rand_start);
                $hashPassword = password_hash($user_password, PASSWORD_DEFAULT);
                $user_id = $user['user_id'];
                
                $query = "UPDATE users SET user_type = '$user_type', user_firstName = '$user_firstName', user_lastName = '$user_lastName', user_phone = '$user_phone', user_username = '$user_username', user_password = '$hashPassword', user_verification = '$verification_code'  WHERE user_id = '$user_id'";

                mysqli_query($conn, $query);
                $_SESSION['user_id'] = $user_id;
                mysqli_close($conn);

                //Sending User Email for verification of account.    
                $to = $user['user_email'];
                $from = "info@producerwarehouse.co.za";
                $name = $user_username;
                $subject = "Producer Warehouse User Account Verification";
                $number = $_REQUEST['number'];
                $cmessage = '<h2>Account registration and verification for '.$user['user_email'].'</h2><br>

                    <p>Click The Link Below To Confirm Your Email and Verify Your User Account</p>

                    <p><a href="user_registration.php?code='.$user_verification.'&email='.$user['user_email'].'">Verify Here </a></p>

                    <p>Or Copy and Paste this link on your browser</p>

                    <p><a href="user_registration.php?code='.$user_verification.'&email='.$user['user_email'].'">user_registration.php?code='.$user_verification.'&email='.$user['user_email'].'</a></p>

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
	
		        $message2 = "Email Is Sent To ".$user_email." For User Verification.";

		        echo "<script type='text/javascript'>alert('$message2')</script>";

		        echo '<meta http-equiv="refresh" content="0; url= user-account.php">';
        	}
        }else {
        		
        	$unique_id = uniqid();
        	$rand_start = mt_rand(1,5);
            $verification_code = substr($unique_id, $rand_start);
            $hashPassword = password_hash($user_password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (user_type, user_firstName, user_lastName, user_phone, user_username, user_email, user_password, user_verification) VALUES ('$user_type', '$user_firstName', '$user_lastName','$user_phone', '$user_username', '$user_email', '$hashPassword', '$verification_code')";

            mysqli_query($conn, $query);
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            mysqli_close($conn);
            
            //Sending User Email for verification of account.    
            $to = $user['user_email'];
            $from = "info@producerwarehouse.co.za";
            $name = $user_username;
            $subject = $_REQUEST['subject'];
            $number = $_REQUEST['number'];
            $cmessage = '<h2>Account registration and verification for '.$user['user_email'].'</h2><br>

                <p>Click The Link Below To Confirm Your Email and Verify Your User Account</p>

                <p><a href="user_registration.php?code='.$verification_code.'&email='.$user['user_email'].'">Verify Here </a></p>

                <p>Or Copy and Paste this link on your browser</p>

                <p><a href="user_registration.php?code='.$verification_code.'&email='.$user['user_email'].'">user_registration.php?code='.$verification_code.'&email='.$user['user_email'].'</a></p>

                <p>IF YOU DID NOT REQUEST THIS ACTION OR YOU DID NOT SIGN UP FOR PRODUCER WAREHOUSE IGNORE THIS EMAIL.</p>';

            $headers = "From: $from";
            $headers = "From: " . $from . "\r\n";
            $headers .= "Reply-To: ". $from . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            $subject = "Producer Warehouse Account Verification.";

            $logo = 'img/logo.png';
            $link = 'index.php';

            $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
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


		    echo "<script type='text/javascript'>alert('$message2')</script>";

        	echo '<meta http-equiv="refresh" content="0; url= index.php">';		
        }
    }
?>