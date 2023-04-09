<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/orders_all.fun.php");

    $result = selectAllOrders($_SESSION["user_id"]);
    if(isset($_POST["mark_done"])){
        $result1 = setOrderAsMarkDone($_SESSION["user_id"], $_POST["mark_done"]);
        errorsForSetOrderAsMarkDone($result1);
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
                <?php if($data["status"] == 1) : ?>
                    <p>Order Pending...</p>
                <?php elseif($data["status"] == 2) : ?>
                    <form method="post">
                        <P>Dispatch Date: <?= $data["dispatch_date"] ?></P>
                        <P>Delivery Date: <?= $data["delivery_date"] ?></P>
                        <button <?= strtotime(date("Y-m-d")) <= strtotime($data["delivery_date"]) ? "disabled" : "" ?> name="mark_done" value="<?= $data["order_id"] ?>" >Mark Done</button>
                    </form>
                <?php elseif($data["status"] == 3) : ?>
                    <p>Order Delivered</p>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<?php require_once("./02_foot.php") ?>