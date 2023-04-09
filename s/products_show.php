<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/products_show.fun.php");

    $a = isset($_GET["a"]) ? json_decode(base64_decode($_GET["a"])) : "";
    if (isset($_POST["search"])) {
        $result = selectSpecificItem($_POST["search_by"], $_POST["key_word"], $_SESSION["user_id"]);
        if ((gettype($result) === "integer" ? $result : 0) > 0) {
            errorsForSelectSpecificItem($result, $_POST);
        } else {
            $_GET["error"] = base64_encode("");
        }
    } else {
        $result = selectAllItem($_SESSION["user_id"]);
        if ((gettype($result) === "integer" ? $result : 0) > 0) {
            errorsForSelectAllItem($result);
        }
    }
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>
<link rel="stylesheet" type="text/css" href="./css/products.css">
<link rel="stylesheet" type="text/css" href="./css/products_show.css">

<link rel="stylesheet" type="text/css" href="./css/products.css">
<div class="main">
    <div class="subul">
        <div id="show_product">
            <a href="./products_show.php" class="sublink">Show Products</a>
        </div>
    </div>
    <hr>
    <div class="main-section">
        <div class="search-item">
            <form method="post">
                <select id="dropdown" name="search_by">
                    <option value="item_id">Item id</option>
                    <option value="name">Name</option>
                    <option value="type">Type</option>
                    <option value="mrp">Mrp</option>
                    <option value="quantity">Quantity</option>
                    <option value="manufacture_date">Manufacture date</option>
                    <option value="Expire_date">Expire date</option>
                </select>
                <input id="keyword" type="text" name="key_word" required value="<?= $a->key_word ?? ""; ?>">
                <input id="submit" type="submit" value="&#128269;" name="search">
            </form>
        </div>
        <div class="all-items">
            <?php while ($data = mysqli_fetch_assoc($result)) : ?>
            <div class="item">
                <div class="inner-item-id">
                    <h1 class="item_id "><?= $data["item_id"] ?></h1>
                </div>
                <div class="images">
                    <img class="imgs" src="./../<?= $data["image"] ?>" alt="<?= $data["item_id"] ?>">
                </div>
                <div>
                    <p class="name_text">Name:</p>
                    <h2 class="name"><?= $data["name"] ?></h2>
                </div>
                <div>
                    <p class="quantity_text">Quantity:</p>
                    <p class="quntity"><?= $data["quantity"] ?></p>
                </div>
                <div>
                    <P class="manufacture_date_text">Manufacture date:</P>
                    <p class="manufacture_date"><?= $data["manufacture_date"] ?></p>
                </div>
                <div>
                    <p class="expire_date_text">Expire date:</p>
                    <p class="expire_date"><?= $data["expire_date"] ?></p>
                </div>
                <div class="mrp_section">
                    <p class="mrp"> <?= $data["mrp"] ?></p>    
                    <p class="mrp_text">&#8377;</p>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<?php require_once("./02_foot.php") ?>