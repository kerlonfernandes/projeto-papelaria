<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../../classes/Database.inc.php";
require "../../classes/Helpers.inc.php";
require "../../_app/Config.inc.php";

use Midspace\Database;
use HelpersClass\SupAid;

$helpers = new SupAid();

$db = new Database(MYSQL_CONFIG);

$res = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nomeProduto = $_POST["produto_nome"];
    $descricaoProduto = $_POST["produto_descricao"];
    $precoProduto = str_replace(array('.', ','), array('', '.'), $_POST["preco"]);
    $precoAnterior = str_replace(array('.', ','), array('', '.'), $_POST["preco_anterior"]);
    $quantidadeProduto = $_POST["produto_quantidade"];
    $categoriaProduto = $_POST['categoria_produto'];
    $tipoProduto = $_POST['tipo_produto'];
    $idProduto = $helpers->decodeURL($_POST['id_produto']);


    $res = array();


    $produto = $db->execute_non_query("UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, preco_anterior = :preco_anterior, quantidade = :quantidade, slug = :slug, categoria_id = :categoria_id, tipo_produto_id = :tipo_produto_id WHERE id = :id", [
        ":nome" => $nomeProduto,
        ":descricao" => $descricaoProduto,
        ":preco" => $precoProduto,
        ":preco_anterior" => $precoAnterior,
        ":quantidade" => $quantidadeProduto,
        ":slug" => $helpers->createSlug($nomeProduto),
        ":categoria_id" => $categoriaProduto,
        ":tipo_produto_id" => $tipoProduto,
        ":id" => $idProduto
    ]);

    if ($produto->status == "success") {
        $res['status'] = "success";
        $res['message'] = "Produto atualizado com sucesso!";
        $res['error'] = false;
        echo json_encode($res);
    } else {
        $res['status'] = "error";
        $res['message'] = "Ocorreu um erro ao atualizar o produto!";
        $res['error'] = true;
        echo json_encode($res);
    }
}
