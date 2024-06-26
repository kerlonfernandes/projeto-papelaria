<div class="modal fade" id="cadastrar-produto" tabindex="-1" aria-labelledby="cadastrar-produtoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="cadastrar-produtoLabel">Cadastrar Produto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="cadastro-produto">
          <div class="mb-3">
            <label for="prod-nome" class="form-label">Nome do Produto:</label>
            <input type="text" class="form-control" id="prod-nome" name="produto_nome" require="">
          </div>
          <div class="mb-3">
            <label for="prod-descricao" class="form-label">Descrição:</label>
            <textarea class="form-control" id="prod-descricao" name="produto_descricao" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="imagens" class="form-label">Adicione as imagens do imóvel:</label>
            <input class="form-control" type="file" id="imagens" name="imagens[]" accept="image/*" multiple require>

            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
          <div class="mb-3">
            <label for="categorias-produtos" class="form-label">Selecione a categoria do produto</label>
            <select class="form-select form-select" id="categorias-produtos" name="categoria_produto" require="">
            </select>
          </div>

          <div class="mb-3">
            <label for="tipo-produto" class="form-label">Selecione o tipo do produto</label>
            <select class="form-select form-select" id="tipo-produtos" name="tipo_produto" require="">
            </select>
          </div>
          <div class="mb-3 mt-5">
            <label for="prod-preco" class="form-label">Valor:</label>
            <input type="text" class="form-control" id="real" placeholder="0,00" onkeyup="formatarReal(this)" name="preco" min="0" require="">
          </div>
          <div class="mb-3">
            <label for="prod-preco-anterior" class="form-label">Valor anterior:</label>
            <input type="text" class="form-control" id="prod-preco-anterior" placeholder="0,00" onkeyup="formatarReal(this)" name="preco_anterior" min="0">
          </div>
          <div class="mb-3">
            <label for="prod-quantidade" class="form-label">Quantidade:</label>
            <input type="number" class="form-control" id="prod-quantidade" name="produto_quantidade" min="0" value="1" require="">
          </div>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
