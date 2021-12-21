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
  <a class="navbar-brand" href="index.php"><h2 style="color: rgb(23,86,22)">&nbsp;Citizenreport</h2></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="register.php" style="color: rgb(23,86,22)">Register <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link js-open" href="login.php" style="color: rgb(23,86,22)">Sign In </a>
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

    $id = $_GET['id'];

    $news = "SELECT * FROM `engine` WHERE `category` = '$id'";

    $news_result = mysqli_query($conn, $news);

    if($news_result) {

        echo '
            <!-- declaring the container colum-->
            <div class="col-lg-12">
                <!-- making the container to be in a row-->
                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 20px; margin-top: 20px;">
                        <!-- gives it the card feeling -->
                        <div class="card">
                            <div class="card-header">
                            <h3 style="text-align: center; color: rgb(23,86,22)">'.$id.' section</h3>
                            </div>
                            <div class="card-body" style="padding: 0px">
        
        ';
        while ($row = mysqli_fetch_array($news_result, MYSQLI_ASSOC)) {
            $id = $row['id'];
            $newsTitle = $row['title'];
            $newsInfo = $row['info'];
            $newsUrl = $row['url'];
            $newsDate = $row['date'];

            echo '
                    <a href="UserPage.php?id='.base64_encode($id).'" style="text-decoration: none;"><h5 style="text-align: center;"><small>>></small>'.$newsTitle.'<small><<</small></h5></a>
                ';

        }

        echo ' 

                            <p style="margin-left: 50%;"><a href="#">(1)</a><a href="#">(2)</a><a href="#">(3)</a></p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        ';

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


    
</body>
</html>