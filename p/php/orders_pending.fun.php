<?php

require_once("./../database.config.php");


// #1 function
function selectPendingOrders($userId)
{
    $queryString = "SELECT * FROM orders LEFT JOIN provider_client ON f_provider_client_id = r_id WHERE f_provider_id = ? AND provider_client.status = 3 AND orders.status = 1 ORDER BY order_date;";
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
function setOrderDispatchDateAndDeliveryDate($userId, $dispatchDate, $deliveryDate)
{
    $queryString = "UPDATE orders SET dispatch_date = ?, delivery_date = ?, status = 2 WHERE order_id = ?;";
    $dbConn = databaseConnector();
    $todayDate = date("y-m-d");
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "sss", $todayDate, $deliveryDate[$dispatchDate], $dispatchDate);
        mysqli_stmt_execute($stmt);
    }
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $todayDate, $stmt, $userId, $dispatchDate, $deliveryDate);
}
