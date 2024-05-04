<?php
require "../../classes/Database.inc.php";
require "../../_app/Config.inc.php";
require "../../classes/Helpers.inc.php";

use HelpersClass\SupAid;
use Midspace\Database;

$helpers = new SupAid();
$db = new Database(MYSQL_CONFIG);
$res = array();

$imagens = $_FILES["imagens"];
$pastaDestino = "../../app/images/";

if (!file_exists($pastaDestino)) {
    mkdir($pastaDestino, 0777, true);
}

$nomesImagens = [];
$err_msg = "";

foreach ($imagens["tmp_name"] as $index => $tmpName) {
    if ($imagens["error"][$index] == UPLOAD_ERR_OK) {
        $novoNome = uniqid('img_', true) . '_' . basename($imagens["name"][$index]);
        $caminhoArquivo = $pastaDestino . $novoNome;
        if (move_uploaded_file($tmpName, $caminhoArquivo)) {
            $nomesImagens[] = $novoNome;
        } else {
            $err_msg = "Erro ao mover o arquivo $tmpName para $caminhoArquivo";
        }
    } else {
        $err_msg = "Não foi possível carregar a imagem!";
    }
}

$nomesImagensString = implode(", ", $nomesImagens);

$produto = $db->execute_query("SELECT imagens FROM produtos WHERE id = :id_produto", [
    ":id_produto" => $_POST['id_produto']
]);

if ($produto->status === 'success' && count($produto->results) > 0) {
    $image_names = $produto->results[0]->imagens;
    $images = ($image_names !== null) ? explode(", ", $image_names) : [];

    $images = array_merge($images, $nomesImagens);

    $images = implode(", ", $images);
    $novas_imagens = (substr($images, 0, 2) === ', ') ? substr($images, 2) : $images;

    $result = $db->execute_non_query("UPDATE produtos SET imagens = :novas_imagens WHERE id = :id_produto", [
        ":novas_imagens" => $novas_imagens,
        ":id_produto" => $_POST['id_produto']
    ]);

    if ($result->status == "success") {
        $res['status'] = "success";
        $res['success'] = true;
        $res['message'] = "Imagens adicionadas com sucesso!";
    } else {
        $res['success'] = false;
        $res['message'] = "Erro ao mover o arquivo para o diretório de destino.";
    }
} else {
    $res['success'] = false;
    $res['message'] = "Erro ao recuperar as imagens do produto.";
}

echo json_encode($res);
