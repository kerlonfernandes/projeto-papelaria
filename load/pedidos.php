<?php
session_start();
require "../classes/Database.inc.php";
require "../_app/Config.inc.php";
require "../classes/Helpers.inc.php";

use HelpersClass\SupAid;
use Midspace\Database;

$helpers = new SupAid();
$db = new Database(MYSQL_CONFIG);
$res = array();
$produtos = [];

if (isset($_SESSION["user_id"]) && $_SESSION['logged_user'] == true) {
    $res = $db->execute_query("SELECT * FROM produtos_pedidos 
    LEFT JOIN produtos 
    ON produtos_pedidos.id_produto = produtos.id 
    WHERE produtos_pedidos.id_usuario = :user_id;", [
        ":user_id" => $_SESSION['user_id']
    ]);

    if ($res->status === 'success' && $res->affected_rows > 0) {
        $produtos = $res->results;
    }
}

?>

<?php if (!empty($produtos)) : ?>
    <?php foreach ($produtos as $produto) : ?>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card product-card p-3">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="product-image">
                            <img src="
                                <?php
                                $imagens = $produto->imagens;
                                if (strpos($imagens, ',') !== false) {
                                    $imagensArray = explode(',', $imagens);
                                    $primeiraImagem = $imagensArray[0];
                                    echo $primeiraImagem;
                                } else {
                                    if ($imagens != "") {
                                        echo SITE . "/app/images/" . $imagens;
                                    } else {
                                        echo SITE . "/src/images/sem-imagem.jpg";
                                    }
                                }
                                ?>
                            " class="img-fluid" alt="<?= $imagens ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-4">
                <div class="card product-card p-3  <?= $produto->item_selecionado == 1 ? 'alert alert-primary' : '' ?>">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="product-title mb-1"><a href="#"><?= $produto->nome ?></a></h5>
                                <p class="product-price mb-2">R$<?= number_format($produto->preco, 2, ',', '.'); ?></p>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text">Quantidade</span>
                                    <input type="text" class="form-control form-control-sm quantidade-input" value="<?= $produto->quantidade ?>" readonly>

                                </div>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

<?php else : ?>
    <div class="row align-items-center text-center">
        <span>Não há produtos no carrinho</span>
    </div>

<?php endif; ?>