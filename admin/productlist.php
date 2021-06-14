<?php
include "common.php";
?>


<div class="productsDisplay">
    <div class="container product mt-5 pt-5">
        <div class="row mt-3">

            <?php

            include '../db.php';

            
            $shop = $_SESSION['shopid'];

            $query = "SELECT * FROM product WHERE shopid = '$shop'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            // $_SESSION['pshopid'] = $row['shopid'];


            while ($row = mysqli_fetch_assoc($result)) {
                $data = '
                    <div class="col-md-4 pt-3">
                        <div class="card" style="width: 15rem;">
                            <div class="card-header">
                                <img class="card-img-top" src="../uploads/products/' . $row['pimagename'] . '" alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center">' . $row['pname'] . '</h5>
                                <p class="card-text text-center"><span class="fa fa-inr"></span> ' . $row['proprice'] . '</p>
                            </div>
                        </div>
                    </div>';

                echo $data;
            }

            ?>

        </div>
    </div>
</div>
