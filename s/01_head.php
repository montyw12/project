<?php
session_start();
if (isset($_SESSION["user"])) {
    if ($_SESSION["user"] === "producer") {
        header("location: ./../p/home.php");
        exit();
    } else if ($_SESSION["user"] === "distributor") {
        header("location: ./../d/home.php");
        exit();
    }
} else {
    header("location: ./../a/01_signin.php?note=InvalidPageAccess");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= strtoupper(pathinfo($_SERVER["PHP_SELF"], PATHINFO_FILENAME)) ?></title>
    <link rel="stylesheet" href="./../bootstrap.css">
    <link rel="stylesheet" href="./../w3.css">
    <style>
        *::selection {
            background-color: #7a86b8;
            color: #000000;
        }
    </style>
</head>

<body>
    <header>
        <div class="w3-bar w3-deep-purple w3-xlarge">
            <div class="container">
                <a href="./home.php" class="w3-bar-item w3-button w3-hover-purple">Home</a>
                <a href="./products_show.php" class="w3-bar-item w3-button w3-hover-purple mx-3">Products</a>
                <div class="w3-dropdown-hover">
                    <button class="w3-button w3-hover-purple mx-3">Distributors</button>
                    <div class="w3-dropdown-content w3-bar-block w3-card-4">
                        <a href="./distributors_all.php" class="w3-bar-item w3-button w3-hover-purple">All</a>
                        <a href="./distributors_connected.php" class="w3-bar-item w3-button w3-hover-purple">Connected Distributors</a>
                        <a href="./distributors_request.php" class="w3-bar-item w3-button w3-hover-purple">Request From Distributors</a>
                    </div>
                </div>
                <div class="w3-dropdown-hover">
                    <button class="w3-button w3-hover-purple mx-3">Orders</button>
                    <div class="w3-dropdown-content w3-bar-block w3-card-4">
                        <a href="./orders_all.php" class="w3-bar-item w3-button w3-hover-purple">All</a>
                        <a href="./orders_make.php" class="w3-bar-item w3-button w3-hover-purple">Make Orders</a>
                        <a href="./orders_pending.php" class="w3-bar-item w3-button w3-hover-purple">Pending Orders</a>
                    </div>
                </div>
                <div class="w3-dropdown-hover">
                    <button class="w3-button w3-hover-purple mx-3">Expire</button>
                    <div class="w3-dropdown-content w3-bar-block w3-card-4">
                        <a href="./expire_show.php" class="w3-bar-item w3-button w3-hover-purple">Show Expire Item</a>
                        <a href="./expire_expired.php" class="w3-bar-item w3-button w3-hover-purple">Already Expired Item</a>
                    </div>
                </div>
                <a href="./../a/02_signout.php" class="w3-bar-item w3-button w3-hover-red w3-right">Sign out</a>
            </div>
        </div>
    </header>