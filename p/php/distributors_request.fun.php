<?php

require_once("./../database.config.php");


// #1 function
function selectRequestForProducers($producer_id)
{
    $quearyString = "SELECT user_id, type, name, address, email, item_has, status FROM users LEFT JOIN provider_client ON user_id = f_client_id WHERE type = 'distributor' AND f_provider_id = ? AND status = 2 ORDER BY name";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $quearyString)) {
        mysqli_stmt_bind_param($stmt, "s", $producer_id);
        mysqli_stmt_execute($stmt);
        $resultToReturn =  mysqli_stmt_get_result($stmt);
        // $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($quearyString, $dbConn, $stmt, $producer_id);
    return $resultToReturn;
}


// #2 function
function acceptRequestFromDistributor($producer_id, $distributor_id)
{
    $quearyString = "UPDATE provider_client SET status = 3 WHERE f_provider_id = ? AND f_client_id = ?;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $quearyString)) {
        mysqli_stmt_bind_param($stmt, "ss", $producer_id, $distributor_id);
        mysqli_stmt_execute($stmt);
        // $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($quearyString, $dbConn, $stmt, $producer_id, $distributor_id);
    return $resultToReturn;
}


// #3 function
function errorsForAcceptRequestFromDistributor($error_code)
{
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None");
            header("location: ./distributors_request.php?" . $qs);
            exit();
            break;
        case 1:
            $qs = "error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./distributors_request.php?" . $qs);
            exit();
            break;
        default:
            $qs = "error=" . base64_encode("Please try again!");
            header("location: ./distributors_request.php?" . $qs);
            exit();
            break;
    }
}


// #4 funtion
function rejectRequestFromDistributor($producer_id, $distributor_id)
{
    $quearyString = "UPDATE provider_client SET status = 0 WHERE f_provider_id = ? AND f_client_id = ?;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $quearyString)) {
        mysqli_stmt_bind_param($stmt, "ss", $producer_id, $distributor_id);
        mysqli_stmt_execute($stmt);
        // $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($quearyString, $dbConn, $stmt, $producer_id, $distributor_id);
    return $resultToReturn;
}


// #5 function
function errorsForRejectRequestFromDistributor($error_code)
{
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None");
            header("location: ./distributors_request.php?" . $qs);
            exit();
            break;
        case 1:
            $qs = "error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./distributors_request.php?" . $qs);
            exit();
            break;
        default:
            $qs = "error=" . base64_encode("Please try again!");
            header("location: ./distributors_request.php?" . $qs);
            exit();
            break;
    }
}
