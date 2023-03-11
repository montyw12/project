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
                <h1>Forget Password</h1>
                <div id="otp">
                    <label for="">OTP</label>
                    <input id="otp_text" type="number" name="otp" required value="<?= $a->otp ?? "" ?>">
                </div>
                
                <div id="error">
                    <p>
                        <?= isset($_GET["error"]) ? base64_decode($_GET["error"]) : null ?>
                    </p>
                </div>
                <div>
                    <input id="submit" type="submit" name="check_otp" value="Check OTP">
                </div>
                <div id="acc_text">
                    <p>Already have a account? <a href="./01_signin.php">Sign in</a></p>
                </div>
            </div>
        </form>
    </div>
</body>

</html>