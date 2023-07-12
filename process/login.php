<?php
    session_start();
    include "includes/config.php";

    $errors = array();
    
  	if (isset($_POST['submit'])) {

	    $password = mysqli_real_escape_string($conn,$_POST['password']);
	    $user_email = mysqli_real_escape_string($conn,$_POST['email']);
	    
	    $query = "SELECT * FROM users WHERE user_email = '$user_email'";
	    $result = mysqli_query($conn, $query);
	    $row = mysqli_fetch_array($result);

	    if (!empty($row)) {
	    	
		    if ($row['user_email'] == $user_email) {

		    	$verified_pass = password_verify($password, $row['user_password']);

		        if ($verified_pass){
		            
		            //return true;
		            $_SESSION['email']= $user_email;
		            $_SESSION['user_id']= $row['user_id'];
		            echo '<meta http-equiv="refresh" content="0; url= user-account">';
	 
		            if (isset($_SESSION['rdurl'])) {
		                
		                echo '<meta http-equiv="refresh" content="0; url= '.$_SESSION['rdurl'].'">';
		            }
		        }else {
		            array_push($errors, " Incorrect User Password.");
		        }
		  	}else {
		  		array_push($errors, " Incorrect User Email.");
		  	}
		}else {
			array_push($errors, " Email Does not Match our records.");
		}  	
  	} 
?>