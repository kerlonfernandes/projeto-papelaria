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

if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['id_produto'])) {
        $idProduto = $_POST['id_produto'];
        
        $resultProduto = $db->execute_non_query(
            "DELETE FROM produtos WHERE id = :id;", [
            ":id" => $idProduto
        ]);
     
        if($resultProduto->status == "success") {
   
            $res['status'] = "success";
            $res['message'] = "Produto excluído com sucesso!";
            $res['error'] = false;
            echo json_encode($res);
        } else {
 
            $res['status'] = "error";
            $res['message'] = "Ocorreu um erro ao excluir o produto!";
            $res['error'] = true;
            echo json_encode($res);
        }
    } else {
        $res['status'] = "error";
        $res['message'] = "ID do produto não especificado!";
        $res['error'] = true;
        echo json_encode($res);
    }
} else {
    $res['status'] = "error";
    $res['message'] = "Método de requisição inválido!";
    $res['error'] = true;
    echo json_encode($res);
}

