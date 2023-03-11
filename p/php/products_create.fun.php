<?php

require_once("./../database.config.php");


// #1 function
function insertItem($producer_id, $type, $name, $mrp, $quantity, $manufacture_date, $expire_date, $image)
{
    $manufacture_date_timestamp = mktime(0, 0, 0, substr($manufacture_date, 5, 2), (substr($manufacture_date, 8, 2) + 6), substr($manufacture_date, 0, 4));
    $expire_date_timestamp = mktime(0, 0, 0, substr($expire_date, 5, 2), substr($expire_date, 8, 2), substr($expire_date, 0, 4));
    if (($expire_date_timestamp - $manufacture_date_timestamp) >= 0) {
        if ($image["error"] === 0) {
            if ($image["size"] <= 2097152) { // image less than 2 MB
                $imageExtension = pathinfo($image["name"], PATHINFO_EXTENSION);
                $imageExtension = strtolower($imageExtension);
                $allowedExtensions = ["jpg", "jpeg", "png"];
                if (in_array($imageExtension, $allowedExtensions)) {
                    $imageTitle = "IMG_" . date("ymd") . "_" . date("His") . "." . $imageExtension;
                    $imagePath = "00_img/" . $imageTitle;
                    move_uploaded_file($image["tmp_name"], ("./../" . $imagePath));
                    $queryString = "INSERT INTO items(item_id,f_producer_id,type,name,mrp,quantity,manufacture_date,expire_date,image) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?);";
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
    unset($manufacture_date_timestamp, $expire_date_timestamp, $imageExtension, $allowedExtensions, $imageTitle, $imagePath, $queryString, $dbConn, $item_id, $stmt, $producer_id, $type, $name, $mrp, $quantity, $manufacture_date, $expire_date, $image);
    return $flagToReturn;
}


// #2 function
function errorsForInsertItem($error_code, $post_data)
{
    $a = base64_encode(json_encode($post_data));
    switch ($error_code) {
        case 0:
            $qs = "a=" . $a . "&error=" . base64_encode("None");
            header("location: ./products_create.php?" . $qs);
            exit();
            break;
        case 1:
            $qs = "a=" . $a . "&error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./products_create.php?" . $qs);
            exit();
            break;
        case 2:
            $qs = "a=" . $a . "&error=" . base64_encode("Invalid image file formate");
            header("location: ./products_create.php?" . $qs);
            exit();
            break;
        case 3:
            $qs = "a=" . $a . "&error=" . base64_encode("Image file must be less than 2MB");
            header("location: ./products_create.php?" . $qs);
            exit();
            break;
        case 4:
            $qs = "a=" . $a . "&error=" . base64_encode("Something problem with image file upload again");
            header("location: ./products_create.php?" . $qs);
            exit();
            break;
        case 5:
            $qs = "a=" . $a . "&error=" . base64_encode("Atleast 7 days difference between item manufacture day and expire day");
            header("location: ./products_create.php?" . $qs);
            exit();
            break;
        default:
            $qs = "a=" . $a . "&error=" . base64_encode("Please try again!");
            header("location: ./products_create.php?" . $qs);
            exit();
            break;
    }
}
