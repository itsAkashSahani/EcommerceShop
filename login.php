<?php

include 'db.php';

session_start();

$email = $_POST['log-email'];
$password = $_POST['log-password'];

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

$sql = "SELECT uid, fname, haveShop FROM user WHERE email = '$email' and password = '$password'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$count = mysqli_num_rows($result);


if ($count == 1) {
	echo "user_exist";

	$_SESSION["haveShop"] = $row['haveShop'];
	$_SESSION["uid"] = $row['uid'];
	$uid = $row['uid'];
	$_SESSION["fname"] = $row['fname'];
	$_SESSION["email"] = $email;
	$countquery = "SELECT * FROM `cart` WHERE `userid` = '$uid'";
	$result = mysqli_query($con, $countquery);
	$count = mysqli_num_rows($result);
	$_SESSION['pcount'] = $count;

	if ($_SESSION["haveShop"] == 1) {
		$sql = "SELECT * FROM shopinfo WHERE userid = '$uid'";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_assoc($result);
		$_SESSION['shopname'] = $row['shopname'];
		$_SESSION['shopid'] = $row['shopid'];
	}
} else {
	echo "something_wrong";
}
