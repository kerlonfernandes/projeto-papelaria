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

if (isset($_SESSION["user_id"]) && $_SESSION['logged_user'] == True) {
    $user_id = $_SESSION['user_id'];
    $total = $db->execute_query("SELECT 
    SUM(produtos_carrinho.preco * produtos_carrinho.quantidade_p) AS total
    FROM 
    (
        SELECT 
            carrinho.produto_id, 
            produtos.*, 
            COUNT(*) AS quantidade_p
        FROM 
            carrinho 
        LEFT JOIN 
            users ON carrinho.user_id = users.id 
        LEFT JOIN 
            produtos ON produtos.id = carrinho.produto_id 
        WHERE 
            users.id = :user_id AND carrinho.item_selecionado = 1
        GROUP BY 
            carrinho.produto_id
    ) AS produtos_carrinho;", [":user_id" => $user_id])->results[0]->total;
    
    $results = $db->execute_non_query(
    "INSERT INTO pedido (id_cliente, data_pedido, hora_pedido, total_pedido) 
    VALUES (:id_cliente, :data_pedido, :hora_pedido, :total)
    ", [
        ":id_cliente" => $user_id, 
        ":data_pedido" => $dataAtual, 
        ":hora_pedido" => $horaAtual, 
        ":total" => $total
    ]);

    if($results->status == "success") {
        $res['status'] = "success";
        $res['message'] = "Pedido feito com sucesso! Iremos te redirecionar para o próximo passo 😉";
        $res['retorno'] = "Sucesso!";
        $res['id'] = $helpers->encodeURL($results->last_id);

    } else {
        $res['status'] = "error";
        $res['message'] = "Erro ao fazer pedido!";
        $res['retorno'] = "Erro!";

    }
    echo json_encode($res);
}
