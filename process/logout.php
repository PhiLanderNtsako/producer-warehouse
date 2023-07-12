<?php 
    session_start();
    unset($_SESSION['user_id']);

    if (isset($_SESSION['rdurl'])) {
		                
        echo '<meta http-equiv="refresh" content="0; url= http://localhost'.$_SESSION['rdurl'].'">';
    }else{
        echo '<meta http-equiv="refresh" content="0; url= ../index.php">';
    }

?>