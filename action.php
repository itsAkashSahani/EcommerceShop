<?php

include 'db.php';

session_start();

extract($_POST);

if (isset($_POST['productid'])) {
    $productid = $_POST['productid'];
    

    if (isset($_SESSION['uid'])) {
        $user = $_SESSION['uid'];
        $shopid = $_SESSION['pshopid'];
        $query = "INSERT INTO cart (productid, userid, shopid) VALUES ('$productid', '$user', '$shopid')";
        mysqli_query($con, $query);
        echo 'added';
    }
    else {
        echo 'login_first';
    }
}
