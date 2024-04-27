<?php
require "../classes/Database.inc.php";
require "../_app/Config.inc.php";


use Midspace\Database;

$db = new Database(MYSQL_CONFIG);

$sql = "SELECT produtos.*, tipo_produto.descricao AS description FROM `produtos` 
LEFT JOIN tipo_produto ON produtos.tipo_produto_id = tipo_produto.id WHERE tipo_produto = 'Mochilas'";
$result = $db->execute_query($sql);
$produtos = $result->results;



if ($result->status === 'success') :
    $grupos_produtos = array_chunk($produtos, 4);
?>
 
 <div class="limit">
        <div class="container mt-5">
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselMochilas" data-bs-slide="prev">
                <span class="carousel-control-prev-icon buttons-caroussel" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <div id="carouselMochilas" class="carousel slide">
                <div class="carousel-indicators" style="pointer-events: none;">
                    <?php foreach ($grupos_produtos as $index => $grupo) : ?>
                        <button type="button" data-bs-target="#carouselMochilas" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-current="true" aria-label="Slide <?php echo $index + 1; ?>"></button>
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
                                                    <button type="button" class="btn btn-success botao-ver-mais adicionar">ADICIONAR <i class="fa-solid fa-cart-plus"></i></button>
                                                    <br>
                                                    <a href="<?= SITE ?>/produto/<?= $produto->slug ?>" type="button" class="btn btn-primary botao-ver-mais" style="width:100%;  background-color: #086E7D;">Ver Mais</a>
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
            <button class="carousel-control-next" type="button" data-bs-target="#carouselMochilas" data-bs-slide="next">
                <span class="carousel-control-next-icon buttons-caroussel" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

<?php
else :
    echo '<p>Erro ao recuperar os produtos.</p>';
endif;
?>