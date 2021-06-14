<?php
include 'db.php';
session_start();

$productid = $_POST['productid'];

$query = "SELECT * FROM product WHERE proid = $productid";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

$title = $row['pname'];
$image = $row['pimagename'];
$desc = $row['pdesc'];
$price = $row['proprice'];
$brand = $row['brand'];
$shopid = $row['shopid'];

$query = "SELECT * FROM shopinfo WHERE shopid = $shopid";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

$shopname = $row['shopname'];



echo '
<div class="product-detail">
<div class="container detail">
    <div class="row">
        <div class="col-md-5">
            <img class="d-block w-100" src="./uploads/products/' . $image . '" alt="Product">
        </div>
        <div class="col-md-7">
            <h2 class="pro-title">
            ' . $title . '
            </h2>
            <p>' . $desc . '</p>
            <p>Product Code : ' . $productid . '</p>
            <p class="price">' . $price . '</p>
            <p><b>Availability:</b> In Stock</p>
            <p><b>Brand:</b> ' . $brand . '</p>
            <p><b>Shop Name:</b> ' . $shopname . '</p>
            <button onclick="addToCart(' . $productid . ')" class="btn btn-danger btn-block px-1" id="addtocart"><span class="fas fa-shopping-cart"></span>  Add To Cart</button>                     
        </div>
    </div>
</div>
</div>
';

echo $data;

