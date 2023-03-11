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
                    <label for="">Email </label>
                    <input id="email_text" type="email" name="email" required value="<?= $a->email ?? "" ?>">
                </div>
                
                <div id="error">
                    <p>
                        <?= isset($_GET["error"]) ? base64_decode($_GET["error"]) : null ?>
                    </p>
                </div>
                <div>
                    <input id="submit" type="submit" name="send_otp" value="Send OTP">
                </div>
                <div id="acc_text">
                    <p>Already have a account? <a href="./01_signin.php">Sign in</a></p>
                </div>
            </div>
        </form>
    </div>
</body>

</html>