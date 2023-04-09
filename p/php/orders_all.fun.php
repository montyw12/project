<?php

require_once("./../database.config.php");

// #1 function
function selectAllOrders($producerId)
{
    $queryString = "SELECT order_id, f_provider_id, dispatch_date, delivery_date, orders.status, item_no, r_id FROM orders LEFT JOIN provider_client ON f_provider_client_id = r_id WHERE f_provider_id = ? AND provider_client.status = 3 AND orders.status != 0 ORDER BY orders.status, order_date;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "s", $producerId);
        mysqli_stmt_execute($stmt);
        $resultToReturn = mysqli_stmt_get_result($stmt);
        // $resultToReturn = 0;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $stmt, $producerId);
    return $resultToReturn;
}
