<?php 

include "display.php";
    
if($_SESSION['users']['name'] == null && $_SESSION['users']['email'] == null) {
  header("location: index.php");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Report</title>

    <!-- link to bootstrap style -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <style>
        body {
            width: 100%;
            background-color: rgb(23,86,22);
            color: white;
        }

        .container {
            margin-top: 5%;
        }

        h2 {
            text-align: center;
            margin-bottom: 40px;
        }
        
    </style>

</head>
<body>

<!-- Add Entry Form -->
<div class="container">
<h2 >Fill in the Box So that Other Users Can Be Informed</h2>
    <div class="row">
            <div class="col-md-6 m-auto">
                <form method="POST" enctype="multipart/form-data">
                    <?php require "process/forms.php"; ?> <!-- submit the form to forms.php --> 
                        <div class="form-label-group">
                            <input type="text" class="form-control" name='title' autofocus>
                            <label>Enter The Title</label>
                        </div>

                        <div class="form-label-group">
                            <input type="text" class="form-control" name='url' autofocus>
                            <label>Enter The Url</label>
                        </div>

                        <div class="form-label-group">
                            <textarea name='info' class="form-control"></textarea>
                            <label>Enter A Brief Info</label>
                        </div>

                        <!-- <div class="form-label-group">
                            <textarea name='keywords' class="form-control"></textarea>
                            <label>Enter The Keywords</label>
                        </div> -->

                        <div class="form-label-group">
                            <input type="date" class="form-control" name='date' autofocus>
                            <label>Enter The Date</label>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Category</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01" name="category">
                                <option value="fighting">Fighting</option>
                                <option value="rioting">Rioting</option>
                                <option value="accident">Accident</option>
                                <option value="travel">Travel</option>
                                <option value="education">Education</option>
                                <option value="business">Business</option>
                            </select>
                        </div>

                        <div class="form-label-group">
                            <input type="file" name="image">
                            <label>Upload News Image</label>
                        </div>

                        <input type="hidden" name="addName" value="<?php echo $name; ?>">
                        <input type="hidden" name="addEmail" value="<?php echo $email; ?>">

                        <button name='addEntry' class="btn btn-lg btn-primary btn-block" type="submit">Add Entry</button>

                        <p class="mt-5 mb-3 text-muted text-center">&copy; 2020-2021 Citizenreport</p>
                </form>
            </div>
    </div>

</div>
</body>
</html>