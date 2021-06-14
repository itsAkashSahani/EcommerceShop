<div class="productsDisplay">
    <div class="container product">
        <h2>New Arrivals</h2>
        <div class="row mt-3">

            <?php

            include 'db.php';

            // session_start();

            $query = "SELECT * FROM product";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $_SESSION['pshopid'] = $row['shopid'];


            while ($row = mysqli_fetch_assoc($result)) {
                $data = '
                    <div class="col-md-3 pt-3">
                        <div class="card" style="width: 15rem;">
                            <div class="card-header">
                                <img class="card-img-top" src="./uploads/products/' . $row['pimagename'] . '" alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center">' . $row['pname'] . '</h5>
                                <p class="card-text text-center"><span class="fa fa-inr"></span> ' . $row['proprice'] . '</p>
                                <button onclick="addToCart(' . $row['proid'] . ')" class="btn btn-danger btn-block px-1" id="addtocart"><span class="fas fa-shopping-cart"></span>  Add To Cart</button>
                                <button onclick="buyNow(' . $row['proid'] . ')" class="btn btn-success btn-block px-1" id="buy"><span class="fas fa-wallet"></span>  Buy Now</button>
                            </div>
                        </div>
                    </div>';

                echo $data;
            }

            ?>

        </div>
    </div>
</div>

<script>
    function addToCart(productid) {
        $.ajax({
            url: 'action.php',
            type: 'post',
            data: {
                productid: productid
            },
            success: function(data) {
                if (data == 'added') {
                    swal("Product Added", "Check Your Cart To Proceed", "success");
                } else if (data == 'login_first') {
                    swal("Login First", "", "alert");
                }
            }
        });
    }
</script>