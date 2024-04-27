<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pitágoras Papelaria | Início</title>
    <link rel="icon" type="image/png" href="./src/images/logo.png">
    <?php require_once "./inc/assets.inc.php"; ?>
    <?php require_once "./inc/css_files.inc.php"; ?>

</head>

<body>
    <div id="overlay">
        <div class="spinner"></div>
    </div>

    <?php
    require "./classes/Database.inc.php";

    use Midspace\Database;

    $db = new Database(MYSQL_CONFIG);




    ?>

    <?php include "./components/header.php" ?>
    <?php
    include "./components/caroussel.php"
    ?>
    <div class="horizontal-bar mb-4 d-flex justify-content-center align-items-center">
        <a class="centered-text categorias-titulo mt-3">Destaques</a>
    </div>
    <div class="text-center mt-3" id="loading-destaques" style="display:block;">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="destaques"></div>

    <div class="horizontal-bar mt-5 mb-5  d-flex justify-content-center align-items-center">
        <a href="<?= SITE ?>/categoria/material-escolar" class="centered-text categorias-titulo mt-3">Materiais escolares</a>
    </div>
    <div class="materiais"></div>
    <div class="text-center mt-3" id="loading-materiais" style="display:block;">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="horizontal-bar mt-5 mb-5 d-flex justify-content-center align-items-center">
        <a href="<?= SITE ?>/categoria/materiais-escritorio" class="centered-text categorias-titulo mt-3">Materiais para Escritório</a>
    </div>
    <div class="text-center mt-3" id="loading-materiais-escritorio" style="display:block;">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="materiais-escritorio"></div>

    <div class="horizontal-bar mt-5 mb-5 d-flex justify-content-center align-items-center">
        <a href="<?= SITE ?>/categoria/mochilas" class="centered-text categorias-titulo mt-3">Mochilas</a>
    </div>
    <div class="text-center mt-3" id="loading-mochilas" style="display:block;">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="mochilas"></div>

    <?php include "./components/footer.php" ?>

    <?php require_once "./inc/js_files.inc.php"; ?>


</body>

</html>