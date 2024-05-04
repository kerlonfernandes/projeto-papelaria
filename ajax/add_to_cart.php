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

if (isset($_POST["id"]) && isset($_SESSION["user_id"]) && $_SESSION['logged_user'] == True) {
    $id_produto = $helpers->decodeURL($_POST['id']);
    $id_usuario = $_SESSION['user_id'];
    if(!isset($_POST['quantidade'])) {
        $quantidade = 1;
    }
    else {
        $quantidade = $_POST['quantidade'];
    }
    $results = $db->execute_non_query("INSERT INTO carrinho (user_id, produto_id, quantidade) VALUES (:user_id, :produto_id, :quantidade)", [
        ":user_id" => $id_usuario,
        ":produto_id" => $id_produto,
        ":quantidade" => $quantidade
    ]);

    if($results->status == "success") {
        $res['status'] = "success";
        $res['message'] = "Item adicionado ao carrinho com sucesso!";
        $res['retorno'] = "Sucesso!";

    } else {
        $res['status'] = "error";
        $res['message'] = "Erro ao adicionar item ao carrinho!.";
        $res['retorno'] = "Erro!";

    }
    echo json_encode( $res );
}