<?php
session_start();
ob_start();
if (isset($_SESSION["user"])) {
    if ($_SESSION["user"] === "producer") {
        header("location: ./../p/home.php");
        exit();
    } else if ($_SESSION["user"] === "seller") {
        header("location: ./../s/home.php");
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
    <title>
        <?= strtoupper(pathinfo($_SERVER["PHP_SELF"], PATHINFO_FILENAME)) ?>
    </title>
    <link rel="stylesheet" href="./../bootstrap.css">
    <link rel="stylesheet" href="./../w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <a href="./home.php" class="w3-bar-item w3-button w3-hover-purple"><i class="fa fa-home"></i>&nbsp;Home</a>
                <a href="./products_show.php" class="w3-bar-item w3-button w3-hover-purple mx-3 w3-hide-small w3-hide-medium"><i class="fa fa-cubes"></i>&nbsp;Products</a>
                <div class="w3-dropdown-hover w3-hide-small w3-hide-medium">
                    <button class="w3-button w3-hover-purple mx-3"><i class="fa fa-user"></i>&nbsp;Producers</button>
                    <div class="w3-dropdown-content w3-bar-block w3-card-4">
                        <a href="./producers_all.php" class="w3-bar-item w3-button w3-hover-purple">All</a>
                        <a href="./producers_connected.php" class="w3-bar-item w3-button w3-hover-purple">Connected Producers</a>
                        <a href="./producers_request.php" class="w3-bar-item w3-button w3-hover-purple">Request From Producers</a>
                    </div>
                </div>
                <div class="w3-dropdown-hover w3-hide-small w3-hide-medium">
                    <button class="w3-button w3-hover-purple mx-3"><i class="fa fa-user"></i>&nbsp;Sellers</button>
                    <div class="w3-dropdown-content w3-bar-block w3-card-4">
                        <a href="./sellers_all.php" class="w3-bar-item w3-button w3-hover-purple">All</a>
                        <a href="./sellers_connected.php" class="w3-bar-item w3-button w3-hover-purple">Connected Sellers</a>
                        <a href="./sellers_request.php" class="w3-bar-item w3-button w3-hover-purple">Request From Sellers</a>
                    </div>
                </div>
                <div class="w3-dropdown-hover w3-hide-small w3-hide-medium">
                    <button class="w3-button w3-hover-purple mx-3"><i class="fa fa-shopping-cart"></i>&nbsp;Orders</button>
                    <div class="w3-dropdown-content w3-bar-block w3-card-4">
                        <a href="./orders_all.php" class="w3-bar-item w3-button w3-hover-purple">All</a>
                        <a href="./orders_make.php" class="w3-bar-item w3-button w3-hover-purple">Make Orders</a>
                        <a href="./orders_pending.php" class="w3-bar-item w3-button w3-hover-purple">Pending Orders</a>
                    </div>
                </div>
                <a href="./../a/02_signout.php" class="w3-bar-item w3-button w3-hover-red w3-right w3-hide-small w3-hide-medium"><i class="fa fa-sign-out"></i>&nbsp;Sign out</a>
                <a href="javascript:void(0)" class="w3-bar-item w3-button w3-hover-purple w3-right w3-hide-large" onclick="navBarToggle()">&#9776;</a>
            </div>
        </div>
        <div class="container">
            <div id="demo" class="w3-bar-block w3-deep-purple w3-hide w3-hide-large">
                <a href="./products_show.php" class="w3-bar-item w3-button w3-hover-purple"><i class="fa fa-cubes"></i>&nbsp;Products</a>
                <a href="./producers_all.php" class="w3-bar-item w3-button w3-hover-purple"><i class="fa fa-user"></i>&nbsp;All Producers</a>
                <a href="./producers_connected.php" class="w3-bar-item w3-button w3-hover-purple"><i class="fa fa-user"></i>&nbsp;Connected Producers</a>
                <a href="./producers_request.php" class="w3-bar-item w3-button w3-hover-purple"><i class="fa fa-user"></i>&nbsp;Request From Producers</a>
                <a href="./sellers_all.php" class="w3-bar-item w3-button w3-hover-purple"><i class="fa fa-user"></i>&nbsp;All Sellers</a>
                <a href="./sellers_connected.php" class="w3-bar-item w3-button w3-hover-purple"><i class="fa fa-user"></i>&nbsp;Connected Sellers</a>
                <a href="./sellers_request.php" class="w3-bar-item w3-button w3-hover-purple"><i class="fa fa-user"></i>&nbsp;Request From Sellers</a>
                <a href="./orders_all.php" class="w3-bar-item w3-button w3-hover-purple"><i class="fa fa-shopping-cart"></i>&nbsp;All Orders</a>
                <a href="./orders_make.php" class="w3-bar-item w3-button w3-hover-purple"><i class="fa fa-shopping-cart"></i>&nbsp;Make Orders</a>
                <a href="./orders_pending.php" class="w3-bar-item w3-button w3-hover-purple"><i class="fa fa-shopping-cart"></i>&nbsp;Pending Orders</a>
                <a href="./../a/02_signout.php" class="w3-bar-item w3-button w3-hover-red w3-right"><i class="fa fa-sign-out"></i>&nbsp;Sign out</a>
            </div>
        </div>
    </header>