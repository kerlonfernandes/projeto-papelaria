

        <div class="container">
            <h2 class="text-center mb-4">Checkout</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Formas de Pagamento</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="metodoPagamento" id="radioCartao" value="cartao">
                                <label class="form-check-label" for="radioCartao">
                                    Cartão de Crédito
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="metodoPagamento" id="radioPix" value="pix">
                                <label class="form-check-label" for="radioPix">
                                    PIX
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="metodoPagamento" id="radioBoleto" value="boleto">
                                <label class="form-check-label" for="radioBoleto">
                                    Boleto Bancário
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card" id="cartaoForm">
                        <div class="card-body">
                            <h5 class="card-title">Pagamento com Cartão de Crédito</h5>
                            <div class="form-group">
                                <label for="nomeCartao">Nome no Cartão</label>
                                <input type="text" class="form-control" id="nomeCartao" required>
                            </div>
                            <div class="form-group">
                                <label for="cpfCartao">CPF/CNPJ</label>
                                <input type="text" class="form-control" id="cpfCartao" required>
                            </div>
                            <div class="form-group">
                                <label for="numeroCartao">Número do Cartão</label>
                                <input type="text" class="form-control" id="numeroCartao" required>
                            </div>
                            <div class="form-group">
                                <label for="validadeCartao">Data de Validade</label>
                                <input type="text" class="form-control" id="validadeCartao" required>
                            </div>
                            <div class="form-group">
                                <label for="cvvCartao">CVC/CVV</label>
                                <input type="text" class="form-control" id="cvvCartao" required>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="pixForm">
                        <div class="card-body">
                            <h5 class="card-title">Pagamento com PIX</h5>
                            <div class="form-group">
                                <label for="cpfPix">CPF/CNPJ</label>
                                <input type="text" class="form-control" id="cpfPix" required>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="boletoForm">
                        <div class="card-body">
                            <h5 class="card-title">Pagamento com Boleto Bancário</h5>
                            <div class="form-group">
                                <label for="cpfBoleto">CPF/CNPJ</label>
                                <input type="text" class="form-control" id="cpfBoleto" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
