<?php
	include "includes/top-cache.php"; 
	include "includes/config.php";
	session_start();

	$errors = array();
    
	if (isset($_POST['submit'])) {

		$user_password = mysqli_real_escape_string($conn,$_POST['user_password']);
		$user_email = mysqli_real_escape_string($conn,$_POST['user_email']);
		
		$check_email = "SELECT * FROM users WHERE user_email = '$user_email'";
		$result = mysqli_query($conn, $check_email);
		$row = mysqli_fetch_assoc($result);

		if (!empty($row)) {
			
			if ($row['user_email'] == $user_email) {

				$verified_pass = password_verify($user_password, $row['user_password']);

				if ($verified_pass){

					$_SESSION['user_id']= $row['user_id'];

					if (isset($_SESSION['rdurl'])) {
					
						echo '<meta http-equiv="refresh" content="0; url= http://localhost'.$_SESSION['rdurl'].'">';
					}else{
				
						echo '<meta http-equiv="refresh" content="0; url= user-account">';
					}
				}else {
					array_push($errors, "Email or password is wrong.");
				}
			}
		}else {
			array_push($errors, "Email or password is wrong.");
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
	<title>PRODUCER WAREHOUSE - Sign In</title>
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
				<h4>New to Producer Warehouse?</h4>
				<p>Create an account and start selling your beats, sample packs, vst's, daw templates or just give out for free.</p>
				<p>No Monthly Fee, only pay when you have made a sale.</p>
				<p>15% of the selling price.</p>
				<a class="button button-account" href="sign-up">Create an Account</a>
			    </div>
			</div>
		    </div>
		    <div class="col-lg-6">
			<div class="login_form_inner">
			    <h3>Login</h3>
			    <?php 
				if (count($errors) > 0):
				foreach ($errors as $error):
			     ?>
				<small style="color: red"><?php echo $error ?></small>
			    <?php   
				endforeach
			    ?>
			    <?php 
				endif
			    ?>
			    <form class="row login_form" action="<?=$_SERVER['PHP_SELF']?>" id="contactForm" method="POST">
				<div class="col-md-12 form-group">
				    <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Your Email" pattern = "[A-z0-9.]+@[A-z]+.\.[A-z.}]+" required>
				</div>
				<div class="col-md-12 form-group">
				    <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Your Password" pattern = "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
				</div>
				<div class="col-md-12 form-group">
				    <button type="submit" value="submit" name="submit" class="button button-login w-100">Log In</button>
				    <a href="#">Forgot Password?</a>
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