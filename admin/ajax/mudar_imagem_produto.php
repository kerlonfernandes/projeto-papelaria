<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../../classes/Database.inc.php";
require "../../_app/Config.inc.php";

use Midspace\Database;

$db = new Database(MYSQL_CONFIG);
$res = array();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagem"])) {
    $imagem = $_FILES["imagem"];
    $image_origin_name = $_POST['image_name'];
    $pastaDestino = "../../app/images/";

  
    if (!file_exists($pastaDestino)) {
        mkdir($pastaDestino, 0777, true);
    }

    if ($imagem["error"] == UPLOAD_ERR_OK) {
        $novoNome = uniqid('img_', true) . '_' . basename($imagem["name"]);
        $caminhoArquivo = $pastaDestino . $novoNome;


        if (move_uploaded_file($imagem["tmp_name"], $caminhoArquivo)) {

            $imagem_alterar = $db->execute_query("SELECT imagens FROM produtos WHERE id = :id_produto", [
                ":id_produto" => $_POST['id_produto']
            ])->results[0];
            
            $uniq_img = $imagem_alterar->imagens;
            $arr_images = explode(", ", $uniq_img);
            
            if (isset($novoNome)) {
                $index = array_search($image_origin_name, $arr_images);
                if ($index !== false) {
                    $arr_images[$index] = $novoNome;
                }
            }
            
            $new_images = implode(", ", $arr_images);
            $db->execute_query("UPDATE produtos SET imagens = :novas_imagens WHERE id = :id_produto", [
                ":novas_imagens" => $new_images,
                ":id_produto" => $_POST['id_produto']
            ]);
            $res['status'] = "success"; 
            $res['success'] = true;
            $res['message'] = "Imagem alterada com sucesso!";
            
        } else {
            $res['success'] = false;
            $res['message'] = "Erro ao mover o arquivo para o diretório de destino.";
        }
    } else {
        $res['success'] = false;
        $res['message'] = "Erro ao carregar o arquivo: " . $imagem["error"];
    }
} else {
    $res['success'] = false;
    $res['message'] = "Nenhuma imagem foi enviada.";
}



echo json_encode($res);

