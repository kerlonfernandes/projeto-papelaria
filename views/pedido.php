<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Endereço</title>
    <?php

use Midspace\Database;

        require_once "./inc/assets.inc.php"; 
        require_once "./inc/css_files.inc.php"; 
        require_once "./classes/Database.inc.php"; 

        $db = new Database(MYSQL_CONFIG);
        $estados = $db->execute_query("SELECT nome FROM estados");

     ?>


    <style>
        .step {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .step-item {
            padding: 10px 0;
            color: #6c757d;
            font-size: 18px;
            position: relative;
            margin-bottom: 20px;
        }

        .step-item::before {
            content: "\2022";
            font-size: 18px;
            position: absolute;
            left: -25px;
            top: 50%;
            transform: translateY(-50%);
            color: #007bff;
        }

        .step-item.active::before {
            content: "\25BA";
            font-size: 20px;
        }
    </style>

</head>

<body>
    <?php include "./components/header.php" ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="step mb-4">
                    <div class="step-item active" id="passo1">Passo 1: Informações Pessoais</div>
                    <div class="step-item" id="passo2">Passo 2: Endereço</div>
                    <div class="step-item" id="passo3">Passo 3: Confirmação</div>
                </div>
                <div class="form-card">
                    <h2>Dados de endereço</h2>
                    <form id="enderecoForm">
                        <div id="passo1_content">
                            <div class="form-group">
                                <label for="nomeCompleto">Nome Completo</label>
                                <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" required>
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" required pattern="\([0-9]{2}\) [0-9]{4,5}-[0-9]{4}">
                            </div>
                            <button type="button" class="btn btn-next mt-4">Próximo <i class="fa-solid fa-arrow-right"></i></button>
                        </div>

                        <div id="passo2_content" style="display: none;">
                            <div class="form-group">
                                <label for="cep">CEP</label>
                                <input type="text" class="form-control" id="cep" name="cep" required pattern="[0-9]{5}-[0-9]{3}" maxlength="9">
                            </div>
                            <div class="form-group">
                                <label for="endereco">Endereço</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="numeroResidencia">Número</label>
                                    <input type="text" class="form-control" id="numeroResidencia" name="numeroResidencia" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="complemento">Complemento</label>
                                    <input type="text" class="form-control" id="complemento" name="complemento">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" class="form-control" id="bairro" name="bairro" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="estado">Estado</label>
                                    <select id="estado" class="form-control" name="estado" required>
                                        <option selected disabled>Selecione...</option>
                                        
                                        <?php if($estados->affected_rows > 0): ?>
                                        <?php foreach($estados->results as $estado): ?>
                                        <option value="<?= $estado->nome ?>"><?= $estado->nome ?></option>
                                            
                                        <?php endforeach; ?>
                                        <?php endif; ?>

                                    </select>
                                </div>
                            </div>
                            <div class="botoes mt-4">
                                <button type="button" class="btn btn-prev"><i class="fa-solid fa-arrow-left"></i> Anterior</button>
                                <button type="button" class="btn btn-next">Próximo <i class="fa-solid fa-arrow-right"></i></button>
                            </div>
                        </div>

                        <div id="passo3_content" style="display: none;">
                            <div class="review-area p-4">
                                <h4 class="mb-4">Por favor, revise suas informações:</h4>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <strong>Nome Completo:</strong>
                                        <span id="nomeRevisao"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong>Telefone:</strong>
                                        <span id="telefoneRevisao"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <strong>Endereço:</strong>
                                        <span id="enderecoRevisao"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong>Número:</strong>
                                        <span id="numeroRevisao"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <strong>Complemento:</strong>
                                        <span id="complementoRevisao"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong>Bairro:</strong>
                                        <span id="bairroRevisao"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <strong>Cidade:</strong>
                                        <span id="cidadeRevisao"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong>Estado:</strong>
                                        <span id="estadoRevisao"></span>
                                    </div>
                                </div>
                                <div class="text-center mt-4 mb-5">
                                    <button type="button" class="btn btn-prev mr-3"><i class="fa-solid fa-arrow-left"></i> Anterior</button>
                                    <button type="submit" class="btn btn-primary">Confirmar</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require_once "./inc/js_files.inc.php"; ?>

    <script>
        $(document).ready(function() {
            $(".btn-next").click(function() {
                var currentStep = $(".step-item.active");
                var nextStep = currentStep.next();
                currentStep.removeClass("active");
                nextStep.addClass("active");
                $("#" + currentStep.attr("id") + "_content").hide();
                $("#" + nextStep.attr("id") + "_content").show();
            });

            $(".btn-prev").click(function() {
                var currentStep = $(".step-item.active");
                var prevStep = currentStep.prev();
                currentStep.removeClass("active");
                prevStep.addClass("active");
                $("#" + currentStep.attr("id") + "_content").hide();
                $("#" + prevStep.attr("id") + "_content").show();
            });

            $("#enderecoForm").submit(function(event) {
                event.preventDefault();

                // Captura os valores dos campos
                var nomeCompleto = $("#nomeCompleto").val();
                var telefone = $("#telefone").val();
                var endereco = $("#endereco").val();
                // Captura os demais campos de endereço

                // Atualiza os valores na seção de revisão
                $("#nomeRevisao").text(nomeCompleto);
                $("#telefoneRevisao").text(telefone);
                $("#enderecoRevisao").text(endereco);
                // Atualiza os demais campos de endereço

                // Mostra a seção de revisão
                $("#passo2_content").hide();
                $("#passo3_content").show();
            });
        });
    </script>
</body>

</html>