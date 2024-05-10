<?php

session_start();
require "../classes/Database.inc.php";
require "../_app/Config.inc.php";

use Midspace\Database;
$db = new Database(MYSQL_CONFIG);


if(isset($_SESSION["user_id"]) && $_SESSION['logged_user'] == True) {
    $res = $db->execute_query("
        SELECT 
            SUM(produtos_carrinho.preco * produtos_carrinho.quantidade_p) AS subtotal
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
            ) AS produtos_carrinho;", [
        ":user_id" => $_SESSION['user_id']
            ]);

    if($res->affected_rows > 0) {
        if(isset($res->results[0]->subtotal)) {
            echo number_format($res->results[0]->subtotal, 2, ',', '.');
        }
        else {
            echo number_format(0, 2, ',', '.');
        }
    }
    else {
        echo number_format(0, 2, ',', '.');
    }
}
