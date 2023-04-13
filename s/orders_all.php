<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/orders_all.fun.php");

    $result = selectAllOrders($_SESSION["user_id"]);
    if (isset($_POST["mark_done"])) {
        $result1 = setOrderAsMarkDone($_SESSION["user_id"], $_POST["mark_done"]);
        errorsForSetOrderAsMarkDone($result1);
    }
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <?php if (isset($_GET["error"])) : ?>
                <?php if (base64_decode($_GET["error"]) == "None") : ?>
                    <div class="w3-panel w3-green w3-round w3-xlarge">
                        <span class="w3-left">Order mark done!</span>
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
                <div class="card my-3 w3-xlarge w3-leftbar w3-card-2 <?= $data["status"] == 1 ? "w3-border-red" : ($data["status"] == 2 ? "w3-border-yellow" : "w3-border-green") ?>">
                    <div class="card-header">
                        <?= $data["order_id"] ?>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Order Date: <?= $data["order_date"] ?></p>
                        <p class="card-text">No of item in Order: <?= $data["item_no"] ?></p>
                        <?php if ($data["status"] == 3) : ?>
                            <p class="card-text">Dispatch date: <?= $data["dispatch_date"] ?></p>
                            <p class="card-text">Delivery date: <?= $data["delivery_date"] ?></p>
                        <?php endif; ?>
                        <?php if (substr($data["f_provider_id"], 0, 2) == "0D") : ?>
                            <p class="card-text">Provider id: <?= $data["f_provider_id"] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer">
                        <?php if ($data["status"] == 1) : ?>
                            <span>
                                Status: Order Pending...
                            </span>
                        <?php elseif ($data["f_provider_id"] == $_SESSION["user_id"] && $data["status"] != 3) : ?>
                            <span>
                                Status: Order Dispatch
                            </span>
                        <?php elseif ($data["status"] == 2) : ?>
                            <form method="post">
                                <P>Dispatch Date: <?= $data["dispatch_date"] ?></P>
                                <P>Delivery Date: <?= $data["delivery_date"] ?></P>
                                <button class="btn btn-warning" <?= strtotime(date("Y-m-d")) <= strtotime($data["delivery_date"]) ? "disabled" : "" ?> name="mark_done" value="<?= $data["order_id"] ?>">Mark Done</button>
                            </form>
                        <?php elseif ($data["status"] == 3) : ?>
                            <span>
                                Status: Order Delivered
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php require_once("./02_foot.php") ?>