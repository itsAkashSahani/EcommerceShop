<!DOCTYPE html>
<html lang="en">

<head>
    <title>EI Stores</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/e845c8086a.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="js/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    session_start();
    ?>

    <div class="modal" id="checkoutModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Checkout</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->

                <form method="post" id="checkoutForm" name="checkoutForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="oaddress">Shop Address</label>
                            <textarea class="form-control" id="oaddress" name="oaddress" rows="3" required></textarea>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="ocity">City</label>
                                <input type="text" class="form-control" name="ocity" id="ocity" required>

                            </div>
                            <div class="form-group col">
                                <label for="ostate">State</label>
                                <input type="text" class="form-control" name="ostate" id="ostate" required>
                            </div>
                            <div class="form-group col">
                                <label for="opin">Last Name</label>
                                <input type="number" class="form-control" name="opin" id="opin" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" value="Submit" />
                        </div>

                        <div id="msg">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="container pt-5">
        <h2 class="pt-5 text-center text-success"><?php echo $_SESSION['fname'] . '`s Cart' ?></h2>
        <br><br>

        <?php
        include 'db.php';
        $data = '
        <table class="table table-bordered table-striped">
        <tr>
            <th>Product Name</th>
            <th>Preview</th>
            <th>Category</th>
            <th>Price</th>
            <th>Delete</th>
        </tr>';

        $totalprice = 0;
        $userid = $_SESSION['uid'];

        $countquery = "SELECT * FROM `cart` WHERE `userid` = '$userid'";
        $result = mysqli_query($con, $countquery);
        $count = mysqli_num_rows($result);
        $_SESSION['pcount'] = $count;


        $displayquery = "SELECT * FROM `cart` WHERE `userid` = '$userid'";
        $result = mysqli_query($con, $displayquery);



        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $productid[] = $row['productid'];
            }
            foreach ($productid as $pid) {
                $showquery = "SELECT * FROM `product` WHERE `proid` = '$pid'";
                $cartresult = mysqli_query($con, $showquery);

                if (mysqli_num_rows($cartresult) > 0) {
                    while ($cartrow = mysqli_fetch_assoc($cartresult)) {
                        $totalprice = $totalprice + $cartrow['proprice'];
                        $data .= '
                <tr>
                    <td>' . $cartrow['pname'] . '</td>
                    <td><img src="./uploads/products/' . $cartrow['pimagename'] . '" class="mx-auto d-block" widht="40px" height="40px"></td>
                    <td>' . $cartrow['pcategory'] . '</td>
                    <td>' . $cartrow['proprice'] . '</td>
                    <td>
                        <button onclick="DeleteCart(' . $cartrow['proid'] . ')" class="btn btn-danger mx-auto d-block">
                            Delete
                        </button>
                    </td>
                </tr>';
                    }
                }
            }
            $data .= '</table>
                            <hr class="mt-4" style="background: black;">
                            <div class="row">
                            <h1 class="col-md-6">Total: ' . $totalprice . '</h1>
                            <button data-toggle="modal" data-target="#checkoutModal" class="col-md-6 btn btn-success">
                                Checkout
                            </button></div>';
            echo $data;
            $_SESSION['cartProducts'] = $productid;
            // print_r($_SESSION['cartProducts']);
        }

        if (isset($_POST['deleteid'])) {
            $cartid = $_POST['deleteid'];
            $deletequery = "DELETE FROM `cart` WHERE `productid` = '$cartid'";
            mysqli_query($con, $deletequery);
        }
        ?>
    </div>

</body>
<script>
    function DeleteCart(deleteid) {
        var conf = confirm("Are you sure");
        if (conf == true) {
            $.ajax({
                url: 'cart.php',
                type: 'post',
                data: {
                    deleteid: deleteid
                },
                success: function(data) {
                    window.location.href = "cart.php";
                }
            })
        }
    }

    jQuery('#checkoutForm').on('submit', function(e) {
        jQuery.ajax({
            url: 'checkout.php',
            type: 'post',
            data: jQuery('#checkoutForm').serialize(),
            success: function(data) {
                if (data == "Order_Placed") {
                    swal("Order Placed Successfully", "You will receive conformation mail shortly.", "success");
                    $('#checkoutForm')[0].reset();
                    setTimeout(function() {
                        window.location.href = "index.php";
                    }, 3000);
                } else {
                    $("#msg").html(data);
                }
            }
        });
        e.preventDefault();
    });
</script>

</html>