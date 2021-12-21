<?php 

// this is just to check for any errors before registration
if(isset($_POST['register'])) {

    $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES);
    $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES);
    $password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES);
    $token = bin2hex(random_bytes(50));  // generate unique token

    $errors = [];


	if(empty($name)){

		$errors[] = "<div class='alert alert-info'>Please enter your name</div>";

	}

	if(empty($email)){
		$errors[] = "<div class='alert alert-info'>Please enter your email</div>";
	}

	if(empty($password)){
		$errors[] = "<div class='alert alert-info'>Please enter your password</div>";
	}

    if(empty($errors)){

        require "functions/functions.php";

		$feedback = registerNewUser($name, $email, $password, $token);

        echo $feedback;
    } else {
        forEach($errors as $error) {
            echo "{$error}<br>";
        }

    }
}


// this is just to check for any error befoe login in the user
if(isset($_POST['login'])) {

    $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES);
    $password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES);

    $errors = [];

	if(empty($email)){
		$errors[] = "<div class='alert alert-info'>Please enter your email</div>";
	}

	if(empty($password)){
		$errors[] = "<div class='alert alert-info'>Enter your password</div>";
	}

    if(empty($errors)){

        require "functions/functions.php";

		$feedback = loginUser($email, $password);

        echo $feedback;
    } else {
        forEach($errors as $error) {
            echo "{$error}<br>";
        }

    }
}


// checking for empty space in the add entry
// checking for add entry
if(isset($_POST['addEntry'])) {

    $name = trim($_POST['addName']);
    $email = trim($_POST['addEmail']);
    $title = htmlspecialchars(trim($_POST['title']), ENT_QUOTES);
    $info = htmlspecialchars(trim($_POST['info']), ENT_QUOTES);
    $url = htmlspecialchars(trim($_POST['url']), ENT_QUOTES);
    // $keywords = htmlspecialchars(trim($_POST['keywords']), ENT_QUOTES);
    $date = trim($_POST['date']);
    $category = trim($_POST['category']);

    $token = bin2hex(random_bytes(5));

    $pf = $_FILES['image'];

    $image = $pf['name'];

    $errors = [];

	if(empty($title)){

		$errors[] = "<div class='alert alert-info'>Please enter the title</div>";

	}

	if(empty($info)){
		$errors[] = "<div class='alert alert-info'>Please enter the info</div>";
	}

    // if(empty($keywords)){
	// 	$errors[] = "<div class='alert alert-info'>Enter enter the keywords</div>";
	// }

    if(empty($date)){
		$errors[] = "<div class='alert alert-info'>Please enter the Date</div>";
	}

    if(empty($category)){
		$errors[] = "<div class='alert alert-info'>Please enter the Category do not select Choose..</div>";
	}

    if(empty($image)){
		$errors[] = "<div class='alert alert-info'>Please choose a file</div>";
	}

    if(empty($errors)){

        $allowed_types = ['image/png', 'image/jpeg', 'image/PNG', 'image/JPG'];


		$pf_name = $token.$pf['name'];
		$pf_type = $pf['type'];
		$pf_tmp = $pf['tmp_name'];

		if(in_array($pf_type, $allowed_types)){

			if(!is_dir("images")){
				mkdir("images");
			}

			$photo_path = "assets/{$pf_name}";

			require "functions/functions.php";

			move_uploaded_file($pf_tmp, $photo_path);

			$feedback = addNewEntry($title, $info, $url, $name, $email, $date, $category, $photo_path);

            echo $feedback;

		}
		
    } else {
        forEach($errors as $error) {
            echo "{$error}<br>";
        }

    }
}



?>