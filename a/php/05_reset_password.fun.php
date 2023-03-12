<?php

require_once("./../database.config.php");


// #1 function
function resetPassword($user_uid, $password, $confirmPassword)
{
    if (6 < strlen($password)) {
        if (checkConfirmPassword($password, $confirmPassword)) {
            $password = md5($password);
            if (filter_var($user_uid, FILTER_VALIDATE_EMAIL)) {
                $queryString = "UPDATE users SET password = ? WHERE email = ?;";
                $queryString1 = "SELECT user_id, type FROM users WHERE email = ?;";
            } else {
                $queryString = "UPDATE users SET password = ? WHERE user_id = ?;";
                $queryString1 = "SELECT user_id, type FROM users WHERE user_id = ?;";
            }
            $dbConn = databaseConnector();
            $stmt = mysqli_stmt_init($dbConn);
            if (mysqli_stmt_prepare($stmt, $queryString)) {
                mysqli_stmt_bind_param($stmt, "ss", $password, $user_uid);
                mysqli_stmt_execute($stmt);
                $stmt = mysqli_stmt_init($dbConn);
                if (mysqli_stmt_prepare($stmt, $queryString1)) {
                    mysqli_stmt_bind_param($stmt, "s", $user_uid);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $data = mysqli_fetch_assoc($result);
                    $_SESSION["user"] = $data["type"];
                    $_SESSION["user_id"] = $data["user_id"];
                }
                $resultToReturn = 0;
                unset($_SESSION["flagToChangePassword"]);
                databaseConnectorClose($dbConn);
            } else {
                $resultToReturn = 1;
            }
        } else {
            $resultToReturn = 2;
        }
    } else {
        $resultToReturn = 3;
    }
    unset($queryString, $queryString1, $dbConn, $stmt, $user_uid, $password, $confirmPassword);
    return $resultToReturn;
}


// #2 function
function errorsForResetPassword($error_code)
{
    switch ($error_code) {
        case 0:
            unset($_SESSION["flagToChangePassword"]);
            if ($_SESSION["user"] == "seller") {
                header("location: ./../s/home.php");
                exit();
            } else if ($_SESSION["user"] == "distributor") {
                header("location: ./../d/home.php");
                exit();
            } else if ($_SESSION["user"] == "producer") {
                header("location: ./../p/home.php");
                exit();
            }
            break;
        case 1:
            $qs = "&error=" . base64_encode("Something want wrong");
            header("location: ./05_reset_password.php?" . $qs);
            exit();
            break;
        case 2:
            $qs = "&error=" . base64_encode("Password not match");
            // header("location: ./00_signup.php?error=password not match");
            header("location: ./05_reset_password.php?" . $qs);
            exit();
            break;
        case 3:
            $qs = "&error=" . base64_encode("Password must be greater than 6 characters");
            // header("location: ./00_signup.php?error=password must be greater than 6 characters");
            header("location: ./05_reset_password.php?" . $qs);
            exit();
            break;
        default:
            $qs = "&error=" . base64_encode("Please try again!");
            header("location: ./05_reset_password.php?" . $qs);
            exit();
            break;
    }
}


// #3 function
function checkConfirmPassword($password, $confirmPassword)
{
    if ($password === $confirmPassword) {
        return true;
    } else {
        return false;
    }
}
