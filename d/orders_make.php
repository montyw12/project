<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/orders_make.fun.php");

    $result = selectAllItemOFConnectedProducers($_SESSION["user_id"]);
    
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
    <?php
    while($data = isset($result) ? mysqli_fetch_assoc($result) : null){
        var_dump($data);
        echo "<br/>";
    }
    ?>
    </div>
</main>

<?php require_once("./02_foot.php") ?>