<?php
session_start();
try {
    require_once("./php/function.php");
    $a = isset($_GET["a"]) ? json_decode(base64_decode($_GET["a"])) : "";
    if (isset($_POST["signin"])) {
        $result = userSignin($_POST["userid"], $_POST["password"]);
        if ($result === 0) {
            $userId = $_POST["userid"];
            $prefixUserid = substr($userId, 0, 2);
            if ($prefixUserid === "0D") {
                $_SESSION["user"] = "distributor";
                $_SESSION["user_id"] = $_POST["userid"];
                header("location: ./../d/home.php");
                exit();
            } else if ($prefixUserid === "0P") {
                $_SESSION["user"] = "producer";
                $_SESSION["user_id"] = $_POST["userid"];
                header("location: ./../p/home.php");
                exit();
            } else if ($prefixUserid === "0S") {
                $_SESSION["user"] = "seller";
                $_SESSION["user_id"] = $_POST["userid"];
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
</head>

<body>
    <form method="POST">
        <table>
            <tr>
                <td>
                    <label for="">User ID: </label>
                </td>
                <td>
                    <input type="text" name="userid" value="<?= isset($a->userid) ? $a->userid : ""; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Password: </label>
                </td>
                <td>
                    <input type="password" name="password">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="./03_forget_password.php">Forget password?</a>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?= isset($_GET["error"]) ? base64_decode($_GET["error"]) : NULL ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="signin" value="Sign-in">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>