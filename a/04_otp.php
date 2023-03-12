<?php
session_start();
if (isset($_SESSION["user_uid"], $_SESSION["otp"])) {
    $a = isset($_GET["a"]) ? json_decode(base64_decode($_GET["a"])) : "";
    require_once("./php/04_otp.fun.php");
    if (isset($_POST["next"])) {
        $result = checkOtp($_POST["otp"], $_SESSION["otp"]);
        errorsForCheckOtp($result, $_POST);
    }
} else {
    header("location: ./01_signin.php?note=InvalidPageAccess");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input OTP Page</title>
    <link rel="stylesheet" href="./css/04_otp.css">
</head>

<body>
    <div class="main-section">
        <form method="POST">
            <div class="main-form">
                <h1>Account Recovery</h1>
                <div id="otp">
                    <label for="">Varification Code</label>
                    <input id="otp_text" type="number" min="100000" max="999999" name="otp" placeholder="Enter code" required value="<?= $a->otp ?? "" ?>">
                </div>

                <div id="error">
                    <p>
                        <?= isset($_GET["error"]) ? base64_decode($_GET["error"]) : null ?>
                    </p>
                </div>
                <div>
                    <input id="submit" type="submit" name="next" value="Next">
                </div>
                <div id="acc_text">
                    <p>Already have a account? <a href="./01_signin.php">Sign in</a></p>
                </div>
            </div>
        </form>
    </div>
</body>

</html>