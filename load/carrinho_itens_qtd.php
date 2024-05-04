<?php
session_start();
require "../classes/Database.inc.php";
require "../_app/Config.inc.php";

use Midspace\Database;
$db = new Database(MYSQL_CONFIG);


if(isset($_SESSION["user_id"]) && $_SESSION['logged_user'] == True) {
    $res = $db->execute_query("SELECT COUNT(*)
    FROM carrinho
    LEFT JOIN users ON carrinho.user_id = users.id
    LEFT JOIN produtos ON produtos.id = carrinho.produto_id
    WHERE users.id = :user_id
    GROUP BY carrinho.produto_id;
    ", [
        ":user_id"=> $_SESSION['user_id']
    ]);

    if($res->affected_rows > 0) {
        echo $res->affected_rows;
    }
}
