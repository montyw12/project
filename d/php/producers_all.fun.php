<?php

require_once("./../database.config.php");

// #1 function
function selectAllProducers($distributorId)
{
    $queryString = "SELECT user_id, name, address, email, status FROM users LEFT JOIN provider_client ON user_id = f_provider_id WHERE type = 'producer'  AND f_client_id = ? ORDER BY name;";
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
function requestForConnect($distributorId, $producerId)
{
    $queryString = "UPDATE provider_client SET status = 2 WHERE f_provider_id = ? AND f_client_id = ?;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "ss", $producerId, $distributorId);
        mysqli_stmt_execute($stmt);
        $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $stmt, $distributorId, $producerId);
    return $resultToReturn;
}


// #4 function
function errorsForRequestForConnect($error_code)
{
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None");
            header("location: ./producers_all.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        case 1:
            $qs = "error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./producers_all.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        default:
            $qs = "error=" . base64_encode("Please try again!");
            header("location: ./producers_all.php?" . $qs);
            ob_end_clean();
            exit();
            break;
    }
}


// #5 function
function disconnectDistributor($distributorId, $producerId)
{
    $queryString = "UPDATE provider_client SET status = 0 WHERE f_provider_id = ? AND f_client_id = ?";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "ss", $producerId, $distributorId);
        mysqli_stmt_execute($stmt);
        $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $stmt, $distributorId, $producerId);
    return $resultToReturn;
}


// #6 function
function errorsForDisconnectDistributor($error_code)
{
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None");
            header("location: ./producers_all.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        case 1:
            $qs = "error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./producers_all.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        default:
            $qs = "error=" . base64_encode("Please try again!");
            header("location: ./producers_all.php?" . $qs);
            ob_end_clean();
            exit();
            break;
    }
}
