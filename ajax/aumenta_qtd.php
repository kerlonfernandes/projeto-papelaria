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
    if (!isset($_POST['quantidade'])) {
        $quantidade = 1;
    } else {
        $quantidade = $_POST['quantidade'];
    }
  
    if ($_POST['checkboxChecked'] == "1") {
        $item_selecionado = 1;
    } else {
        $item_selecionado = 0;
    }

    $results = $db->execute_non_query("INSERT INTO carrinho (user_id, produto_id, quantidade, item_selecionado) VALUES (:user_id, :produto_id, :quantidade, :item_selecionado)", [
        ":user_id" => $id_usuario,
        ":produto_id" => $id_produto,
        ":quantidade" => $quantidade,
        ":item_selecionado" => $item_selecionado
    ]);

    if ($results->status == "success") {
        $res['status'] = "success";
        $res['message'] = "Item adicionado ao carrinho com sucesso!";
        $res['retorno'] = "Sucesso!";
        $res['debug'] = $item_selecionado;

    } else {
        $res['status'] = "error";
        $res['message'] = "Erro ao adicionar item ao carrinho!.";
        $res['retorno'] = "Erro!";
    }
    echo json_encode($res);
}
