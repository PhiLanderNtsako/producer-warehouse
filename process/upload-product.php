<?php
    session_start();
    include "includes/config.php";

    $product_title = mysqli_real_escape_string($conn,$_POST['product_title']);
    $product_titleSlug = str_replace(' ', '-', strtolower($product_title));
    $product_category = mysqli_real_escape_string($conn,$_POST['product_category']);
    $product_type = mysqli_real_escape_string($conn,$_POST['product_type']);
    $product_price = $_POST['product_price'];
    $product_description = mysqli_real_escape_string($conn,$_POST['product_description']);

    $product_image = $_FILES['product_image']['name'];
    $product_file = $_FILES['product_file']['name'];
    $product_preview = $_FILES['product_previewAudio']['name'];

    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE user_id = $user_id LIMIT 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    $upload_time_dir = date('dmy-His');
    $user_folderName = $row['username'].'-'.$row['user_id'];
    $product_folderName = $product_titleSlug.'-'.$upload_time_dir;
    $upload_dir = 'uploads/'.$user_folderName.'/'.$product_folderName.'/';

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);  //create directory if not exist
    }

    $product_image_name = $product_title.'(image)';
    $product_file_name = $product_title.'(Producer Warehouse)';
    $product_preview_name = $product_title.'(preview audio)';

    move_uploaded_file($_FILES['product_image']['tmp_name'],$upload_dir.'/'.$product_image_name);
	move_uploaded_file($_FILES['product_file']['tmp_name'],$upload_dir.'/'.$product_file_name);
    move_uploaded_file($_FILES['product_previewAudio']['tmp_name'],$upload_dir.'/'.$product_preview_name);
    
    $insert_product = "INSERT INTO products(product_title, product_titleSlug, product_category, product_type, product_price, product_description, product_date, product_image, product_file, product_preview, product_folderName, product_verification) VALUES('$product_title', '$product_titleSlug', '$product_category', '$product_type', '$product_price', '$product_description', NOW(), '$product_image_name', '$product_file_name', '$product_preview_name', '$product_folderName', 'Product Under Review')";
    mysqli_query($conn, $insert_product);
	$product_id = mysqli_insert_id($conn);
    echo mysqli_error($conn);
    
    //echo '<meta http-equiv="refresh" content="0; url= user-account.php">';
    
?>    