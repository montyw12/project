<?php
session_start();
try {
    require_once("./php/00_signup.fun.php");
    $a = isset($_GET["a"]) ? json_decode(base64_decode($_GET["a"])) : "";
    if (isset($_POST["signup"])) {
        $result = userSignup($_POST["type"], $_POST["name"], $_POST["address"], $_POST["email"], $_POST["password"], $_POST["confirmPassword"]);
        if ($result === 0) {
            $userId = $_SESSION["user_id"];
            $prefixUserid = substr($userId, 0, 2);
            if ($prefixUserid === "0D") {
                $_SESSION["user"] = "distributor";
                header("location: ./../d/home.php");
                exit();
            } else if ($prefixUserid === "0P") {
                $_SESSION["user"] = "producer";
                header("location: ./../p/home.php");
                exit();
            } else if ($prefixUserid === "0S") {
                $_SESSION["user"] = "seller";
                header("location: ./../s/home.php");
                exit();
            }
        } else {
            errorsForSignup($result, $_POST);
        }
    }
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
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
    <div class="container">
        <div class="row">
            <div class="col-xl-2 col-lg-0 col-md-0 col-sm-0"></div>
            <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12" style="min-height: 68px;">
                <?php if (isset($_GET["error"])) : ?>
                    <?php if (base64_decode($_GET["error"]) == "None") : ?>
                        <div class="w3-panel w3-green w3-round w3-xlarge">
                            <span class="w3-left">Sign up successfully!</span>
                            <span style="cursor:pointer;" onclick="this.parentElement.style.display='none'" class="w3-right w3-hover-text-black">&times;</span>
                        </div>
                    <?php else : ?>
                        <div class="w3-panel w3-red w3-round w3-xlarge">
                            <span class="w3-left"><?= base64_decode($_GET["error"]) ?></span>
                            <span style="cursor:pointer;" onclick="this.parentElement.style.display='none'" class="w3-right w3-hover-text-black">&times;</span>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="col-xl-2 col-lg-0 col-md-0 col-sm-0"></div>
            <div class="col-xl-2 col-lg-0 col-md-0 col-sm-0"></div>
            <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 w3-card-4 w3-round-large w3-xlarge">
                <form method="POST">
                    <h1 align="center">Signup Page</h1>
                    <label class="mb-2"><i class="fa fa-user-o"></i>&nbsp;&nbsp;User type</label>
                    <select class="w3-select w3-border w3-round-large w3-hover-border-purple mb-4" name="type" value="<?= $a->type ?? " select" ?>">
                        <option value="select" selected>Select type</option>
                        <option value="seller">Seller</option>
                        <option value="distributor">Distributor</option>
                        <option value="producer">Producer</option>
                    </select>

                    <label class="mb-1"><i class="fa fa-id-card-o"></i>&nbsp;&nbsp;Name</label>
                    <input class="w3-input w3-border w3-round-large w3-hover-border-purple mb-3" type="text" name="name" placeholder="Name" required value="<?= $a->name ?? "" ?>">

                    <label class="mb-1"><i class="fa fa-address-card-o"></i>&nbsp;&nbsp;Address</label>
                    <input class="w3-input w3-border w3-round-large w3-hover-border-purple mb-3" type="text" name="address" placeholder="Address" required value="<?= $a->address ?? ""; ?>">

                    <label class="mb-1"><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Email</label>
                    <input class="w3-input w3-border w3-round-large w3-hover-border-purple mb-3" type="email" name="email" placeholder="Email" required value="<?= $a->email ?? ""; ?>">

                    <label class="mb-1"><i class="fa fa-key"></i>&nbsp;&nbsp;Password</label>
                    <input class="w3-input w3-border w3-round-large w3-hover-border-purple mb-3" type="password" placeholder="Password" name="password" required>

                    <label class="mb-1"><i class="fa fa-key"></i>&nbsp;&nbsp;Confirm Password</label>
                    <input class="w3-input w3-border w3-round-large w3-hover-border-purple mb-3" type="password" placeholder="Confirm password" name="confirmPassword" required>

                    <div class="w3-row" align="center">
                        <button class="w3-button w3-border w3-round-large w3-deep-purple w3-hover-purple mb-3" type="submit" name="signup"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;Sign up</button>
                    </div>

                    <p align="center">Already have a account? <a class="w3-text-deep-purple w3-hover-text-red" href="./01_signin.php">Sign in</a></p>

                </form>
            </div>
            <div class="col-xl-2 col-lg-0 col-md-0 col-sm-0"></div>
        </div>
    </div>
</body>

</html>