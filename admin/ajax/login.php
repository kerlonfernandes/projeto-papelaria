<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../../classes/Database.inc.php";
require "../../_app/Config.inc.php";
use Midspace\Database;
$res = array();

try{

if(!isset($_POST['email']) || !isset($_POST['password'])) {
    $res['status'] = 'error';
    $res['message'] = 'Campos de email e senha são obrigatórios.';
    $res['erro'] = true;
    echo json_encode($res);
    return;
}

$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$password = $_POST['password'];

$db = new Database(MYSQL_CONFIG);

$result = $db->execute_query(
    "SELECT * 
    FROM users 
    LEFT JOIN nivel_acesso 
    ON users.id = nivel_acesso.id_user 
    WHERE users.email = :email",
    ["email" => $email]
);

if (!empty($result->results) && password_verify($password, $result->results[0]->senha)) {
    $response = $result->results[0];
    $_SESSION['admin'] = $response->nome;
    $_SESSION['id_admin'] = $response->id;
    $_SESSION['admin'] =  $response->acesso;
    $_SESSION['logged_admin'] = true;

    $res['status'] = 'success';
    $res['message'] = 'Autenticado com sucesso!';
    $res['erro'] = false;

    echo json_encode($res);
} else {
    $res['status'] = 'error';
    $res['message'] = 'Login ou senha incorretos!';
    $res['erro'] = true;
    echo json_encode($res);
}
}
catch (Exception $e) {
    $res["status"] = "error";
    $res["message"] = "ocorreu um erro interno no servidor";
    echo json_encode($res);
}