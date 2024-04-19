<?php
// Importar a classe Database
use Midspace\Database;

// $db = new Database(MYSQL_CONFIG);

// $sql = "SELECT * FROM produtos";
// $result = $db->execute_query($sql);

$produtos = [
  (object)[
    "nome" => "Caderno",
    "preco" => "79.00",
    "valor_passado" => "90.00",
    "descricao" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe perferendis dolor quaerat deserunt necessitatibus aut aperiam quibusdam sequi.",
    "imagens_produto" => "https://via.placeholder.com/150",
    "slug_produto" => "caderno-hello-kitty",
    "link_produto" => "https://example.com/product-1",
  ],
  (object)[
    "nome" => "Lápis",
    "preco" => "5.00",
    "valor_passado" => "6.00",
    "descricao" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe perferendis dolor quaerat deserunt necessitatibus aut aperiam quibusdam sequi.",
    "imagens_produto" => "https://via.placeholder.com/150",
    "slug_produto" => "lapis-marca-texto",
    "link_produto" => "https://example.com/product-2",
  ],
  (object)[
    "nome" => "Borracha",
    "preco" => "3.50",
    "valor_passado" => "4.00",
    "descricao" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe perferendis dolor quaerat deserunt necessitatibus aut aperiam quibusdam sequi.",
    "imagens_produto" => "https://via.placeholder.com/150",
    "slug_produto" => "borracha-especial",
    "link_produto" => "https://example.com/product-3",
  ],
  (object)[
    "nome" => "Régua",
    "preco" => "10.00",
    "valor_passado" => "12.00",
    "descricao" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe perferendis dolor quaerat deserunt necessitatibus aut aperiam quibusdam sequi.",
    "imagens_produto" => "https://via.placeholder.com/150",
    "slug_produto" => "regua-30cm",
    "link_produto" => "https://via.placeholder.com/150",
  ],
  (object)[
    "nome" => "Estojo",
    "preco" => "15.00",
    "valor_passado" => "18.00",
    "descricao" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe perferendis dolor quaerat deserunt necessitatibus aut aperiam quibusdam sequi.",
    "imagens_produto" => "https://via.placeholder.com/150",
    "slug_produto" => "estojo-colorido",
    "link_produto" => "https://via.placeholder.com/150",
  ],
  (object)[
    "nome" => "Caneta",
    "preco" => "2.00",
    "valor_passado" => "2.50",
    "descricao" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe perferendis dolor quaerat deserunt necessitatibus aut aperiam quibusdam sequi.",
    "imagens_produto" => "https://via.placeholder.com/150",
    "slug_produto" => "caneta-azul",
    "link_produto" => "https://via.placeholder.com/150",
  ],
];


$result['status'] = 'success';


if ($result['status'] === 'success') :
  $grupos_produtos = array_chunk($produtos, 4);
?>
  <style>
    .carousel-control-prev .carousel-control-prev-icon::before {
      color: black;
      /* Define a cor do ícone como preto */
    }
  </style>

<div class="limit">
    <div class="container mt-5">
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicatorsDestaques" data-bs-slide="prev">
            <span class="carousel-control-prev-icon buttons-caroussel" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <div id="carouselExampleIndicatorsDestaques" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators" style="pointer-events: none;">
                <?php foreach ($grupos_produtos as $index => $grupo) : ?>
                    <button type="button" data-bs-target="#carouselExampleIndicatorsDestaques" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-current="true" aria-label="Slide <?php echo $index + 1; ?>"></button>
                <?php endforeach; ?>
            </div>
            <div class="carousel-inner">
                <?php foreach ($grupos_produtos as $index => $grupo) : ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <div class="row row-cols-1 row-cols-md-4 g-4">
                            <?php foreach ($grupo as $produto) : ?>
                                <div class="col">
                                    <div class="card h-100">
                                        <a href="<?php echo $produto->link_produto; ?>" class="card-img-link">
                                            <img src="<?php echo $produto->imagens_produto; ?>" class="card-img-top img-hover" alt="<?php echo $produto->nome; ?>">
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $produto->nome; ?></h5>
                                            <p class="card-text"><?php echo $produto->descricao; ?></p>
                                        </div>
                                        <div class="card-footer text-body-secondary">
                                            <h3>R$<?php echo $produto->preco; ?></h3>
                                            <h5 class="riscado text-end">R$<?php echo $produto->valor_passado; ?></h5>
                                            <button type="button" class="btn btn-primary botao-ver-mais" style="width:100%;">Ver Mais</button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicatorsDestaques" data-bs-slide="next">
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