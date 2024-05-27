<?php
session_start();
require "../../classes/Database.inc.php";
require "../../_app/Config.inc.php";
require "../../classes/Helpers.inc.php";

use HelpersClass\SupAid;
use Midspace\Database;

$helpers = new SupAid();
$db = new Database(MYSQL_CONFIG);
$res = array();

if (isset($_POST["id"]) && isset($_SESSION["user_id"]) && $_SESSION['logged_user'] == True) {
    
    $pedido_id = $helpers->decodeURL($_POST["id"]);
    $produto_id = $helpers->decodeURL($_POST["id_produto"]);
    
    $qtd_itens_q = $db->execute_query("SELECT qtd_itens FROM produtos_pedidos WHERE id_pedido = :id_pedido", [":id_pedido" => $pedido_id]);
    $qtd_itens = $qtd_itens_q->results[0]->qtd_itens;
    
    $results = $db->execute_non_query("UPDATE produtos_pedidos SET qtd_itens = :qtd_itens WHERE id_pedido = :id_pedido AND id_produto = :id_produto", [
        ":qtd_itens" => $qtd_itens + 1,
        ":id_pedido" => $pedido_id,
        ":id_produto" => $produto_id
    ]);
    // UPDATE `produtos_pedidos` SET `qtd_itens` = '7' WHERE `produtos_pedidos`.`id` = 96 

    if($results->status == "success") {
        $res['status'] = "success";
        $res['message'] = "Item removido com sucesso!";
        $res['retorno'] = "Sucesso!";
        $res['debug'] = $_POST;
    } else {
        $res['status'] = "error";
        $res['message'] = "Erro ao remover item do carrinho!";
        $res['retorno'] = "Erro!";

    }
    echo json_encode( $res );
}