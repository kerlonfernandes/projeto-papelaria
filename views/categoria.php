<?php
session_start();

require "./classes/Database.inc.php";


use Midspace\Database;
use HelpersClass\SupAid;

$helpers = new SupAid();
$db = new Database(MYSQL_CONFIG);




?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <?php
    if (isset($route)) {
        $tipo = isset($route[0]) ? $route[0] : "";
        $tipos_produtos = $db->execute_query("SELECT produtos.*, produtos.id AS prod_id, tipo_produto.tipo_produto AS tipo_name FROM produtos LEFT JOIN tipo_produto ON tipo_produto.id = produtos.tipo_produto_id WHERE tipo_produto.slug_tipo = :tipo;", [":tipo" => $tipo]);
        $tipos_prod = $tipos_produtos->results;
    
    ?>
    <div class="container m-t">
        <div class="row">
            <?php if ($tipos_produtos->affected_rows > 0) : ?>
                <?php foreach ($tipos_prod as $produto) : ?>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card h-100">
                            <div class="image-container" style="height: 300px; padding:10px; padding-bottom:10px; overflow: hidden;">
                                <img src="<?php
                                $imagens = $produto->imagens;
                                if (strpos($imagens, ',') !== false) {
                                    $imagensArray = explode(',', $imagens);
                                    $primeiraImagem = $imagensArray[0];
                                    echo $primeiraImagem;
                                } else {

                                    if($imagens != "") {
                                        echo SITE."/app/images/".$imagens;
                                    }
                                    else {
                                        echo SITE."/src/images/sem-imagem.jpg";
                                    }
                                }
                                ?>" class="card-img-top img-hover" alt="<?php echo $produto->nome; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php
                                                        $nome = $produto->nome;
                                                        if (strlen($nome) > 50) {
                                                            $nome = substr($nome, 0, 50) . "...";
                                                        }
                                                        ?>
                                    <h5 class="card-title"><?php echo $nome; ?></h5>
                                </h5>
                                <p class="card-text"><?php $produto->descricao ?></p>
                            </div>
                            <div class="card-footer text-body-secondary">
                                <h3>R$<?= number_format($produto->preco, 2, ',', '.'); ?></h3>

                                <?php
                                if ($produto->preco_anterior != 0) {
                                    echo '<h5 class="riscado text-end">R$' . number_format($produto->preco_anterior, 2, ',', '.') . '</h5>';
                                } else {
                                    echo "'<h5 class='text-center novo'>Novo</h5>";;
                                } ?>


                                <div class="button-container">
                                <button type="button" class="btn btn-success botao-ver-mais adicionar" data-prod="<?= $helpers->encodeURL($produto->prod_id) ?>">ADICIONAR <i class="fa-solid fa-cart-plus"></i></button>
                                    <br>
                                    <a href="<?= SITE ?>/produto/<?= $produto->slug ?>" type="button" class="btn btn-primary botao-ver-mais" style="width:100%;  background-color: #086E7D;">Ver Mais</a>
                                </div>
                            </div>
                        </div>

                    </div>

                <?php endforeach; ?>
            <?php else : ?>
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Poxa, que pena...</h5>
                                    <p class="card-text">Infelizmente não há produtos dessa categoria ainda.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endif ?>

        </div>
    </div>
    <?php 
    } 
    else {
        require "./templates/categorias.php";
        
    }
    
    require "./inc/js_files.inc.php";
    ?>
</body>

</html>