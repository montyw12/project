<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signout Page</title>
</head>

<body>
    <?php
    session_unset();
    session_destroy();
    header("location: ./01_signin.php?status=signout");
    ?>
</body>

</html>