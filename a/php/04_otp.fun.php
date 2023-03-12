<?php

require_once("./../database.config.php");


// #1 function
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


// #2 function
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
