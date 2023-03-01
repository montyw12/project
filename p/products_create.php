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
<link rel="stylesheet" type="text/css" href="./css/products_show.css">

<main>
    <ul class="subul">
        <li><a href="./products_show.php" class="sublink">Show Products</a></li>
        <li><a href="./products_update.php" class="sublink">Update Products</a></li>
        <li><a href="./products_create.php" class="sublink">Create Products</a></li>
    </ul>
    <div class="main-section">
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        <label for="">Item type:</label>
                    </td>
                    <td>
                        <input type="text" name="type" required value="<?= isset($a->type) ? $a->type : ""; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Item name:</label>
                    </td>
                    <td>
                        <input type="text" name="name" required value="<?= isset($a->name) ? $a->name : ""; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Item mrp:</label>
                    </td>
                    <td>
                        <input type="number" name="mrp" step="0.01" min="0.00" max="100000.00" required value="<?= isset($a->mrp) ? $a->mrp : ""; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Item quantity:</label>
                    </td>
                    <td>
                        <input type="number" name="quantity" min="0" max="10000" required value="<?= isset($a->quantity) ? $a->quantity : ""; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Item manufacture date:</label>
                    </td>
                    <td>
                        <input type="date" name="manufacture_date" required value="<?= isset($a->manufacture_date) ? $a->manufacture_date : ""; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Item expire date:</label>
                    </td>
                    <td>
                        <input type="date" name="expire_date" required value="<?= isset($a->expire_date) ? $a->expire_date : ""; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Item image:</label>
                    </td>
                    <td>
                        <input type="file" name="image" required>
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
                    <td>
                        <input type="submit" value="Create Item" name="submit">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</main>

<?php require_once("./02_foot.php") ?>