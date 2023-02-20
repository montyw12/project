<?php
session_start();
try {
    require_once("./php/function.php");
    $a = isset($_GET["a"]) ? json_decode(base64_decode($_GET["a"])) : "";
    if (isset($_POST["signup"])) {
        $result = userSignup($_POST["type"], $_POST["name"], $_POST["address"], $_POST["email"], $_POST["password"], $_POST["confirmPassword"]);
        if ($result === 0) {
            $userId = $_SESSION["userid"];
            unset($_SESSION["userid"]);
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
</head>

<body>
    <form method="POST">
        <table>
            <tr>
                <td>
                    <label for="">User type: </label>
                </td>
                <td>
                    <select name="type" value="<?= isset($a->type) ? $a->type : "select"; ?>">
                        <option value="select" selected>Select type</option>
                        <option value="seller">Seller</option>
                        <option value="distributor">Distributor</option>
                        <option value="producer">Producer</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Name: </label>
                </td>
                <td>
                    <input type="text" name="name" required value="<?= isset($a->name) ? $a->name : ""; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Address: </label>
                </td>
                <td>
                    <input type="text" name="address" required value="<?= isset($a->address) ? $a->address : ""; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Email: </label>
                </td>
                <td>
                    <input type="email" name="email" required value="<?= isset($a->email) ? $a->email : ""; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Password: </label>
                </td>
                <td>
                    <input type="password" name="password" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Confirm Password: </label>
                </td>
                <td>
                    <input type="password" name="confirmPassword" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="./01_signin.php">Allready have a account?</a>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?= isset($_GET["error"]) ? base64_decode($_GET["error"]) : NULL ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="signup" value="Sign-up">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>