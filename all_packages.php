<?php
session_start();
include("./functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>
</head>

<body>
    <?php include("./includes/navbar.php"); ?>
    <?php include("./includes/categories.php"); ?>
    <div id="packages_box">
        <?php getSearchResults(); ?>
        <?php getPack(); ?>
        <?php getCatPack(); ?>
        <?php getTypePack(); ?>
    </div>
    <?php include("./includes/footer.php"); ?>
</body>

</html>