<?php

require_once("./../database.config.php");


// #1 function
function selectAllSellers($distributorId)
{
    $queryString = "SELECT user_id, type, name, address, email, item_has, status FROM users LEFT JOIN provider_client ON user_id = f_client_id WHERE (type = 'seller'  AND (f_provider_id = ? OR f_client_id IS NULL));";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "s", $distributorId);
        mysqli_stmt_execute($stmt);
        $resultToReturn = mysqli_stmt_get_result($stmt);
        // $resultToReturn = 0;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $stmt);
    return $resultToReturn;
}


// #2 function
function checkStatusForBtn($status)
{
    if (isset($status)) {
        if ($status == 0)
            $flagToReturn = "Connect";
        else if ($status == 1 or $status == 2)
            $flagToReturn = "Pending";
        else if ($status == 3)
            $flagToReturn = "Disconnect";
    }
    unset($status);
    return $flagToReturn;
}

// #3 function
function requestForConnect($distributorId, $sellerId)
{
    $queryString = "UPDATE provider_client SET status = 1 WHERE f_provider_id = ? AND f_client_id = ?;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "ss", $distributorId, $sellerId);
        mysqli_stmt_execute($stmt);
        // $resultToReturn = mysqli_stmt_get_result($stmt);
        $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $stmt, $distributorId, $sellerId);
    return $resultToReturn;
}


// #4 function
function errorsForRequestForConnect($error_code)
{
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None");
            header("location: ./sellers_all.php?" . $qs);
            exit();
            break;
        case 1:
            $qs = "error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./sellers_all.php?" . $qs);
            exit();
            break;
        default:
            $qs = "error=" . base64_encode("Please try again!");
            header("location: ./sellers_all.php?" . $qs);
            exit();
            break;
    }
}


// #5 function
function disconnectDistributor($distributorId, $sellerId)
{
    $queryString = "UPDATE provider_client SET status = 0 WHERE f_provider_id = ? AND f_client_id = ?";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "ss", $distributorId, $sellerId);
        mysqli_stmt_execute($stmt);
        // $resultToReturn = mysqli_stmt_get_result($stmt);
        $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $stmt, $distributorId, $sellerId);
    return $resultToReturn;
}


// #6 function
function errorsForDisconnectDistributor($error_code)
{
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None");
            header("location: ./sellers_all.php?" . $qs);
            exit();
            break;
        case 1:
            $qs = "error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./sellers_all.php?" . $qs);
            exit();
            break;
        default:
            $qs = "error=" . base64_encode("Please try again!");
            header("location: ./sellers_all.php?" . $qs);
            exit();
            break;
    }
}
