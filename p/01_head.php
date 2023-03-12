<?php
session_start();
if (isset($_SESSION["user"])) {
    if ($_SESSION["user"] === "distributor") {
        header("location: ./../d/home.php");
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
    <link rel="stylesheet" type="text/css" href="./css/01_head.css">
    <title><?= strtoupper(pathinfo($_SERVER["PHP_SELF"], PATHINFO_FILENAME)) ?></title>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="navbar">
                <div>
                    <button id="bar">&#9776;</button>
                </div>
                <div>
                    <a id="navlink" href="./home.php">
                        <p id="home">&#127968;</p>Home
                    </a>
                </div>
                <div>
                    <a id="navlink" href="./products.php">
                        <p id="products">&#128230;</p>Products
                    </a>
                </div>
                <div>
                    <a id="navlink" href="./distributors.php">
                        <p id="distributors">&#129489;&#127995;</p>Distributors
                    </a>
                </div>
                <div>
                    <a id="navlink" href="./orders.php">
                        <p id="order">&#128722;</p>Orders
                    </a>
                </div>
                <div>
                    <a id="navlink" href="./analysis.php">
                        <p id="analysis">&#128202;</p>Analysis
                    </a>
                </div>
                <div>
                    <a id="navlink" href="./../a/02_signout.php">
                        <p id="signout">&#128682;</p>Signout
                    </a>
                </div>
            </div>
        </div>