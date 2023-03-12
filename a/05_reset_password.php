<?php
session_start();
if (isset($_SESSION["flagToChangePassword"])) {
    require_once("./php/05_reset_password.fun.php");
    if (isset($_POST["reset_password"])) {
        $result = resetPassword($_SESSION["user_uid"], $_POST["password"], $_POST["confirm_password"]);
        errorsForResetPassword($result);
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
    <title>Change Password Page</title>
    <link rel="stylesheet" href="./css/05_reset_password.css">
</head>

<body>
    <div class="main-section">
        <form method="POST">
            <div class="main-form">
                <h1>Reset Password</h1>
                <div id="pass">
                    <label for="">Password</label>
                    <input id="pass_text" type="password" placeholder="Password" name="password" required>
                </div>
                <div id="cpass">
                    <label for="">Confirm Password</label>
                    <input id="cpass_text" type="password" placeholder="Confirm Password" required name="confirm_password">
                </div>
                <div id="error">
                    <p>
                        <?= isset($_GET["error"]) ? base64_decode($_GET["error"]) : null ?>
                    </p>
                </div>
                <div>
                    <input id="submit" type="submit" name="reset_password" value="Reset Password">
                </div>
                <div id="acc_text">
                    <p>Already have a account? <a href="./01_signin.php">Sign in</a></p>
                </div>
            </div>
        </form>
    </div>
</body>

</html>