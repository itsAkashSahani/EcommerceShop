<main>
    <div class="dashboard-cards">
        <div class="card-dash-single">
            <div>
                <h1>54</h1>
                <span>Customers</span>
            </div>
            <div>
                <span class="fas fa-users"></span>
            </div>
        </div>
        <div class="card-dash-single">
            <div>
                <h1>54</h1>
                <span>Products</span>
            </div>
            <div>
                <span class="fas fa-list"></span>
            </div>
        </div>
        <div class="card-dash-single">
            <div>
                <h1>54</h1>
                <span>Orders</span>
            </div>
            <div>
                <span class="fas fa-shopping-bag"></span>
            </div>
        </div>
        <div class="card-dash-single">
            <div>
                <h1>54</h1>
                <span>Total Sales</span>
            </div>
            <div>
                <span class="fas fa-wallet"></span>
            </div>
        </div>
    </div>

    <div class="recent-grid">
        <div class="users">
            <div class="card-dash">
                <div class="card-dash-header">
                    <h3>Recent Orders</h3>
                    <button>See all <span class="fas fa-arrow-right"></span></button>
                </div>
                <div class="card-dash-body">
                    <?php

                    include '../db.php';

                    extract($_POST);

                    if (isset($_POST['readRecord'])) {
                        $data = '
        <table class="table table-bordered table-striped">
        <tr>
            <th>Order ID</th>
            <th>Product Name</th>
            <th>Price</th>
        </tr>';

                        $shopid = $_SESSION['shopid'];

                        $displayquery = "SELECT * FROM `product` WHERE `shopid` = '$shopid' ORDER BY `proid` desc";
                        $result = mysqli_query($con, $displayquery);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $product[] = $row['proid'];
                            }
                        }
                        foreach ($product as $proid) {
                            $displayquery = "SELECT * FROM `ordertable` WHERE `productid` = '$proid' and `status` = 0 ORDER BY `oid` DESC";
                            $result = mysqli_query($con, $displayquery);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $pid = $row['productid'];
                                    $uid = $row['userid'];
                                    $userquery = "SELECT * FROM `user` WHERE `uid` = '$uid'";
                                    $getuser = mysqli_query($con, $userquery);
                                    $urow = mysqli_fetch_assoc($getuser);
                                    $username = $urow['fname'] . ' ' . $urow['lname'];
                                    $proquery = "SELECT * FROM `product` WHERE `proid` = '$pid'";
                                    $getpro = mysqli_query($con, $proquery);
                                    $prow = mysqli_fetch_assoc($getpro);
                                    $proname = $prow['pname'];
                                    $image = $prow['pimagename'];
                                    $price = $prow['proprice'];
                                    $pqty = 1;


                                    $data .= '
                    <tr>
                        <td>' . $row['oid'] . '</td>
                        <td>' . $proname . '</td>
                        <td>' . $price . '</td>
                    </tr>';
                                }
                            }
                        }
                        $data .= '</table>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="products">
            <div class="card-dash">
                <div class="card-dash-header">
                    <h3>New Products</h3>
                    <button>See all <span class="fas fa-arrow-right"></span></button>
                </div>
                <div class="card-dash-body">
                    <div class="product">
                        <div class="info">
                            <img src="img/shirt.png" width="40px" height="40px" alt="Product image">
                            <div>
                                <h4>Lewis S. Cunningham</h4>
                                <small>CEO Excerpt</small>
                            </div>
                        </div>
                        <div class="pinfo">
                            <span class="fas fa-file"></span>
                            <span class="fas fa-inr"></span>
                            <!-- <span class="fas fa-phone"></span> -->
                        </div>
                    </div>
                    <div class="product">
                        <div class="info">
                            <img src="img/shirt.png" width="40px" height="40px" alt="Product image">
                            <div>
                                <h4>Lewis S. Cunningham</h4>
                                <small>CEO Excerpt</small>
                            </div>
                        </div>
                        <div class="pinfo">
                            <span class="fas fa-file"></span>
                            <span class="fas fa-inr"></span>
                            <!-- <span class="fas fa-phone"></span> -->
                        </div>
                    </div>
                    <div class="product">
                        <div class="info">
                            <img src="img/shirt.png" width="40px" height="40px" alt="Product image">
                            <div>
                                <h4>Lewis S. Cunningham</h4>
                                <small>CEO Excerpt</small>
                            </div>
                        </div>
                        <div class="pinfo">
                            <span class="fas fa-file"></span>
                            <span class="fas fa-inr"></span>
                            <!-- <span class="fas fa-phone"></span> -->
                        </div>
                    </div>
                    <div class="product">
                        <div class="info">
                            <img src="img/shirt.png" width="40px" height="40px" alt="Product image">
                            <div>
                                <h4>Lewis S. Cunningham</h4>
                                <small>CEO Excerpt</small>
                            </div>
                        </div>
                        <div class="pinfo">
                            <span class="fas fa-file"></span>
                            <span class="fas fa-inr"></span>
                            <!-- <span class="fas fa-phone"></span> -->
                        </div>
                    </div>
                    <div class="product">
                        <div class="info">
                            <img src="img/shirt.png" width="40px" height="40px" alt="Product image">
                            <div>
                                <h4>Lewis S. Cunningham</h4>
                                <small>CEO Excerpt</small>
                            </div>
                        </div>
                        <div class="pinfo">
                            <span class="fas fa-file"></span>
                            <span class="fas fa-inr"></span>
                            <!-- <span class="fas fa-phone"></span> -->
                        </div>
                    </div>
                    <div class="product">
                        <div class="info">
                            <img src="img/shirt.png" width="40px" height="40px" alt="Product image">
                            <div>
                                <h4>Lewis S. Cunningham</h4>
                                <small>CEO Excerpt</small>
                            </div>
                        </div>
                        <div class="pinfo">
                            <span class="fas fa-file"></span>
                            <span class="fas fa-inr"></span>
                            <!-- <span class="fas fa-phone"></span> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</div>