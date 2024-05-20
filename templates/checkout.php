<style>

.payment-method {
    display: flex;
    align-items: center;
}

.payment-method img {
    margin-right: 10px;
    width: 50px; /* Ajuste o tamanho conforme necessário */
    height: auto;
}


.card {
    cursor: pointer;
}

/* Estilize conforme necessário */

</style>


<div class="container">
    <h2 class="text-center mb-4">Checkout</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Formas de Pagamento</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="metodoPagamento" id="radioDebito" value="debito">
                        <label class="form-check-label" for="radioDebito">
                            <div class="payment-method">
                            <img src="<?= SITE ?>/src/images/card.png" alt="Cartão de Débito">
                                Débito
                            </div>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="metodoPagamento" id="radioCartao" value="cartao">
                        <label class="form-check-label" for="radioCartao">
                            <div class="payment-method">
                            <img src="<?= SITE ?>/src/images/card.png" alt="Cartão de Crédito">
                                Cartão de Crédito
                            </div>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="metodoPagamento" id="radioPix" value="pix">
                        <label class="form-check-label" for="radioPix">
                            <div class="payment-method">
                                <img src="<?= SITE ?>/src/images/logo-pix-520x520.png" alt="PIX">
                                PIX
                            </div>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="metodoPagamento" id="radioBoleto" value="boleto">
                        <label class="form-check-label" for="radioBoleto">
                            <div class="payment-method">
                            <img src="<?= SITE ?>/src/images/boleto.png" alt="Boleto Bancário">
                                Boleto Bancário
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card" id="cartaoForm">
                <div class="card-body">
                    <h5 class="card-title">Pagamento com Cartão de Crédito</h5>
                    <div class="form-group" style="display: none;">
                        <label for="nomeCartao">Nome no Cartão</label>
                        <input type="text" class="form-control" id="nomeCartao" required>
                    </div>
                    <div class="form-group">
                        <label for="cpfCartao">CPF/CNPJ</label>
                        <input type="text" class="form-control cpfcnpj" id="cpfCartao" required>
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
                    <div class="form-group" style="display: none;">
                        <label for="cpfPix">CPF/CNPJ</label>
                        <input type="text" class="form-control cpfcnpj" id="cpfPix" required>
                    </div>
                </div>
            </div>
            <div class="card" id="boletoForm">
                <div class="card-body">
                    <h5 class="card-title">Pagamento com Boleto Bancário</h5>
                    <div class="form-group" style="display: none;">
                        <label for="cpfBoleto">CPF/CNPJ</label>
                        <input type="text" class="form-control cpfcnpj" id="cpfBoleto" required>
                    </div>
                </div>
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
        <li class="stepbar-item active">
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

<script>
document.addEventListener("DOMContentLoaded", function() {
    const radios = document.querySelectorAll('.form-check-input');
    radios.forEach(radio => {
        radio.addEventListener('click', function() {
            this.checked = true;
        });
    });
});
</script>
