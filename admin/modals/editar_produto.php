<div class="modal fade" id="editar-produto" tabindex="-1" aria-labelledby="editar-produtoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editar-produtoLabel">Editar Produto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="editar-produto">
          <div class="mb-3">
            <label for="prod-nome" class="form-label">Nome do Produto:</label>
            <input type="text" class="form-control" id="prod-nome" name="produto_nome">
          </div>
          <div class="mb-3">
            <label for="prod-descricao" class="form-label">Descrição:</label>
            <textarea class="form-control" id="prod-descricao" name="produto_descricao" rows="3"></textarea>
          </div>

          <div class="mb-3">
            <label for="categorias-produtos-editar" class="form-label">Selecione a categoria do produto</label>
            <select class="form-select form-select" id="categorias-produtos-editar" name="categoria_produto">
            <option value="" class="cat-editar"></option>
            </select>
          </div>

          <div class="mb-3">
            <label for="tipo-produto-editar" class="form-label">Selecione o tipo do produto</label>
            <select class="form-select form-select" id="tipo-produtos-editar" name="tipo_produto">
              <option value="" class="tipo-editar"></option>
            </select>
          </div>
          <div class="mb-3 mt-5">
            <label for="prod-preco" class="form-label">Valor:</label>
            <input type="text" class="form-control" id="real" placeholder="0,00" onkeyup="formatarReal(this)" name="preco" min="0">
          </div>
          <div class="mb-3">
            <label for="prod-preco-anterior" class="form-label">Valor anterior:</label>
            <input type="text" class="form-control" id="prod-preco-anterior" placeholder="0,00" onkeyup="formatarReal(this)" name="preco_anterior" min="0">
          </div>
          <div class="mb-3">
            <label for="prod-quantidade" class="form-label">Quantidade:</label>
            <input type="number" class="form-control" id="prod-quantidade" name="produto_quantidade" min="0" value="1">
          </div>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Editar</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>