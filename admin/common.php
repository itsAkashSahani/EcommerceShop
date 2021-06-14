<!DOCTYPE html>
<html lang="en">


<head>

    <title>Admin Panel</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/e845c8086a.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="../js/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>

<body>
    <input type="checkbox" name="" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="fas fa-shopping-cart"></span><span>EI Stores</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="addproducts.php"><span class="fas fa-plus"></span><span>Add Products</span></a>
                </li>
                <li>
                    <a href="productlist.php"><span class="fas fa-list"></span><span>Product List</span></a>
                </li>
                <li>
                    <a href="ordershow.php"><span class="fas fa-book"></span><span>Orders</span></a>
                </li>
                <li>
                    <a href="report.php"><span class="fas fa-file"></span><span>Sales Report</span></a>
                </li>
                <li>
                    <a href="../logout.php"><span class="fas fa-sign-out-alt"></span><span>Log Out</span></a>
                </li>
            </ul>
        </div>
    </div>



    <div class="main-content">
        <header class="row d-inline-flex justify-content-between ml-2">
            <div class="col-md-4">
                <h2>
                    <label for="nav-toggle">
                        <Span class="fas fa-bars"></Span>
                    </label>
                    Desktop
                </h2>
            </div>

            <div class="user-wrapper col-md-4 d-flex justify-content-end">
                <?php
                include '../db.php';
                session_start();
                $user = $_SESSION['uid'];

                $query = "SELECT * FROM `shopinfo` WHERE `userid` = '$user'";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                $_SESSION['sname'] = $row['shopname'];
                $_SESSION['shopid'] = $row['shopid'];
                echo '
                <img src="../uploads/shoplogo/'.$row['filename'].'" alt="" width="40px" height="40px">
                <div>  
                    <h4>'.$row['shopname'].'</h4>
                </div>
                ';
                ?>
            </div>
        </header>

</body>

</html>