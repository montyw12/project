<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/home.fun.php");

    $data = selectAllInformation($_SESSION["user_id"]);
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>

<div class="container" style="min-height: 100vh">
    <div class="row">
        <h1>Distributor-Home</h1>
        <h1><?= $_SESSION["user_id"] ?></h1>
        <?php print_r($data) ?>
    </div>
</div>

<?php require_once("./02_foot.php") ?>