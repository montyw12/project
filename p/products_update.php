<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/products_update.fun.php");

    $a = isset($_GET["a"]) ? json_decode(base64_decode($_GET["a"])) : "";
    if (isset($_POST["search_submit"])) {
        $result = selectItemForUpdate($_POST["item_id"], $_SESSION["user_id"]);
        if ((gettype($result) === "integer" ? $result : 0) > 0) {
            errorsForSelectItemForUpdate($result);
        } else if ($result->num_rows === 0) {
            errorsForSelectItemForUpdate(2);
        } else {
            $_GET["error"] = base64_encode("");
            $data = mysqli_fetch_assoc($result);
        }
    } else if (isset($_POST["update_submit"])) {
        if (isset($_POST["item_id"]) && $_POST["item_id"] != "") {
            $result1 = updateItem($_SESSION["user_id"], $_POST["item_id"], $_POST["type"], $_POST["name"], $_POST["mrp"], $_POST["quantity"], $_POST["manufacture_date"], $_POST["expire_date"], $_FILES["image"]);
            if ($result1 === 0) {
                $_GET["error1"] = base64_encode("Item Updated Successfully!");
            } else {
                errorsForUpdateItem($result1, $_POST);
            }
        } else {
            $_GET["error"] = base64_encode("First Search Item");
        }
    }
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>
<link rel="stylesheet" type="text/css" href="./css/products.css">
<link rel="stylesheet" type="text/css" href="./css/products_show.css">

<main>
    <ul class="subul">
        <li><a href="./products_show.php" class="sublink">Show Products</a></li>
        <li><a href="./products_update.php" class="sublink">Update Products</a></li>
        <li><a href="./products_create.php" class="sublink">Create Products</a></li>
    </ul>
    <div class="main-section">
        <form method="post">
            <table>
                <tr>
                    <td>
                        <label for="">Input Item id:</label>
                    </td>
                    <td>
                        <input type="text" name="item_id" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for=""></label>
                    </td>
                    <td>
                        <label for=""><?= isset($_GET["error"]) ? base64_decode($_GET["error"]) : "" ?></label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="search_submit" value="Search">
                    </td>
                </tr>
            </table>
        </form>
        <?php if (isset($_POST["item_id"]) && $_POST["item_id"] != "") : ?>
            <form method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>
                            <label for="">Item id:</label>
                        </td>
                        <td>
                            <?= isset($data["item_id"]) ? $data["item_id"] : "" ?>
                            <input type="hidden" name="item_id" required value="<?= isset($data["item_id"]) ? $data["item_id"] : (isset($a->item_id) ? $a->item_id : NULL) ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Item type:</label>
                        </td>
                        <td>
                            <input type="text" name="type" required value="<?= isset($data["type"]) ? $data["type"] : (isset($a->type) ? $a->type : "") ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Item name:</label>
                        </td>
                        <td>
                            <input type="text" name="name" required value="<?= isset($data["name"]) ? $data["name"] : (isset($a->name) ? $a->name : "") ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Item mrp:</label>
                        </td>
                        <td>
                            <input type="number" name="mrp" step="0.01" min="0.00" max="100000.00" required value="<?= isset($data["mrp"]) ? $data["mrp"] : (isset($a->mrp) ? $a->mrp : "") ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Item quantity:</label>
                        </td>
                        <td>
                            <input type="number" name="quantity" min="0" max="10000" required value="<?= isset($data["quantity"]) ? $data["quantity"] : (isset($a->quantity) ? $a->quantity : "") ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Item manufacture date:</label>
                        </td>
                        <td>
                            <input type="date" name="manufacture_date" required value="<?= isset($data["manufacture_date"]) ? $data["manufacture_date"] : (isset($a->manufacture_date) ? $a->manufacture_date : "") ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Item expire date:</label>
                        </td>
                        <td>
                            <input type="date" name="expire_date" required value="<?= isset($data["expire_date"]) ? $data["expire_date"] : (isset($a->expire_date) ? $a->expire_date : "") ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Item image:</label>
                        </td>
                        <td>
                            <input type="file" name="image" required value="<?= isset($data["image"]) ? $data["image"] : "" ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for=""></label>
                        </td>
                        <td>
                            <label for=""><?= isset($_GET["error1"]) ? base64_decode($_GET["error1"]) : "" ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Update Item" name="update_submit">
                        </td>
                    </tr>
                </table>
            </form>
        <?php endif; ?>
    </div>
</main>

<?php require_once("./02_foot.php") ?>