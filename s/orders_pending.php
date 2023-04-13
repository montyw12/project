<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/orders_pending.fun.php");

    $result = selectPendingOrders($_SESSION["user_id"]);
    if (isset($_POST["cancel_order"])) {
        $result1 = cancelOrder($_SESSION["user_id"], $_POST["cancel_order"]);
        errorsForCancelOrder($result1);
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
                        <span class="w3-left">Order dispatch successully!</span>
                        <span style="cursor:pointer;" onclick="this.parentElement.style.display='none'" class="w3-right w3-hover-text-black">&times;</span>
                    </div>
                <?php elseif (base64_decode($_GET["error"]) == "None1") : ?>
                    <div class="w3-panel w3-yellow w3-round w3-xlarge">
                        <span class="w3-left">Order cancelled!</span>
                        <span style="cursor:pointer;" onclick="this.parentElement.style.display='none'" class="w3-right w3-hover-text-black">&times;</span>
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
    <div class="row">
        <?php while ($data = isset($result) ? mysqli_fetch_assoc($result) : null) : ?>
            <div class="col-12">
                <div class="card-deck">
                    <div class="card my-3 w3-border-black w3-xlarge">
                        <div class="card-header">
                            <?= $data["order_id"] ?>
                        </div>
                        <div class="card-body">
                            <p class="card-title">Order date: <?= $data["order_date"] ?></p>
                            <p class="card-text">No of item: <?= $data["item_no"] ?> </p>
                            <p class="card-text">Client id: <?= $data["f_client_id"] ?> </p>
                            <p class="card-text">Client name: <?= $data["name"] ?> </p>
                            <p class="card-text">Client email: <?= $data["email"] ?> </p>
                            <?php if ($_SESSION["user_id"] == $data["f_provider_id"]) : ?>
                                <div class="form">
                                    <form method="post">
                                        <button class="w3-button w3-green w3-round-large w3-hover-purple mb-3" value="<?= $data["order_id"] ?>" name="dispatch_order">Dispatch order</button>
                                        <input class="w3-input w3-border w3-round-large" type="date" min="<?= date("Y-m-d"); ?>" name="delivery_date[<?= $data['order_id']; ?>]" required>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer">
                            <form method="post">
                                <button class="w3-button w3-red w3-round-large w3-hover-purple" name="cancel_order" value="<?= $data["order_id"] ?>">Cancel Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php require_once("./02_foot.php") ?>