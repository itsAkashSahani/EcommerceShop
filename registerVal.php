<?php

include 'db.php';

session_start();

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$password = $_POST['password'];
$haveShop = 0;

$name = "/^[a-zA-Z ]+$/";
$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
$number = "/^[0-9]+$/";


if (!preg_match($name, $fname)) {
	echo "
		<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>this $fname is not valid..!</b>
		</div>
	";
	exit();
}
if (!preg_match($name, $lname)) {
	echo "
		<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>this $lname is not valid..!</b>
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


if (!preg_match($number, $contact)) {
	echo "
		<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>Mobile number $contact is not valid</b>
		</div>
	";
	exit();
}
if (!(strlen($contact) == 10)) {
	echo "
		<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>Mobile number must be 10 digit</b>
		</div>
	";
	exit();
}

$sql = "SELECT uid FROM user WHERE email = '$email'";
$check_query = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($check_query);
if ($row > 0) {
	echo "
			<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Email Address is already available Try Another email address</b>
			</div>
		";
	exit();
} else {
	$sql = "INSERT INTO user (fname, lname, email, contact, password, haveShop) 
		VALUES ('$fname', '$lname', '$email', 
		'$contact', '$password', '$haveShop')";
	$run_query = mysqli_query($con, $sql);

	if ($run_query) {
		echo "register_success";
	} else {
		echo "Error :" . mysqli_error($con);
	}


	$_SESSION["fname"] = $fname;
	$_SESSION["email"] = $email;
	$_SESSION['pcount'] = 0;

	$sql = "SELECT uid FROM user WHERE email = '$email'";
	$check_query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($check_query);
	$_SESSION["uid"] = $row['uid'];
}
