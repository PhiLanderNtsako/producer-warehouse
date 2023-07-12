<?php 
    if (isset($_POST['newsletter_submit'])) {
        
        $subscriber_email = mysqli_real_escape_string($conn,$_POST['subscriber_email']);

        $subscriber_check = "SELECT * FROM subscribers WHERE subscriber_email = '$subscriber_email' LIMIT 1";
        $results = mysqli_query($conn, $subscriber_check);
        
        if ($row = mysqli_fetch_assoc($results)){
            $status = " Already Subscribed";
        }else{
            $ins_subcriber = "INSERT INTO subscribers(subscriber_email) VALUES('$subscriber_email'";
            mysqli_query($conn, $ins_subcriber);
            echo mysqli_error($conn);
            $status = " Thank You For Subscribing.";
        }
    }  
?>