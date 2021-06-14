<?php

include 'db.php';

session_start();

$sname = $_POST['sname'];
// $shoplogo = $_POST['shoplogo'];
$scategory = $_POST['scategory'];
$shopmail = $_POST['shopemail'];
$addr = $_POST['shopaddr'];
$city = $_POST['city'];
$state = $_POST['state'];
$pin = $_POST['pin'];
$userid = $_SESSION['uid'];

$email = $_POST['email'];
$password = $_POST['password'];
$haveStop = 1;


if (isset($_FILES['shoplogo'])) {
    $logo = addslashes(file_get_contents($_FILES['shoplogo']['tmp_name']));

    $logo_name = $_FILES['shoplogo']['name'];
    $upload_dir = "uploads/shoplogo/";
    $uploaded_file = $upload_dir . basename($_FILES["shoplogo"]["name"]);
    $uploadOk = 1;
    $imageType = strtolower(pathinfo($uploaded_file, PATHINFO_EXTENSION));
    $name = "/^[a-zA-Z ]+$/";
    $emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
    $number = "/^[0-9]+$/";


    if (!preg_match($name, $sname)) {
        echo "
		<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>this $sname is not valid..!</b>
		</div>
	";
        exit();
    }

    if (!preg_match($emailValidation, $shopmail)) {
        echo "
		<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>this $email is not valid..!</b>
		</div>
	";
        exit();
    }

    if (!preg_match($name, $city)) {
        echo "
		<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>this $city is not valid..!</b>
		</div>
	";
        exit();
    }

    if (!preg_match($name, $state)) {
        echo "
		<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>this $state is not valid..!</b>
		</div>
	";
        exit();
    }

    if (!preg_match($number, $pin)) {
        echo "
		<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>this $pin is not valid..!</b>
		</div>
	";
        exit();
    }

    if (!preg_match($emailValidation, $email)) {
        echo "
		<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>this $email is not valid..!</b>
		</div>
	";
        exit();
    }

    if (strlen($password) < 9) {
        echo "
		<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>Password is weak</b>
		</div>
	";
        exit();
    }

    $check = getimagesize($_FILES['shoplogo']['tmp_name']);

    if ($check !== false) {
        if (move_uploaded_file($_FILES['shoplogo']['tmp_name'], $uploaded_file)) {
            $sql = "INSERT INTO shopinfo (`shopname`, `scategory`, `shoplogo`, `filename`, `address`, `city`, `state`, `pincode`, `userid`) 
            VALUES ('$sname', '$scategory', '$logo', '$logo_name', '$addr', '$city', '$state', '$pin', '$userid')";

            $run_query = mysqli_query($con, $sql);

            if ($run_query) {
                echo "Shop_Created";
                $sql = "SELECT * FROM shopinfo";
                $check_query = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($check_query);
                $_SESSION["shopid"] = $row['shopid'];
                $_SESSION['shopname'] = $row['shopname'];
                $sql = "UPDATE user SET haveShop = '$haveStop' WHERE email = '$email'";

                $run_query = mysqli_query($con, $sql);
            } else {
                echo "
		        <div class='alert alert-warning'>
			        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			        <b>Something Went Wrong !! Try Again</b>
		        </div>";
                exit();
            }
        } else {
            echo "
		    <div class='alert alert-warning'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <b>Uploading Failed</b>
		    </div>";
            exit();
        }
    } else {
        echo "
		<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>File should be image</b>
		</div>";
        exit();
    }
} else {
    echo "error";
}
