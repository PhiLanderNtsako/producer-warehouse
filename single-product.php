<?php
    include "includes/top-cache.php";
    include 'includes/config.php';  
    session_start();

    $_SESSION['rdurl'] = $_SERVER['REQUEST_URI'];
    $status = " ";

    if (isset($_POST['product_id'])) {

	$product_id = $_POST['product_id'];

	$query_products = mysqli_query($conn, "SELECT * FROM users, products WHERE products.product_id = '$product_id' AND users.user_id = products.user_id");
	$row = mysqli_fetch_assoc($query_products);

	$product_price = $row['product_price'];
	$product_image = $row['product_image'];
	$product_pricing = $row['product_pricing'];
	$product_category = $row['product_category'];
	$user_username = $row['user_username'];
	$user_id = $row['user_id'];
	$product_title = $row['product_title'];
	$product_folderName = $row['product_folderName'];
	$code = $product_id.$product_title;

	$cartArray = array(
	     $code => array(
		'code' => $code,
		'product_id' => $product_id,
		'product_title' => $product_title,
		'product_price' => $product_price,
		'product_pricing' => $product_pricing,
		'product_category' => $product_category,
		'user_username' => $user_username,
		'user_id' => $user_id,
		'product_folderName' => $product_folderName,
		'product_image' => $product_image
	    )
	);

	if(empty($_SESSION['cart'])) {

		$_SESSION['cart'] = $cartArray;
		$status = "Product is added to your cart!";
	}else {

		$array_keys = array_keys($_SESSION['cart']);
		if(in_array($code,$array_keys)) {

			$status = "Product is already added to your cart!";	
		} else {

			$_SESSION['cart'] = array_merge($_SESSION['cart'],$cartArray);
			$status = "Product is added to your cart!";
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
    <title>PRODUCER WAREHOUSE - Product Details</title>
    <link rel="icon" href="img/Fevicon.png" type="image/png">
    <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!--================ Start Header Menu Area =================-->
    <?php
	include 'includes/header.php';
	if (isset($_POST['product_id'])) {
	    echo'
		<div class="alert alert-success alert-dismissible text-center">
		    <strong> '.$status.'</strong>
		</div>';
	}
    ?>
    <!--================ End Header Menu Area =================-->

    <!--================Single Product Area =================-->
    <?php
        $product_id = $_GET['id'];
    	$product_slug = $_GET['slug'];

    	$query_products = "SELECT * FROM users, products WHERE products.product_id = $product_id AND users.user_id = products.user_id";
    	$result = mysqli_query($conn, $query_products);
    	$row = mysqli_fetch_assoc($result);

    	$query_orders = "SELECT COUNT(*) AS count FROM order_items, products WHERE products.product_id = $product_id AND order_items.product_id = products.product_id";
    	$result = mysqli_query($conn, $query_orders);
    	$row2 = mysqli_fetch_assoc($result);

	$product_category = strtoupper($row['product_category']);
	$product_pricing = strtoupper($row['product_pricing']);
   	$product_date = date("j M, Y", strtotime($row['product_date']));
    ?>
    <div class="product_image_area">
	<div class="container">
	    <div class="row s_product_inner">
		<div class="col-lg-6">
		    <div class="owl-carousel owl-theme s_Product_carousel">
			<div class="single-prd-item">
			    <img class="img-fluid" src="uploads/<?php echo $row['product_folderName'].'/'.$row['product_image'] ?>" alt="">
			</div>
		    </div>
		</div>
		<div class="col-lg-5 offset-lg-1">
		    <div class="s_product_text">
			<small><?php echo $row['user_username'] ?></small>
			<h3><?php echo $row['product_title'] ?></h3>
			<h2>R<?php echo $row['product_price'] ?></h2>
			<ul class="list">
			    <li>
				<a class="active" href="product-category/<?php echo $row['product_category']?>"><span>Category</span> : <?php echo $product_category ?></a>
			    </li>
			    <li>
				<a class="active" href="javascript:;"><span>License</span> : <?php echo $product_pricing ?></a>
			    </li>
			    <li>
			   	<a href="javascript:;"><span>Date</span> : <?php echo $product_date ?></a>
			    </li>
			</ul>
			<p><?php echo $row['product_description'] ?></p>
			<div class="product_count">
			    <form method="post" action="" id="cart-form">
				<input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
				<input type="hidden" name="product_title" value="<?php echo $row['product_title'] ?>">
				<input type="hidden" name="product_price" value="<?php echo $row['product_price'] ?>">
				<input type="hidden" name="product_image" value="<?php echo $row['product_image'] ?>">
				<input type="hidden" name="product_category" value="<?php echo $row['product_category'] ?>">
				<input type="hidden" name="product_type" value="<?php echo $row['product_type'] ?>">
				<a class="button primary-btn" href="javascript:;" onclick="document.getElementById('cart-form').submit();"><i class="ti-shopping-cart"></i> Add To Cart</a>
			    </form>
			</div>
		    </div>
		</div>
	    </div>
	</div>
    </div>
    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
	<div class="container">
	    <ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item">
		    <a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
		</li>
		<li class="nav-item">
		    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Statistics</a>
		</li>
		<li class="nav-item">
		    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Preview</a>
		</li>
	    </ul>
	    <div class="tab-content" id="myTabContent">
		<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
		    <p><?php echo $row['product_description'] ?></p>
		</div>
		<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
		    <div class="table-responsive">
		        <table class="table">
			    <tbody>
				<tr>
				    <td>
					<h5>Number Of Downloads/Orders</h5>
				    </td>
				    <td>
					<h5><?php echo $row2['count'] ?></h5>
				    </td>
				</tr>
			    </tbody>
			</table>
	   	    </div>
		</div>
		<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
		    <div class="table-responsive">
		        <table class="table">
			    <tbody>
				<tr>
				    <td>
					<audio id="player" src="uploads/<?php echo $row['product_folderName'] ?>/<?php echo $row['product_preview'] ?>" type="audio/mp3">
					</audio>
					<div>
					    <button onclick="document.getElementById('player').play()">Play</button>
					    <button onclick="document.getElementById('player').pause()">Pause</button>
					    <button onclick="document.getElementById('player').volume +=0.1">Vol +</button>
					    <button onclick="document.getElementById('player').volume -= 0.1">Vol -</button>            
				    	</div>
				    </td>
				</tr>
			    </tbody>
			</table>
	   	    </div>
		</div>
	    </div>
	</section>
	<!--================End Product Description Area =================-->

	<!--================ Start Top Products in Warehouse area =================-->
	<section class="related-product-area section-margin--small mt-0">
	    <div class="container">
		<div class="section-intro pb-60px">
		    <p>Popular items in the market</p>
		    <h2><span class="section-intro__style">Products</span></h2>
		</div>
		<div class="row mt-30">
		    <div class="col-sm-6 col-xl-3 mb-4 mb-xl-0">
			<div class="single-search-product-wrapper">
			    <h2>Top <span class="section-intro__style">Beats</span></h2>
			    <?php
				$query_products = "SELECT * FROM users, products WHERE users.user_id = products.user_id AND product_category = 'beats' LIMIT 4";
				$result = mysqli_query($conn, $query_products);
					
				while($row = mysqli_fetch_assoc($result)){
			    ?>
			    <div class="single-search-product d-flex">
				<a href="product/<?php echo $row['product_id']?>/<?php echo $row['product_titleSlug']?>"><img src="uploads/<?php echo $row['product_folderName'].'/'.$row['product_image'] ?>" alt=""></a>
				<div class="desc">
				    <a href="product/<?php echo $row['product_id']?>/<?php echo $row['product_titleSlug']?>" class="title"><?php echo $row['product_title'] ?></a>
				    <div class="price">R<?php echo $row['product_price'] ?></div>
				</div>
			   </div>
			   <?php
				}
			   ?>
			</div>
		    </div>
		    <div class="col-sm-6 col-xl-3 mb-4 mb-xl-0">
			<div class="single-search-product-wrapper">
			    <h2>Top <span class="section-intro__style">Packs</span></h2>
			    <?php
				$query_products = "SELECT * FROM users, products WHERE users.user_id = products.user_id AND product_category = 'sample-packs' LIMIT 4";
				$result = mysqli_query($conn, $query_products);
					
				while($row = mysqli_fetch_assoc($result)){
			    ?>
			    <div class="single-search-product d-flex">
				<a href="product/<?php echo $row['product_id']?>/<?php echo $row['product_titleSlug']?>"><img src="uploads/<?php echo $row['product_folderName'].'/'.$row['product_image'] ?>" alt=""></a>
				<div class="desc">
				    <a href="product/<?php echo $row['product_id']?>/<?php echo $row['product_titleSlug']?>" class="title"><?php echo $row['product_title'] ?></a>
				    <div class="price">R<?php echo $row['product_price'] ?></div>
				</div>
			   </div>
			   <?php
				}
			   ?>
			</div>
		    </div>
		    <div class="col-sm-6 col-xl-3 mb-4 mb-xl-0">
			<div class="single-search-product-wrapper">
			    <h2>Top <span class="section-intro__style">Kits</span></h2>
			    <?php
				$query_products = "SELECT * FROM users, products WHERE users.user_id = products.user_id AND product_category = 'drum-kits' LIMIT 4";
				$result = mysqli_query($conn, $query_products);
					
				while($row = mysqli_fetch_assoc($result)){
			    ?>
			    <div class="single-search-product d-flex">
				<a href="single-product.php?id=<?php echo $row['product_id']?>&slug=<?php echo $row['product_titleSlug']?>"><img src="uploads/<?php echo $row['product_folderName'].'/'.$row['product_image'] ?>" alt=""></a>
				<div class="desc">
				    <a href="single-product.php?id=<?php echo $row['product_id'] ?>&slug=<?php echo $row['product_titleSlug'] ?>" class="title"><?php echo $row['product_title'] ?></a>
				    <div class="price">R<?php echo $row['product_price'] ?></div>
				</div>
			   </div>
			   <?php
				}
			   ?>
			</div>
		    </div>
		    <div class="col-sm-6 col-xl-3 mb-4 mb-xl-0">
			<div class="single-search-product-wrapper">
			    <h2>Top <span class="section-intro__style">VSTs</span></h2>
			    <?php
				$query_products = "SELECT * FROM users, products WHERE users.user_id = products.user_id AND product_category = 'vst-expansions' LIMIT 4";
				$result = mysqli_query($conn, $query_products);
					
				while($row = mysqli_fetch_assoc($result)){
			    ?>
			    <div class="single-search-product d-flex">
				<a href="single-product.php?id=<?php echo $row['product_id']?>&slug=<?php echo $row['product_titleSlug']?>"><img src="uploads/<?php echo $row['product_folderName'].'/'.$row['product_image'] ?>" alt=""></a>
				<div class="desc">
				    <a href="single-product.php?id=<?php echo $row['product_id'] ?>&slug=<?php echo $row['product_titleSlug'] ?>" class="title"><?php echo $row['product_title'] ?></a>
				    <div class="price">R<?php echo $row['product_price'] ?></div>
				</div>
			   </div>
			   <?php
				}
			   ?>
			</div>
		    </div>
		</div>
	    </div>
	</section>
	<!--================ end related Product area =================-->

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