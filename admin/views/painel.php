<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?= SITE ?>/src/css/home.css">
    <link rel="stylesheet" href="<?= SITE ?>/src/css/admin.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                if(isset($_GET['sys'])) {
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
                        case "pedidos";
                            echo "Pedidos";
                            break;
                        case "templates-settings";
                            echo "Configurações Gerais";
                            break;
                        case "payments";
                            echo "Pagamentos";
                            break;
                    }
                }
                else {
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= SITE ?>/src/js/index.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/src/js/styles/styles.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/src/js/scripts.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/src/js/admin/admin.js?id=<?= uniqid() ?>"></script>

</body>

</html>