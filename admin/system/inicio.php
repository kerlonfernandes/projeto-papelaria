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
                        <p class="box-text">Pedidos em aberto</p>
                        <span class="badge text-bg-danger qtd pedidos-abertos"><?= $pedidos_abertos->p_abertos ?></span>
                        <a href="<?= SITE ?>/admin/?route=painel&sys=pedidos&filter=em-aberto" class="btn btn-da-box btn-block btn-sm mt-3">Visualizar <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="box alert alert-success">
                        <p class="box-text">Finalizados</p>
                        <span class="badge text-bg-success qtd finalizados"><?= $finalizados->p_finalizados ?></span>
                        <a href="<?= SITE ?>/admin/?route=painel&sys=pedidos&filter=finalizados" class="btn btn-da-box btn-block btn-sm mt-3">Visualizar <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="box alert alert-warning">
                        <p class="box-text">A Entregar</p>
                        <span class="badge text-bg-warning qtd entregar"><?= $a_entregar->p_a_entregar ?></span>
                        <a class="btn btn-da-box btn-block btn-sm mt-3">Visualizar <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="box alert alert-danger">
                        <p class="box-text">Aguardando reembolso</p>
                        <span class="badge text-bg-alert qtd entregar"><?=  $aguardando_reembolso->a_reembolso ?></span>
                        <a href="<?= SITE ?>/admin/?route=painel&sys=pedidos&filter=cancelados" class="btn btn-da-box btn-block btn-sm mt-3">Visualizar <i class="fa-solid fa-arrow-right"></i></a>
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
                        <span class="badge"><?=  $prod_cad->produtos_qtd ?></span>
                        <a href="<?= SITE ?>/admin/?route=painel&sys=products" class="btn btn-da-box btn-block btn-sm mt-3">Visualizar <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="box">
                        <p class="box-text">Usuários cadastrados</p>
                        <span class="badge"><?=  $usuarios->usuarios_qtd?></span>
                        <a href="<?= SITE ?>/admin/?route=painel&sys=users" class="btn btn-da-box btn-block btn-sm mt-3">Visualizar <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
