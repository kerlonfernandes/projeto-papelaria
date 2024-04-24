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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $type_query = "";
    $query = ""; 

    if(isset($_POST['id'])) {
        $query = "DELETE FROM tipo_produto WHERE id = :id";
        $params = [":id" => $_POST["id"]];
        $msg = "Tipo deletado com sucesso!";

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
            $res['message'] = "Ocorreu um erro ao deletar!";
            $res['error'] = true;
            echo json_encode($res);
        }
    } else {
        $res['status'] = "error";
        $res['message'] = "Nenhuma operação de exclusão foi especificada!";
        $res['error'] = true;
        echo json_encode($res);
    }
}