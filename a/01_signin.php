<?php
session_start();
try {
    require_once("./php/01_signin.fun.php");
    $a = isset($_GET["a"]) ? json_decode(base64_decode($_GET["a"])) : "";
    if (isset($_POST["signin"])) {
        $result = userSignin($_POST["user_uid"], $_POST["password"]);
        if ($result === 0) {
            $userId = $_SESSION["user_id"] ?? $_POST["user"];
            $prefixUserid = substr($userId, 0, 2);
            if ($prefixUserid === "0D") {
                $_SESSION["user"] = "distributor";
                $_SESSION["user_id"] = $_SESSION["user_id"];
                header("location: ./../d/home.php");
                exit();
            } else if ($prefixUserid === "0P") {
                $_SESSION["user"] = "producer";
                $_SESSION["user_id"] = $_SESSION["user_id"];
                header("location: ./../p/home.php");
                exit();
            } else if ($prefixUserid === "0S") {
                $_SESSION["user"] = "seller";
                $_SESSION["user_id"] = $_SESSION["user_id"];
                header("location: ./../s/home.php");
                exit();
            }
        } else {
            errorsForSignin($result, $_POST);
        }
    }
} catch (Exception $e) {
    echo "Error Meassage: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin Page</title>
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
                            <span class="w3-left">Sign in successfully!</span>
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
            <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 w3-card-2 w3-round-large w3-xlarge">
                <form method="POST">
                    <h1 align="center">Signin Page</h1>
                    <label class="mb-2"><i class="fa fa-user-circle-o"></i>&nbsp;&nbsp;Email or user id</label>
                    <input class="w3-input w3-border w3-round-large w3-hover-border-purple mb-3" type="text" name="user_uid" placeholder="Email or user id" required value="<?= $a->user_uid ?? "" ?>" autofocus>

                    <label class="mb-2"><i class="fa fa-key"></i>&nbsp;&nbsp;Password</label>
                    <input class="w3-input w3-border w3-round-large w3-hover-border-purple mb-3" type="password" placeholder="Password" required name="password">

                    <div class="w3-row">
                        <a class="w3-text-deep-purple w3-hover-text-red w3-right" href="./03_forget_password.php">Forget password?</a>
                    </div>

                    <div class="w3-row" align="center">
                        <button class="w3-button w3-border w3-round-large w3-deep-purple w3-hover-purple mb-3" type="submit" name="signin"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;Sign in</button>
                    </div>

                    <p align="center">Don't have an account? <a class="w3-text-deep-purple w3-hover-text-red" href="./00_signup.php">Sign up</a></p>

                </form>
            </div>
            <div class="col-xl-2 col-lg-0 col-md-0 col-sm-0"></div>
        </div>
    </div>
</body>

</html>