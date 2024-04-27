<!DOCTYPE html>
<html lang="en">

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

    <style>
        .product-card {
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product-card .card-body {
            padding: 1rem;
            position: relative;
        }

        .product-card .product-image {
            width: 100%;
            height: 0;
            padding-bottom: 66.66%;
            /* 150px/225px */
            overflow: hidden;
            border-radius: 10px;
        }

        .product-card .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .product-card .product-info {
            margin-top: 0.5rem;
            margin-left: 1.5rem;
        }

        .product-card .product-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .product-card .product-price {
            font-size: 1rem;
            margin-bottom: 1rem;
            text-decoration: line-through;
            color: #888;
        }

        .product-card .remove-btn {
            position: absolute;
            bottom: 1rem;
            right: 1rem;
        }
    </style>

    <section class="h-100 h-custom m-3" style="background-color: #eee; padding-bottom: 100%;">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card shopping-cart">
                        <div class="card-body">
                            <h5 class="mb-3">Seu Carrinho</h5>
                            <hr>
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="card product-card p-3">
                                        <div class="row align-items-center ms-1 prod-card">
                                            <div class="col-md-4 d-flex align-items-center">
                                                <input type="checkbox" class="form-check-input me-4" id="product1Checkbox" data-id="1">
                                                <img src="https://via.placeholder.com/150" class="img-fluid" alt="Product 1">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card-body">
                                                    <h5 class="product-title mb-1"><a href="">Product 1</a></h5>
                                                    <p class="product-price mb-2">$10.00</p>
                                                    <p class="product-qtd mb-2">Quantidade: 1</p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger btn-sm mt-auto float-end remove-prod" data-mdb-ripple-color="danger" data-id="1">Remover do carrinho <i class="fa-regular fa-square-minus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-5">
                                    <div class="col-lg-5 col-md-6 mb-4">
                                        <!-- <h5 class="text-uppercase">Cupon</h5> -->
                                        <div class="input-group mb-3">
                                            <!-- <input type="text" class="form-control" placeholder="Enter coupon code"> -->
                                            <!-- <button type="button" class="btn btn-primary">Apply coupon</button> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6 mb-4">
                                        <h5 class="text-uppercase">Resumo do pedido</h5>
                                        <ul class="list-group mb-3">
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                                Subtotal
                                                <span>R$100.00</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                Frete
                                                <span><Ri:d></Ri:d>R$5.00</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                                <div>
                                                    <h5 class="mb-0">Total</h5>
                                                    <p class="mb-0">R$105.00</p>
                                                </div>
                                                <div>
                                                    <button type="button" data-mdb-button-init data-mdb-ripple-color="primary" class="btn btn-primary btn-lg" id="checkoutBtn">Finalizar pedido</button>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
     
    </script>

    <?php require_once "./inc/js_files.inc.php"; ?>
</body>

</html>
