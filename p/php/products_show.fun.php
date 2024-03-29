<?php

require_once("./../database.config.php");

// #1 function
function selectAllItem($producerId)
{
    $queryString = "SELECT item_id, type, name, mrp, user_item.quantity, manufacture_date, expire_date, image FROM items LEFT JOIN user_item ON items.item_id = user_item.f_item_id WHERE f_producer_id = ? AND f_user_id = ? ORDER BY name;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "ss", $producerId, $producerId);
        mysqli_stmt_execute($stmt);
        $resultToReturn = mysqli_stmt_get_result($stmt);
        // $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $stmt, $producerId);
    return $resultToReturn;
}


// #2 function
function errorsForSelectAllItem($error_code)
{
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None");
            header("location: ./products_show.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        case 1:
            $qs = "error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./products_show.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        default:
            $qs = "error=" . base64_encode("Please try again!");
            header("location: ./products_show.php?" . $qs);
            ob_end_clean();
            exit();
            break;
    }
}


// #3 function
function selectSpecificItem($searchBy, $keyWord, $producerId)
{
    if ($searchBy != "select") {
        $queryString = "SELECT item_id, type, name, mrp, user_item.quantity, manufacture_date, expire_date, image FROM items LEFT JOIN user_item ON items.item_id = user_item.f_item_id WHERE $searchBy LIKE '%$keyWord%' AND f_producer_id = ? AND f_user_id = ? ORDER BY name;";
        $dbConn = databaseConnector();
        $stmt = mysqli_stmt_init($dbConn);
        if (mysqli_stmt_prepare($stmt, $queryString)) {
            mysqli_stmt_bind_param($stmt, "ss", $producerId, $producerId);
            mysqli_stmt_execute($stmt);
            $resultToReturn = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            databaseConnectorClose($dbConn);
            // $resultToReturn = 0;
        } else {
            $resultToReturn = 1;
        }
    } else {
        $resultToReturn = 2;
    }
    unset($queryString, $dbConn, $stmt, $searchBy, $keyWord, $producerId);
    return $resultToReturn;
}


// #4 function
function errorsForSelectSpecificItem($error_code, $post_data)
{
    $a = base64_encode(json_encode($post_data));
    switch ($error_code) {
        case 0:
            $qs = "a=" . $a . "&error=" . base64_encode("None");
            header("location: ./products_show.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        case 1:
            $qs = "a=" . $a . "&error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./products_show.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        case 2:
            $qs = "a=" . $a . "&error=" . base64_encode("Select option for `search by` filed");
            header("location: ./products_show.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        default:
            $qs = "a=" . $a . "&error=" . base64_encode("Please try again!");
            header("location: ./products_show.php?" . $qs);
            ob_end_clean();
            exit();
            break;
    }
}
