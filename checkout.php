<?php
include 'db.php';
session_start();

$address = $_POST['oaddress'];
$city = $_POST['ocity'];
$state = $_POST['ostate'];
$pin = $_POST['opin'];

$userid = $_SESSION['uid'];
$status = 0;



if (isset($_SESSION['cartProducts'])) {
    foreach ($_SESSION['cartProducts'] as $cartproid) {
        $sql = "INSERT INTO `ordertable` (`userid`, `productid`, `address`, `city`, `state`, `pin`, `status`)
        VALUES ('$userid', '$cartproid', '$address', '$city', '$state', '$pin', '$status')";
        $result = mysqli_query($con, $sql);
    }
    echo 'Order_Placed';
    $sql = "DELETE FROM `cart` WHERE `userid` = $userid";
    $result = mysqli_query($con, $sql);
} else {
    echo 'No_Products';
}
