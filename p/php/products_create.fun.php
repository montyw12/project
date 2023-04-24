<?php

require_once("./../database.config.php");

// #1 function
function insertItem($producerId, $type, $name, $mrp, $quantity, $manufactureDate, $expireDate, $image)
{
    $manufactureDateTimestamp = mktime(0, 0, 0, substr($manufactureDate, 5, 2), (substr($manufactureDate, 8, 2) + 6), substr($manufactureDate, 0, 4));
    $expireDateTimestamp = mktime(0, 0, 0, substr($expireDate, 5, 2), substr($expireDate, 8, 2), substr($expireDate, 0, 4));
    if (($expireDateTimestamp - $manufactureDateTimestamp) >= 0) {
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
                        mysqli_stmt_bind_param($stmt, "ssssdisss", $item_id, $producerId, $type, $name, $mrp, $quantity, $manufactureDate, $expireDate, $imagePath);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                        $stmt1 = mysqli_stmt_init($dbConn);
                        $queryString1 = "INSERT INTO user_item(f_user_id, f_item_id, quantity) VALUES(?, ?, ?);";
                        if (mysqli_stmt_prepare($stmt1, $queryString1)) {
                            mysqli_stmt_bind_param($stmt1, "ssi", $producerId, $item_id, $quantity);
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
    unset($manufactureDateTimestamp, $expireDateTimestamp, $imageExtension, $allowedExtensions, $imageTitle, $imagePath, $queryString, $dbConn, $item_id, $stmt, $stmt1, $queryString1, $producerId, $type, $name, $mrp, $quantity, $manufactureDate, $expireDate, $image);
    return $flagToReturn;
}


// #2 function
function errorsForInsertItem($error_code, $post_data)
{
    $a = base64_encode(json_encode($post_data));
    switch ($error_code) {
        case 0:
            $qs = "error=" . base64_encode("None");
            header("location: ./products_create.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        case 1:
            $qs = "a=" . $a . "&error=" . base64_encode("Someting want wrong! try agian");
            header("location: ./products_create.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        case 2:
            $qs = "a=" . $a . "&error=" . base64_encode("Invalid image file formate");
            header("location: ./products_create.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        case 3:
            $qs = "a=" . $a . "&error=" . base64_encode("Image file must be less than 2MB");
            header("location: ./products_create.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        case 4:
            $qs = "a=" . $a . "&error=" . base64_encode("Something problem with image file upload again");
            header("location: ./products_create.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        case 5:
            $qs = "a=" . $a . "&error=" . base64_encode("Atleast 7 days difference between item manufacture day and expire day");
            header("location: ./products_create.php?" . $qs);
            ob_end_clean();
            exit();
            break;
        default:
            $qs = "a=" . $a . "&error=" . base64_encode("Please try again!");
            header("location: ./products_create.php?" . $qs);
            ob_end_clean();
            exit();
            break;
    }
}
