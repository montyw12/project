<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/products_update.fun.php");
    if (isset($_POST["submit"])) {
        $result = selectItemForUpdate($_POST["search_by"], $_POST["key_word"]);
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
                        <label for="">Search by:</label>
                    </td>
                    <td>
                        <select name="search_by">
                            <option value="select">Select</option>
                            <option value="item_id">Item id</option>
                            <option value="name">Name</option>
                            <option value="type">Type</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Input keyword</label>
                    </td>
                    <td>
                        <input type="text" name="key_word">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Search">
                    </td>
                </tr>
            </table>
        </form>
        <?php while ($data = mysqli_fetch_assoc($result)) : ?>
            <form method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>
                            <label for="">Item type:</label>
                        </td>
                        <td>
                            <input type="text" name="type" required value="<?= $data["type"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Item name:</label>
                        </td>
                        <td>
                            <input type="text" name="name" required value="<?= $data["name"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Item mrp:</label>
                        </td>
                        <td>
                            <input type="number" name="mrp" step="0.01" min="0.00" max="100000.00" required value="<?= $data["mrp"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Item quantity:</label>
                        </td>
                        <td>
                            <input type="number" name="quantity" min="0" max="10000" required value="<?= $data["quantity"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Item manufacture date:</label>
                        </td>
                        <td>
                            <input type="date" name="manufacture_date" required value="<?= $data["manufacture_date"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Item expire date:</label>
                        </td>
                        <td>
                            <input type="date" name="expire_date" required value="<?= $data["expire_date"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Item image:</label>
                        </td>
                        <td>
                            <input type="file" name="image" required value="<?= $data["image"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Create Item" name="submit">
                        </td>
                    </tr>
                </table>
            </form>
        <?php endwhile; ?>
    </div>
</main>

<?php require_once("./02_foot.php") ?>