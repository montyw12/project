<?php

// echo "for producer " . "0P" . base_convert(date("sYimHd"),10,36) . "<br>";
// echo "for distributor " . "0D" . base_convert(date("sYimHd"),10,36) . "<br>";
// echo "for seller " . "0S" . base_convert(date("sYimHd"),10,36) . "<br>";
// echo "for item " . "0I" . base_convert(date("sYimHd"),10,36) . "<br>";
// echo "for order " . "0O" . base_convert(date("sYimHd"),10,36) . "<br>";
// echo "for batch " . "0B" . base_convert(date("sYimHd"),10,36) . "<br>";
// echo "for connection " . "0C" . base_convert(date("sYimHd"),10,36) . "<br>";

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
function userSignin($userUid, $password)
{
    $hashPassword = md5($password);
    if (filter_var($userUid, FILTER_VALIDATE_EMAIL)) {
        $queryString = "SELECT user_id,password FROM users WHERE email = ? AND password = ?;";
    } else {
        $queryString = "SELECT user_id,password FROM users WHERE user_id = ? AND password = ?;";
    }
    // $queryString = "SELECT user_id,password FROM users WHERE user_id=? AND password=?;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "ss", $userUid, $hashPassword);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
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
    unset($hashPassword, $queryString, $dbConn, $stmt, $result, $userUid, $password);
    return $resultToReturn;
}


// #6 function
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


// #7 function
function sendOtp($userUid)
{
    if (filter_var($userUid, FILTER_VALIDATE_EMAIL)) {
        $queryString = "SELECT email FROM users WHERE email = ?;";
    } else {
        $queryString = "SELECT email FROM users WHERE user_id = ?;";
    }
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "s", $userUid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        databaseConnectorClose($dbConn);
        if (!empty(mysqli_fetch_assoc($result))) {
            $_SESSION["user_uid"] = $userUid;
            $resultToReturn = 0;
        } else {
            $resultToReturn = 1;
        }
    } else {
        $resultToReturn = 2;
    }
    unset($queryString, $dbConn, $stmt, $result, $userUid);
    return $resultToReturn;
}


// #8 function
function errorsForSendOtp($error_code, $post_data)
{
    $a = base64_encode(json_encode($post_data));
    switch ($error_code) {
        case 0:
            $qs = "a=" . $a . "&error=" . base64_encode("None");
            // header("location: ./03_forget_password.php?error=none");
            header("location: ./03_forget_password.php?" . $qs);
            exit();
            break;
        case 1:
            $qs = "a=" . $a . "&error=" . base64_encode("Invalid user id or email address");
            // header("location: ./03_forget_password.php?error=invalid userid or password");
            header("location: ./03_forget_password.php?" . $qs);
            exit();
            break;
        case 2:
            $qs = "a=" . $a . "&error=" . base64_encode("Something want wrong");
            // header("location: ./03_forget_password.php?error=someting want wrong! try again");
            header("location: ./03_forget_password.php?" . $qs);
            exit();
            break;
        default:
            $qs = "a=" . $a . "&error=" . base64_encode("Please try again!");
            // header("location: ./03_forget_password.php?error=please try again!");
            header("location: ./03_forget_password.php?" . $qs);
            exit();
            break;
    }
}


// #9 function
function sendEmailForOtp($userUid, $otp)
{
    if (filter_var($userUid, FILTER_VALIDATE_EMAIL)) {
        $queryString = "SELECT name, email FROM users WHERE email = ?;";
    } else {
        $queryString = "SELECT name, email FROM users WHERE user_id = ?;";
    }
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "s", $userUid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        databaseConnectorClose($dbConn);
        if (!empty($result)) {
            $data = mysqli_fetch_assoc($result);
            if (sendEmailToUserForOtp($data["name"], $data["email"], $otp)) {
                $resultToReturn = 0;
            } else {
                $resultToReturn = 1;
            }
        } else {
            $resultToReturn = 2;
        }
    } else {
        $resultToReturn = 3;
    }
    unset($queryString, $dbConn, $stmt, $result, $userUid);
    return $resultToReturn;
}


// #10 function
function sendEmailToUserForOtp($name, $email, $otp)
{
    $to = $email;
    $subject = "Varification For Reset Password";
    $message = "<p style=\"font-size: large;\">Hello $name Your 6 Digit Varification Code Is</p>
        <hr>
        <h1 style=\"font-size: x-large; color: #00ff00;\">$otp</h1>
        <hr>
        <p style=\"font-size: large; color: red;\">Please Don't Share With Anyone!</p>
        <p style=\"margin-top: 15px;\"><i>**This is an auto-generated email. Please do not reply to this email.**</i></p>";

    $nl = "\r\n";
    //Header information
    $headers = "MIME-Version: 1.0" . $nl;
    $headers .= "Content-type: text/html; charset=iso-8859-1" . $nl;
    $headers .= "From:example.org" . $nl;

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}


// #11 function
function errorsForSendEmailForOtp($error_code)
{
    switch ($error_code) {
        case 0:
            header("location: ./04_otp.php?");
            exit();
            break;
        case 1:
        case 3:
            $qs = "&error=" . base64_encode("Something want wrong");
            // header("location: ./03_forget_password.php?error=someting want wrong! try again");
            header("location: ./03_forget_password.php?" . $qs);
            exit();
            break;
        case 2:
            $qs = "&error=" . base64_encode("Invalid user id or email address");
            // header("location: ./03_forget_password.php?error=invalid userid or password");
            header("location: ./03_forget_password.php?" . $qs);
            exit();
            break;
        default:
            $qs = "&error=" . base64_encode("Please try again!");
            // header("location: ./03_forget_password.php?error=please try again!");
            header("location: ./03_forget_password.php?" . $qs);
            exit();
            break;
    }
}


// #12 function
function checkOtp($otp, $otp1)
{
    if ($otp == $otp1) {
        unset($_SESSION["otp"]);
        $_SESSION["flagToChangePassword"] = 1;
        $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    return $resultToReturn;
}


// #13 function
function errorsForCheckOtp($error_code, $post_data)
{
    $a = base64_encode(json_encode($post_data));
    switch ($error_code) {
        case 0:
            header("location: ./05_reset_password.php?");
            exit();
            break;
        case 1:
            $qs = "a=" . $a . "&error=" . base64_encode("Invalid varification code");
            header("location: ./04_otp.php?" . $qs);
            exit();
            break;
        default:
            $qs = "a=" . $a . "&error=" . base64_encode("Please try again!");
            // header("location: ./03_forget_password.php?error=please try again!");
            header("location: ./04_otp.php?" . $qs);
            exit();
            break;
    }
}


// #14 function
function resetPassword($userUid, $password, $confirmPassword)
{
    if (6 < strlen($password)) {
        if (checkConfirmPassword($password, $confirmPassword)) {
            $password = md5($password);
            if (filter_var($userUid, FILTER_VALIDATE_EMAIL)) {
                $queryString = "UPDATE users SET password = ? WHERE email = ?;";
                $queryString1 = "SELECT user_id, type FROM users WHERE email = ?;";
            } else {
                $queryString = "UPDATE users SET password = ? WHERE user_id = ?;";
                $queryString1 = "SELECT user_id, type FROM users WHERE user_id = ?;";
            }
            $dbConn = databaseConnector();
            $stmt = mysqli_stmt_init($dbConn);
            if (mysqli_stmt_prepare($stmt, $queryString)) {
                mysqli_stmt_bind_param($stmt, "ss", $password, $userUid);
                mysqli_stmt_execute($stmt);
                $stmt = mysqli_stmt_init($dbConn);
                if (mysqli_stmt_prepare($stmt, $queryString1)) {
                    mysqli_stmt_bind_param($stmt, "s", $userUid);
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
    unset($queryString, $queryString1, $dbConn, $stmt, $userUid, $password, $confirmPassword);
    return $resultToReturn;
}


// #15 function
function errorsForResetPassword($error_code)
{
    switch ($error_code) {
        case 0:
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
