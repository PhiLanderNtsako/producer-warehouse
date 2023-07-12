<?php
	include "includes/top-cache.php"; 
	include "includes/config.php";     
	session_start();

    	$errors = array();
    	if (isset($_POST['submit'])) {

		$user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
		$user_username = mysqli_real_escape_string($conn, $_POST['user_username']);
		$user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
		$password_verification = mysqli_real_escape_string($conn, $_POST['password_verification']);
		$user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
		$user_phone = $_POST['user_phone']; 

		if ($user_password != $password_verification) {
			array_push($errors, " Passwords do not match.");
		}else{
			$user_check_query = "SELECT * FROM users WHERE user_email = '$user_email' LIMIT 1";
			$result = mysqli_query($conn, $user_check_query);
			$user = mysqli_fetch_assoc($result);

			if ($user) {

				if(empty($user['user_verification'])){

					$unique_id = uniqid();
					$rand_start = mt_rand(1, 5);
					$verification_code = substr($unique_id, $rand_start);
					$hashPassword = password_hash($user_password, PASSWORD_DEFAULT);
					$user_id = $user['user_id'];

					$update_user = "UPDATE users SET user_type = '$user_type', user_username = '$user_username', user_phone = '$user_phone', user_password = '$hashPassword', user_verification = '$verification_code', created_at = NOW() WHERE user_id = '$user_id'";
					$results = mysqli_query($conn, $update_user);
					echo mysqli_error($conn);
					$_SESSION['user_id'] = $user_id;
				
					include 'includes/acc-verify-mail.php';
					$message2 = "Email Is Sent To " . $user_email . " For User Verification.";
					echo "<script type='text/javascript'>alert('$message2')</script>";

					echo '<meta http-equiv="refresh" content="0; url= http://localhost/projects/producerwarehouse/user-account">';

				}else {
					array_push($errors, "Account already exist under this email.");
				}
			}else {
				$unique_id = uniqid();
				$rand_start = mt_rand(1, 5);
				$verification_code = substr($unique_id, $rand_start);
				$hashPassword = password_hash($user_password, PASSWORD_DEFAULT);

				$insert_user = "INSERT INTO users(user_type, user_phone, user_username, user_email, user_password, user_verification) VALUES ('$user_type','$user_phone', '$user_username', '$user_email', '$hashPassword', '$verification_code')";
				mysqli_query($conn, $insert_user);
				$_SESSION['user_id'] = mysqli_insert_id($conn);
				echo mysqli_error($conn);
				mysqli_close($conn);  

				include 'includes/acc-verify-mail.php';
				$message2 = "Email Is Sent To " . $user_email . " For User Verification.";
				echo "<script type='text/javascript'>alert('$message2')</script>";

				echo '<meta http-equiv="refresh" content="0; url= user-account">';
			}
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
	<title>PRODUCER WAREHOUSE - Sign Up</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">
	<link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="vendors/linericon/style.css">
	<link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
	<link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
	<link rel="stylesheet" href="vendors/nice-select/nice-select.css">
	<link rel="stylesheet" href="vendors/nouislider/nouislider.min.css">
	<link rel="stylesheet" href="css/style.css">
    </head>
    <body>
	<!--================ Start Header Menu Area =================-->
	<?php
	    include 'includes/header.php';
	?>
	<!--================ End Header Menu Area =================-->

	<!--================Login Box Area =================-->
	<section class="login_box_area section-margin">
	    <div class="container">
		<div class="row">
		    <div class="col-lg-6">
			<div class="login_box_img">
			    <div class="hover">
				<h4>Welcome To Producer Warehouse</h4>
				<p class="text-warning">
				    - password must be atleast 1 character, number, lowercase and uppercase letters, it must be 8 or more in length.
				</p>
				<h4>Already Have an Account?</h4>
				<p>Login into your account and keep track of your orders, products and more tools</p>
				<a class="button button-account" href="sign-in">Login Now</a>
			    </div>
			</div>
		    </div>
		    <div class="col-lg-6">
			<div class="login_form_inner register_form_inner">
			    <h3>Create an account</h3>
			    <?php if (count($errors) > 0) : ?>
			    	<?php foreach ($errors as $error) : ?>
			    	    <small style="color: red"><?php echo $error ?></small>
			       	<?php endforeach ?>
			    <?php endif ?>
			    <form class="row login_form" action="<?=$_SERVER['PHP_SELF']?>" id="register_form" method="POST">
				<div class="col-md-12 form-group">
				    <div class="sorting">
					<select name="user_type" required>
					    <option value="">Select User Type</option>
					    <option value="Seller">Seller - Producer/Composer</option>
					    <option value="Buyer">Buyer - Artist/Producer</option>
					</select>
				    </div>
				</div>
				<div class="col-md-12 form-group">
				    <input type="text" class="form-control" id="user_username" name="user_username" placeholder="Username" required>
				</div>
				<div class="col-md-12 form-group">
				    <input type="tel" class="form-control" id="user_phone" name="user_phone" placeholder="Phone Number" pattern="[0-9]{10}" required>
				</div>
				<div class="col-md-12 form-group">
				    <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email Address" pattern="[A-z0-9.]+@[A-z]+.\.[A-z.}]+" required>
				</div>
				<div class="col-md-12 form-group">
				    <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
				</div>
				<div class="col-md-12 form-group">
				    <input type="password" class="form-control" id="password_verification" name="password_verification" placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
				</div>
				<div class="col-md-12 form-group">
				    <div class="creat_account">
					<input type="checkbox" name="agreement" id="f-option2" required>
					<label for="f-option2">I agree to the Terms & Conditions and Privacy Policy. </label>
				    </div>
				</div>
				<div class="col-md-12 form-group">
				    <button type="submit" value="submit" name="submit" class="button button-login w-100">Register</button>
				</div>
			    </form>
	    		</div>
		    </div>
		</div>
	    </div>
	</section>
	<!--================End Login Box Area =================-->

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