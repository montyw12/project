<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/expire_show.fun.php");

    $a = isset($_GET["a"]) ? json_decode(base64_decode($_GET["a"])) : "";
    if (isset($_POST["search"])) {
        $result = selectSpecificExpireItem($_POST["expire_days"], $_SESSION["user_id"]);
    }
    $whileIteration = 0;
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>

<div class="container" style="min-height: 100vh">
    <div class="row my-3">
        <div class="col-12 w3-xlarge">
            <?php if (isset($_GET["error"])) : ?>
                <?php if (base64_decode($_GET["error"]) == "None") : ?>
                    <div class="w3-panel w3-green w3-round">
                        <span class="w3-left p-1">ABC</span>
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
                <input class="w3-input w3-border w3-round-large" type="number" name="expire_days" min="1" max="1000" required style="width: 25%; display: inline; height: 45px;" placeholder="Search">
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
            <?php $whileIteration++; ?>
        <?php endwhile; ?>
        <?php if ($whileIteration == 0) : ?>
            <div class="col-12 mt-5 text-muted" style="text-align: center;">
                <h5>Show expired products section is empty!</h5>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once("./02_foot.php") ?>