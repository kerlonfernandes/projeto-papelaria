<?php
session_start();



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    require "./components/header.php";
    require "./inc/assets.inc.php";
    require "./inc/css_files.inc.php";

    ?>
</head>

<body>
<div id="overlay">
        <div class="spinner"></div>
    </div>
    <?php 
print_r($route);
    ?>

    <?php
    require "./inc/js_files.inc.php";
    ?>
</body>

</html>