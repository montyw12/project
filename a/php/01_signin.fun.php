<?php

require_once("./../database.config.php");


// #1 function
function userSignin($user_uid, $password)
{
    $hashPassword = md5($password);
    if (filter_var($user_uid, FILTER_VALIDATE_EMAIL)) {
        $queryString = "SELECT user_id,password FROM users WHERE email = ? AND password = ?;";
    } else {
        $queryString = "SELECT user_id,password FROM users WHERE user_id = ? AND password = ?;";
    }
    // $queryString = "SELECT user_id,password FROM users WHERE user_id=? AND password=?;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "ss", $user_uid, $hashPassword);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        databaseConnectorClose($dbConn);
        if ($result->num_rows == 1) {
            $data = mysqli_fetch_assoc($result);
            $_SESSION["user_id"] = $data["user_id"];
            $resultToReturn = 0;
        } else {
            $resultToReturn = 1;
        }
    } else {
        $resultToReturn = 2;
    }
    unset($hashPassword, $queryString, $dbConn, $stmt, $result, $user_uid, $password);
    return $resultToReturn;
}


// #2 function
function errorsForSignin($error_code, $post_data)
{
    $post_data["password"] = null;
    $a = base64_encode(json_encode($post_data));
    switch ($error_code) {
        case 0:
            $qs = "a=" . $a . "&error=" . base64_encode("None");
            // header("location: ./01_signin.php?error=none");
            header("location: ./01_signin.php?" . $qs);
            exit();
            break;
        case 1:
            $qs = "a=" . $a . "&error=" . base64_encode("Invalid user id, email or password");
            // header("location: ./01_signin.php?error=invalid userid or password");
            header("location: ./01_signin.php?" . $qs);
            exit();
            break;
        case 2:
            $qs = "a=" . $a . "&error=" . base64_encode("Something want wrong");
            // header("location: ./01_signin.php?error=someting want wrong! try again");
            header("location: ./01_signin.php?" . $qs);
            exit();
            break;
        default:
            $qs = "a=" . $a . "&error=" . base64_encode("Please try again!");
            // header("location: ./01_signin.php?error=please try again!");
            header("location: ./01_signin.php?" . $qs);
            exit();
            break;
    }
}
