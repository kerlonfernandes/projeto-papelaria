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

$id_pedido = $helpers->decodeURL($_POST['id']);

$cep = isset($_POST['cep']) ? $_POST['cep'] : "";
$endereco = isset($_POST['endereco']) ? $_POST['endereco'] : "";
$numeroResidencia = isset($_POST['numero']) ? $_POST['numero'] : "";
$complemento = isset($_POST['complemento']) ? $_POST['complemento'] : "";
$bairro = isset($_POST['bairro']) ? $_POST['bairro'] : "";
$cidade = isset($_POST['cidade']) ? $_POST['cidade'] : "";
$estado = isset($_POST['estado']) ? $_POST['estado'] : "";

// Verifica se algum campo obrigatório está vazio
if (empty($cep) || empty($endereco) || empty($numeroResidencia) || empty($bairro) || empty($cidade) || empty($estado)) {
    $res['status'] = "error";
    $res['message'] = "Todos os campos obrigatórios devem ser preenchidos!";
    $res['error'] = true;
    echo json_encode($res);
    exit;
}

$results = $db->execute_non_query(
    "UPDATE pedido 
    SET cep = :cep,
        endereco = :endereco, 
        numero_residencia = :numeroResidencia, 
        complemento = :complemento, 
        bairro = :bairro, 
        cidade = :cidade, 
        estado = :estado 
    WHERE id = :id_pedido",
    [
        ":cep" => $cep,
        ":endereco" => $endereco,
        ":numeroResidencia" => $numeroResidencia,
        ":complemento" => $complemento,
        ":bairro" => $bairro,
        ":cidade" => $cidade,
        ":estado" => $estado,
        ":id_pedido" => $id_pedido,
    ]
);

if ($results->status == "success") {
    $res['status'] = "success";
    $res['message'] = "Endereço atualizado com sucesso!";
    $res['error'] = false;
} else {
    $res['status'] = "error";
    $res['message'] = "Ocorreu um erro ao atualizar endereço!";
    $res['error'] = true;
}
echo json_encode($res);
