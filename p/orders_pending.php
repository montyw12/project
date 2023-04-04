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
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>
<main>
    <ul class="subul">
        <li><a href="./orders_all.php" class="sublink">All</a></li>
        <li><a href="./orders_pending.php" class="sublink">Pending</a></li>
    </ul>
    <div class="main-section">
        <div>
            <p><?= isset($_GET["error"]) ? base64_decode($_GET["error"]) : "" ?></p>
        </div>
        <?php while ($data = isset($result) ? mysqli_fetch_assoc($result) : null) : ?>
            <div>
                <?php var_dump($data); ?>
                <div class="form">
                    <form method="post">
                        <button value="<?= $data["order_id"] ?>" name="dispatch_order">Dispatch order</button>
                        <input type="date" min="<?= date("Y-m-d"); ?>" name="delivery_date[<?= $data['order_id']; ?>]" required>
                    </form>
                    <form method="post">
                        <button name="cancel_order" value="<?= $data["order_id"] ?>">Cancel Order</button>
                    </form>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<?php require_once("./02_foot.php") ?>