<?php
session_start();

$name = $_SESSION['users']['name'];
$email = $_SESSION['users']['email'];

$check = $_COOKIE['ok'];

$check = json_decode($check);


for($i = 0; $i < count($check); $i++){

    if($check[$i]->name == $name && $check[$i]->email == $email && $check[$i]->count == 0){

        array_splice($check, $i);


        $storeCooks = new stdClass();

        $storeCooks->name = $name;
        $storeCooks->email = $email;
        $storeCooks->count = 1;

        

        array_push($check, $storeCooks);

        setcookie('ok', json_encode($check), time() + 3600);

        break;
    }
}

$_SESSION = [];

session_destroy();

header("location: index.php");

?> 