<?php 

session_start();

if(!isset($_SESSION['users']['name'])) {
    header("location: index.php");
}

$nameUser = $_SESSION['users']['name'];
$emailUser = $_SESSION['users']['email'];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nairanews</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/page.css">

    <style>
        body {
            background-color: rgb(252,252,240);
        }

        nav.nav_color {
            background-color: rgb(246,246,236);
        }
    </style>

</head>
<body>

<!-- Navigation System -->

<nav class="navbar navbar-expand-lg navbar-light nav_color">
  <a class="navbar-brand" href="user.php"><h2 style="color: rgb(23,86,22)">&nbsp;Citizenreport</h2></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link js-open" href="#" style="color: rgb(23,86,22)"><h3 id="comment">Add Comment</h3> <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php" style="color: rgb(23,86,22)"><h3>Logout</h3></a>
        </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="button">Search</button>&nbsp;&nbsp;&nbsp;
    </form>
  </div>
</nav>

<!-- start of container -->

<div class="container-fluid">


<?php 

    require "database/connect.php";

    $id_code = $_GET['id'];

    $id = base64_decode($id_code);

    $news = "SELECT * FROM `engine` WHERE `id` = $id";

    $rel_news = mysqli_query($conn, $news);

    if($rel_news) {

        if (mysqli_num_rows($rel_news) == 1) {
            
            // session_start();

            $_SESSION['news'] = mysqli_fetch_array($rel_news, MYSQLI_ASSOC);

            // $name = $_SESSION['news']['name'];
            // $email = $_SESSION['news']['email'];
            $title = $_SESSION['news']['title'];
            $info = $_SESSION['news']['info'];
            $url = $_SESSION['news']['url'];
            $date = $_SESSION['news']['date'];
            $image = $_SESSION['news']['image'];


            echo '
            <!-- declaring the container colum-->
            <div class="col-lg-12">
                <!-- making the container to be in a row-->
                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 20px; margin-top: 20px;">
                        <!-- gives it the card feeling -->
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title" id="titleCom" style="text-align: center; color: rgb(23,86,22)">'.$title.'</h3>
                            </div>
                            <div class="card-body" style="padding-top: 0px; padding-bottom: 0px;">
                            <img class="card-img-top" src="'.$image.'" alt="No Image Attached" style="width:100%">
                            <hr>
                            <p class="card-text" id="infoCom" style="margin-top: 20px;">'.$info.'</p>

                            ';

            echo'
                            <span id="vote_cot"></span><span class="like_vote">(like)</span>
                            <input type="hidden" value="1" id="num_vote">
                            <hr>
                            <p class="card-text">From: '.$url.' </p>
                            <hr>
                            <p class="card-text"><small>Date: '.$date.' </small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            ';



            // when the page loads check if the user has voted
            $vote_query = "SELECT * FROM `vote` WHERE `name` = '$nameUser' AND `email` = '$emailUser' AND `title` = '$title' AND `info` = '$info' LIMIT 1";

            $users_result = mysqli_query($conn, $vote_query);

            if($users_result) {

                if (mysqli_num_rows($users_result) == 1) {

                    
                    $sum_query = "SELECT SUM(`vote_total`) FROM `vote` WHERE `title` = '$title' AND `info` = '$info'";

                    $sum_result = mysqli_query($conn, $sum_query);
            
                    if($sum_result) {
            
                        $row = mysqli_fetch_row($sum_result);
                
                        $sum = $row[0];
                
                        $_SESSION['sum'] = $sum; 
                
                    };
        
                    echo'

                    // if he has voted

                    <script>

                    let ok_vote = document.getElementsByClassName("like_vote")[0];

                    // remove attribute
                    ok_vote.removeAttribute("onclick", "like()");

                    // set attribute for the sign out
                    ok_vote.setAttribute("onclick", "dislike()");

                    document.getElementById("vote_cot").innerText = String('.$_SESSION["sum"].').trim();

                    document.getElementsByClassName("like_vote")[0].innerHTML = "(Unlike)";
                    </script>
                    
                    ';


                } else {

                    $sum_query = "SELECT SUM(`vote_total`) FROM `vote` WHERE `title` = '$title' AND `info` = '$info'";

                    $sum_result = mysqli_query($conn, $sum_query);
            
                    if($sum_result) {
            
                    $row = mysqli_fetch_row($sum_result);
            
                    $sum = $row[0];
            
                    $_SESSION['num'] = $sum; 
            
                    };


                    echo'

                    <script>

                    let ok_vote = document.getElementsByClassName("like_vote")[0];

                    // remove attribute
                    ok_vote.removeAttribute("onclick", "dislike()");
                
                
                    // set attribute
                    ok_vote.setAttribute("onclick", "like()");

                    ok_vote.innerText = "(like)";

                    document.getElementById("vote_cot").innerText = String('.$_SESSION["num"].').trim();

                    </script>
                    
                    ';

                    
                }
            }else {
                echo mysqli_error($conn);
            }



            echo '
                <div class="modal_background">
                    <div class="modal_box">
                            <h3 style="color: rgb(23,86,22)">Enter Your Comment</h3>
                            <textarea placeholder="enter your comment" class="form-control" id="comCom"></textarea>
                            <input type="hidden" value='.$nameUser.' id="nameCom">
                            <input type="hidden" value='.$emailUser.' id="emailCom">
                            <input type="hidden" value='.$id.' id="idCom">
                            <p style="display: none;">Your Comment Is </p>
                        <br>
                        <div class="text_align">
                            <button type="button" class="btn btn-lg btn-block button button--close js-close" id="butCom">Submit</button>
                        </div>
                    </div>
                </div>
            ';

            // comment iteration 

            $comment_query = "SELECT * FROM `comment` WHERE `title` = '$title' AND `info` = '$info'";

            $comment_result = mysqli_query($conn, $comment_query);

            if($comment_result) {

                while ($row = mysqli_fetch_array($comment_result, MYSQLI_ASSOC)) {
                    $id = $row['id'];
                    $commentName = $row['name'];
                    $commentEmail = $row['email'];
                    $commentTitle = $row['title'];
                    $commentInfo = $row['info'];
                    $commentComment = $row['comment'];
                    $commentDate = $row['date'];
                    $commentTime = $row['time'];
            
                    echo '
                    <!-- declaring the container colum-->
                    <div class="col-lg-12">
                        <!-- making the container to be in a row-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- gives it the card feeling -->
                                <div class="card">
                                    <div class="card-header">
                                    <h5 class="card-title" style="color: rgb(23,86,22)">Re: '.$commentTitle.'</h5>
                                    <h6 class="card-title" style="color: rgb(23,86,22)">by '.$commentName.': <span>'.$commentTime.'</span> <span>'.$commentDate.'</span></h6>
                                    </div>
                                    <div class="card-body">
                                    <p class="card-text" id="infoCom">'.$commentComment.'</p>
                                    <span>(Modify)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
            
                }

            }
            

        } else {
            mysqli_error($conn);
        }

    } else {
        mysqli_error($conn);
    }
?>



</div>

<!-- end of container -->

<!-- footer -->
<p class="mt-5 mb-3 text-muted text-center">&copy; 2020-2021 Nairanews</p>

<!-- javascript links -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>


<script type="text/javascript" src="js/page.js"></script>
    
</body>
</html>