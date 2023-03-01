<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/products_show.fun.php");
    $a = isset($_GET["a"]) ? json_decode(base64_decode($_GET["a"])) : "";
    if (isset($_POST["search"])) {
        $result = selectSpecificItem($_POST["search_by"], $_POST["key_word"]);
        if((gettype($result)==="integer"? $result : 0) > 0){
            errorsForSelectSpecificItem($result,$_POST);
        } else {
            $_GET["error"] = base64_encode("");
        }
    } else {
        $result = selectAllItem();
        if((gettype($result)==="integer"? $result : 0) > 0){
            errorsForSelectAllItem($result);
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
                        <label for="">Search by:</label>
                    </td>
                    <td>
                        <select name="search_by">
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
                        <input type="text" name="key_word" required value="<?= isset($a->key_word) ? $a->key_word : ""; ?>">
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