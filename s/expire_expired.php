<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/expire_expired.fun.php");

    $result = selectExpiredItems($_SESSION["user_id"]);
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>
<div class="main">
    <div class="subul">
        <div id="show_product">
            <a href="./expire_show.php" class="sublink">Show expire item</a>
        </div>
        <div id="show_product">
            <a href="./expire_expired.php" class="sublink">Expired item</a>
        </div>
    </div>
    <div class="all-items">
        <?php while ($data = isset($result) ? mysqli_fetch_assoc($result) : null) : ?>
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

<?php require_once("./02_foot.php") ?>