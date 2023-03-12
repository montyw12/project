<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/orders_make.fun.php");

    $result = selectAllItemOFConnectedProducers($_SESSION["user_id"]);
    if(isset($_POST["make_order"])){
        checkDetailsForMakeOrders($_SESSION["user_id"],$_POST["item_select"],$_POST["item_quantity"]);
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
        <form method="post">
            <input type="submit" value="Make Order" name="make_order">
            <?php
            while ($data = isset($result) ? mysqli_fetch_assoc($result) : null) :
                var_dump($data);
            ?>
                <input type="checkbox" name="item_select[<?= $data["f_producer_id"] ?>]" value="<?= $data["item_id"] ?>">
                <input type="number" name="item_quantity[<?= $data["item_id"] ?>]" min="1" max="1000">
            <?php
                echo "<br/>";
            endwhile;
            ?>
        </form>
    </div>
</main>

<?php require_once("./02_foot.php") ?>