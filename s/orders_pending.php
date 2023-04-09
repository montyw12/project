<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/orders_pending.fun.php");

    $result = selectPendingOrders($_SESSION["user_id"]);
    if(isset($_POST["cancel_order"])){
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
        <li><a href="./orders_make.php" class="sublink">Make</a></li>
        <li><a href="./orders_pending.php" class="sublink">Pending</a></li>
    </ul>
    <div class="main-section">
        <div>
            <p><?= isset($_GET["error"]) ? base64_decode($_GET["error"]) : "" ?></p>
        </div>
        <?php while ($data = isset($result) ? mysqli_fetch_assoc($result) : null) : ?>
            <div>
                <?php var_dump($data); ?>
                <form method="post">
                    <button name="cancel_order" value="<?= $data["order_id"] ?>">Cancel Order</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<?php require_once("./02_foot.php") ?>