<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../../classes/Database.inc.php";
require "../../classes/Helpers.inc.php";
require "../../_app/Config.inc.php";

use Midspace\Database;
use HelpersClass\SupAid;

$db = new Database(MYSQL_CONFIG);
$helpers = new SupAid();


if (!isset($_GET['id'])) return;

$produtos = $db->execute_query("SELECT produtos_pedidos.*, categorias.*, produtos_pedidos.*, produtos.* ,categorias.nome AS categoria_nome 
                                FROM produtos_pedidos 
                                LEFT JOIN produtos ON produtos.id = produtos_pedidos.id_produto 
                                LEFT JOIN categorias ON categorias.id = produtos.categoria_id 
                                WHERE produtos_pedidos.id_pedido = :id; ", [":id" => $_GET['id']]);

$pedido = $db->execute_query("SELECT * FROM pedido WHERE id = :id", [":id" => $produtos->results[0]->id_pedido]);
?>

<div class="table-responsive">
    <h3 class="text-center mb-3">Produtos pedidos</h3>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>ID produto</th>
                <th>Nome do Produto</th>
                <th>Categoria</th>
                <th>Quantidade</th>

            </tr>
        </thead>
        <tbody>
            <?php if ($produtos->affected_rows > 0) : ?>
                <?php foreach ($produtos->results as $produto) : ?>
                    <tr>
                        <td>
                            <a href="<?= SITE ?>/admin/?route=painel&sys=product&id=<?= $helpers->encodeURL($produto->id_produto) ?>" class="btn btn-success sys-btn panel-btn">Acessar</a>
                            <button class="btn btn-danger sys-btn panel-btn" data-id="<?= $helpers->encodeURL($produto->id_produto) ?>">Remover</button>
                        </td>
                        
                        <td><?= $produto->id_produto ?></td>
                        <td><?php if(strlen($produto->nome) > 50) {echo substr($produto->nome, 50)."...";} else {echo $produto->nome;}?></td>
                        <td><?= $produto->categoria_nome ?></td>
                        <td>
                            <span class="input-group-text">
                                <button class="btn btn-outline-secondary diminui-qtd" type="button" data-id="<?= $helpers->encodeURL($produto->id_pedido) ?>" data-id-produto="<?= $helpers->encodeURL($produto->id_produto) ?>">-</button>
                                <span class="ms-3 me-3 quantidade-input"><?= $produto->qtd_itens ?></span>
                                <button class="btn btn-outline-secondary aumentar-qtd" type="button" data-id="<?= $helpers->encodeURL($produto->id_pedido) ?>" data-id-produto="<?= $helpers->encodeURL($produto->id_produto) ?>">+</button>
                            </span>
                        </td>


                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="col-lg-7 col-md-6 m-5">
        <h5 class="text-uppercase">Resumo do pedido</h5>
        <ul class="list-group mb-3">
            <span class="h3 m-2">R$<span class="subtotal"><?= $pedido->results[0]->total_pedido ?></span></span>

        </ul>
    </div>
    <div class="col-lg-7 col-md-6 m-5">
        <h5 class="text-uppercase">Taxa entrega</h5>
        <ul class="list-group mb-3">
            <span class="h3 m-2">R$<span class="subtotal"><?= $pedido->results[0]->taxa_envio ?></span></span>

        </ul>
    </div>
</div>