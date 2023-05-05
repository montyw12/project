<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/products_create.fun.php");

    $a = isset($_GET["a"]) ? json_decode(base64_decode($_GET["a"])) : "";
    if (isset($_POST["submit"])) {
        $result = insertItem($_SESSION["user_id"], $_POST["type"], $_POST["name"], $_POST["mrp"], $_POST["quantity"], $_POST["manufacture_date"], $_POST["expire_date"], $_FILES["image"]);
        errorsForInsertItem($result, $_POST);
    }
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>

<div class="container" style="min-height: 100vh">
    <div class="row my-3">
        <div class="col-12 w3-xlarge">
            <?php if (isset($_GET["error"])) : ?>
                <?php if (base64_decode($_GET["error"]) == "None") : ?>
                    <div class="w3-panel w3-green w3-round">
                        <span class="w3-left">Item Created Successfully!</span>
                        <span style="cursor:pointer;" onclick="this.parentElement.style.display='none'" class="w3-right w3-hover-text-black">&times;</span>
                    </div>
                <?php else : ?>
                    <div class="w3-panel w3-red w3-round">
                        <span class="w3-left"><?= base64_decode($_GET["error"]) ?></span>
                        <span style="cursor:pointer;" onclick="this.parentElement.style.display='none'" class="w3-right w3-hover-text-black">&times;</span>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-xl-2 col-lg-0 col-md-0 col-sm-0"></div>
        <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 w3-large">
            <form class="w3-border w3-round-large p-3" method="post" enctype="multipart/form-data">
                <label>Item type:</label>
                <input class="w3-input w3-border w3-round-large my-1 mb-3" type="text" name="type" required value="<?= $a->type ?? $data["type"] ?? "" ?>" placeholder="input type">

                <label>Item name:</label>
                <input class="w3-input w3-border w3-round-large my-1 mb-3" type="text" name="name" required value="<?= $a->name ?? $data["name"] ?? "" ?>" placeholder="input name">

                <label>Item mrp:</label>
                <input class="w3-input w3-border w3-round-large my-1 mb-3" type="number" name="mrp" step="0.01" min="0.00" max="100000.00" required value="<?= $a->mrp ?? $data["mrp"] ?? "" ?>" placeholder="input mrp">

                <label>Item quantity:</label>
                <input class="w3-input w3-border w3-round-large my-1 mb-3" type="number" name="quantity" min="0" max="10000" required value="<?= $a->quantity ?? $data["quantity"] ?? "" ?>" placeholder="input quantity">

                <label>Item manufacture date:</label>
                <input class="w3-input w3-border w3-round-large my-1 mb-3" type="date" name="manufacture_date" required value="<?= $a->manufacture_date ?? $data["manufacture_date"] ?? "" ?>">

                <label>Item expire date:</label>
                <input class="w3-input w3-border w3-round-large my-1 mb-3" type="date" name="expire_date" required value="<?= $a->expire_date ?? $data["expire_date"] ?? "" ?>">

                <label>Item image:</label>
                <input class="w3-input w3-border w3-round-large my-1 mb-3" type="file" name="image" required value="<?= $a->image ?? $data["image"] ?? "" ?>">

                <input class="w3-button w3-blue w3-hover-purple w3-border w3-round-large my-1" type="submit" value="Create Item" name="submit">
            </form>
        </div>
        <div class="col-xl-2 col-lg-0 col-md-0 col-sm-0"></div>
    </div>
</div>

<?php require_once("./02_foot.php") ?>