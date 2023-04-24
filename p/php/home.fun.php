<?php 

require_once("./../database.config.php");

// #1 function
function selectAllInformation($userId)
{
    $queryString = "SELECT users.name, users.email, users.address, user_amount.amount, count(T1.f_client_id) AS total_client FROM users JOIN user_amount ON users.user_id = user_amount.f_user_id JOIN provider_client AS T1 ON users.user_id = T1.f_provider_id WHERE users.user_id = ? AND T1.status = 3;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);
        $resultToReturn = mysqli_stmt_get_result($stmt);
        // $resultToReturn = 0;
    }
    mysqli_stmt_close($stmt);
    databaseConnectorClose($dbConn);
    unset($queryString, $dbConn, $stmt, $userId);
    return $resultToReturn;
}
