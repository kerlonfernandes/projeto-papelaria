<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seus Pedidos</title>
    <?php
    require "./inc/assets.inc.php";
    require "./inc/css_files.inc.php";
    ?>
</head>

<body>

    <?php
    require "./components/header.php";
    ?>
    <div id="overlay">
        <div class="spinner"></div>
    </div>

    <section class="h-100 h-custom m-3" style="background-color: #eee; padding-bottom: 100%;">

        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="row mt-5">
                    <div class="col-lg-5 col-md-6 mb-4">
                        <h5 class="text-uppercase">Filtros</h5>
                        <div class="input-group mb-3">
                            <select class="form-select" id="filtro" aria-label="Filtrar por">
                                <option value="recentes">Mais recente</option>
                                <option value="antigos">Mias antigos</option>
                              
                            </select>
                            <input type="text" class="form-control" id="pesquisa" placeholder="Pesquisar">
                            <button class="btn btn-primary" type="button" id="btnFiltrar">Filtrar</button>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 mb-4">
                        <h5 class="text-uppercase">Lista de Pedidos</h5>
                        <ul class="list-group mb-3" id="listaPedidos">
                        
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="card shopping-cart">
                        <div class="card-body">
                            <h5 class="mb-3">Seus Pedidos</h5>
                            <hr>
                            <div class="pedido-items">
                                <div class="text-center mt-3" id="loading-pedidos" style="display:block; padding:50px;">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="<?= SITE ?>/src/js/jquery.min.js?id=<?= uniqid() ?>"></script>
    <?php require_once "./inc/js_files.inc.php"; ?>

</body>

</html>