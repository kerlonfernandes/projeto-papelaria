<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="panel">
                <div class="panel-header">Pedidos</div>
                <div class="panel-content">
                    <div class="box alert alert-danger">
                        <p class="box-text">Pedidos em aberto <i class="fa-solid fa-paper-plane"></i></p>
                        <span class="badge text-bg-danger qtd pedidos-abertos"><?= $pedidos_abertos->p_abertos ?></span>
                        <a href="<?= SITE ?>/admin/?route=painel&sys=pedidos&filter=em-aberto" class="btn btn-da-box btn-block btn-sm mt-3">Visualizar <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="box alert alert-success">
                        <p class="box-text">Finalizados <i class="fa-regular fa-circle-check"></i></p>
                        <span class="badge text-bg-success qtd finalizados"><?= $finalizados->p_finalizados ?></span>
                        <a href="<?= SITE ?>/admin/?route=painel&sys=pedidos&filter=finalizados" class="btn btn-da-box btn-block btn-sm mt-3">Visualizar <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="box alert alert-warning">
                        <p class="box-text">A Entregar <i class="fa-solid fa-truck-fast"></i></p>
                        <span class="badge text-bg-warning qtd entregar"><?= $a_entregar->p_a_entregar ?></span>
                        <a class="btn btn-da-box btn-block btn-sm mt-3">Visualizar <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="box alert alert-danger">
                        <p class="box-text">Aguardando reembolso <i class="fa-solid fa-triangle-exclamation"></i></p>
                        <span class="badge text-bg-alert qtd entregar"><?= $aguardando_reembolso->a_reembolso ?></span>
                        <a href="<?= SITE ?>/admin/?route=painel&sys=pedidos&filter=cancelados" class="btn btn-da-box btn-block btn-sm mt-3">Visualizar <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="row mt-5 card p-5" style="border: none; background-color: #EEEE;">
                    <h3 class="text-center">Alterar</h3>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Dados de login</h5>
                                    <form id="login_admin" class="login-form">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email de acesso</label>
                                            <input type="email" class="form-control" id="user" name="email" placeholder="Email" required value="<?= $dados_admin->email ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Senha</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Senha" required>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary w-50">Alterar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="panel">
                <div class="panel-header">Cadastros</div>
                <div class="panel-content">
                    <div class="box">
                        <p class="box-text">Produtos cadastrados</p>
                        <span class="badge"><?= $prod_cad->produtos_qtd ?></span>
                        <a href="<?= SITE ?>/admin/?route=painel&sys=products" class="btn btn-da-box btn-block btn-sm mt-3">Visualizar <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="box">
                        <p class="box-text">Usuários cadastrados</p>
                        <span class="badge"><?= $usuarios->usuarios_qtd ?></span>
                        <a href="<?= SITE ?>/admin/?route=painel&sys=users" class="btn btn-da-box btn-block btn-sm mt-3">Visualizar <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>