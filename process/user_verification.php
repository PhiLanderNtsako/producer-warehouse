<?php 
        include "../includes/config.php";
        session_start();

	$verification_code = $_GET['code'];
	$user_email = $_GET['email'];

	$user_check_query = "SELECT * FROM users WHERE user_email = '$user_email' AND user_verification = '$verification_code' LIMIT 1";
	$result = mysqli_query($conn, $user_check_query);
	$user = mysqli_fetch_assoc($result);

        if($user) {

                $user_id = $user['user_id'];
        	$verify_user = "UPDATE users SET user_verification = 'Verified' WHERE user_id = $user_id";
        	mysqli_query($conn, $verify_user);
        	$_SESSION['user_id'] = $user_id;
		mysqli_close($conn);

                echo '<meta http-equiv="refresh" content="0; url= ../user-account.php">';
                echo 'Sucess';
        }
?>