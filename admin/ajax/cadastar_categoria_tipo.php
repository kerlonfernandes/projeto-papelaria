<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../../classes/Database.inc.php";
require "../../_app/Config.inc.php";
require "../../classes/Helpers.inc.php";
use HelpersClass\SupAid;
use Midspace\Database;
$helpers = new SupAid();
$db = new Database(MYSQL_CONFIG);
$res = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $type_query = "";
    $query = ""; 

    if(isset($_POST['tipo'])) {
        $query = "INSERT INTO tipo_produto (tipo_produto, slug_tipo) VALUES (:tipo_n, :slug_tipo)";
        $params = [":tipo_n" => $_POST["tipo"],
                 ":slug_tipo" => $helpers->createSlug($_POST["tipo"])];
        $msg = "Tipo cadastrado com sucesso!";

    }
    if(isset($_POST['categoria'])) {
        $query = "INSERT INTO categorias (nome, slug_categoria) VALUES (:categoria, :slug_categoria)";
        $params = [":categoria" => $_POST["categoria"],
                    ':slug_categoria' => $helpers->createSlug($_POST["categoria"])];
        $msg = "Categoria cadastrada com sucesso!";
    }

    if (!empty($query)) {
        $results = $db->execute_non_query($query, $params);

        if($results->status == "success") {
            $res['status'] = "success";
            $res['message'] = $msg;
            $res['error'] = false;
            echo json_encode($res);
        }
        else {
            $res['status'] = "error";
            $res['message'] = "Ocorreu um erro ao cadastrar!";
            $res['error'] = true;
            echo json_encode($res);
        }
    } else {
        $res['status'] = "error";
        $res['message'] = "Nenhuma operação de inserção foi especificada!";
        $res['error'] = true;
        echo json_encode($res);
    }
}