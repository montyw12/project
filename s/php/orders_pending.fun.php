<?php

require_once("./../database.config.php");


// #1 function
function selectPendingOrders($sellerId)
{
    $queryString = "SELECT * FROM orders LEFT JOIN provider_client ON f_provider_client_id = r_id WHERE f_client_id = ? AND provider_client.status = 3 AND orders.status = 1 ORDER BY order_date;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "s", $sellerId);
        mysqli_stmt_execute($stmt);
        $resultToReturn = mysqli_stmt_get_result($stmt);
        // $resultToReturn = 0;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $stmt, $sellerId);
    return $resultToReturn;
}


// #2 function
function cancelOrder($sellerId, $orderId)
{
    $queryString = "UPDATE orders SET status = 0 WHERE order_id = ?;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "s", $orderId);
        mysqli_stmt_execute($stmt);
        $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $stmt, $sellerId, $orderId);
    return $resultToReturn;
}


// #3 function
function errorsForCancelOrder($error_code)
{
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None");
            header("location: ./orders_pending.php?" . $qs);
            exit();
            break;
        case 1:
            $qs = "error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./orders_pending.php?" . $qs);
            exit();
            break;
        default:
            $qs = "error=" . base64_encode("Please try again!");
            header("location: ./orders_pending.php?" . $qs);
            exit();
            break;
    }
}
