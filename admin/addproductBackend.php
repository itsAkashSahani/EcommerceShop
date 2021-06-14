<?php

include '../db.php';

session_start();

extract($_POST);

$pname = $_POST['pname'];
$pcategory = $_POST['pcategory'];
$pqty = $_POST['pqty'];
$pdesc = $_POST['pdesc'];
$price = $_POST['price'];
$brand = $_POST['brand'];
$shopid = $_SESSION['shopid'];


if (isset($_FILES['pfile'])) {
    $pimage = addslashes(file_get_contents($_FILES['pfile']['tmp_name']));

    $pimagename = $_FILES['pfile']['name'];
    $upload_dir = "../uploads/products";
    $uploaded_file = $upload_dir . basename($_FILES["pfile"]["name"]);
    $uploadOk = 1;
    $imageType = strtolower(pathinfo($uploaded_file, PATHINFO_EXTENSION));
    $name = "/^[a-zA-Z ]+$/";
    $number = "/^[0-9]+$/";


    if (!preg_match($number, $pqty)) {
        echo "
		<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>this $pqty is not valid..!</b>
		</div>
	";
        exit();
    }

    if (!preg_match($number, $price)) {
        echo "
		<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>this $price is not valid..!</b>
		</div>
	";
        exit();
    }

    $check = getimagesize($_FILES['pfile']['tmp_name']);

    if ($check !== false) {
        if (move_uploaded_file($_FILES['pfile']['tmp_name'], $uploaded_file)) {
            $sql = "INSERT INTO product (`pname`, `pimage`, `pimagename`, `pcategory`, `pqty`, `pdesc`, `proprice`, `pbrand`, `shopid`) 
            VALUES ('$pname', '$pimage', '$pimagename', '$pcategory', '$pqty', '$pdesc', '$price', '$brand', '$shopid')";

            $run_query = mysqli_query($con, $sql);

            if ($run_query) {
                echo "Product_Added";
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


