

   
   <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="step mb-4">
                    <div class="step-item active" id="passo1">Passo 1: Informações Pessoais</div>
                    <div class="step-item" id="passo2">Passo 2: Endereço</div>
                    <div class="step-item" id="passo3">Passo 3: Confirmação</div>
                </div>
                <div class="form-card mb-5">
                    <h2>Dados de endereço</h2>
                    <form id="enderecoForm">
                        <div id="passo1_content">
                            <div class="form-group">
                                <input class="id" type="hidden" name="id" value="<?= $route[0] ?>">
                                <label for="nomeCompleto">Nome Completo</label>
                                <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" required>
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <input type="tel" class="form-control celular" id="telefone" name="telefone" required>
                            </div>
                            <button type="button" class="btn btn-next mt-4">Próximo <i class="fa-solid fa-arrow-right"></i></button>
                        </div>

                        <div id="passo2_content" style="display: none;">
                            <div class="form-group">
                                <label for="cep">CEP</label>
                                <input type="text" class="form-control cep" id="cep" name="cep" maxlength="9">
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

                                        <?php if ($estados->affected_rows > 0) : ?>
                                            <?php foreach ($estados->results as $estado) : ?>
                                                <option value="<?= $estado->sigla ?>"><?= $estado->sigla ?></option>

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
                                    <button type="submit" class="btn btn-primary confirmar">Confirmar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-5" style="height: 100%;">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <ul class="stepbar">
        <li class="stepbar-item active">
          <a class="step-link" href="#">Endereço</a>
          <div class="step-line"></div>
        </li>
        <li class="stepbar-item">
          <a class="step-link" href="#">Pagamento</a>
          <div class="step-line"></div>
        </li>
        <li class="stepbar-item">
          <a class="step-link" href="#">Aguardar pedido</a>
          <div class="step-line"></div>
        </li>
      </ul>
    </div>
  </div>
</div>