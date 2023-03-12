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
    <link rel="stylesheet" href="./css/01_signin.css">
</head>

<body>
    <div class="main-section">
        <form method="POST">
            <div class="main-form">
                <h1>Signin Page</h1>
                <div id="user_id">
                    <label for="">Email or user id</label>
                    <input id="userid_text" type="text" name="user_uid" placeholder="Email or user id" required value="<?= $a->user_uid ?? "" ?>">
                </div>
                <div id="pass">
                    <label for="">Password </label>
                    <input id="pass_text" type="password" placeholder="Password" required name="password">
                    <a id="forget_text" href="./03_forget_password.php">Forget password?</a>
                </div>
                <div id="error">
                    <p>
                        <?= isset($_GET["error"]) ? base64_decode($_GET["error"]) : null ?>
                    </p>
                </div>
                <div>
                    <input id="submit" type="submit" name="signin" value="Sign-in">
                </div>
                <div id="acc_text">
                    <p>Don't have an account? <a href="./00_signup.php">Sign up</a></p>
                </div>
            </div>
        </form>
    </div>
</body>

</html>