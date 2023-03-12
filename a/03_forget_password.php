<?php
session_start();
try {
    require_once("./php/03_forget_password.fun.php");
    $a = isset($_GET["a"]) ? json_decode(base64_decode($_GET["a"])) : "";
    if (isset($_POST["get_otp"])) {
        $result = sendOtp($_POST["user_uid"]);
        if ($result === 0) {
            $_SESSION["otp"] = rand(100000, 1000000);
            $result1 = sendEmailForOtp($_SESSION["user_uid"], $_SESSION["otp"]);
            errorsForSendEmailForOtp($result1);
        } else {
            errorsForSendOtp($result, $_POST);
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
    <title>Forget Password Page</title>
    <link rel="stylesheet" href="./css/03_forget_password.css">
</head>

<body>
    <div class="main-section">
        <form method="POST">
            <div class="main-form">
                <h1>Forget Password</h1>
                <div id="email">
                    <label for="">Email or user id</label>
                    <input id="email_text" type="text" name="user_uid" placeholder="Email or user id" required value="<?= $a->user_uid ?? "" ?>">
                </div>

                <div id="error">
                    <p>
                        <?= isset($_GET["error"]) ? base64_decode($_GET["error"]) : null ?>
                    </p>
                </div>
                <div>
                    <input id="submit" type="submit" name="get_otp" value="Get varification code">
                </div>
                <div id="acc_text">
                    <p>Already have a account? <a href="./01_signin.php">Sign in</a></p>
                </div>
            </div>
        </form>
    </div>
</body>

</html>