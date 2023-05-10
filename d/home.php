<?php require_once("./01_head.php") ?>
<?php
try {
    require_once("./php/home.fun.php");

    $data = selectAllInformation($_SESSION["user_id"]);
} catch (Exception $e) {
    echo "ERROR MESSAGE: " . $e->getMessage();
}
?>

<style>
/* Internal CSS */
h1, h4 {
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.lead {
    font-size: 1.2rem;
    line-height: 1.5;
}

.col-md-6 {
    margin-top: 40px;
}

/* Inline CSS */
h1 {
    animation: slide-in-fwd-center 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
}

@keyframes slide-in-fwd-center {
  0% {
    transform: translateZ(-1400px) rotateX(90deg);
    opacity: 0;
  }
  100% {
    transform: translateZ(0) rotateX(0);
    opacity: 1;
  }
}

</style>

<div class="container" style="min-height: 100vh;">
    <div class="row">
        <h1 class="mb-4">Distributor-Home</h1>
        <h1 class="mb-4"><?= $_SESSION["user_id"] ?></h1>
        
        <div class="col-md-6">
            <h4 class="mb-2">Name:</h4>
            <p class="lead"><?= $data["name"] ?></p>

            <h4 class="mb-2">Address:</h4>
            <p class="lead"><?= $data["address"] ?></p>

            <h4 class="mb-2">Email:</h4>
            <p class="lead"><?= $data["email"] ?></p>
        </div>

        <div class="col-md-6">
            <h4 class="mb-2">Amount:</h4>
            <p class="lead"><?= $data["amount"] ?></p>

            <h4 class="mb-2">Total Connected Clients:</h4>
            <p class="lead"><?= $data["total_connected_client"] ?></p>

            <h4 class="mb-2">Total Connected Providers:</h4>
            <p class="lead"><?= $data["total_connected_provider"] ?></p>
        </div>
    
    </div>
</div>

<?php require_once("./02_foot.php") ?>