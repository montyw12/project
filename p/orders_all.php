<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/orders_all.fun.php");

    $result = selectAllOrders($_SESSION["user_id"]);
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
                <?php if($data["status"] == 1) : ?>
                    <p>Order Pending...</p>
                    <?php elseif($data["status"] == 2) : ?>
                        <p>Order Dispatched</p>
                <?php elseif($data["status"] == 3) : ?>
                    <p>Order Delivered</p>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<?php require_once("./02_foot.php") ?>