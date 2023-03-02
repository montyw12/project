<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/distributors_all.fun.php");

    $result = selectAllDistributors();
    if (isset($_POST["Connect"])) {
        $result1 = requestForConnect($_SESSION["user_id"], $_POST["Connect"]);
        errorsForRequestForConnect($result1);
    } else if (isset($_POST["Disconnect"])) {
        $result2 = disconnectDistributor($_SESSION["user_id"], $_POST["Disconnect"]);
        errorsForDisconnectDistributor($result2);
    }
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>
<main>
    <ul class="subul">
        <li><a href="./distributors_connected.php" class="sublink">connected</a></li>
        <li><a href="./distributors_all.php" class="sublink">all</a></li>
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