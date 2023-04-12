<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/sellers_connected.fun.php");

    $result = selectAllConnectedSellers($_SESSION["user_id"]);
    if (isset($_POST["Disconnect"])) {
        $result1 = disconnectSellers($_SESSION["user_id"], $_POST["Disconnect"]);
        errorsForDisconnectSellers($result1);
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
                            <button class="w3-button w3-red w3-round-large w3-hover-purple" name="Disconnect" value="<?= $data["user_id"] ?>">Disconnect</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php require_once("./02_foot.php") ?>