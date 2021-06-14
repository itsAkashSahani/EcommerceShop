<?php

include 'db.php';

session_start();

$email = $_POST['adminEmail'];
$password = $_POST['adminPass'];

$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";


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

$sql = "SELECT uid, fname FROM user WHERE email = '$email' and password = '$password'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);


if ($count == 1) {
    echo "user_exist";
    $_SESSION["uid"] = mysqli_insert_id($con);
    $_SESSION["fname"] = $row['fname'];
	$_SESSION["email"] = $email;
} else {
    echo "something_wrong";
}
