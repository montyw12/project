<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password Page</title>
    <link rel="stylesheet" href="./css/05_change_password.css">
</head>

<body>
    <div class="main-section">
        <form method="POST">
            <div class="main-form">
                <h1>Change Password</h1>
                <div id="pass">
                    <label for="">Password</label>
                    <input id="pass_text" type="password" name="userid" required value="<?= $a->userid ?? "" ?>">
                </div>
                <div id="cpass">
                    <label for="">Confirm Password</label>
                    <input id="cpass_text" type="password" required name="password">
                </div>
                <div id="error">
                    <p>
                        <?= isset($_GET["error"]) ? base64_decode($_GET["error"]) : null ?>
                    </p>
                </div>
                <div>
                    <input id="submit" type="submit" name="signin" value="Change Password">
                </div>
                <div id="acc_text">
                    <p>Already have a account? <a href="./01_signin.php">Sign in</a></p>
                </div>
            </div>
        </form>
    </div>
</body>

</html>