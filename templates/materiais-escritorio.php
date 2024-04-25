<?php


$sql = "SELECT produtos.*, tipo_produto.descricao AS description FROM `produtos` 
LEFT JOIN tipo_produto ON produtos.tipo_produto_id = tipo_produto.id WHERE tipo_produto = 'Material para escritório'";
$result = $db->execute_query($sql);
$produtos = $result->results;



if ($result->status === 'success') :
    $grupos_produtos = array_chunk($produtos, 4);
?>

    <div class="limit">
        <div class="container mt-5">
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon buttons-caroussel" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators" style="pointer-events: none;">
                    <?php foreach ($grupos_produtos as $index => $grupo) : ?>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-current="true" aria-label="Slide <?php echo $index + 1; ?>"></button>
                    <?php endforeach; ?>
                </div>
                <div class="carousel-inner">
                    <?php foreach ($grupos_produtos as $index => $grupo) : ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <div class="row row-cols-1 row-cols-md-4 g-4">
                                <?php foreach ($grupo as $produto) : ?>
                                    <div class="col">
                                        <div class="card h-100">
                                            <div class="image-container" style="height: 300px; padding:10px; padding-bottom:10px; overflow: hidden;">
                                                <img src="./app/images/<?php
                                                                        $imagens = $produto->imagens;
                                                                        if (strpos($imagens, ',') !== false) {
                                                                            $imagensArray = explode(',', $imagens);
                                                                            $primeiraImagem = $imagensArray[0];
                                                                            echo $primeiraImagem;
                                                                        } else {
                                                                            echo $imagens;
                                                                        }
                                                                        ?>" class="card-img-top img-hover" alt="<?php echo $produto->nome; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $produto->nome; ?></h5>
                                                <p class="card-text"><?php $produto->descricao ?></p>
                                            </div>
                                            <div class="card-footer text-body-secondary">
                                                <h3>R$<?= number_format($produto->preco, 2, ',', '.'); ?></h3>
                                                <h5 class="riscado text-end">R$<?= number_format($produto->preco_anterior, 2, ',', '.'); ?></h5>

                                                <div class="button-container">
                                                    <button type="button" class="btn btn-success botao-ver-mais" style="width:60%; background-color: #008A00 !important; ">ADICIONAR <i class="fa-solid fa-cart-plus"></i></button>
                                                    <br>
                                                    <button type="button" class="btn btn-primary botao-ver-mais" style="width:100%;  background-color: #00BFFF;">Ver Mais</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon buttons-caroussel" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

<?php
else :
    // Se a consulta falhar, exibir uma mensagem de erro
    echo '<p>Erro ao recuperar os produtos.</p>';
endif;
?>