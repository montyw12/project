<?php

require_once("./../database.config.php");


// #1 function
function selectAllItemOFConnectedProducers($distributor_id)
{
    // $queryString = "SELECT item_id, f_producer_id, items.type, items.name, mrp, quantity manufacture_date, expire_date, image FROM items LEFT JOIN provider_client ON f_producer_id = f_provider_id LEFT JOIN users ON f_producer_id = user_id WHERE f_client_id = ? AND status = 3 ORDER BY users.name, items.name;";
    $queryString = "SELECT item_id, f_producer_id, type, name, mrp, items.quantity, manufacture_date, expire_date, image, user_item.quantity FROM items LEFT JOIN provider_client ON items.f_producer_id = provider_client.f_provider_id LEFT JOIN user_item ON user_item.f_item_id = items.item_id WHERE provider_client.f_client_id = ? AND provider_client.status = 3 AND user_item.f_user_id != ?;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "ss", $distributor_id, $distributor_id);
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
function createOrder($user_id, $item_select, $item_quantity)
{
    if (count($item_select) == 1) {
        foreach ($item_select as $key => $value) {
            $provider_id = $key;
            break;
        }
        foreach ($item_select[$provider_id] as $a) {
            if ((!empty($a)) && (!empty($item_quantity[$a]))) {
                $item["item_id"][] = $a;
                $item["quantity"][] = $item_quantity[$a];
            }
        }
        if (isset($item)) {
            $dbConn = databaseConnector();
            $queryString = "SELECT r_id FROM provider_client WHERE f_provider_id = ? AND f_client_id = ?";
            $stmt = mysqli_stmt_init($dbConn);
            if (mysqli_stmt_prepare($stmt, $queryString)) {
                mysqli_stmt_bind_param($stmt, "ss", $provider_id, $user_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $data = mysqli_fetch_assoc($result);
                $f_provider_client_id = $data["r_id"];
            }
            mysqli_stmt_close($stmt);

            $queryString1 = "INSERT INTO orders(order_id, f_provider_client_id, item_no, order_date, status) VALUES(?, ?, ?, ?, ?);";
            $order_id = "0O" . base_convert(date("sYimHd"), 10, 36);
            $item_no =  count($item["item_id"]);
            $order_date = date("Y-m-d");
            $status = 1;
            $stmt1 = mysqli_stmt_init($dbConn);
            if (mysqli_stmt_prepare($stmt1, $queryString1)) {
                mysqli_stmt_bind_param($stmt1, "ssisi", $order_id, $f_provider_client_id, $item_no, $order_date, $status);
                mysqli_stmt_execute($stmt1);
            }
            mysqli_stmt_close($stmt1);

            $queryString2 = "INSERT INTO order_item(f_order_id, f_item_id, quantity) VALUES(?, ?, ?);";
            $stmt2 = mysqli_stmt_init($dbConn);
            for ($i = 0; $i < count($item["item_id"]); $i++) {
                if (mysqli_stmt_prepare($stmt2, $queryString2)) {
                    mysqli_stmt_bind_param($stmt2, "ssi", $order_id, $item["item_id"][$i], $item["quantity"][$i]);
                    mysqli_stmt_execute($stmt2);
                }
            }
            mysqli_stmt_close($stmt2);
            databaseConnectorClose($dbConn);
            $resultToReturn = 0;
        } else {
            $resultToReturn = 1;
        }
    } else {
        $resultToReturn = 2;
    }
    unset($key, $value, $provider_id, $a, $item, $dbConn, $queryString, $stmt, $result, $data, $f_provider_client_id, $queryString1, $order_id, $item_no, $order_date, $status, $stmt1, $queryString2, $stmt2, $i, $user_id, $item_select, $item_quantity);
    return $resultToReturn;
}


// #3 function
function errorsForCreateOrder($error_code)
{
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None");
            header("location: ./orders_make.php?" . $qs);
            exit();
            break;
        case 1:
            $qs = "error=" . base64_encode("Provide sufficient information to make order");
            header("location: ./orders_make.php?" . $qs);
            exit();
            break;
        case 2:
            $qs = "error=" . base64_encode("Select items of any one producers for a orders");
            header("location: ./orders_make.php?" . $qs);
            exit();
            break;
        default:
            $qs = "error=" . base64_encode("Please try again!");
            header("location: ./orders_make.php?" . $qs);
            exit();
            break;
    }
}
