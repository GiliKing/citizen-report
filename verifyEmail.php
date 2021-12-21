<?php 

session_start();

if($_SESSION['users']['name'] == null && $_SESSION['users']['email'] == null) {
    header("location: index.php");
}


?>



<?php

require "database/connect.php";

$ok = 1;

$token =$_GET['token'];

$query = "SELECT * FROM `users` WHERE `token`='$token' LIMIT 1";

$result = mysqli_query($conn, $query);

if($result) {

    if (mysqli_num_rows($result) == 1) {

        $user = "UPDATE `users` SET `verified`='$ok' WHERE `token`='$token'";

        $user_result = mysqli_query($conn, $user);

        if($user_result) {
            
            echo "
            <div 
            style='
            width: 90%;
            margin: 30px auto;
            '>
            <h1 style='
            width: 100%;
            margin-top: 20%;
            color: rgb(23,86,22);
            text-align: center;
            '>Your Email Address has been verified successfully. Please Login</h1>
            </div>
            ";


            $_SESSION = [];
        }

    } else {

        echo "<h1>Database Error/ Or User Not Found Please Try Agian</h1>";
        echo mysqli_error($conn);
        
    }

} else {
    echo "<h1> Verification Link Does Not Exit </h1>";
    echo mysqli_error($conn);
}



?>