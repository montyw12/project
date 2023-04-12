<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/sellers_all.fun.php");

    $result = selectAllSellers($_SESSION["user_id"]);
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

<div class="container">
    <div class="row">
        <?php while ($data = isset($result) ? mysqli_fetch_assoc($result) : null) : ?>
            <div class="col-12">
                <div class="card my-3 w3-xlarge w3-border-black w3-leftbar">
                    <div class="card-header">
                        <?= $data["user_id"] ?>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Name: <?= $data["name"] ?></p>
                        <p class="card-text">Email: <?= $data["email"] ?></p>
                        <p class="card-text">Address: <?= $data["address"] ?></p>
                    </div>
                    <div class="card-footer">
                        <form method="post">
                            <?php if ($data["status"] == 0) : ?>
                                <button class="w3-button w3-green w3-round-large w3-hover-purple" name="Connect" value="<?= $data["user_id"] ?>">Connect</button>
                            <?php elseif ($data["status"] == 1 || $data["status"] == 2) : ?>
                                <button class="w3-button w3-yellow w3-round-large w3-hover-purple" name="Pending" value="<?= $data["user_id"] ?>" disabled>Pending</button>
                            <?php elseif ($data["status"] == 3) : ?>
                                <button class="w3-button w3-red w3-round-large w3-hover-purple" name="Disconnect" value="<?= $data["user_id"] ?>">Disconnect</button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php require_once("./02_foot.php") ?>