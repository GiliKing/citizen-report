


<?php

session_start();

ini_set('display_errors', 0);

$email = $_SESSION['NewEmail'];
$token = $_SESSION['NewToken'];

$verified = $_SESSION['users']['verified'];

if($verified == 1) {
    header("location: login.php");
}

if($verified == 0) {
    include 'functions/sendEmail.php';

    sendVerificationEmail($email, $token);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Sent</title>
    <style>
        .container {
            width: 90%;
            margin: 30px auto;
        }
        h1 {
            width: 100%;
            margin-top: 20%;
            color: rgb(23,86,22);
            text-align: center;
        }
        p {
            font-size: 20px;
            color: blue;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>A verificatin link has been sent to your Email Account.</h1> 
        <p>Please login into your Email and click on Verify to activate your acount.</p>
    </div>
    
</body>
</html>