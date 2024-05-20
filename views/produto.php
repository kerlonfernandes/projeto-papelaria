<?php
session_start();

use Midspace\Database;
use HelpersClass\SupAid;

require "./classes/Database.inc.php";
require "./classes/Helpers.inc.php";

$helpers = new SupAid();
$db = new Database(MYSQL_CONFIG);


$produto = $db->execute_query("SELECT 
produtos.*, 
categorias.nome AS categoria, 
tipo_produto.tipo_produto AS tipo 
FROM 
produtos 
LEFT JOIN 
categorias ON categorias.id = produtos.categoria_id 
LEFT JOIN 
tipo_produto ON tipo_produto.id = produtos.tipo_produto_id 
WHERE 
produtos.id = :id
AND produtos.slug LIKE CONCAT('%', :slug, '%')", [
    ":slug" => $route[0],
    ":id" => $helpers->decodeURL($route[1])
]);

$imagens_array = [];
$prod = $produto->results[0];

if ($prod->imagens !== null) {
    if (strpos($prod->imagens, ',') !== false) {
        $imagens_array = explode(',', $prod->imagens);
    } else {
        $imagens_array[] = $prod->imagens;
    }
}

$imagens_array = array_map('trim', $imagens_array);


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pitágoras Papelaria | <?= $prod->nome  ?></title>
    <?php
    require "./inc/assets.inc.php";
    require "./inc/css_files.inc.php";

    ?>
</head>

<body>
    <?php require "./components/header.php"; ?>
    <div id="overlay">
        <div class="spinner"></div>
    </div>
    <div class="container mt-5">

        <div class="row">

            <div class="col-md-6">
                <div class="card p-4">
                    <div id="carouselExampleControls" class="carousel" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php if (!empty($imagens_array)) : ?>
                                <?php foreach ($imagens_array as $key => $imagem) : ?>

                                    <?php

                                    $caminho_imagem = SITE . "/app/images/$imagem";
                                    $imagem_existente = file_exists($caminho_imagem) && !empty($imagem); // Verifica se a imagem existe e não está vazia
                                    ?>
                                    <div class="carousel-item <?= ($key === 0) ? 'active' : ''; ?>">
                                        <?php if ($imagem) : ?>
                                            <img src="<?= $caminho_imagem; ?>" class="d-block w-100 imagem-carousel" alt="Imagem <?= $key + 1; ?>" data-bs-toggle="modal" data-bs-target="#uploadImagemModal" data-imagem="<?= $caminho_imagem; ?>" data-img-name="<?= $imagem ?>" style="width: 200px auto;">
                                        <?php else : ?>
                                            <img src="<?= SITE ?>/src/images/sem-imagem.jpg" class="d-block w-100 imagem-carousel" alt="Placeholder">
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="alert alert-danger d-flex align-items-center text-center" role="alert">
                                    Este produto não contém imagem, portanto, não aparecerá na home inicial do site por questões do sistema.
                                </div>
                            <?php endif; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card p-4" style="height:800px;">
                    <span class="text-muted"><?php
                                                if ($prod->preco_anterior == "") {
                                                    echo "Novo";
                                                }
                                                ?></span>
                    <h3><?= $prod->nome ?></h3>
                    <hr>
                    <div class="price"><span class="h1" style="font-weight: 300;">R$<?= number_format($prod->preco, 2, ',', '.'); ?></span></div>
                    <div class="prod-info" style="height:100px;">
                        <div class="info mt-2">Em estoque: <strong><?= $prod->quantidade ?></strong></div>
                        <div class="buttons-prod">
                            <button type="button" class="btn btn-primary w-100" style="margin-top: 100px;">Comprar</button>
                            <button type="button" class="btn btn-outline-secondary w-100 mt-2 adicionar" data-prod="<?= $helpers->encodeURL($prod->id) ?>">Adicionar ao carrinho</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card p-4">
                            <h3 class="text-center">Descrição do produto</h3>

                            <span class="mt-3">
                                <?= $prod->descricao ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card p-4">
                            <h3 class="text-center">Outras informações do produto</h3>

                            <span class="mt-3">
                                <h4>Categoria do produto</h4>
                                <?= $prod->categoria ?>
                            </span>
                            <span class="mt-3">
                                <h4>Tipo do produto</h4>
                                <?= $prod->tipo ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <?php
    require "./components/footer.php";

    require "./inc/js_files.inc.php";
    ?>
</body>

</html>