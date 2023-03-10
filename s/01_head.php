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
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="./css/master.css">
</head>

<body>
    <div class="container">
        <header>
            <div class="navbar">
                <ul class="nav">
                    <li><a class="navlink" href="./home.php">Home</a></li>
                    <li><a class="navlink" href="./products.php">Products</a></li>
                    <li><a class="navlink" href="./distributors.php">Distributors</a></li>
                    <li><a class="navlink" href="./orders.php">Orders</a></li>
                    <li><a class="navlink" href="./analysis.php">Analysis</a></li>
                    <li><a class="navlink" href="./../a/02_signout.php">Signout</a></li>
                </ul>
            </div>
        </header>