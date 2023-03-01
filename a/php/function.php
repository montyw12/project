<?php

// echo "for producer " . "0P" . base_convert(date("sYimHd"),10,36) . "<br>";
// echo "for distributor " . "0D" . base_convert(date("sYimHd"),10,36) . "<br>";
// echo "for seller " . "0S" . base_convert(date("sYimHd"),10,36) . "<br>";
// echo "for item " . "0I" . base_convert(date("sYimHd"),10,36) . "<br>";
// echo "for order " . "0O" . base_convert(date("sYimHd"),10,36) . "<br>";
// echo "for batch " . "0B" . base_convert(date("sYimHd"),10,36) . "<br>";
// echo "for connection " . "0C" . base_convert(date("sYimHd"),10,36) . "<br>";

// #1 function
function databaseConnector()
{
    $connection = mysqli_connect("localhost", "root", "", "00_project_pms");
    if ($connection) {
        return $connection;
    } else {
        return "can not connect to database";
    }
}


// #2 function
function databaseConnectorClose($a)
{
    mysqli_close($a);
    unset($a);
}


// #3 function
function userSignup($type, $name, $address, $email, $password, $confirmPassword)
{
    if ($type != "select") {
        if (6 < strlen($password)) {
            if (checkConfirmPassword($password, $confirmPassword)) {
                $hashPassword = md5($password);
                if (checkEmailNotExist($email)) {
                    $queryString = "INSERT INTO user(user_id,type,name,address,email,password) VALUES(?, ?, ?, ?, ?, ?);";
                    $dbConn = databaseConnector();
                    if ($type === "seller") {
                        $userId = "0S" . base_convert(date("sYimHd"), 10, 36);
                    } else if ($type === "distributor") {
                        $userId = "0D" . base_convert(date("sYimHd"), 10, 36);
                    } else if ($type === "producer") {
                        $userId = "0P" . base_convert(date("sYimHd"), 10, 36);
                    }
                    $stmt = mysqli_stmt_init($dbConn);
                    if (mysqli_stmt_prepare($stmt, $queryString)) {
                        mysqli_stmt_bind_param($stmt, "ssssss", $userId, $type, $name, $address, $email, $hashPassword);
                        mysqli_stmt_execute($stmt);
                        // var_dump(mysqli_stmt_get_result($stmt));
                        databaseConnectorClose($dbConn);
                        $flagToReturn = 0;
                        $_SESSION["user_id"] = $userId;
                    } else {
                        $flagToReturn = 1;
                    }
                } else {
                    $flagToReturn = 2;
                }
            } else {
                $flagToReturn = 3;
            }
        } else {
            $flagToReturn = 4;
        }
    } else {
        $flagToReturn = 5;
    }

    unset($hashPassword, $queryString, $dbConn, $userId, $stmt, $type, $name, $address, $email, $password, $confirmPassword);
    return $flagToReturn;
}


// #4 function
function checkConfirmPassword($password, $confirmPassword)
{
    if ($password === $confirmPassword) {
        return true;
    } else {
        return false;
    }
}


// #5 function
function checkEmailNotExist($email)
{
    $queryString = "SELECT * FROM user WHERE email=?;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        databaseConnectorClose($dbConn);
        $rowOfResult = mysqli_fetch_assoc($result);
        $flagToReturn = is_null($rowOfResult);
        unset($queryString, $dbConn, $stmt, $result, $rowOfResult, $email);
        return $flagToReturn;
    }
}


// #6 function
function errorsForSignup($error_code, $post_data)
{
    $post_data["password"] = NULL;
    $post_data["confirmPassword"] = NULL;
    $a = base64_encode(json_encode($post_data));
    switch ($error_code) {
        case 0:
            $qs = "a=" . $a . "&error=" . base64_encode("None");
            // header("location: ./01_signin.php?error=none");
            header("location: ./01_signin.php?" . $qs);
            exit();
            break;
        case 1:
            $qs = "a=" . $a . "&error=" . base64_encode("Someting want wrong! try agian");
            // header("location: ./00_signup.php?error=someting want wrong! try again");
            header("location: ./00_signup.php?" . $qs);
            exit();
            break;
        case 2:
            $qs = "a=" . $a . "&error=" . base64_encode("Email is allready taken");
            // header("location: ./00_signup.php?error=email is allready taken");
            header("location: ./00_signup.php?" . $qs);
            exit();
            break;
        case 3:
            $qs = "a=" . $a . "&error=" . base64_encode("Password not match");
            // header("location: ./00_signup.php?error=password not match");
            header("location: ./00_signup.php?" . $qs);
            exit();
            break;
        case 4:
            $qs = "a=" . $a . "&error=" . base64_encode("Password must be greater than 6 characters");
            // header("location: ./00_signup.php?error=password must be greater than 6 characters");
            header("location: ./00_signup.php?" . $qs);
            exit();
            break;
        case 5:
            $qs = "a=" . $a . "&error=" . base64_encode("First select user-type");
            // header("location: ./00_signup.php?error=first select user-type");
            header("location: ./00_signup.php?" . $qs);
            exit();
            break;
        default:
            $qs = "a=" . $a . "&error=" . base64_encode("Please try again!");
            // header("location: ./00_signup.php?error=please try again");
            header("location: ./00_signup.php?" . $qs);
            exit();
            break;
    }
}


// #7 function
function userSignin($userid, $password)
{
    $hashPassword = md5($password);
    $queryString = "SELECT user_id,password FROM user WHERE user_id=? AND password=?;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "ss", $userid, $hashPassword);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        databaseConnectorClose($dbConn);
        if (!empty(mysqli_fetch_assoc($result))) {
            $resultToReturn = 0;
        } else {
            $resultToReturn = 1;
        }
    } else {
        $resultToReturn = 2;
    }
    unset($hashPassword, $queryString, $dbConn, $stmt, $result, $userid, $password);
    return $resultToReturn;
}


// #8 function
function errorsForSignin($error_code, $post_data)
{
    $post_data["password"] = NULL;
    $post_data["confirmPassword"] = NULL;
    $a = base64_encode(json_encode($post_data));
    switch ($error_code) {
        case 0:
            $qs = "a=" . $a . "&error=" . base64_encode("None");
            // header("location: ./01_signin.php?error=none");
            header("location: ./01_signin.php?" . $qs);
            exit();
            break;
        case 1:
            $qs = "a=" . $a . "&error=" . base64_encode("Invalid userid or password");
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
