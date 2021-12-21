<?php

if(isset($_POST['nameEntry'])) {
    $name = htmlspecialchars(trim($_POST['nameEntry']), ENT_QUOTES);

    $email = htmlspecialchars(trim($_POST['emailEntry']), ENT_QUOTES);

    $id = $_POST['idEntry'];

    $title = $_POST['titleEntry'];

    $info = $_POST['infoEntry'];

    $date = htmlspecialchars(trim($_POST['date']), ENT_QUOTES);

    $time = htmlspecialchars(trim($_POST['time']), ENT_QUOTES);

    $comment = htmlspecialchars(trim($_POST['commentEntry']), ENT_QUOTES);

    // echo $date;

    require "database/connect.php";

    $nameEntry = mysqli_real_escape_string($conn, $name);

    $emailEntry = mysqli_real_escape_string($conn, $email);

    $titleEntry = mysqli_real_escape_string($conn, $title);

    $infoEntry = mysqli_real_escape_string($conn, $info);

    $dateEntry = mysqli_real_escape_string($conn, $date);

    $timeEntry = mysqli_real_escape_string($conn, $time);

    $commentEntry = mysqli_real_escape_string($conn, $comment);



    $users_comment = "INSERT INTO `comment` (`name`, `email`, `title`, `info`, `comment`, `date`, `time`) VALUES('$nameEntry', '$emailEntry', '$titleEntry', '$infoEntry', '$commentEntry', '$dateEntry', '$timeEntry')";

    $users_result = mysqli_query($conn, $users_comment);
    
    if($users_result) {

        echo base64_encode($id);
    } else  {
        
        echo mysqli_error($conn);
    }






}



?>