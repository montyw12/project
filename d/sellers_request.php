<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/sellers_request.fun.php");
    $result = selectRequestForDistributors($_SESSION["user_id"]);
    if (isset($_POST["accept"])) {
        $result1 = acceptRequestFromSellers($_SESSION["user_id"], $_POST["accept"]);
        errorsForAcceptRequestFromSellers($result1);
    }
    if (isset($_POST["reject"])) {
        $result2 = rejectRequestFromSellers($_SESSION["user_id"], $_POST["reject"]);
        errorsForRejectRequestFromSellers($result2);
    }
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>
<main>
    <ul class="subul">
        <li><a href="./sellers_all.php" class="sublink">All</a></li>
        <li><a href="./sellers_connected.php" class="sublink">Connected</a></li>
        <li><a href="./sellers_request.php" class="sublink">Request</a></li>
    </ul>
    <div class="main-section">
        <form method="POST">
            <?php while ($data = isset($result) ? mysqli_fetch_assoc($result) : null) : ?>
                <?php print_r($data) ?>
                <button value="<?= $data["user_id"] ?>" name="accept">Accept</button>
                <button value="<?= $data["user_id"] ?>" name="reject">Reject</button>
                <br>
            <?php endwhile; ?>
        </form>
    </div>
</main>

<?php require_once("./02_foot.php") ?>