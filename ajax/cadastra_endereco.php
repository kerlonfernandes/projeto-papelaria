<?php
session_start();
require "../classes/Database.inc.php";
require "../_app/Config.inc.php";
require "../classes/Helpers.inc.php";

use HelpersClass\SupAid;
use Midspace\Database;

$helpers = new SupAid();
$db = new Database(MYSQL_CONFIG);
$res = array();

if (isset($_SESSION["user_id"]) && $_SESSION['logged_user'] == true) {
    $user_id = $_SESSION['user_id'];

    if (isset($_POST['nomeCompleto']) && isset($_POST['telefone']) && isset($_POST['cep']) && isset($_POST['endereco']) && isset($_POST['numeroResidencia']) && isset($_POST['bairro']) && isset($_POST['cidade']) && isset($_POST['estado']) && isset($_POST['id'])) {
        $id_pedido = $helpers->decodeURL($_POST['id']);
        $nome_completo = $_POST['nomeCompleto'];
        $telefone = $_POST['telefone'];
        $cep = $_POST['cep'];
        $endereco = $_POST['endereco'];
        $numeroResidencia = $_POST['numeroResidencia'];
        $complemento = isset($_POST['complemento']) ? $_POST['complemento'] : null;
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];

        // Atualiza os campos de endereço no pedido
        $results = $db->execute_non_query(
            "UPDATE pedido 
            SET nome_completo = :nome_completo,
                telefone = :telefone,
                cep = :cep,
                endereco = :endereco, 
                numero_residencia = :numeroResidencia, 
                complemento = :complemento, 
                bairro = :bairro, 
                cidade = :cidade, 
                estado = :estado 
            WHERE id = :id_pedido AND id_cliente = :user_id",
            [
                ":nome_completo" => $nome_completo,
                ":telefone" => $telefone,
                ":cep" => $cep,
                ":endereco" => $endereco,
                ":numeroResidencia" => $numeroResidencia,
                ":complemento" => $complemento,
                ":bairro" => $bairro,
                ":cidade" => $cidade,
                ":estado" => $estado,
                ":id_pedido" => $id_pedido,
                ":user_id" => $user_id
            ]
        );

        if ($results->status == "success") {

            $pedido = $db->execute_non_query("INSERT INTO pedidos (id_pedido, id_usuario, status_pedido, aguardando_reembolso, hora_pedido, data_pedido) VALUES (:id_pedido, :id_usuario, :status_pedido, :aguardando_reembolso, :hora_pedido, :data_pedido)", [
                ":id_usuario" => $user_id,
                ":id_pedido" => $id_pedido,
                ":status_pedido" => "Em Aberto",
                ":aguardando_reembolso" => 0,
                ":hora_pedido" => $horaAtual,
                ":data_pedido" => $dataAtual
            ]);

            $carrinho_produtos = $db->execute_query("SELECT 
                                            carrinho.produto_id, 
                                            produtos.*,
                                            carrinho.item_selecionado,
                                            COUNT(*) AS quantidade_p
                                        FROM 
                                            carrinho 
                                        LEFT JOIN 
                                            users ON carrinho.user_id = users.id 
                                        LEFT JOIN 
                                            produtos ON produtos.id = carrinho.produto_id 
                                        WHERE 
                                            users.id = :user_id
                                        AND carrinho.item_selecionado = 1
                                        GROUP BY 
                                            carrinho.produto_id;
                                            ", [":user_id" => $user_id]);

            foreach($carrinho_produtos->results as $produto) {
                
                $db->execute_non_query("INSERT INTO produtos_pedidos (id_pedido, id_produto, id_usuario, qtd_itens ,registro) VALUES (:id_pedido, :id_produto, :id_usuario, :qtd_itens, :registro)", [
                    ":id_pedido" => $id_pedido,
                    ":id_produto" => $produto->id,
                    ":id_usuario" => $user_id,
                    ":qtd_itens" => $produto->quantidade_p,
                    ":registro" => $dataAtual . " " . $horaAtual
                ]);
            }

            $res['status'] = "success";
            $res['message'] = "Endereço atualizado com sucesso!";
            $res['retorno'] = "Sucesso!";
            $res['id'] = $helpers->encodeURL($results->last_id);
        } else {
            $res['status'] = "error";
            $res['message'] = "Erro ao atualizar endereço!";
            $res['retorno'] = "Erro!";
        }
    } else {
        $res['status'] = "error";
        $res['message'] = "Todos os campos devem ser preenchidos!";
        $res['retorno'] = "Erro!";
    }

    echo json_encode($res);
}
