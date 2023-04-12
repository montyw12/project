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
            $_GET["error"] = null;
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

<div class="container">
    <div class="row my-3">
        <div class="col-12 w3-xlarge">
            <?php if (isset($_GET["error"])) : ?>
                <?php if (base64_decode($_GET["error"]) == "None") : ?>
                    <div class="w3-panel w3-green w3-round">
                        <span class="w3-left p-1">Order make successully!</span>
                        <span style="cursor:pointer;" onclick="this.parentElement.style.display='none'" class="w3-right w3-hover-text-black p-1">&times;</span>
                    </div>
                <?php else : ?>
                    <div class="w3-panel w3-red w3-round">
                        <span class="w3-left"><?= base64_decode($_GET["error"]) ?></span>
                        <span style="cursor:pointer;" onclick="this.parentElement.style.display='none'" class="w3-right w3-hover-text-black">&times;</span>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="row my-3" align="center">
        <div class="col-12">
            <form method="post">
                <select class="w3-select w3-round-large" id="dropdown" name="search_by" style="width: 12%; height: 45px; padding-left: 12px;">
                    <option value="item_id">Item id</option>
                    <option value="name">Name</option>
                    <option value="type">Type</option>
                    <option value="mrp">Mrp</option>
                    <option value="quantity">Quantity</option>
                    <option value="manufacture_date">Manufacture date</option>
                    <option value="Expire_date">Expire date</option>
                </select>
                <input class="w3-input w3-border w3-round-large" id="keyword" type="text" name="key_word" required value="<?= $a->key_word ?? ""; ?>" style="width: 25%; display: inline; height: 45px;">
                <input class="w3-button w3-blue w3-hover-purple w3-round-large" id="submit" type="submit" value="&#128269; Search" name="search" style="height: 45px;">
            </form>
        </div>
    </div>
    <div class="row my-3">
        <?php while ($data = isset($result) ? mysqli_fetch_assoc($result) : null) : ?>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="card-deck">
                    <div class="card my-3 w3-border-black w3-xlarge w3-card-2">
                        <div class="card-header">
                            <?= $data["item_id"] ?>
                        </div>
                        <img class="card-img-top" src="./../<?= $data["image"] ?>" alt="<?= $data["item_id"] ?>" style="max-height: 200px;">
                        <div class="card-body">
                            <p class="card-title">Name: <?= $data["name"] ?></p>
                            <p class="card-text">Type: <?= $data["type"] ?> </p>
                            <p class="card-text">Manufacture date: <?= $data["manufacture_date"] ?> </p>
                            <p class="card-text">Expire date: <?= $data["expire_date"] ?> </p>
                            <p class="card-text">Quantity: <?= $data["quantity"] ?> </p>
                        </div>
                        <div class="card-footer">
                            <span><?= $data["mrp"] ?> &#8377;</span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php require_once("./02_foot.php") ?>