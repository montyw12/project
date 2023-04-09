<?php

require_once("./../database.config.php");


// #1 function
function selectAllOrders($sellerId)
{
    $queryString = "SELECT order_id, f_provider_id, dispatch_date, delivery_date, orders.status, item_no, r_id FROM orders LEFT JOIN provider_client ON f_provider_client_id = r_id WHERE f_client_id = ? AND provider_client.status = 3 AND orders.status != 0 ORDER BY orders.status, order_date;";
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
function setOrderAsMarkDone($sellerId, $orderId)
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
    mysqli_stmt_close($stmt);

    $queryString1 = "SELECT f_item_id, quantity, f_provider_id FROM order_item LEFT JOIN orders ON f_order_id = order_id LEFT JOIN provider_client ON f_provider_client_id = provider_client.r_id WHERE f_order_id = ? AND f_client_id = ? AND order_id = ?;";
    $stmt1 = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt1, $queryString1)) {
        mysqli_stmt_bind_param($stmt1, "sss", $orderId, $sellerId, $orderId);
        mysqli_stmt_execute($stmt1);
        $result1 = mysqli_stmt_get_result($stmt1);
        while ($data1 = mysqli_fetch_assoc($result1)) {
            $ordersItemId[] = $data1["f_item_id"];
            $oredersItemQuantity[] = $data1["quantity"];
            $providerId = $data1["f_provider_id"];
        }
        $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    mysqli_stmt_close($stmt1);

    $queryString2 = "SELECT f_item_id FROM user_item WHERE f_user_id = ?;";
    $usersItemId[] = "none";
    $stmt2 = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt2, $queryString2)) {
        mysqli_stmt_bind_param($stmt2, "s", $sellerId);
        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);
        while ($data2 = mysqli_fetch_assoc($result2)) {
            $usersItemId[] = $data2["f_item_id"];
        }
        $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    mysqli_stmt_close($stmt2);

    $queryString3_0 = "UPDATE user_item SET quantity = quantity + ? WHERE f_user_id = ? AND f_item_id = ?;";
    $queryString3_1 = "INSERT INTO user_item(f_user_id, f_item_id, quantity) VALUES(?, ?, ?);";
    // $queryString3_2 = "UPDATE user_item SET quantity = quantity - ? WHERE f_user_id = ? AND f_item_id = ?;";
    $stmt3 = mysqli_stmt_init($dbConn);
    for ($i = 0; $i < count($ordersItemId); $i++) {
        if (in_array($ordersItemId[$i], $usersItemId)) {
            if (mysqli_stmt_prepare($stmt3, $queryString3_0)) {
                mysqli_stmt_bind_param($stmt3, "iss", $oredersItemQuantity[$i], $sellerId, $ordersItemId[$i]);
                mysqli_stmt_execute($stmt3);
            }
        } else {
            if (mysqli_stmt_prepare($stmt3, $queryString3_1)) {
                mysqli_stmt_bind_param($stmt3, "ssi", $sellerId, $ordersItemId[$i], $oredersItemQuantity[$i]);
                mysqli_stmt_execute($stmt3);
            }
        }
        $queryString3_2 = "UPDATE items SET quantity = (SELECT SUM(quantity) FROM user_item WHERE f_item_id = ?) WHERE item_id = ?;";
        if (mysqli_stmt_prepare($stmt3, $queryString3_2)) {
            mysqli_stmt_bind_param($stmt3, "ss", $ordersItemId[$i], $ordersItemId[$i]);
            mysqli_stmt_execute($stmt3);
        }
        // if (mysqli_stmt_prepare($stmt3, $queryString3_2)) {
        //     mysqli_stmt_bind_param($stmt3, "iss", $oredersItemQuantity[$i], $providerId, $ordersItemId[$i]);
        //     mysqli_stmt_execute($stmt3);
        // }
    }
    mysqli_stmt_close($stmt3);
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $stmt, $queryString1, $stmt1, $result1, $data1, $ordersItemId, $oredersItemQuantity, $providerId, $queryString2, $usersItemId, $stmt2, $result2, $data2, $queryString3_0, $queryString3_1, $queryString3_2, $stmt3, $i, $sellerId, $orderId);
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
