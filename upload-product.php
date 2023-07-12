<?php
    include "includes/top-cache.php";
    include "includes/config.php"; 
    session_start();

    if (!isset($_SESSION['user_id'])) {
        echo '<meta http-equiv="refresh" content="0; url= sign-in">';
      }
    $_SESSION['rdurl'] = $_SERVER['REQUEST_URI'];
    $session_timeout = 3600;
  
    if (!isset($_SESSION['last_visit'])) {
        $_SESSION['last_visit'] = time();
    }
    if ((time() - $_SESSION['last_visit']) > $session_timeout) {
        unset($_SESSION['user_id']);
        echo '<meta http-equiv="refresh" content="0; url= sign-in">';
    }
  
    $_SESSION['last_visit'] = time();
    $url = $_SERVER['REQUEST_URI'];
    $category = $_GET['category'];
    $errors = array();

    if (isset($_POST['submit'])) {

        $product_title = mysqli_real_escape_string($conn, $_POST['product_title']);
        $product_titleSlug = str_replace(' ', '-', strtolower($product_title));
        $product_category = mysqli_real_escape_string($conn, $_POST['product_category']);
        $product_pricing = mysqli_real_escape_string($conn, $_POST['product_pricing']);
        $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);

        if($product_pricing == 'free'){
            $product_price = 0.00;
        }else{
            $product_price = $_POST['product_price'];  
        }

        $product_image = $_FILES['product_image']['name'];
        $product_file = $_FILES['product_file']['name'];
        $image_extension = pathinfo($product_image, PATHINFO_EXTENSION);
        $file_extension = pathinfo($product_file, PATHINFO_EXTENSION);

        $user_id = $_SESSION['user_id'];
        $check_user = "SELECT * FROM users WHERE user_id = $user_id LIMIT 1";
        $result = mysqli_query($conn, $check_user);
        $row = mysqli_fetch_assoc($result);

        $user_id = $row['user_id'];

        $upload_time_dir = date('dmy-His');
        $folder_i = $row['user_username'].'-'.$row['user_id'];
        $folder_ii = $product_titleSlug.'-'.$upload_time_dir;
        $product_folderName = ''.$folder_i.'/'.$folder_ii .'';
        $upload_dir = 'uploads/'.$product_folderName.'/';

        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $product_image_name = $product_titleSlug.'.'.$image_extension;
        $product_file_name = $product_title.' (Producer Warehouse).'.$file_extension;

        move_uploaded_file($_FILES['product_image']['tmp_name'], $upload_dir.'/'. $product_image_name);
        move_uploaded_file($_FILES['product_file']['tmp_name'], $upload_dir.'/'.$product_file_name);

        $insert_product = "INSERT INTO products(user_id, product_title, product_titleSlug, product_category, product_pricing, product_price, product_description, product_date, product_image, product_file, product_folderName, product_verification) VALUES('$user_id','$product_title', '$product_titleSlug', '$product_category', '$product_pricing', '$product_price', '$product_description', NOW(), '$product_image_name', '$product_file_name', '$product_folderName', 'Product Under Review')";
        mysqli_query($conn, $insert_product);
        $product_id = mysqli_insert_id($conn);
        echo mysqli_error($conn);

        $product_code = 'pw_p#'.$product_id;
        $query = "UPDATE products SET product_code = '$product_code' WHERE product_id = '$product_id'";
        mysqli_query($conn, $query);
        echo mysqli_error($conn);

        include 'includes/product-uploaded-mail.php';
        echo '<meta http-equiv="refresh" content="0; url= user-account">';
    }    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <base href="http://localhost/projects/producerwarehouse/">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>PRODUCER WAREHOUSE- Upload Product</title>
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
        <?php
            if ($category == 'beats') {
        ?>                
        <!--================Login Box Area =================-->
        <section class="login_box_area section-margin">
            <div class="container">
                <div class="section-intro pb-60px">
                    <p>Upload your product</p>
                    <h2>Choose Category Type</h2>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="login_box_img">
                            <div class="hover">
                                <h3>Upload Beat</h3><br>
                                <p>
                                    Producer Warehouse Beats License types - Free License and Exclusive License.<br>
                                    <strong>Free License</strong> - Beats which are free and only includes an mp3 file inside.<br>
                                    <strong>Exclusive License</strong> - Beats which are sold and only two one person/customer, once it is purchased it will be removed from the warehouse. The zip file must have *mp3, wav and project bones* of the beat.<br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
			        <div class="login_form_inner register_form_inner">
			            <h3>Upload Beat</h3>
			            <?php if (count($errors) > 0) : ?>
			    	        <?php foreach ($errors as $error) : ?>
			    	            <small style="color: red"><?php echo $error ?></small>
			       	        <?php endforeach ?>
			            <?php endif ?>
			            <form action="<?php echo $url ?>" method="POST" class="row login_form"  id="upload_form" enctype="multipart/form-data">
                            <input type="hidden" name="product_category" value="beats">
                            <div class="col-md-12 form-group">
                                <div class="sorting">
                                    <select name="product_pricing"  id="product_pricing" required>
                                        <option value="">License Type</option>
                                        <option value="free">Free</option>
                                        <option value="exclusive">Exclusive</option>
                                    </select> 
                                </div>
				            </div>
				            <div class="col-md-12 form-group" id="product_price">
                                <input type="text" class="form-control" name="product_price" placeholder="Price (e.g 360)" pattern="\d*">
				            </div>
				            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="product_title" name="product_title" placeholder="Title (e.g Drake x Tory Lanez Type Beat)" required>
				            </div>
                            <div class="col-md-12 form-group">
                                <textarea class="form-control" id="product_description" name="product_description" placeholder="Description" required></textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <label id="product_image">Upload Image</label>
                                <input type="file" id="product_image" name="product_image" class="form-control" required>
                                <small class="text-primary">image must be png, jpg or jpeg</small>
                            </div>
                            <div class="col-md-12 form-group">
                                <label id="product_image">Upload Zip</label>
                                <input type="file" name="product_file" class="form-control" required>
                                <small class="text-primary">file must be zip</small>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" name="submit" class="button button-register w-100" onclick="document.getElementById('upload_form').submit();">Upload</button>
                            </div>
			            </form>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Login Box Area =================-->
        <?php
           }
           if ($category == 'others') {
        ?> 
        <!--================Login Box Area =================-->
        <section class="login_box_area section-margin">
            <div class="container">
                <div class="section-intro pb-60px">
                    <p>Upload your product</p>
                    <h2>Choose Category Type</h2>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="login_box_img">
                            <div class="hover">
                                <h3>Upload Beats Here</h3><br>
                                <h3>Upload Sample Packs, Plugins or Templates</h3><br>
                                <p>
                                    Sample Packs - *Drum Kits, Midi Loops, Drum Loops, Melody Loops*.<br>
                                    <strong>Free License</strong> - Free.<br>
                                    <strong>Premium License</strong> - Products which are sold at a certain price and they are not exclusive.<br>
                                    Products must be in a Zip file and specify what is included inside the file in the product description when uploading..<br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
			            <div class="login_form_inner register_form_inner">
			                <h3>Upload Product</h3>
                            <?php if (count($errors) > 0) : ?>
                                <?php foreach ($errors as $error) : ?>
                                    <small style="color: red"><?php echo $error ?></small>
                                <?php endforeach ?>
                            <?php endif ?>
			                <form action="<?php echo $url ?>" method="POST" class="row login_form" id="upload_form" enctype="multipart/form-data" novalidate>
				                <div class="col-md-6 form-group">
				                    <div class="sorting">
                                        <select name="product_category" required>
                                            <option value="">Category</option>
                                            <option value="drum-kits">Drum Kits</option>
                                            <option value="melody-loops">Melody Loops</option>
                                            <option value="drum-loops">Drum Loops</option>
                                            <option value="midi-loops">Midi Loops</option>
                                            <option value="vst-plugins">VST Plugins</option>
                                            <option value="daw-templates">DAW Templates</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
				                    <div class="sorting">
                                        <select name="product_pricing" id="product_pricing" required>
                                            <option value="">License Type</option>
                                            <option value="free">Free</option>
                                            <option value="premium">Premium</option>
                                        </select>
				                    </div>
                                </div>
                                <div class="col-md-12 form-group" id="product_price">
                                    <input type="text" class="form-control" name="product_price" placeholder="Price (e.g 360" pattern="[0-9]">
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" id="product_title" name="product_title" placeholder="Title (e.g Sweet Sound MusiQ Drum Kit Vol. 1)" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <textarea class="form-control" id="product_description" name="product_description" placeholder="Description" required></textarea>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label id="product_image">Upload Image</label>
                                    <input type="file" id="product_image" name="product_image" class="form-control" required>
                                    <small class="text-primary">image must be png, jpg or jpeg</small>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label id="product_image">Upload Zip File</label>
                                    <input type="file" name="product_file" class="form-control" required>
                                    <small class="text-primary">file must be zip</small>
                                </div>
                                <div class="col-md-12 form-group">
                                    <button type="submit" name="submit" class="button button-register w-100" onclick="document.getElementById('upload_form').submit();">Upload</button>
                                </div>
			                </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Login Box Area =================-->
        <?php
           }
        ?> 
        <!--================ Start footer Area  =================-->
        <?php
            include 'includes/footer.php';
        ?>
        <!--================ End footer Area  =================-->

        <!--================ Style & Script For Product Type and Price Inputs  =================-->

        <style media="screen">
            .hide {
                display: none;
            }
        </style>
        <script>
            (
                function() {
                    'user strict';

                    var d = document;
                    var myForm = d.getElementById('upload_form');
                    var product_price = d.getElementById('product_price');
                    var product_pricing = d.getElementById('product_pricing');
                    var temp;

                    myForm.reset();
                    product_price.className = 'hide';
                    product_pricing.onchange = function() {
                        if (this.value === 'exclusive' || this.value === 'premium') {
                                product_price.className = product_price.className.replace('hide', 'col-md-12 form-group');   
                        }else{
                            temp = this.value;
                            product_price.className = 'hide'; 
                        }
                    };
                }()
            );
        </script>

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
