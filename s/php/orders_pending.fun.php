<?php

require_once("./../database.config.php");

// #1 function
function selectPendingOrders($sellerId)
{
    $queryString = "SELECT t1.order_id, t1.order_date, t1.dispatch_date, t1.delivery_date, t1.item_no, t3.user_id AS provider_id, t3.name AS provider_name, t3.email AS provider_email, t3.address AS provider_address FROM orders AS t1 JOIN provider_client AS t2 ON t1.f_provider_client_id = t2.r_id JOIN users AS t3 ON t2.f_provider_id = t3.user_id WHERE t1.status = 1 AND t2.status = 3 AND t2.f_client_id = ? ORDER BY t2.f_provider_id ASC, t1.order_date DESC;";
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
    // $queryString = "UPDATE orders SET status = 0 WHERE order_id = ?;";
    // $dbConn = databaseConnector();
    // $stmt = mysqli_stmt_init($dbConn);
    // if (mysqli_stmt_prepare($stmt, $queryString)) {
    //     mysqli_stmt_bind_param($stmt, "s", $orderId);
    //     mysqli_stmt_execute($stmt);
    //     $resultToReturn = 0;
    // } else {
    //     $resultToReturn = 1;
    // }
    // mysqli_stmt_close($stmt);
    // databaseConnectorClose($dbConn);
    // unset($queryString, $dbConn, $stmt, $sellerId, $orderId);
    // return $resultToReturn;
    $queryString = "UPDATE orders SET status = 0 WHERE order_id = ?;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "s", $orderId);
        mysqli_stmt_execute($stmt);

        $stmt1 = mysqli_stmt_init($dbConn);
        $queryString1 = "SELECT SUM(order_item.quantity * items.mrp) AS order_amount, f_provider_id, f_client_id FROM order_item LEFT JOIN items ON order_item.f_item_id = items.item_id LEFT JOIN orders ON order_item.f_order_id = orders.order_id LEFT JOIN provider_client ON orders.f_provider_client_id = provider_client.r_id WHERE order_item.f_order_id = ?;";
        if (mysqli_stmt_prepare($stmt1, $queryString1)) {
            mysqli_stmt_bind_param($stmt1, "s", $orderId);
            mysqli_stmt_execute($stmt1);
            $result1 = mysqli_stmt_get_result($stmt1);
            $data1 = mysqli_fetch_assoc($result1);
        }
        mysqli_stmt_close($stmt1);

        $queryString2 = "UPDATE user_amount SET amount = amount + ? WHERE f_user_id = ?;";
        $queryString2_1 = "UPDATE user_amount SET amount = amount - ? WHERE f_user_id = ?;";
        $stmt2 = mysqli_stmt_init($dbConn);
        if (mysqli_stmt_prepare($stmt2, $queryString2)) {
            mysqli_stmt_bind_param($stmt2, "ds", $data1["order_amount"], $data1["f_client_id"]);
            mysqli_stmt_execute($stmt2);
        }
        if (mysqli_stmt_prepare($stmt2, $queryString2_1)) {
            mysqli_stmt_bind_param($stmt2, "ds", $data1["order_amount"], $data1["f_provider_id"]);
            mysqli_stmt_execute($stmt2);
        }
        mysqli_stmt_close($stmt2);

        $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $stmt, $stmt1, $queryString1, $result1, $data1, $queryString2, $queryString2_1, $stmt2, $sellerId, $orderId);
    return $resultToReturn;
}


// #3 function
function errorsForCancelOrder($error_code)
{
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None1");
            header("location: ./orders_pending.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        case 1:
            $qs = "error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./orders_pending.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        default:
            $qs = "error=" . base64_encode("Please try again!");
            header("location: ./orders_pending.php?" . $qs);
            ob_end_clean();
            exit();
            break;
    }
}
