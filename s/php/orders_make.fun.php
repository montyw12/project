<?php

require_once("./../database.config.php");

// #1 function
function selectAllItemOFConnectedDistributors($sellerId)
{
    $queryString = "SELECT item_id, f_provider_id, type, name, mrp, items.quantity, manufacture_date, expire_date, image, user_item.quantity FROM items LEFT JOIN user_item ON items.item_id = user_item.f_item_id LEFT JOIN provider_client ON user_item.f_user_id = provider_client.f_provider_id WHERE provider_client.f_client_id = ? AND provider_client.f_provider_id LIKE '0D%' AND provider_client.status = 3 ORDER BY f_provider_id, items.type, items.name;";
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
    unset($queryString, $dbConn, $stmt);
    return $resultToReturn;
}


// #2 function
function createOrder($sellerId, $itemSelected, $itemQuantity)
{
    $totalOrderAmount = 0;
    if (count($itemSelected) == 1) {
        foreach ($itemSelected as $key => $value) {
            $distributorId = $key;
            break;
        }
        foreach ($itemSelected[$distributorId] as $a) {
            if ((!empty($a)) && (!empty($itemQuantity[$a]))) {
                $item["item_id"][] = $a;
                $item["quantity"][] = $itemQuantity[$a];
            }
        }
        if (isset($item)) {
            $dbConn = databaseConnector();

            $queryString = "SELECT mrp FROM items WHERE item_id = ?;";
            $stmt = mysqli_stmt_init($dbConn);
            foreach ($item["item_id"] as $index => $item_id) {
                if (mysqli_stmt_prepare($stmt, $queryString)) {
                    mysqli_stmt_bind_param($stmt, "s", $item_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $data = mysqli_fetch_assoc($result);
                    $totalOrderAmount += $data["mrp"] * $item["quantity"][$index];
                }
            }
            mysqli_stmt_close($stmt);

            $queryString1 = "SELECT amount FROM user_amount WHERE f_user_id = ?;";
            $stmt1 = mysqli_stmt_init($dbConn);
            if (mysqli_stmt_prepare($stmt1, $queryString1)) {
                mysqli_stmt_bind_param($stmt1, "s", $_SESSION["user_id"]);
                mysqli_stmt_execute($stmt1);
                $result1 = mysqli_stmt_get_result($stmt1);
                $data1 = mysqli_fetch_assoc($result1);
            }
            mysqli_stmt_close($stmt1);

            if ($data1["amount"] >= $totalOrderAmount) {

                $queryString2 = "UPDATE user_amount SET amount = amount - ? WHERE f_user_id = ?;";
                $queryString2_1 = "UPDATE user_amount SET amount = amount + ? WHERE f_user_id = ?;";
                $stmt2 = mysqli_stmt_init($dbConn);
                if (mysqli_stmt_prepare($stmt2, $queryString2)) {
                    mysqli_stmt_bind_param($stmt2, "ds", $totalOrderAmount, $sellerId);
                    mysqli_stmt_execute($stmt2);
                }
                if (mysqli_stmt_prepare($stmt2, $queryString2_1)) {
                    mysqli_stmt_bind_param($stmt2, "ds", $totalOrderAmount, $distributorId);
                    mysqli_stmt_execute($stmt2);
                }
                mysqli_stmt_close($stmt2);

                $queryString3 = "SELECT r_id FROM provider_client WHERE f_provider_id = ? AND f_client_id = ?";
                $stmt3 = mysqli_stmt_init($dbConn);
                if (mysqli_stmt_prepare($stmt3, $queryString3)) {
                    mysqli_stmt_bind_param($stmt3, "ss", $distributorId, $sellerId);
                    mysqli_stmt_execute($stmt3);
                    $result3 = mysqli_stmt_get_result($stmt3);
                    $data3 = mysqli_fetch_assoc($result3);
                    $f_provider_client_id = $data3["r_id"];
                }
                mysqli_stmt_close($stmt3);

                $queryString4 = "INSERT INTO orders(order_id, f_provider_client_id, item_no, order_date, status) VALUES(?, ?, ?, ?, ?);";
                $order_id = "0O" . base_convert(date("sYimHd"), 10, 36);
                $item_no =  count($item["item_id"]);
                $order_date = date("Y-m-d");
                $status = 1;
                $stmt4 = mysqli_stmt_init($dbConn);
                if (mysqli_stmt_prepare($stmt4, $queryString4)) {
                    mysqli_stmt_bind_param($stmt4, "ssisi", $order_id, $f_provider_client_id, $item_no, $order_date, $status);
                    mysqli_stmt_execute($stmt4);
                }
                mysqli_stmt_close($stmt4);

                $queryString5 = "INSERT INTO order_item(f_order_id, f_item_id, quantity) VALUES(?, ?, ?);";
                $stmt5 = mysqli_stmt_init($dbConn);
                for ($i = 0; $i < count($item["item_id"]); $i++) {
                    if (mysqli_stmt_prepare($stmt5, $queryString5)) {
                        mysqli_stmt_bind_param($stmt5, "ssi", $order_id, $item["item_id"][$i], $item["quantity"][$i]);
                        mysqli_stmt_execute($stmt5);
                    }
                }
                mysqli_stmt_close($stmt5);
                databaseConnectorClose($dbConn);
                $resultToReturn = 0;
            } else {
                $resultToReturn = 1;
            }
        } else {
            $resultToReturn = 2;
        }
    } else {
        $resultToReturn = 3;
    }
    unset($totalOrderAmount, $key, $value, $distributorId, $a, $item, $dbConn, $queryString, $stmt, $index, $item_id, $result, $data, $queryString1, $stmt1, $result1, $data1, $queryString2, $queryString2_1, $stmt2, $queryString3, $stmt3, $result3, $data3, $f_provider_client_id, $queryString4, $order_id, $item_no, $order_date, $status, $stmt4, $queryString5, $stmt5, $sellerId, $itemSelected, $itemQuantity);
    return $resultToReturn;
}


// #3 function
function errorsForCreateOrder($error_code)
{
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None");
            header("location: ./orders_make.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        case 1:
            $qs = "error=" . base64_encode("You have not sufficient amount to make this order");
            header("location: ./orders_make.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        case 2:
            $qs = "error=" . base64_encode("Provide sufficient information to make order");
            header("location: ./orders_make.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        case 3:
            $qs = "error=" . base64_encode("Select items of any one distributor for a orders");
            header("location: ./orders_make.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        default:
            $qs = "error=" . base64_encode("Please try again!");
            header("location: ./orders_make.php?" . $qs);
            ob_end_clean();
            exit();
            break;
    }
}
