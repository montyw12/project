<?php

require_once("./../database.config.php");


// #1 function
function selectAllOrders($userId)
{
    $queryString = "SELECT order_id, f_provider_id, dispatch_date, delivery_date, orders.status, item_no, r_id FROM orders LEFT JOIN provider_client ON f_provider_client_id = r_id WHERE f_client_id = ? AND provider_client.status = 3 AND orders.status != 0 ORDER BY orders.status, order_date;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);
        $resultToReturn = mysqli_stmt_get_result($stmt);
        // $resultToReturn = 0;
    }
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $stmt, $userId);
    return $resultToReturn;
}


// #2 function
function setOrderAsMarkDone($userId, $orderId)
{
    $queryString = "UPDATE orders SET status = 3 WHERE order_id = ?;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "s", $orderId);
        mysqli_stmt_execute($stmt);
        $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $stmt, $userId, $orderId);
    return $resultToReturn;
}


// #3 function
function errorsForSetOrderAsMarkDone($error_code)
{
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None");
            header("location: ./orders_all.php?" . $qs);
            exit();
            break;
        case 1:
            $qs = "error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./orders_all.php?" . $qs);
            exit();
            break;
        default:
            $qs = "error=" . base64_encode("Please try again!");
            header("location: ./orders_all.php?" . $qs);
            exit();
            break;
    }
}
