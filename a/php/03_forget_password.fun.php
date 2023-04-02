<?php

require_once("./../database.config.php");
require("./php/vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


// #1 function
function sendOtp($user_uid)
{
    if (filter_var($user_uid, FILTER_VALIDATE_EMAIL)) {
        $queryString = "SELECT email FROM users WHERE email = ?;";
    } else {
        $queryString = "SELECT email FROM users WHERE user_id = ?;";
    }
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "s", $user_uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        databaseConnectorClose($dbConn);
        if (!empty(mysqli_fetch_assoc($result))) {
            $_SESSION["user_uid"] = $user_uid;
            $resultToReturn = 0;
        } else {
            $resultToReturn = 1;
        }
    } else {
        $resultToReturn = 2;
    }
    unset($queryString, $dbConn, $stmt, $result, $user_uid);
    return $resultToReturn;
}


// #2 function
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


// #3 function
function sendEmailForOtp($user_uid, $otp)
{
    if (filter_var($user_uid, FILTER_VALIDATE_EMAIL)) {
        $queryString = "SELECT name, email FROM users WHERE email = ?;";
    } else {
        $queryString = "SELECT name, email FROM users WHERE user_id = ?;";
    }
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "s", $user_uid);
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
    unset($queryString, $dbConn, $stmt, $result, $user_uid);
    return $resultToReturn;
}


// #4 function
function sendEmailToUserForOtp($name, $email, $otp)
{
    $subject = "Varification For Reset Password";
    $message = "<p style=\"font-size: large;\">Hello $name Your 6 Digit Varification Code Is</p>
        <hr>
        <h1 style=\"font-size: x-large; color: #00ff00;\">$otp</h1>
        <hr>
        <p style=\"font-size: large; color: red;\">Please Don't Share With Anyone!</p>
        <p style=\"margin-top: 15px;\"><i>**This is an auto-generated email. Please do not reply to this email.**</i></p>";

    $nl = "\r\n";
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->isHTML(true);
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->Username = "kunj.o727@gmail.com";
        $mail->Password = "cdqxbfueauditvma";
        $mail->setFrom("kunj.o727@gmail.com", "PMS");
        $mail->addAddress($email, $name);
        $mail->Subject = $subject;
        $mail->Body = $message;
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo "ERROR MESSAGE: " . $e->getMessage();
    }
}


// #5 function
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
