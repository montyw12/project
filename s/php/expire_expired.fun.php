<?php

require_once("./../database.config.php");

// #1 function
function selectExpiredItems($sellerId)
{
    $queryString = "SELECT * FROM items LEFT JOIN user_item ON items.item_id = user_item.f_item_id WHERE user_item.f_user_id = ? AND items.expire_date <= ?;";
    $expireDay = date("Y-m-d");
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "ss", $sellerId, $expireDay);
        mysqli_stmt_execute($stmt);
        $resultToReturn = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        databaseConnectorClose($dbConn);
        // $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    unset($queryString, $dbConn, $stmt, $expireDay, $sellerId);
    return $resultToReturn;
}


// #2 function
function errorsForSelectExpiredItems($error_code)
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
