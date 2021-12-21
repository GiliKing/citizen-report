<?php


// register the user to the database
function registerNewUser($name, $email, $password, $token) {

    require "database/connect.php";

    $response = checkUser($email, $password);

    if($response == true) {

        echo "<div class='alert alert-info'>User Already Exit</div>";

    } else {

        $nameEntry = mysqli_real_escape_string($conn, $name);

        $emailEntry = mysqli_real_escape_string($conn, $email);

        $passwordEntry = mysqli_real_escape_string($conn, $password);

        $users_register = "INSERT INTO `users` (`name`, `email`, `password`, `token`) VALUES('$nameEntry', '$emailEntry', md5('$passwordEntry'), '$token')";

        $users_result = mysqli_query($conn, $users_register);

        if($users_result) {

            echo "<div class='alert alert-success'>User Registered Successfully</div>";

            session_start();

            $_SESSION['NewEmail'] = $emailEntry;
            $_SESSION['NewToken'] = $token;
            $_SESSION['users']['verified'] = 0;

            header("location: verify.php");

        } else  {

            mysqli_error($conn);

        }

    }




};


// but first check if the user exit already before registring
function checkUser($email, $password) {

    require "database/connect.php";

    $emailEntry = mysqli_real_escape_string($conn, $email);

    $passwordEntry = mysqli_real_escape_string($conn, $password);

    $user_query = "SELECT * FROM `users` WHERE `email` = '$emailEntry' AND `password` = md5('$passwordEntry') LIMIT 1";

    $users_result = mysqli_query($conn, $user_query);

    if($users_result) {

        if (mysqli_num_rows($users_result) == 1) {
        
            return true;

        } else {

            return false;
            
        }
    }else {
        echo mysqli_error($conn);
    }
}


// login in the user
function loginUser($email, $password) {

    require "database/connect.php";

    $emailEntry = mysqli_real_escape_string($conn, $email);

    $passwordEntry = mysqli_real_escape_string($conn, $password);

    $user_query = "SELECT * FROM `users` WHERE `email` = '$emailEntry' AND `password` = md5('$passwordEntry') LIMIT 1";

    $users_result = mysqli_query($conn, $user_query);

    if($users_result) {

        if (mysqli_num_rows($users_result) == 1) {
            
            session_start();

            $_SESSION['users'] = mysqli_fetch_array($users_result, MYSQLI_ASSOC);

            $verified = $_SESSION['users']['verified'];

            if($verified != 1) {

                $_SESSION['NewEmail'] = $_SESSION['users']['email'];
                $_SESSION['NewToken'] = $_SESSION['users']['token'];

                header("location: verify.php");
                
            } else {
                
                header("location: user.php");

            }

        } else {

            echo "<div class='alert alert-danger'>Invalid Email/Password </div>";
        }
    } else {
        mysqli_error($conn);
    }

}



// add entry to the database
function addNewEntry($title, $info, $url, $name, $email, $date, $category, $photo_path) {

    require "database/connect.php";

    $titleEntry = mysqli_real_escape_string($conn, $title);

    $infoEntry = mysqli_real_escape_string($conn, $info);

    $urlEntry = mysqli_real_escape_string($conn, $url);

    // $keywordsEntry = mysqli_real_escape_string($conn, $keywords);

    $dateEntry = mysqli_real_escape_string($conn, $date);

    $CategoryEntry = mysqli_real_escape_string($conn, $category);

    $nameEntry = mysqli_real_escape_string($conn, $name);

    $emailEntry = mysqli_real_escape_string($conn, $email);
    

    $response = checkEntry($title, $url, $date);

    if($response == true) {

        // yes information exit
        echo "<div class='alert alert-info'>These Informations Already Exit</div>";

    } else {

        // check again if the user is registered
        $user_query = "SELECT * FROM `users` WHERE `name` = '$nameEntry' AND `email` = '$emailEntry' LIMIT 1";

        $users_result = mysqli_query($conn, $user_query);

        if($users_result) {
                
                // yes user is registered
                // add entry to the database
                $users_register = "INSERT INTO `engine` (`name`, `email`, `title`, `info`, `url`, `date`, `image`, `category`) VALUES('$nameEntry', '$emailEntry', '$titleEntry', '$infoEntry', '$urlEntry', '$dateEntry', '$photo_path', '$CategoryEntry')";

                $users_result_register = mysqli_query($conn, $users_register);
        
                if($users_result_register) {
        
                    echo "<div class='alert alert-success'>Entry Added Successfully</div>";

                } else  {
                    
                   echo mysqli_error($conn);
                }

        }else {

            echo "<div class='alert alert-danger'>Your Information Dont Exit In Our Databse</div>";

            echo mysqli_error($conn);
        }

       
    }




};

// but first check if the entry exit already before registring
function checkEntry($title, $info, $date) {

    require "database/connect.php";

    $titleEntry = mysqli_real_escape_string($conn, $title);

    $infoEntry = mysqli_real_escape_string($conn, $info);

    $dateEntry = mysqli_real_escape_string($conn, $date);

    $user_query = "SELECT * FROM `engine` WHERE `title` = '$titleEntry' AND `info` = '$infoEntry' AND `date` = '$dateEntry' LIMIT 1";

    $users_result = mysqli_query($conn, $user_query);

    if($users_result) {

        if (mysqli_num_rows($users_result) == 1) {
        
            return true;

        } else {

            return false;
            
        }
    }else {
        echo mysqli_error($conn);
    }
}





?>