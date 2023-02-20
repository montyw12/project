<?php

// #1 function
function databaseConnector()
{
    $connection = mysqli_connect("localhost", "root", "", "00_project_pms");
    if ($connection) {
        return $connection;
    } else {
        return "can not connect to database";
    }
}


// #2 function
function databaseConnectorClose($a)
{
    mysqli_close($a);
}


// #3 function
function selectAllItem()
{
    $queryString = "SELECT * FROM item;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        // mysqli_stmt_bind_param($stmt);
        mysqli_stmt_execute($stmt);
        $resultToReturn = mysqli_stmt_get_result($stmt);
    }
    databaseConnectorClose($dbConn);
    return $resultToReturn;
}


// #4 function
function selectSpecificItem($search_by, $key_word)
{
    $queryString = "SELECT * FROM item WHERE $search_by LIKE '%$key_word%';";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        // mysqli_stmt_bind_param($stmt, "s", $key_word);
        mysqli_stmt_execute($stmt);
        $resultToReturn = mysqli_stmt_get_result($stmt);
    }
    databaseConnectorClose($dbConn);
    return $resultToReturn;
}
