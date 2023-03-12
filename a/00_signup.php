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
    <link rel="stylesheet" href="./css/00_signup.css">
</head>

<body>
    <div class="main-section">
        <form method="POST">
            <div class="main-form">
                <h1>Signup Page</h1>
                <div class="user-type">
                    <label for="" id="user_type">User type</label>
                    <select id="dropdown" name="type" value="<?= $a->type ?? " select" ?>">
                        <option value="select" selected>Select type</option>
                        <option value="seller">Seller</option>
                        <option value="distributor">Distributor</option>
                        <option value="producer">Producer</option>
                    </select>
                </div>
                <div id="name">
                    <label for="">Name</label>
                    <input id="name_text" type="text" name="name" placeholder="Name" required value="<?= $a->name ?? "" ?>">
                </div>
                <div id="address">
                    <label for="">Address</label>
                    <input id="address_text" type="text" name="address" placeholder="Address" required value="<?= $a->address ?? ""; ?>">
                </div>
                <div id="email">
                    <label for="">Email</label>
                    <input id="email_text" type="email" name="email" placeholder="Email" required value="<?= $a->email ?? ""; ?>">
                </div>
                <div id="pass">
                    <label for="">Password</label>
                    <input id="pass_text" type="password" placeholder="Password" name="password" required>
                </div>
                <div id="cpass">
                    <label for="">Confirm Password</label>
                    <input id="cpass_text" type="password" placeholder="Confirm password" name="confirmPassword" required>
                </div>
                <div id="error">
                    <p>
                        <?= isset($_GET["error"]) ? base64_decode($_GET["error"]) : null ?>
                    </p>
                </div>
                <div>
                    <input id="submit" type="submit" name="signup" value="Sign-up">
                </div>
                <div id="acctext">
                    <p>Already have a account? <a href="./01_signin.php">Sign in</a></p>
                </div>
            </div>
        </form>
    </div>
</body>

</html>