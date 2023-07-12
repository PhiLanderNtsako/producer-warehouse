<?php
    $path = $_SERVER['REQUEST_URI'];
    include 'config.php';
?>
<!--================ Start Header Menu Area =================-->
<header class="header_area">
    <!-- ================ Subscribe section start ================= -->
    <style>
        .form-popup {
            display:none;
        }
    </style>
    <div class="form-popup" id="myForm">
        <form action="search" method="get" class="subscribe-form form-inline mt-5 pt-1" id="search-form">
            <div class="form-group ml-sm-auto">
                <button class="btn btn-danger" onclick="closeForm()"><i class="ti-close"></i></button>
                <input type="text" class="form-control mb-1" name="keyword" placeholder="Search our warehouse" required>
            </div>
            <a class="button button-subscribe mr-auto mb-1" href="javascript:;" onclick="document.getElementById('search-form').submit();" name="submit"><i class="ti-search"></i> Search</a>
        </form>
    </div>
    <!-- ================ Subscribe section end ================= -->
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand logo_h" href="home"><img src="img/logo.png" alt="" height="70px"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                        <li class="nav-item <?php if ($path == "/projects/producerwarehouse/home/") {echo "active";} ?>"><a class="nav-link" href="home">Home</a></li>

                        <li class="nav-item <?php if ($path == "/projects/producerwarehouse/product-category/beats") {echo "active";} ?>"><a class="nav-link" href="product-category/beats">Beats</a></li>

                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sample Packs</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item <?php if ($path == "/projects/producerwarehouse/product-category/midi-loops") {echo "active";} ?>"><a class="nav-link" href="product-category/midi-loops">Midi Loops</a></li>
                                <li class="nav-item <?php if ($path == "/projects/producerwarehouse/product-category/drum-loops") {echo "active";} ?>"><a class="nav-link" href="product-category/drum-loops">Drum Loops</a></li>
                                <li class="nav-item <?php if ($path == "/projects/producerwarehouse/product-category/melody-loops") {echo "active";} ?>"><a class="nav-link" href="product-category/melody-loops">Melody Loops</a></li>
                            </ul>
                        </li>
                        <li class="nav-item <?php if ($path == "/projects/producerwarehouse/product-category/drum-kits") {echo "active";} ?>"><a class="nav-link" href="product-category/drum-kits">Drum Kits</a></li>
                        <li class="nav-item <?php if ($path == "/projects/producerwarehouse/product-category/plugins") {echo "active";} ?>"><a class="nav-link" href="product-category/plugins">Plugins</a></li>
                    </ul>
                    <?php
                        if (isset($_SESSION['user_id'])){

                            $user_id = $_SESSION['user_id'];

                            $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_array($result);
                    ?>
                        <ul class="nav-shop">
                    <?php
                        if (!empty($_SESSION['cart'])) {
                            $cart_count = count(array_keys($_SESSION['cart']));
                    ?>
                        <li class="nav-item"><button><a href="cart"><i class="ti-shopping-cart-full"></i></a><span class="nav-shop__circle"><?php echo $cart_count ?></span></button></li>
                    <?php 
                        }else{ 
                    ?>
                        <li class="nav-item"><button><a href="cart"><i class="ti-shopping-cart"></i></a><span class="nav-shop__circle">0</span></button></li>
                    <?php 
                        } 
                    ?>
                        <li class="nav-item"><button onclick="openForm()"><i class="ti-search"></i></a></button></li>
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle button button-header" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="ti-user"></i> <?php echo $row['user_username'] ?></a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" style="color: black;" href="user-account"><i class="ti-user"></i> Account</a></li>
                            <?php 
                                if($row['user_type'] == 'Seller'){
                            ?>
                                <li class="nav-item"><a class="nav-link" style="color: black;" href="upload-product"><i class="ti-upload"></i> Upload</a></li>
                                <li class="nav-item"><a class="nav-link" style="color: black;" href="sold-products"><i class="ti-money"></i> Sold Products</a></li>
                            <?php 
                                }
                            ?>
                                <li class="nav-item"><a class="nav-link" style="color: black;" href=" process/logout.php"><i class="ti-lock"></i> Logout</a></li>
                                <li class="nav-item"></li>
                            </ul>
                        </li>
                    </ul>
                    <?php
                        }else{
                    ?>
                    <ul class="nav-shop">
                    <?php
                        if (!empty($_SESSION['cart'])) {
                            $cart_count = count(array_keys($_SESSION['cart']));
                    ?>
                        <li class="nav-item"><button><a href="cart"><i class="ti-shopping-cart-full"></i></a><span class="nav-shop__circle"><?php echo $cart_count ?></span></button></li>
                    <?php 
                        }else{ 
                    ?>
                        <li class="nav-item"><button><a href="cart"><i class="ti-shopping-cart"></i></a><span class="nav-shop__circle">0</span></button></li>
                    <?php 
                        } 
                    ?>
                        <li class="nav-item"><button onclick="openForm()"><i class="ti-search"></i></a></button></li>
                        <li class="nav-item submenu dropdown">
                            <a href="sign-in" class="nav-link dropdown-toggle button button-header" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="ti-user"></i> Account</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" style="color: black;" href="sign-in"><i class="ti-unlock"></i> Sign In</a></li>
                                <li class="nav-item"><a class="nav-link" style="color: black;" href="sign-up"><i class="ti-user"></i> Sign Up</a></li>
                                <li class="nav-item"></li>
                            </ul>
                        </li>
                    </ul>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </nav>
    </div>
</header>
<!--================ End Header Menu Area =================-->
<script>
    function openForm(){
       document.getElementById("myForm").style.display = "block";
    }

    function closeForm(){
       document.getElementById("myForm").style.display = "none";
    }
</script>