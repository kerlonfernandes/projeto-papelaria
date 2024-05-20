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
    $res = $db->execute_query("
    SELECT 
        carrinho.produto_id, 
        produtos.*,
        carrinho.item_selecionado,
        COUNT(*) AS quantidade_p
    FROM 
        carrinho 
    LEFT JOIN 
        users ON carrinho.user_id = users.id 
    LEFT JOIN 
        produtos ON produtos.id = carrinho.produto_id 
    WHERE 
        users.id = :user_id 
        AND carrinho.item_selecionado = 1
    GROUP BY 
        carrinho.produto_id;", [
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
                                    echo SITE . "/app/images/" . $primeiraImagem;
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
                <div class="p-3">
                    <!-- <div class="row align-items-center">
                        <div class="col-md-6"> -->
                            <div class="card-body">
                                <h5 class="product-title mb-1"><a href="#"><?= $produto->nome ?></a></h5>
                                <p class="product-price mb-2">R$<?= number_format($produto->preco, 2, ',', '.'); ?></p>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text">Quantidade</span>
                                    <input type="text" class="form-control form-control-sm quantidade-input" value="<?= $produto->quantidade_p ?>" readonly>
                                    <!-- <span class="input-group-text">
                                        <button class="btn btn-outline-secondary diminui-qtd" type="button" data-id="<?= $helpers->encodeURL($produto->produto_id) ?>">-</button>
                                        <button class="btn btn-outline-secondary aumentar-qtd" type="button" data-id="<?= $helpers->encodeURL($produto->produto_id) ?>">+</button>
                                    </span> -->
                                </div>
                            

                            <!-- </div>
                        </div>
                         -->
                    </div>
                </div>
            </div>
        </div>
        <hr>
    <?php endforeach; ?>
<?php else : ?>
    <div class="row align-items-center text-center">
        <span style="margin-top: 200px;">Não há produtos selecionados</span>
    </div>

<?php endif; ?>



