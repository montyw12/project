<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/orders_pending.fun.php");

    $result = selectPendingOrders($_SESSION["user_id"]);
    if (isset($_POST["dispatch_order"])) {
        $result1 = setOrderDispatchDateAndDeliveryDate($_SESSION["user_id"], $_POST["dispatch_order"], $_POST["delivery_date"]);
        errorsForSetOrderDispatchDateAndDeliveryDate($result1);
    } else if (isset($_POST["cancel_order"])) {
        $result1 = cancelOrder($_SESSION["user_id"], $_POST["cancel_order"]);
        errorsForCancelOrder($result1);
    }
    $whileIteration = 0;
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>

<div class="container" style="min-height: 100vh">
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
                            <p class="card-text">Client id: <?= $data["client_id"] ?> </p>
                            <p class="card-text">Client name: <?= $data["client_name"] ?> </p>
                            <p class="card-text">Client email: <?= $data["client_email"] ?> </p>
                            <p class="card-text">Client address: <?= $data["client_address"] ?> </p>
                            <?php if ($_SESSION["user_id"] == $data["f_provider_id"]) : ?>
                                <div class="form">
                                    <form method="post">
                                        <button class="w3-button w3-green w3-round-large w3-hover-purple mb-3" value="<?= $data["order_id"] ?>" name="dispatch_order">Dispatch order</button>
                                        <div class="w3-row">
                                            <label for="">Set delivery date</label>
                                            <input class="w3-input w3-border w3-round-large" title="set delivery date" type="date" min="<?= date("Y-m-d"); ?>" name="delivery_date[<?= $data['order_id']; ?>]" required style="width:50%;">
                                        </div>
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
            <?php $whileIteration++; ?>
        <?php endwhile; ?>
        <?php if ($whileIteration == 0) : ?>
            <div class="col-12 mt-5 text-muted" style="text-align: center;">
                <h5>No any pending orders!</h5>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once("./02_foot.php") ?>