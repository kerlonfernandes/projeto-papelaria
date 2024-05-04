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

    $results = $db->execute_non_query("DELETE FROM carrinho WHERE produto_id = :id", [
        ":id" => $id_produto,
    ]);
    // print_r($ultimo_id_produto);
    if($results->status == "success") {
        $res['status'] = "success";
        $res['message'] = "Item removido com sucesso!";
        $res['retorno'] = "Sucesso!";

    } else {
        $res['status'] = "error";
        $res['message'] = "Erro ao remover item do carrinho!";
        $res['retorno'] = "Erro!";

    }
    echo json_encode( $res );
}