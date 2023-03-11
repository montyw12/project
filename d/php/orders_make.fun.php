<?php

require_once("./../database.config.php");


// #1 function
function selectAllItemOFConnectedProducers($distributor_id)
{
    $queryString = "SELECT item_id, f_provider_id, items.type, items.name, mrp, quantity manufacture_date, expire_date, image FROM items LEFT JOIN provider_client ON f_producer_id = f_provider_id LEFT JOIN users ON f_producer_id = user_id WHERE f_client_id = ? AND status = 3 ORDER BY users.name, items.name;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "s", $distributor_id);
        mysqli_stmt_execute($stmt);
        $resultToReturn = mysqli_stmt_get_result($stmt);
        // $resultToReturn = 0;
    } else {
        $resultToReturn = 1;
    }
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $stmt);
    return $resultToReturn;
}