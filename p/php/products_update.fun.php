<?php

require_once("./../database.config.php");


// #1 function
function selectItemForUpdate($item_id, $producer_id)
{
    $queryString = "SELECT * FROM items WHERE item_id = ? AND f_producer_id = ? ORDER BY name";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "ss", $item_id, $producer_id);
        mysqli_stmt_execute($stmt);
        $resultToReturn = mysqli_stmt_get_result($stmt);
        // $resultToReturn = 0;
        mysqli_stmt_close($stmt);
        databaseConnectorClose($dbConn);
    } else {
        $resultToReturn = 1;
    }
    unset($queryString, $dbConn, $stmt, $item_id, $producer_id);
    return $resultToReturn;
}


// #2 function
function errorsForSelectItemForUpdate($error_code)
{
    // $a = base64_encode(json_encode($post_data));
    $a = null;
    switch ($error_code) {
        case 0:
            $qs = "a=" . $a . "&error=" . base64_encode("None");
            header("location: ./products_update.php?" . $qs);
            exit();
            break;
        case 1:
            $qs = "a=" . $a . "&error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./products_update.php?" . $qs);
            exit();
            break;
        case 2:
            $qs = "a=" . $a . "&error=" . base64_encode("Item not found");
            header("location: ./products_update.php?" . $qs);
            exit();
            break;
        default:
            $qs = "a=" . $a . "&error=" . base64_encode("Please try again!");
            header("location: ./products_update.php?" . $qs);
            exit();
            break;
    }
}


// #3 function
function updateItem($producer_id, $item_id, $type, $name, $mrp, $quantity, $manufacture_date, $expire_date, $image)
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
                    $queryString = "UPDATE items SET type = ?,name = ?,mrp = ?,quantity = ?,manufacture_date = ?,expire_date = ?,image = ? WHERE item_id = ? AND f_producer_id = ?;";
                    $dbConn = databaseConnector();
                    $stmt = mysqli_stmt_init($dbConn);
                    if (mysqli_stmt_prepare($stmt, $queryString)) {
                        mysqli_stmt_bind_param($stmt, "ssdisssss",  $type, $name, $mrp, $quantity, $manufacture_date, $expire_date, $imagePath, $item_id, $producer_id);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                        $stmt1 = mysqli_stmt_init($dbConn);
                        $queryString1 = "UPDATE user_item SET quantity = ? WHERE f_item_id = ? AND f_user_id = ?;";
                        if (mysqli_stmt_prepare($stmt1, $queryString1)) {
                            mysqli_stmt_bind_param($stmt1, "iss", $quantity, $item_id, $producer_id);
                            mysqli_stmt_execute($stmt1);
                        }
                        mysqli_stmt_close($stmt1);
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
    unset($manufacture_date_timestamp, $expire_date_timestamp, $imageExtension, $allowedExtensions, $imageTitle, $imagePath, $queryString, $dbConn, $stmt, $stmt1, $queryString1, $producer_id, $item_id, $type, $name, $mrp, $quantity, $manufacture_date, $expire_date, $image);
    return $flagToReturn;
}


// #4 function
function errorsForUpdateItem($error_code, $post_data)
{
    $a = base64_encode(json_encode($post_data));
    switch ($error_code) {
        case 0:
            $qs = "a=" . $a . "&error1=" . base64_encode("None");
            header("location: ./products_update.php?" . $qs);
            exit();
            break;
        case 1:
            $qs = "a=" . $a . "&error1=" . base64_encode("Someting want wrong! try agian");
            header("location: ./products_update.php?" . $qs);
            exit();
            break;
        case 2:
            $qs = "a=" . $a . "&error1=" . base64_encode("Invalid image file formate");
            header("location: ./products_update.php?" . $qs);
            exit();
            break;
        case 3:
            $qs = "a=" . $a . "&error1=" . base64_encode("Image file must be less than 2MB");
            header("location: ./products_update.php?" . $qs);
            exit();
            break;
        case 4:
            $qs = "a=" . $a . "&error1=" . base64_encode("Something problem with image file upload again");
            header("location: ./products_update.php?" . $qs);
            exit();
            break;
        case 5:
            $qs = "a=" . $a . "&error1=" . base64_encode("Atleast 7 days difference between item manufacture day and expire day");
            header("location: ./products_update.php?" . $qs);
            exit();
            break;
        default:
            $qs = "a=" . $a . "&error1=" . base64_encode("Please try again!");
            header("location: ./products_update.php?" . $qs);
            exit();
            break;
    }
}
