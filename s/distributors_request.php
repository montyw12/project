<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/distributors_request.fun.php");
    $result = selectRequestForSellers($_SESSION["user_id"]);
    if (isset($_POST["accept"])) {
        $result1 = acceptRequestFromDistributors($_SESSION["user_id"], $_POST["accept"]);
        errorsForAcceptRequestFromDistributors($result1);
    }
    if (isset($_POST["reject"])) {
        $result2 = rejectRequestFromDistributors($_SESSION["user_id"], $_POST["reject"]);
        errorsForRejectRequestFromDistributors($result2);
    }
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>
<main>
    <ul class="subul">
        <li><a href="./distributors_all.php" class="sublink">All</a></li>
        <li><a href="./distributors_connected.php" class="sublink">Connected</a></li>
        <li><a href="./distributors_request.php" class="sublink">Request</a></li>
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