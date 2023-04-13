<?php require_once("./01_head.php") ?>
<?php
$i = 0;
try {
    require_once("./php/orders_make.fun.php");

    $result = selectAllItemOFConnectedDistributors($_SESSION["user_id"]);
    if (isset($_POST["make_order"], $_POST["item_select"], $_POST["item_quantity"])) {
        $result1 = createOrder($_SESSION["user_id"], $_POST["item_select"], $_POST["item_quantity"]);
        errorsForCreateOrder($result1);
    }
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>

<div class="container">
    <div class="row">
        <div class="col-12 w3-xlarge">
            <?php if (isset($_GET["error"])) : ?>
                <?php if (base64_decode($_GET["error"]) == "None") : ?>
                    <div class="w3-panel w3-green w3-round w3-xlarge">
                        <span class="w3-left p-1">Order make successully!</span>
                        <span style="cursor:pointer;" onclick="this.parentElement.style.display='none'" class="w3-right w3-hover-text-black p-1">&times;</span>
                    </div>
                <?php else : ?>
                    <div class="w3-panel w3-red w3-round w3-xlarge">
                        <span class="w3-left"><?= base64_decode($_GET["error"]) ?></span>
                        <span style="cursor:pointer;" onclick="this.parentElement.style.display='none'" class="w3-right w3-hover-text-black">&times;</span>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <form method="post" class="row">
        <div class="col-12 my-3">
            <input class="w3-button w3-black w3-hover-purple w3-round-large w3-large w3-right" type="submit" value="Make Order" name="make_order" id="submitBtn">
        </div>
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
                            <div class="mb-3">
                                <input class="w3-check w3-small" type="checkbox" id="<?= $data["item_id"] . $i; ?>" name="item_select[<?= $data["f_provider_id"] ?>][]" value="<?= $data["item_id"] ?>">
                                <label for="<?= $data["item_id"] . $i++; ?>">add to cart</label>
                            </div>
                            <div>
                                <label>Quantity</label>
                                <input class="w3-input w3-border w3-round-large" type="number" placeholder="input quantity" name="item_quantity[<?= $data["item_id"] ?>]" min="1" max="<?= $data["quantity"] ?>">
                            </div>
                        </div>
                        <div class="card-footer">
                            <span><?= $data["mrp"] ?> &#8377;</span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </form>
</div>

<?php require_once("./02_foot.php") ?>