<?php 
    include "display.php";
    
    if($_SESSION['users']['name'] == null && $_SESSION['users']['email'] == null) {
      header("location: index.php");
  }
?>


<?php 

function displayHistory($name, $email) {

    require "database/connect.php";

    $query = "SELECT * FROM `engine` WHERE `name` = '$name' AND `email` = '$email'";

    $result = mysqli_query($conn, $query);

    if($result) {

        echo "

        <h2>These Are Your Official Report History</h2>
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Email</th>
                                <th>Title</th>
                                <th>Report Date</th>
                                <th>Report Category</th>
                            </tr>

                        </thead>
                        </tbody>
        
            ";
            $i = 1;
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            // $id = $row['id'];
            $email = $row['email'];
            $title = $row['title'];
            $date = $row['date'];
            $category = $row['category'];

            echo "
            <tr>
            <td>$i</td>
            <td>$email</td>
            <td>$title</td>
            <td>$date</td>
            <td>$category</td>
            </tr>
            ";

            $i++;

        };
            echo "</tbody></table>";
    } else {
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name; ?> Official History</title>

    <!-- link to bootstrap style -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

    <style>
        body {
            width: 100%;
        }

        h2 {
            width: 80%;
            margin: 30px auto;
        }


    </style>
</head>
<body>


<h2>Your Official Report History Would Be Displayed Here</h2>

<div class="container">
<?php 

$feedback = displayHistory($name, $email);

echo $feedback;

?>

</div>


</body>
</html>