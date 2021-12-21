<style>


p#next_num0 {
    display: flex;
    justify-content: center;
    margin-bottom: 0px;
}


</style>


<?php 


if(!isset($_SESSION['users']['name'])) {
    header("location: index.php");
}

?>

<?php

require "database/connect.php";

$news_query = "SELECT * FROM `engine`";

$news_result = mysqli_query($conn, $news_query);

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
                        <h3 style="text-align: center; color: rgb(23,86,22)">Report Feed</h3>
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

                        <p id="next_num0"><a href="user.php" id="next_num1">(1)</a><a href="#" id="next_num2">(2)</a><a href="#" id="next_num3">(3)</a></p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    ';

}