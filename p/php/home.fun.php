<?php 

require_once("./../database.config.php");

// #1 function
function selectAllInformation($userId)
{
    $data[] = null;
    $queryString = "SELECT name, address, email, amount FROM users JOIN user_amount ON user_id = f_user_id WHERE user_id = ?;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);

    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);
    }

    $queryString = "SELECT count(f_client_id) AS total_connected_client FROM users LEFT JOIN provider_client ON user_id = f_provider_id WHERE user_id = ? AND status = 3;";
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data += mysqli_fetch_assoc($result);
    }
    
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $stmt, $userId, $result);
    return $data;
}
