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

    $res = array();

    $imagens = $_FILES["imagens"];

    $pastaDestino =  "../../app/images/";
    if (!file_exists($pastaDestino)) {
        mkdir($pastaDestino, 0777, true);
    }

    $nomesImagens = [];

    $nomesImagensString = '';

    $err_msg = ""; // Inicializando a variável err_msg aqui

    foreach ($imagens["tmp_name"] as $index => $tmpName) {
        if ($imagens["error"][$index] == UPLOAD_ERR_OK) {
            $novoNome = uniqid('img_', true) . '_' . basename($imagens["name"][$index]);
            $caminhoArquivo = $pastaDestino . $novoNome;
            if (move_uploaded_file($tmpName, $caminhoArquivo)) {
                $nomesImagens[] = $novoNome;
                $nomesImagensString .= $novoNome . ', ';
            } else {
                $err_msg = "Erro ao mover o arquivo $tmpName para $caminhoArquivo"; // Definindo o valor da variável err_msg
            }
        } else {
            $err_msg = "Não foi possível carregar a imagem!"; // Definindo o valor da variável err_msg
        }
    }

    $nomesImagensString = rtrim($nomesImagensString, ', ');

    $produto = $db->execute_non_query("INSERT INTO produtos (nome, descricao, imagens, preco, preco_anterior, quantidade, slug, data_cadastro, categoria_id, tipo_produto_id) VALUES (:nome, :descricao, :imagens, :preco, :preco_anterior, :quantidade, :slug, :data_cadastro, :categoria_id, :tipo_produto_id)", [
        ":nome" => $nomeProduto,
        ":descricao" => $descricaoProduto,
        ":imagens" => $nomesImagensString,
        ":preco" => $precoProduto,
        ":preco_anterior" => $precoAnterior,
        ":quantidade" => $quantidadeProduto,
        ":slug" => $helpers->createSlug($nomeProduto),
        "data_cadastro" => date("Y-m-d H:i:s"),
        ":categoria_id" => $categoriaProduto,
        ":tipo_produto_id" => $tipoProduto
    ]);

    if($produto->status == "success") {
        if ($err_msg != "") {
            $res['status'] = "success";
            $res['message'] = "Produto cadastrado com sucesso! <div class='alert alert-danger' role='alert'>{$err_msg}</div>";
            $res['error'] = false;
            echo json_encode($res);
            return;
        }
      

        $res['status'] = "success";
        $res['message'] = "Produto cadastrado com sucesso!";
        $res['error'] = false;
        echo json_encode($res);
    }
    else {
        $res['status'] = "error";
        $res['message'] = "Ocorreu um erro ao cadastrar o produto!";
        $res['error'] = true;
        echo json_encode($res);
    }
}
