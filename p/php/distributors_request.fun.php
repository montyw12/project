<?php

require_once("./../database.config.php");

// #1 function
function selectRequestForProducers($producerId)
{
    $quearyString = "SELECT user_id, type, name, address, email, status FROM users LEFT JOIN provider_client ON user_id = f_client_id WHERE type = 'distributor' AND f_provider_id = ? AND status = 2 ORDER BY name";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $quearyString)) {
        mysqli_stmt_bind_param($stmt, "s", $producerId);
        mysqli_stmt_execute($stmt);
        $resultToReturn =  mysqli_stmt_get_result($stmt);
        // $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($quearyString, $dbConn, $stmt, $producerId);
    return $resultToReturn;
}


// #2 function
function acceptRequestFromDistributor($producerId, $distributorId)
{
    $quearyString = "UPDATE provider_client SET status = 3 WHERE f_provider_id = ? AND f_client_id = ?;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $quearyString)) {
        mysqli_stmt_bind_param($stmt, "ss", $producerId, $distributorId);
        mysqli_stmt_execute($stmt);
        // $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($quearyString, $dbConn, $stmt, $producerId, $distributorId);
    return $resultToReturn;
}


// #3 function
function errorsForAcceptRequestFromDistributor($error_code)
{
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None");
            header("location: ./distributors_request.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        case 1:
            $qs = "error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./distributors_request.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        default:
            $qs = "error=" . base64_encode("Please try again!");
            header("location: ./distributors_request.php?" . $qs);
            ob_end_clean();
            exit();
            break;
    }
}


// #4 funtion
function rejectRequestFromDistributor($producerId, $distributorId)
{
    $quearyString = "UPDATE provider_client SET status = 0 WHERE f_provider_id = ? AND f_client_id = ?;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $quearyString)) {
        mysqli_stmt_bind_param($stmt, "ss", $producerId, $distributorId);
        mysqli_stmt_execute($stmt);
        // $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($quearyString, $dbConn, $stmt, $producerId, $distributorId);
    return $resultToReturn;
}


// #5 function
function errorsForRejectRequestFromDistributor($error_code)
{
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None");
            header("location: ./distributors_request.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        case 1:
            $qs = "error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./distributors_request.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        default:
            $qs = "error=" . base64_encode("Please try again!");
            header("location: ./distributors_request.php?" . $qs);
            ob_end_clean();
            exit();
            break;
    }
}
