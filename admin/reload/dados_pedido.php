<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../../classes/Database.inc.php";
require "../../classes/Helpers.inc.php";
require "../../_app/Config.inc.php";

use Midspace\Database;
use HelpersClass\SupAid;

$db = new Database(MYSQL_CONFIG);
$helpers = new SupAid();


if (!isset($_GET['id'])) return;

$data = $db->execute_query("SELECT users.*, pedido.*, pedidos.*, pedidos.id AS num_pedido FROM pedidos LEFT JOIN users ON users.id = pedidos.id_usuario LEFT JOIN pedido ON pedido.id = pedidos.id_pedido WHERE pedidos.id_pedido = :id;", [
    ":id" => $_GET['id']
]);

$estados = $db->execute_query("SELECT sigla, nome FROM estados");


$dados_pedido = $data->results[0]

?>
<style>
    .b-n {
        border: none;
    }
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-6">
            <div class="user-info text-center mb-4">
                <ul class="list-group m-3">
                    <div class="text-center h3">Dados do usuário</div>
                    <li class="list-group-item b-n">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Nome completo no pedido</span>
                            <input type="text" class="form-control" placeholder="Nome completo" aria-label="Username" aria-describedby="basic-addon1" readonly value="<?= isset($dados_pedido->nome_completo) ? $dados_pedido->nome_completo : "Sem nome" ?>">
                        </div>
                    </li>
                    <li class="list-group-item b-n">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Nome completo no usuário</span>
                            <input type="text" class="form-control" placeholder="Nome do usuário" aria-label="name" aria-describedby="basic-addon1" readonly value="<?= isset($dados_pedido->nome) ? $dados_pedido->nome : "Sem nome" ?>">
                            <span class="input-group-text" id="basic-addon2"><a href="<?= SITE ?>/admin/?route=painel&sys=usuario&id=<?= $helpers->encodeURL($dados_pedido->id_usuario) ?>"><i class="fa-solid fa-user"></i></a></span>
                        </div>
                    </li>
                    <li class="list-group-item b-n">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Email</span>
                            <input type="text" class="form-control" placeholder="Email" aria-label="name" aria-describedby="basic-addon1" readonly value="<?= isset($dados_pedido->email) ? $dados_pedido->email : "Sem nome" ?>">
                        </div>
                    </li>
                    <li class="list-group-item b-n">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">CPF/CNPJ</span>
                            <input type="text" class="form-control" placeholder="Email" aria-label="name" aria-describedby="basic-addon1" readonly value="<?= isset($dados_pedido->cpfcnpj) ? $dados_pedido->cpfcnpj : "Sem nome" ?>">
                        </div>
                    </li>
                    <li class="list-group-item b-n">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Telefone</span>
                            <input type="text" class="form-control" placeholder="Telefone" aria-label="Username" aria-describedby="basic-addon1" readonly value="<?= isset($dados_pedido->telefone) ? $dados_pedido->telefone : "Sem Telefone" ?>">
                        </div>
                    </li>
                </ul>
                <div class="card">
                    <div class="text-center h3 m-2">Dados de pagamento</div>
                    <ul class="list-group b-n text-start" style="border-radius: 1px;">
                        <li class="list-group-item"><strong>Metodo de pagamento:</strong> <?= isset($dados_pedido->metodo_pagamento) ? $dados_pedido->metodo_pagamento : "Ainda não definido" ?></li>
                        <li class="list-group-item"><strong>Cupom de desconto:</strong> <?= isset($dados_pedido->cupom_desconto) ? $dados_pedido->cupom_desconto : "Sem cupom aplicado" ?></li>

                    </ul>

                </div>
                <p class="d-inline-flex mt-4">
                    <button class="btn btn-primary sys-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Outros detalhes do produto
                    </button>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <ul class="list-group list-group-flush text-start">
                            <li class="list-group-item text-center"><?= isset($dados_pedido->observacoes) ? $dados_pedido->observacoes : "Sem observações adicionadas" ?></li>
                            <li class="list-group-item"><strong>Status do pedido:</strong>
                                <div class="input-group mb-3">
                                    <select class="form-select muda-status" id="select" data-id="<?= $helpers->encodeURL($dados_pedido->num_pedido) ?>">
                                        <option selected> <?= isset($dados_pedido->status_pedido) ? $dados_pedido->status_pedido : "" ?>
                            </li>
                            </option>
                            <option value="Em Aberto">Em Aberto</option>
                            <option value="Pendente">Pendente</option>
                            <option value="Finalizado">Finalizado</option>
                            <option value="A entregar">A entregar</option>
                            <option value="Cancelado">Cancelado</option>
                            </select>
                    </div>

                    <li class="list-group-item"><strong>Aguardando reembolso:</strong>
                        <select class="form-select  aguardando">
                            <option value="<?= $dados_pedido->aguardando_reembolso ?>" selected><?= (isset($dados_pedido->aguardando_reembolso) ? $dados_pedido->aguardando_reembolso : "") == 1 ? "SIM" : "NÃO" ?></option>
                            <option value="1">SIM</option>
                            <option value="0">NÃO</option>
                        </select>
                    </li>
                    <li class="list-group-item"><strong>Hora do pedido:</strong> <?= isset($dados_pedido->hora_pedido) ? $dados_pedido->hora_pedido : "" ?></li>
                    <li class="list-group-item"><strong>Data do pedido:</strong> <?= date("d/m/Y", strtotime($dados_pedido->data_pedido)) ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="user-info text-center mb-4">
            <ul class="list-group m-3">
                <div class="text-center h3">Dados de endereço</div>
                <li class="list-group-item b-n">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">CEP</span>
                        <input type="text" class="form-control cep" placeholder="CEP" aria-label="cep" aria-describedby="basic-addon1" readonly value="<?= isset($dados_pedido->cep) ? $dados_pedido->cep : "Sem CEP" ?>">
                    </div>
                </li>
                <li class="list-group-item b-n">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Endereço</span>
                        <textarea type="text" class="form-control endereco" placeholder="Endereço" aria-label="Username" aria-describedby="basic-addon1" readonly><?= isset($dados_pedido->endereco) ? $dados_pedido->endereco : "Sem Endereço" ?></textarea>
                    </div>
                </li>
                <li class="list-group-item b-n">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Número</span>
                        <input type="text" class="form-control numero" placeholder="Número" aria-label="Número" aria-describedby="basic-addon1" readonly value="<?= isset($dados_pedido->numero_residencia) ? $dados_pedido->numero_residencia : "Sem numero" ?>">
                    </div>
                </li>
                <li class="list-group-item b-n">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Complemento</span>
                        <input type="text" class="form-control complemento" placeholder="Complemento" aria-label="Complemento" aria-describedby="basic-addon1" readonly value="<?= isset($dados_pedido->complemento) ? $dados_pedido->complemento : "Sem complemento" ?>">
                    </div>
                </li>
                <li class="list-group-item b-n">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Bairro</span>
                        <input type="text" class="form-control bairro" placeholder="Bairro" aria-label="Bairro" aria-describedby="basic-addon1" readonly value="<?= isset($dados_pedido->bairro) ? $dados_pedido->bairro : "Sem bairro" ?>">
                    </div>
                </li>
                <li class="list-group-item b-n">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Cidade</span>
                        <input type="text" class="form-control cidade" placeholder="Cidade" aria-label="Cidade" aria-describedby="basic-addon1" readonly value="<?= isset($dados_pedido->cidade) ? $dados_pedido->cidade : "Sem cidade" ?>">
                    </div>
                </li>
                <li class="list-group-item b-n">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Estado</span>

                        <select class="form-select estado">
                            <option selected><?= isset($dados_pedido->estado) ? $dados_pedido->estado : "Sem estado" ?>
                            </option>
                            <?php if ($estados->affected_rows > 0) : ?>
                                <?php foreach ($estados->results as $estado) : ?>
                                    <option value="<?= $estado->sigla ?>"><?= $estado->sigla ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </li>
                <button type="button" class="btn btn-outline-primary w-100 sys-btn mt-3 editar-endereco" data-id="<?= $helpers->encodeURL($dados_pedido->id_pedido) ?>">Editar Endereço</button>
            </ul>
        </div>
    </div>
</div>
</div>