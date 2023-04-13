<?php

require_once("./../database.config.php");

// #1 function
function selectItemForUpdate($itemId, $producerId)
{
    $queryString = "SELECT item_id, type, name, mrp, user_item.quantity, manufacture_date, expire_date, image FROM items LEFT JOIN user_item ON items.item_id = user_item.f_item_id WHERE item_id = ? AND f_producer_id = ?;";
    $dbConn = databaseConnector();
    $stmt = mysqli_stmt_init($dbConn);
    if (mysqli_stmt_prepare($stmt, $queryString)) {
        mysqli_stmt_bind_param($stmt, "ss", $itemId, $producerId);
        mysqli_stmt_execute($stmt);
        $resultToReturn = mysqli_stmt_get_result($stmt);
        // $resultToReturn = 0;
        mysqli_stmt_close($stmt);
        databaseConnectorClose($dbConn);
    } else {
        $resultToReturn = 1;
    }
    unset($queryString, $dbConn, $stmt, $itemId, $producerId);
    return $resultToReturn;
}


// #2 function
function errorsForSelectItemForUpdate($error_code)
{
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None");
            header("location: ./products_update.php?" . $qs);
            exit();
            break;
        case 1:
            $qs = "error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./products_update.php?" . $qs);
            exit();
            break;
        case 2:
            $qs = "error=" . base64_encode("Item not found");
            header("location: ./products_update.php?" . $qs);
            exit();
            break;
        default:
            $qs = "error=" . base64_encode("Please try again!");
            header("location: ./products_update.php?" . $qs);
            exit();
            break;
    }
}


// #3 function
function updateItem($producerId, $itemId, $type, $name, $mrp, $quantity, $manufactureDate, $expireDate, $image)
{
    $manufactureDate_timestamp = mktime(0, 0, 0, substr($manufactureDate, 5, 2), (substr($manufactureDate, 8, 2) + 6), substr($manufactureDate, 0, 4));
    $expireDate_timestamp = mktime(0, 0, 0, substr($expireDate, 5, 2), substr($expireDate, 8, 2), substr($expireDate, 0, 4));
    if (($expireDate_timestamp - $manufactureDate_timestamp) >= 0) {
        if ($image["error"] === 0) {
            if ($image["size"] <= 2097152) { // image less than 2 MB
                $imageExtension = pathinfo($image["name"], PATHINFO_EXTENSION);
                $imageExtension = strtolower($imageExtension);
                $allowedExtensions = ["jpg", "jpeg", "png"];
                if (in_array($imageExtension, $allowedExtensions)) {
                    $imageTitle = "IMG_" . date("ymd") . "_" . date("His") . "." . $imageExtension;
                    $imagePath = "00_img/" . $imageTitle;
                    move_uploaded_file($image["tmp_name"], ("./../" . $imagePath));
                    $queryString = "UPDATE items SET type = ?, name = ?, mrp = ?, manufacture_date = ?, expire_date = ?, image = ? WHERE item_id = ? AND f_producer_id = ?;";
                    $dbConn = databaseConnector();
                    $stmt = mysqli_stmt_init($dbConn);
                    if (mysqli_stmt_prepare($stmt, $queryString)) {
                        mysqli_stmt_bind_param($stmt, "ssdsssss", $type, $name, $mrp, $manufactureDate, $expireDate, $imagePath, $itemId, $producerId);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                        $stmt1 = mysqli_stmt_init($dbConn);
                        $queryString1 = "UPDATE user_item SET quantity = ? WHERE f_item_id = ? AND f_user_id = ?;";
                        if (mysqli_stmt_prepare($stmt1, $queryString1)) {
                            mysqli_stmt_bind_param($stmt1, "iss", $quantity, $itemId, $producerId);
                            mysqli_stmt_execute($stmt1);
                        }
                        mysqli_stmt_close($stmt1);
                        $stmt2 = mysqli_stmt_init($dbConn);
                        $queryString2 = "UPDATE items SET quantity = (SELECT SUM(quantity) FROM user_item WHERE f_item_id = ?) WHERE item_id = ?;";
                        if (mysqli_stmt_prepare($stmt2, $queryString2)) {
                            mysqli_stmt_bind_param($stmt2, "ss", $itemId, $itemId);
                            mysqli_stmt_execute($stmt2);
                        }
                        mysqli_stmt_close($stmt2);
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
    unset($manufactureDate_timestamp, $expireDate_timestamp, $imageExtension, $allowedExtensions, $imageTitle, $imagePath, $queryString, $dbConn, $stmt, $stmt1, $queryString1, $stmt2, $queryString2, $producerId, $itemId, $type, $name, $mrp, $quantity, $manufactureDate, $expireDate, $image);
    return $flagToReturn;
}


// #4 function
function errorsForUpdateItem($error_code, $post_data)
{
    $a = base64_encode(json_encode($post_data));
    switch ($error_code) {
        case 0:
            $qs = "error1=" . base64_encode("None");
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
