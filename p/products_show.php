<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/products_show.fn.php");
    if (isset($_POST["search"])) {
        $result = selectSpecificItem($_POST["search_by"], $_POST["key_word"]);
    } else {
        $result = selectAllItem();
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
                            <option value="mrp">Mrp</option>
                            <option value="quantity">Quantity</option>
                            <option value="manufacture_date">Manufacture date</option>
                            <option value="Expire_date">Expire date</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Input keyword</label>
                    </td>
                    <td>
                        <input type="text" name="key_word" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Search" name="search">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div>
        <?php
        while ($data = mysqli_fetch_assoc($result)) {
            echo "<p>";
            var_dump($data);
            echo "</p>";
        }
        ?>
    </div>
</main>

<?php require_once("./02_foot.php") ?>