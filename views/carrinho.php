<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <?php
    require "./inc/assets.inc.php";
    require "./inc/css_files.inc.php";
    ?>
</head>

<body>

    <?php
    require "./components/header.php";
    require "./modals/finalizar_modal.php";

    ?>
    <div id="overlay">
        <div class="spinner"></div>
    </div>




    <?php if (!isset($route)) : ?>
        <section class="h-100 h-custom m-3" style="background-color: #eee; padding-bottom: 100%;">
            <div class="container h-100 py-5">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                        <div class="card shopping-cart">
                            <div class="card-body">
                                <h5 class="mb-3">Seu Carrinho</h5>
                                <hr>
                                <div class="carrinho-items">
                                    <div class="text-center mt-3" id="loading-carrinho" style="display:block; padding:50px;">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row mt-5">
                                    <div class="col-lg-5 col-md-6 mb-4">
                                        <!-- <h5 class="text-uppercase">Cupon</h5> -->
                                        <div class="input-group mb-3">

                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6 mb-4">
                                        <h5 class="text-uppercase">Resumo do pedido</h5>
                                        <ul class="list-group mb-3">
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                                Subtotal
                                                <span class="h3 m-2">R$<span class="subtotal"></span></span>
                                            </li>

                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                     
                                                <div>
                                                    <button type="button" data-mdb-button-init data-mdb-ripple-color="primary" class="btn btn-primary btn-lg" id="checkoutBtn" style="border-radius: 2px;" data-bs-toggle="modal" data-bs-target="#finalizar">Resumo do pedido</button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    <?php endif; ?>
    <script src="<?= SITE ?>/src/js/jquery.min.js?id=<?= uniqid() ?>"></script>
    <?php require_once "./inc/js_files.inc.php"; ?>
</body>

</html>