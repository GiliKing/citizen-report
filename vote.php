<?php 

session_start();

if(!isset($_SESSION['users']['name'])) {
    header("location: index.php");
}

?>

<?php


// this logic is to like the news
if(isset($_POST["vote"])) {
    $vote  = htmlspecialchars(trim($_POST['vote']), ENT_QUOTES);
    $name = htmlspecialchars(trim($_POST['nameEntry']), ENT_QUOTES);
    $email = htmlspecialchars(trim($_POST['emailEntry']), ENT_QUOTES);
    $title = htmlspecialchars(trim($_POST['titleEntry']), ENT_QUOTES);
    $info = htmlspecialchars(trim($_POST['infoEntry']), ENT_QUOTES);

    require "database/connect.php";

    $nameEntry = mysqli_real_escape_string($conn, $name);

    $emailEntry = mysqli_real_escape_string($conn, $email);

    $titleEntry = mysqli_real_escape_string($conn, $title);

    $infoEntry = mysqli_real_escape_string($conn, $info);

    $voteEntry = mysqli_real_escape_string($conn, $vote);

    $query = "INSERT INTO `vote` (`name`, `email`, `title`, `info`, `vote_total`) VALUE('$nameEntry', '$emailEntry', '$titleEntry', '$infoEntry', '$voteEntry')";

    $result = mysqli_query($conn, $query);

    if($result) {

        $sum_query = "SELECT SUM(`vote_total`) FROM `vote` WHERE `title` = '$titleEntry' AND `info` = '$infoEntry'";

        $sum_result = mysqli_query($conn, $sum_query);
  
        if($sum_result) {
  
          $row = mysqli_fetch_row($sum_result);
  
          $sum = $row[0];
  
          $_SESSION['sum'] = $sum; 
  
        };

        echo $_SESSION['sum'];
    } 
}



//  this logic is to unlike the news
if(isset($_POST["nameOnly"])) {
    $name = htmlspecialchars(trim($_POST['nameOnly']), ENT_QUOTES);
    $email = htmlspecialchars(trim($_POST['emailOnly']), ENT_QUOTES);
    $title = htmlspecialchars(trim($_POST['titleOnly']), ENT_QUOTES);
    $info = htmlspecialchars(trim($_POST['infoOnly']), ENT_QUOTES);

    require "database/connect.php";

    $nameEntry = mysqli_real_escape_string($conn, $name);

    $emailEntry = mysqli_real_escape_string($conn, $email);

    $titleEntry = mysqli_real_escape_string($conn, $title);

    $infoEntry = mysqli_real_escape_string($conn, $info);

    $query = "DELETE FROM `vote` WHERE `name` = '$nameEntry' AND `email` = '$emailEntry' AND `title` = '$titleEntry' AND `info` = '$infoEntry' LIMIT 1";

    $result = mysqli_query($conn, $query);

    if($result) {

        $sum_query = "SELECT SUM(`vote_total`) FROM `vote` WHERE `title` = '$titleEntry' AND `info` = '$infoEntry'";

        $sum_result = mysqli_query($conn, $sum_query);
  
        if($sum_result) {
  
          $row = mysqli_fetch_row($sum_result);
  
          $sum = $row[0];
  
          $_SESSION['sum'] = $sum; 
  
        };

        if(empty($_SESSION['sum'])) {
            echo "nothing";
        } else {
            echo $_SESSION['sum'];
        }

    }

}



?>