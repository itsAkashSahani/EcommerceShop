<?php

session_start();

?>


<div class="container">
    <nav class="navbar navbar-custom navbar-expand-sm fixed-top">
        <!-- Brand -->
        <a class="navbar-brand" href="#">Edith India Stores</a>

        <!-- Links -->
        <ul class="navbar-nav ml-auto">
            <?php
            include 'db.php';

            if (isset($_SESSION["haveShop"]) && ($_SESSION["haveShop"] == 1)) {
                echo '
                <li class="nav-item">
                    <a class="nav-link" href="#"><span class="fas fa-user"></span> Hi ! ' . $_SESSION['fname'] . '</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="cart.php"><span class="fas fa-shopping-cart"></span> Cart <span class="badge badge-light">' . $_SESSION['pcount'] . '</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="admin/index.php"><span class="fas fa-store"></span> My Store</a>
                </li>
    
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><span class="fas fa-sign-out-alt"></span> Logout</a>
                </li>';
            }

            elseif (isset($_SESSION['uid'])) {
                echo '
                <li class="nav-item">
                    <a class="nav-link" href="#"><span class="fas fa-user"></span> Hi ! ' . $_SESSION['fname'] . '</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="cart.php"><span class="fas fa-shopping-cart"></span> Cart <span class="badge badge-light">' . $_SESSION['pcount'] . '</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#createStore"><span class="fas fa-store"></span> Create Store</a>
                </li>
    
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><span class="fas fa-sign-out-alt"></span> Logout</a>
                </li>';

            }
            
            else {
                echo '
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#register"><span class="fas fa-user"></span> Register</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#login"><span class="fas fa-sign-in-alt"></span> Login</a>
                </li>';
            }

            ?>


        </ul>
    </nav>
</div>

<?php 
include "register.php";
include "loginForm.php";
include "createStore.php";
 

?>