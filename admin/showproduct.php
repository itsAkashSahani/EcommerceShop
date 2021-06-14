<?php

include '../db.php';

session_start();

extract($_POST);

if (isset($_POST['readRecord'])) {
    $data = '
        <table class="table table-bordered table-striped">
        <tr>
            <th>Id</th>
            <th>Product Name</th>
            <th>Preview</th>
            <th>Category</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Delete</th>
        </tr>';

        $shopid = $_SESSION['shopid'];

    $displayquery = "SELECT * FROM `product` WHERE `shopid` = '$shopid' ORDER BY `proid` DESC";
    $result = mysqli_query($con, $displayquery);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $products[] = $row['proid'];
            $data .= '
                <tr>
                    <td>' . $row['proid'] . '</td>
                    <td>' . $row['pname'] . '</td>
                    <td><img src="../uploads/products/' .$row['pimagename'].'" class="mx-auto d-block" widht="40px" height="40px"></td>
                    <td>' . $row['pcategory'] . '</td>
                    <td>' . $row['proprice'] . '</td>
                    <td>' . $row['pqty'] . '</td>
                    <td>
                        <button onclick="DeleteProduct(' . $row['proid'] . ')" class="btn btn-danger mx-auto d-block">
                            Delete
                        </button>
                    </td>
                </tr>';
        }
    }
    // $_SESSION['products'] = $products;
    $data .= '</table>';
    echo $data;
}

if (isset($_POST['deleteid'])){
    $productid = $_POST['deleteid'];
    $deletequery = "DELETE FROM `product` WHERE `proid` = '$productid'";
    mysqli_query($con, $deletequery);
}