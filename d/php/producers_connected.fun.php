<?php

require_once("./../database.config.php");


// #3 function
function selectAllConnectedProducers($distributor_id)
{
    $queryString = "SELECT user_id, type, name, address, email, item_has, status FROM users LEFT JOIN provider_client ON user_id = f_provider_id WHERE type = 'producer' AND f_client_id = ? AND status = 3 ORDER BY name;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "s", $distributor_id);
        mysqli_stmt_execute($stmt);
        $resultToReturn = mysqli_stmt_get_result($stmt);
        // $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $stmt, $distributor_id);
    return $resultToReturn;
}


// #4 function
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


// #5 function
function disconnectProducer($distributor_id, $producer_id)
{
    $queryString = "UPDATE provider_client SET status = 0 WHERE f_provider_id = ? AND f_client_id = ?";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "ss", $producer_id, $distributor_id);
        mysqli_stmt_execute($stmt);
        // $resultToReturn = mysqli_stmt_get_result($stmt);
        $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $stmt, $distributor_id, $producer_id);
    return $resultToReturn;
}


// #6 function
function errorsForDisconnectProducer($error_code)
{
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None");
            header("location: ./producers_connected.php?" . $qs);
            exit();
            break;
        case 1:
            $qs = "error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./producers_connected.php?" . $qs);
            exit();
            break;
        default:
            $qs = "error=" . base64_encode("Please try again!");
            header("location: ./producers_connected.php?" . $qs);
            exit();
            break;
    }
}
