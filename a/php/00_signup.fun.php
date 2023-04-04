<?php

require_once("./../database.config.php");


// #1 function
function userSignup($type, $name, $address, $email, $password, $confirmPassword)
{
    if ($type != "select") {
        if (6 < strlen($password)) {
            if (checkConfirmPassword($password, $confirmPassword)) {
                $hashPassword = md5($password);
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if (checkEmailNotExist($email)) {
                        $queryString = "INSERT INTO users(user_id,type,name,address,email,password) VALUES(?, ?, ?, ?, ?, ?);";
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
                            mysqli_stmt_close($stmt);
                            databaseConnectorClose($dbConn);
                            insertRecordInProviderClient($userId, $type);
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
    } else {
        $flagToReturn = 6;
    }

    unset($hashPassword, $queryString, $dbConn, $userId, $stmt, $type, $name, $address, $email, $password, $confirmPassword);
    return $flagToReturn;
}


// #2 function
function checkConfirmPassword($password, $confirmPassword)
{
    if ($password === $confirmPassword) {
        return true;
    } else {
        return false;
    }
}


// #3 function
function checkEmailNotExist($email)
{
    $queryString = "SELECT * FROM users WHERE email=?;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        databaseConnectorClose($dbConn);
        $rowOfResult = mysqli_fetch_assoc($result);
        $flagToReturn = is_null($rowOfResult);
        unset($queryString, $dbConn, $stmt, $result, $rowOfResult, $email);
        return $flagToReturn;
    }
}


// #4 function
function errorsForSignup($error_code, $post_data)
{
    $post_data["password"] = null;
    $post_data["confirmPassword"] = null;
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
            $qs = "a=" . $a . "&error=" . base64_encode("Invalid Email address");
            // header("location: ./00_signup.php?error=invalid email address");
            header("location: ./00_signup.php?" . $qs);
            exit();
            break;
        case 4:
            $qs = "a=" . $a . "&error=" . base64_encode("Password not match");
            // header("location: ./00_signup.php?error=password not match");
            header("location: ./00_signup.php?" . $qs);
            exit();
            break;
        case 5:
            $qs = "a=" . $a . "&error=" . base64_encode("Password must be greater than 6 characters");
            // header("location: ./00_signup.php?error=password must be greater than 6 characters");
            header("location: ./00_signup.php?" . $qs);
            exit();
            break;
        case 6:
            $qs = "a=" . $a . "&error=" . base64_encode("First select user type");
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


// #5 function
function insertRecordInProviderClient($userId, $userType)
{
    $dbConn = databaseConnector();
    if ($userType == "seller") {
        $queryString = "SELECT user_id FROM users WHERE type = 'distributor';";
        $queryString1 = "INSERT INTO provider_client(f_provider_id, f_client_id) VALUES(?, ?);";
        $stmt = mysqli_stmt_init($dbConn);
        if (mysqli_stmt_prepare($stmt, $queryString)) {
            mysqli_stmt_execute($stmt);
            $resultToReturn = mysqli_stmt_get_result($stmt);
            $stmt1 = mysqli_stmt_init($dbConn);
            while ($data = isset($resultToReturn) ? mysqli_fetch_assoc($resultToReturn) : null) {
                if (mysqli_stmt_prepare($stmt1, $queryString1)) {
                    mysqli_stmt_bind_param($stmt1, "ss", $data["user_id"], $userId);
                    mysqli_stmt_execute($stmt1);
                }
            }
        }
    } else if ($userType == "producer") {
        $queryString = "SELECT user_id FROM users WHERE type = 'distributor';";
        $queryString1 = "INSERT INTO provider_client(f_provider_id, f_client_id) VALUES(?, ?);";
        $stmt = mysqli_stmt_init($dbConn);
        if (mysqli_stmt_prepare($stmt, $queryString)) {
            mysqli_stmt_execute($stmt);
            $resultToReturn = mysqli_stmt_get_result($stmt);
            $stmt1 = mysqli_stmt_init($dbConn);
            while ($data = isset($resultToReturn) ? mysqli_fetch_assoc($resultToReturn) : null) {
                if (mysqli_stmt_prepare($stmt1, $queryString1)) {
                    mysqli_stmt_bind_param($stmt1, "ss", $userId, $data["user_id"]);
                    mysqli_stmt_execute($stmt1);
                }
            }
        }
    } else if ($userType == "distributor") {
        $queryString = "SELECT user_id,type FROM users WHERE type = 'producer' OR type = 'seller';";
        $queryString1 = "INSERT INTO provider_client(f_provider_id, f_client_id) VALUES(?, ?);";
        $stmt = mysqli_stmt_init($dbConn);
        if (mysqli_stmt_prepare($stmt, $queryString)) {
            mysqli_stmt_execute($stmt);
            $resultToReturn = mysqli_stmt_get_result($stmt);
            $stmt1 = mysqli_stmt_init($dbConn);
            while ($data = isset($resultToReturn) ? mysqli_fetch_assoc($resultToReturn) : null) {
                if ($data["type"] == "seller") {
                    if (mysqli_stmt_prepare($stmt1, $queryString1)) {
                        mysqli_stmt_bind_param($stmt1, "ss", $userId, $data["user_id"]);
                        mysqli_stmt_execute($stmt1);
                    }
                } else if ($data["type"] == "producer") {
                    if (mysqli_stmt_prepare($stmt1, $queryString1)) {
                        mysqli_stmt_bind_param($stmt1, "ss", $data["user_id"], $userId);
                        mysqli_stmt_execute($stmt1);
                    }
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt1);
    databaseConnectorClose($dbConn);
    unset($dbConn, $queryString, $queryString1, $stmt, $resultToReturn, $stmt1, $data, $userId, $userType);
}
