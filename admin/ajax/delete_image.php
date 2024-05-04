<?php 
require "../../classes/Database.inc.php";
require "../../_app/Config.inc.php";
use Midspace\Database;

$db = new Database(MYSQL_CONFIG);


$image_to_remove = $_POST['image_name'];
$novo_nome = $_POST['novo_nome'] ?? null; 

$produto = $db->execute_query("SELECT imagens FROM produtos WHERE id = :id_produto", [ 
    ":id_produto" => $_POST['id_produto']
]);


if ($produto->status === 'success' && count($produto->results) > 0) {
    $imagens_atuais = $produto->results[0]->imagens;

    $imagens_array = explode(", ", $imagens_atuais);

    $index = array_search($image_to_remove, $imagens_array);
    if ($index !== false) {
        $imagem_path = "../../app/images/" . $image_to_remove;

        if (file_exists($imagem_path)) {
            unlink($imagem_path);
        }

        unset($imagens_array[$index]);

        if ($novo_nome !== null) {
            $imagens_array[$index] = $novo_nome;
        }

        $novas_imagens = implode(", ", $imagens_array);
        $novas_imagens = ($_POST['novas_imagens'][0] === ',') ? substr($_POST['novas_imagens'], 1) : $_POST['novas_imagens'];

        $result = $db->execute_non_query("UPDATE produtos SET imagens = :novas_imagens WHERE id = :id_produto", [
            ":novas_imagens" => $novas_imagens,
            ":id_produto" => $_POST['id_produto']
        ]);

        if ($result->status === 'success') {
            $res['status'] = "success"; 
            $res['success'] = true;
            $res['message'] = "Imagem removida com sucesso!";
            echo json_encode($res);
        } else {
            $res['success'] = false;
            $res['message'] = "Erro ao atualizar o banco de dados.";
            echo json_encode($res);
        }
    } else {
        $res['success'] = false;
        $res['message'] = "Imagem não encontrada na lista.";
        echo json_encode($res);
    }
} else {
    $res['success'] = false;
    $res['message'] = "Produto não encontrado.";
    echo json_encode($res);
}
