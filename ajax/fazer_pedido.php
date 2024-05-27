<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require "../classes/Database.inc.php";
require "../classes/Email.inc.php";
require "../_app/Config.inc.php";
require "../classes/Helpers.inc.php";
require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


use HelpersClass\SupAid;
use Midspace\Database;

$helpers = new SupAid();
$db = new Database(MYSQL_CONFIG);
$res = array();
$email = new Email();

// valor dos itens do pedido

if (isset($_SESSION["user_id"]) && $_SESSION['logged_user'] == True) {
    $user_id = $_SESSION['user_id'];
    $total = $db->execute_query("SELECT 
    SUM(produtos_carrinho.preco * produtos_carrinho.quantidade_p) AS total
    FROM 
    (
        SELECT 
            carrinho.produto_id, 
            produtos.*, 
            COUNT(*) AS quantidade_p
        FROM 
            carrinho 
        LEFT JOIN 
            users ON carrinho.user_id = users.id 
        LEFT JOIN 
            produtos ON produtos.id = carrinho.produto_id 
        WHERE 
            users.id = :user_id AND carrinho.item_selecionado = 1
        GROUP BY 
            carrinho.produto_id
    ) AS produtos_carrinho;", [":user_id" => $user_id])->results[0]->total;


    $usuario = $db->execute_query("SELECT email, nome FROM users WHERE id = :user_id", [":user_id" => $user_id])->results[0];
  

    $recipient_email = $usuario->email;
    $subject = 'O seu pedido foi aberto com sucesso!';
    $body = "<p>Parabéns <strong>{$usuario->nome}</strong></p><br><br><h3>Seu pedido foi aberto com sucesso! continue para os próximos passos.</h3>";
    $recipient_name = $usuario->nome;

    $email->add($subject, $body, $recipient_name, $recipient_email);
    // verificar se a quantidade pedida é maior que a quantidade no estoque
    $produto = $db->execute_query("SELECT 
                                        carrinho.produto_id, 
                                        produtos.*, 
                                        COUNT(*) AS quantidade_p
                                    FROM 
                                        carrinho 
                                    LEFT JOIN 
                                        users ON carrinho.user_id = users.id 
                                    LEFT JOIN 
                                        produtos ON produtos.id = carrinho.produto_id 
                                    WHERE 
                                        users.id = :user_id AND carrinho.item_selecionado = 1
                                    GROUP BY 
                                        carrinho.produto_id", [":user_id" => $user_id]);


    if ($produto->affected_rows > 0) {
        $prod_names = "";
        $produto_dados = $produto->results;
        foreach ($produto_dados as $prod) {

            if ($prod->quantidade_p > $prod->quantidade) {
                $prod_names .= $prod->nome . ", ";
            }
        }
        $prod_names = rtrim($prod_names, ", ");

        if (!empty($prod_names)) {
            $res['status'] = "error";
            $res['message'] = "A quantidade pedida dos produtos {$prod_names} não está disponível no estoque no momento.";
            $res['retorno'] = "Aviso!";
            echo json_encode($res);
            return;
        }
    } else {
        // No products found in the cart
        $res['status'] = "error";
        $res['message'] = "Nenhum produto encontrado no carrinho.";
        $res['retorno'] = "Aviso!";
        echo json_encode($res);
        return;
    }


    // $message = 
    // $produto_dados = $produto->results;
    // foreach($produto_dados as $prod) {

    // }
    // if ($produto_dados->quantidade_p > $produto_dados->quantidade) {
    //     $res['status'] = "error";
    //     $res['message'] = "A quantidade pedida do produto {$produto_dados->nome} não está disponível no estoque no momento.";
    //     $res['retorno'] = "Aviso!";
    //     echo json_encode($res);
    //     return;
    // }
    // insere na tabela a abertura do pedido
    $results = $db->execute_non_query(
        "INSERT INTO pedido (id_cliente, data_pedido, hora_pedido, total_pedido) 
    VALUES (:id_cliente, :data_pedido, :hora_pedido, :total)
    ",
        [
            ":id_cliente" => $user_id,
            ":data_pedido" => $dataAtual,
            ":hora_pedido" => $horaAtual,
            ":total" => $total
        ]
    );

    if ($results->status == "success") {

        $email->add($subject, $body, $recipient_name, $recipient_email);

        $res['status'] = "success";
        $res['message'] = "O seu pedido foi aberto com sucesso! Iremos te redirecionar para o próximo passo 😉";
        $res['retorno'] = "Sucesso!";
        $res['id'] = $helpers->encodeURL($results->last_id);
    } else {
        $res['status'] = "error";
        $res['message'] = "Erro ao fazer pedido!";
        $res['retorno'] = "Erro!";
    }
    echo json_encode($res);
}
