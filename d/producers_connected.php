<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/producers_connected.fun.php");

    $result = selectAllConnectedProducers($_SESSION["user_id"]);
    if (isset($_POST["Disconnect"])) {
        $result1 = disconnectProducer($_SESSION["user_id"], $_POST["Disconnect"]);
        errorsForDisconnectProducer($result1);
    }
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>
<main>
    <ul class="subul">
        <li><a href="./producers_all.php" class="sublink">All</a></li>
        <li><a href="./producers_connected.php" class="sublink">Connected</a></li>
        <li><a href="./producers_request.php" class="sublink">Request</a></li>
    </ul>
    <div class="main-section">
        <form method="POST">
            <?php while ($data = isset($result) ? mysqli_fetch_assoc($result) : null) : ?>
                <?php print_r($data);
                $status = checkStatusForBtn($data["status"]) ?>
                <button value="<?= $data["user_id"] ?>" name="<?= $status ?>" <?= $status == "Pending" ? "disabled" : "" ?>><?= $status ?></button>
                <br>
            <?php endwhile; ?>
        </form>
    </div>
</main>

<?php require_once("./02_foot.php") ?>