<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizenreport</title>

    <!-- link to bootstrap styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- link to my styles -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navigation System -->

<nav class="navbar navbar-expand-lg navbar-light nav_color">
  <a class="navbar-brand" href="index.php"><h2 style="color: rgb(23,86,22)">Citizenreport</h2></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php" style="color: rgb(23,86,22)">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link js-open" href="#" style="color: rgb(23,86,22)">About Us </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="#" style="color: rgb(23,86,22)">Categories </a>
      </li> -->

      <!-- categories dropdown  -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false" style="color: rgb(23,86,22)">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="displayCategory.php?id=fighting" style="color: rgb(23,86,22)">Fighting</a>
          <a class="dropdown-item" href="displayCategory.php?id=rioting" style="color: rgb(23,86,22)">Rioting</a>
          <a class="dropdown-item" href="displayCategory.php?id=accident" style="color: rgb(23,86,22)">Accident</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="displayCategory.php?id=travel" style="color: rgb(23,86,22)">Travel</a>
          <a class="dropdown-item" href="displayCategory.php?id=education" style="color: rgb(23,86,22)">Education</a>
          <a class="dropdown-item" href="displayCategory.php?id=business" style="color: rgb(23,86,22)">Business</a>
        </div>
      </li>
      <!-- end of category dropdown -->


      <!-- registe/sign in dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false" style="color: rgb(23,86,22)">
          Register
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#" style="color: rgb(23,86,22)">Search History</a>
          <a class="dropdown-item" href="login.php" style="color: rgb(23,86,22)">Sign In</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="register.php" style="color: rgb(23,86,22)">Register</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>


<!-- Modal Background -->
<div class="modal_background"></div>

  <!-- Modal Box-->
  <div class="modal_box">
      <h1 style="color: rgb(23,86,22)">Citizenreport</h1>
      <p>
          Citizenreport is a news forum where users can read about events occuring in their
          surrounding and the world at large. Citizenreport is not owned by any government agency.
          It is a text project built by a young man.
      </p>
      <p>
          Also you can become a member by Registering and see all the 
          amazing features we have to offer to you. One of which you would
          be able to add information to our database so that other users can search and
          be informed. Thanks!!.
      </p>
      <div class="text_align">
          <button type="button" class="button button--close js-close">Close</button>
      </div>
  </div>
  <!-- End Of Modal Box -->

</div>
<!-- End Of Modal Background -->



<!-- start of container -->
<div class="container-fluid">

<!-- Start of Carousel -->
<div id="carouselExampleIndicators" class="carousel slide c_move" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner c_inner">
    <div class="carousel-item active">
      <img src="image/new4.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="image/news1.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="image/news2.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev" id="but_move">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next" id="but_move">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </button>
</div>
<!-- End Of Carousel -->



<h2 id="txt1">Citizenreport Nigeria Forum</h2>

<!-- Display News Feed -->

<?php

require "displayNews.php";

?>


<!-- End Of Display News Feed -->




</div>
<!-- End Of Container -->

<!-- footer -->
<p class="mt-5 mb-3 text-muted text-center">&copy; 2020-2021 Citizenreport</p>


<!-- javascript links -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script type="text/javascript" src="js/app.js"></script>
</body>
</html>