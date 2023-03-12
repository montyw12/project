<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/products_create.fun.php");

    $a = isset($_GET["a"]) ? json_decode(base64_decode($_GET["a"])) : "";
    if (isset($_POST["submit"])) {
        $result = insertItem($_SESSION["user_id"], $_POST["type"], $_POST["name"], $_POST["mrp"], $_POST["quantity"], $_POST["manufacture_date"], $_POST["expire_date"], $_FILES["image"]);
        if ($result === 0) {
            $_GET["error"] = base64_encode("Item Created Successfully!");
        } else {
            errorsForInsertItem($result, $_POST);
        }
    }
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>
<link rel="stylesheet" type="text/css" href="./css/products.css">
<link rel="stylesheet" type="text/css" href="./css/products_create.css">

<link rel="stylesheet" type="text/css" href="./css/products.css">
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
        <div class="item-section">
            <form method="post" enctype="multipart/form-data">
            <div class="item_block">
                <div>
                    <label id="item-type_text" for="">Item type:</label>
                    <input id="item_type" type="text" name="type" required value="<?= $a->type ?? ""; ?>">
                </div>
                <div>
                    <label for="" id="item_name_text">Item name:</label>
                    <input id="item_name" type="text" name="name" required value="<?= $a->name ?? ""; ?>">
                </div>
                <div>
                    <label for="" id="item_mrp_text">Item mrp:</label>
                    <input id="item_mrp" type="number" name="mrp" step="0.01" min="0.00" max="100000.00" required value="<?= $a->mrp ?? ""; ?>">
                </div>
                <div>
                    <label for="" id="item_quantity_text">Item quantity:</label>
                    <input id="item_quantity" type="number" name="quantity" min="0" max="10000" required value="<?= $a->quantity ?? ""; ?>">
                </div>
                <div>
                    <label for="" id="item_manufacturedate_text">Item manufacture date:</label>
                    <input id="item_manufacturedate" type="date" name="manufacture_date" required value="<?= $a->manufacture_date ?? ""; ?>">
                </div>
                <div>
                    <label for="" id="item_expiredate_text">Item expire date:</label>
                    <input id="item_expiredate" type="date" name="expire_date" required value="<?= $a->expire_date ?? ""; ?>">
                </div>
                <div>
                    <label for="" id="item_img_text">Item image:</label>
                    <input id="item_img" type="file" name="image" required>
                </div>
                <div>
                    <p><?= isset($_GET["error"]) ? base64_decode($_GET["error"]) : "" ?></p>
                </div>
                <div class="item_create_btn">
                    <input id="create_item" type="submit" value="Create Item" name="submit">
                </div>
            </div>    
            </form>
        </div>
    </div>
</div>

<?php require_once("./02_foot.php") ?>