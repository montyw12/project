<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/producers_request.fun.php");
    $result = selectRequestForDistributors($_SESSION["user_id"]);
    if (isset($_POST["accept"])) {
        $result1 = acceptRequestFromProducers($_SESSION["user_id"], $_POST["accept"]);
        errorsForAcceptRequestFromProducers($result1);
    }
    if (isset($_POST["reject"])) {
        $result2 = rejectRequestFromProducers($_SESSION["user_id"], $_POST["reject"]);
        errorsForRejectRequestFromProducers($result2);
    }
    $whileIteration = 0;
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>

<div class="container" style="min-height: 100vh">
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
                            <button class="w3-button w3-green w3-round-large w3-hover-purple my-3" name="accept" value="<?= $data["user_id"] ?>">Accept</button>
                            <button class="w3-button w3-red w3-round-large w3-hover-purple my-3" name="reject" value="<?= $data["user_id"] ?>">Reject</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php $whileIteration++; ?>
        <?php endwhile; ?>
        <?php if ($whileIteration == 0) : ?>
            <div class="col-12 mt-5 text-muted" style="text-align: center;">
                <h5>No request from any producers!</h5>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once("./02_foot.php") ?>