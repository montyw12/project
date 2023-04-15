<?php

require_once("./../database.config.php");

// #1 function
function selectRequestForDistributors($distributorId)
{
    $quearyString = "SELECT user_id, type, name, address, email, status FROM users LEFT JOIN provider_client ON user_id = f_provider_id WHERE type = 'producer' AND f_client_id = ? AND status = 1 ORDER BY name";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $quearyString)) {
        mysqli_stmt_bind_param($stmt, "s", $distributorId);
        mysqli_stmt_execute($stmt);
        $resultToReturn =  mysqli_stmt_get_result($stmt);
        // $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($quearyString, $dbConn, $stmt, $distributorId);
    return $resultToReturn;
}


// #2 function
function acceptRequestFromProducers($distributorId, $producerId)
{
    $quearyString = "UPDATE provider_client SET status = 3 WHERE f_provider_id = ? AND f_client_id = ?;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $quearyString)) {
        mysqli_stmt_bind_param($stmt, "ss", $producerId, $distributorId);
        mysqli_stmt_execute($stmt);
        $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($quearyString, $dbConn, $stmt, $distributorId, $producerId);
    return $resultToReturn;
}


// #3 function
function errorsForAcceptRequestFromProducers($error_code)
{
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None");
            header("location: ./producers_request.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        case 1:
            $qs = "error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./producers_request.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        default:
            $qs = "error=" . base64_encode("Please try again!");
            header("location: ./producers_request.php?" . $qs);
            ob_end_clean();
            exit();
            break;
    }
}


// #4 funtion
function rejectRequestFromProducers($distributorId, $producerId)
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
    unset($quearyString, $dbConn, $stmt, $distributorId, $producerId);
    return $resultToReturn;
}


// #5 function
function errorsForRejectRequestFromProducers($error_code)
{
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None");
            header("location: ./producers_request.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        case 1:
            $qs = "error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./producers_request.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        default:
            $qs = "error=" . base64_encode("Please try again!");
            header("location: ./producers_request.php?" . $qs);
            ob_end_clean();
            exit();
            break;
    }
}
