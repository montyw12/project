<?php

function databaseConnector()
{
    $connection = mysqli_connect("localhost", "root", "", "00_project");
    if ($connection) {
        return $connection;
    } else {
        return "can not connect to database";
    }
}


function databaseConnectorClose($a)
{
    mysqli_close($a);
    unset($a);
}
