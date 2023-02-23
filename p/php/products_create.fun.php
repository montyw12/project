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
function insertItem($producer_id, $type, $name, $mrp, $quantity, $manufacture_date, $expire_date, $image)
{
    if (1) { // for type
        if ($image["error"] === 0) {
            if ($image["size"] <= 2097152) { // image less than 2 MB
                $imageExtension = pathinfo($image["name"], PATHINFO_EXTENSION);
                $imageExtension = strtolower($imageExtension);
                $allowedExtensions = ["jpg", "jpeg", "png"];
                if (in_array($imageExtension, $allowedExtensions)) {
                    $imageTitle = "IMG_" . date("ymd") . "_" . date("His") . "." .$imageExtension;
                    $imagePath = "00_img/" . $imageTitle;
                    move_uploaded_file($image["tmp_name"], ("./../" . $imagePath));
                    $queryString = "INSERT INTO item(item_id,f_producer_id,type,name,mrp,quantity,manufacture_date,expire_date,image) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?);";
                    $dbConn = databaseConnector();
                    $item_id = "0I" . base_convert(date("sYimHd"), 10, 36);
                    $stmt = mysqli_stmt_init($dbConn);
                    if (mysqli_stmt_prepare($stmt, $queryString)) {
                        mysqli_stmt_bind_param($stmt, "ssssdisss", $item_id, $producer_id, $type, $name, $mrp, $quantity, $manufacture_date, $expire_date, $imagePath);
                        mysqli_stmt_execute($stmt);
                        // var_dump(mysqli_stmt_get_result($stmt));
                        databaseConnectorClose($dbConn);
                        $flagToReturn = 0;
                    } else {
                        $flagToReturn = 1;
                    }
                } else {
                    $flagToReturn = 2;
                }
            } else {
                $flagToReturn = 3;
            }
        } else {
            $flagToReturn = 4;
        }
    } else {
        $flagToReturn = 5;
    }

    return $flagToReturn;
}
