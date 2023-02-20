<?php require_once("./01_head.php") ?>
<link rel="stylesheet" type="text/css" href="./css/products.css">
<link rel="stylesheet" type="text/css" href="./css/products_show.css">
<?php
try {
    require_once("./php/product_create.fn.php");
    if (isset($_POST["submit"])) {
        $result = item_insert($_SESSION["user_id"], $_POST["type"], $_POST["name"], $_POST["mrp"], $_POST["quantity"], $_POST["manufacture_date"], $_POST["expire_date"], $_FILES["image"]);
        var_dump($result);
    }
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>

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
                        <input type="text" name="type" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Item name:</label>
                    </td>
                    <td>
                        <input type="text" name="name" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Item mrp:</label>
                    </td>
                    <td>
                        <input type="number" name="mrp" step="0.01" min="0.00" max="100000.00" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Item quantity:</label>
                    </td>
                    <td>
                        <input type="number" name="quantity" min="0" max="10000" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Item manufacture date:</label>
                    </td>
                    <td>
                        <input type="date" name="manufacture_date" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Item expire date:</label>
                    </td>
                    <td>
                        <input type="date" name="expire_date" required>
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
                        <input type="submit" value="Create Item" name="submit">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</main>

<?php require_once("./02_foot.php") ?>