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
    $acao = $_POST['action'];

   
    $item_selecionado = ($acao == "select") ? 1 : 0;


    $results = $db->execute_non_query("UPDATE carrinho SET item_selecionado = :item_selecionado WHERE produto_id = :id", [
        ":id" => $id_produto,
        ":item_selecionado" => $item_selecionado
    ]);

    if($results->status == "success") {
        $res['status'] = "success";
        $res['message'] = "Item atualizado com sucesso!";
        $res['retorno'] = "Sucesso!";
    } else {
        $res['status'] = "error";
        $res['message'] = "Erro ao atualizar item!";
        $res['retorno'] = "Erro!";
    }

    echo json_encode($res);
}
?>
