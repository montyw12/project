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

<link rel="stylesheet" type="text/css" href="./css/products.css">
<link rel="stylesheet" type="text/css" href="./css/products_update.css">
<div class="main">
    <div class="subul">
        <div id="show_product">
            <a href="./products_show.php" class="sublink">Show Products</a>
        </div>
        <div id="update_product">
            <a href="./products_update.php" class="sublink">Update Products</a>
        </div>
        <div id="create_product">
            <a href="./products_create.php" class="sublink">Create Products</a>
        </div>
    </div>
    <hr>
    <div class="main-section">
        <div class="search-item">
            <form method="post">
                <input id="text" type="text" name="item_id" required>
                <input id="submit" type="submit" name="search_submit" value="&#128269;">
                <p id="error">
                    <?= isset($_GET["error"]) ? base64_decode($_GET["error"]) : "" ?>
                </p>
            </form>
        </div>
        <?php if (isset($_POST["item_id"]) && $_POST["item_id"] != "") : ?>
            <form method="post" enctype="multipart/form-data">
                <div class="item_block">
                    <div id=item>
                        <?= $data["item_id"] ?? "" ?>
                        <input id="item_id" type="hidden" name="item_id" required value="<?= $a->item_id ?? $data["item_id"] ?? "" ?>">
                    </div>
                    <div>
                        <label for="" id="item_type_text">Item type:</label>
                        <input id="item_type" type="text" name="type" required value="<?= $a->type ?? $data["type"] ?? "" ?>">
                    </div>
                    <div>
                        <label for="" id="item_name_text">Item name:</label>
                        <input id="item_name" type="text" name="name" required value="<?= $a->name ?? $data["name"] ?? "" ?>">
                    </div>
                    <div>
                        <label for="" id="item_mrp_text">Item mrp:</label>
                        <input id="item_mrp" type="number" name="mrp" step="0.01" min="0.00" max="100000.00" required value="<?= $a->mrp ?? $data["mrp"] ?? "" ?>">
                    </div>
                    <div>
                        <label for="" id="item_quantity_text">Item quantity:</label>
                        <input id="item_quantity" type="number" name="quantity" min="0" max="10000" required value="<?= $a->quantity ?? $data["quantity"] ?? "" ?>">
                    </div>
                    <div>
                        <label for="" id="item_manufacturedate_text">Item manufacture date:</label>
                        <input id="manufacture_date" type="date" name="manufacture_date" required value="<?= $a->manufacture_date ?? $data["manufacture_date"] ?? "" ?>">
                    </div>
                    <div>
                        <label for="" id="item_expiredate_text">Item expire date:</label>
                        <input id="expire_date" type="date" name="expire_date" required value="<?= $a->expire_date ?? $data["expire_date"]?? "" ?>">
                    </div>
                    <div>
                        <label for="" id="item_img_text">Item image:</label>
                        <input id="item_img" type="file" name="image" required value="<?= $a->image ?? $data["image"] ?? "" ?>">
                    </div>
                    <div>
                        <p>
                            <?= isset($_GET["error1"]) ? base64_decode($_GET["error1"]) : "" ?>
                        </p>
                    </div>
                    <div class="item_update_btn">
                        <input id="update_submit" type="submit" value="Update Item" name="update_submit">
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<?php require_once("./02_foot.php") ?>