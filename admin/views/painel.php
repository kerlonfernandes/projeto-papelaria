<?php

use Midspace\Database;
use HelpersClass\SupAid;

$helpers = new SupAid;
$db = new Database(MYSQL_CONFIG);

$pedidos_abertos = $db->execute_query("SELECT COUNT(id) AS p_abertos FROM `pedidos` WHERE status_pedido = 'Em aberto';")->results[0];
$finalizados = $db->execute_query("SELECT COUNT(id) AS p_finalizados FROM `pedidos` WHERE status_pedido = 'Finalizado';")->results[0];
$a_entregar = $db->execute_query("SELECT COUNT(id) AS p_a_entregar FROM `pedidos` WHERE status_pedido = 'A entregar';")->results[0];
$aguardando_reembolso = $db->execute_query("SELECT COUNT(id) AS a_reembolso FROM `pedidos` WHERE aguardando_reembolso = 1; ")->results[0];
$usuarios = $db->execute_query("SELECT COUNT(id) AS usuarios_qtd FROM users;
    ")->results[0];
$prod_cad = $db->execute_query("SELECT COUNT(id) AS produtos_qtd FROM produtos;")->results[0];
$dados_admin = $db->execute_query("SELECT * FROM users WHERE id = :id", [":id" => $_SESSION["id_admin"]])->results[0];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?= SITE ?>/src/css/home.css">
    <link rel="stylesheet" href="<?= SITE ?>/src/css/admin.css">

    <link rel="stylesheet" href="<?= SITE ?>/src/css/bootstrap.min.css?id=<?= uniqid(); ?>">
    <link rel="stylesheet" href="<?= SITE ?>/src/css/all.min.css?id=<?= uniqid(); ?>">

</head>

<body>
    <div id="overlay">
        <div class="spinner"></div>
    </div>

    <?php require_once "./components/sidebar.php"; ?>

    <div class="content page">

        <div class="menu-icon">
            <i class="fas fa-bars fa-2x"></i>
        </div>
        <div class="alert alert-dark m-2" role="alert">
            <h3 class="d-lg-block" style="font-weight: 600;">
                <?php
                if (isset($_GET['sys'])) {
                    $area = $_GET['sys'];
                    switch ($area) {
                        case "inicio":
                            echo "Início";
                            break;
                        case "users":
                            echo "Usuários";
                            break;
                        case "products";
                            echo "Produtos";
                            break;
                        case "product";
                            echo "Editar produto";
                            break;
                        case "pedidos";
                            echo "Pedidos";
                            break;
                        case "pedido";
                            echo "Pedido ID: {$helpers->decodeURL($_GET['id'])}";
                            break;
                        case "templates-settings";
                            echo "Configurações Gerais";
                            break;
                        case "pagamentos";
                            echo "Pagamentos";
                            break;
                    }
                } else {
                    echo "Início";
                }
                ?>

            </h3>
        </div>
        <?php
        if (isset($_GET["sys"])) {
            $route = rtrim($_GET["sys"], '/');
            $clean_route = filter_var($route, FILTER_SANITIZE_URL);
            $views_dir = 'system/';
            $filePath = $views_dir . $clean_route . '.php';
            if (file_exists($filePath)) {
                require $filePath;
            } else {
                require "system/inicio.php";
            }
        } else {
            require "system/inicio.php";
        }
        ?>
    </div>



    <script src="<?= SITE ?>/src/js/bootstrap.bundle.min.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/src/js/all.min.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/src/js/jquery.min.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/src/js/index.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/src/js/styles/styles.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/src/js/scripts.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/src/js/admin/admin.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/src/js/jquery.mask.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/src/js/styles/masks.js?id=<?= uniqid() ?>"></script>
</body>

</html>