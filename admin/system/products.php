<script>
  function formatarReal(elemento) {
    let valor = elemento.value.replace(/[^\d,]/g, '');

    valor = valor.replace(/,/g, '').replace(/(\d+)\.(\d+)\.$/, '$1$2').replace(/\.(?=.*\.)/g, '');

    valor = valor.replace(/(\d)(\d{2})$/, '$1,$2');

    valor = valor.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');

    elemento.value = valor;
  }
</script>

<div class="container-fluid">
  <div class="container mt-5">
    <form id="pesquisar-produto">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Pesquisar" aria-label="Pesquisar" aria-describedby="button-search" name="pesquisa">
        <button class="btn btn-outline-primary" type="submit" id="button-search">Pesquisar</button>
      </div>
      <h3>Filtrar por:</h3>

      <div class="btn-group d-flex flex-wrap" role="group" aria-label="Basic radio toggle button group">
        <input type="radio" class="btn-check" name="filtro" id="nome" autocomplete="off" value="nome">
        <label class="btn btn-outline-primary" for="nome">Nome do Produto</label>

        <input type="radio" class="btn-check" name="filtro" id="descricao" autocomplete="off" value="descricao">
        <label class="btn btn-outline-primary" for="descricao">Descrição</label>


        <!-- <input type="text" id="real" placeholder="0,00" pattern="^(\d{1,3}(\.\d{3})*|\d+)(,\d{2})?$" onkeyup="formatarReal(this)"> -->

        <label class="btn btn-outline-primary" for="qtd">Quantidade</label>

        <input type="radio" class="btn-check" name="filtro" id="categoria" autocomplete="off" value="categoria">
        <label class="btn btn-outline-primary" for="categoria">Categoria</label>

        <input type="radio" class="btn-check" name="filtro" id="tipo-produto" autocomplete="off" value="tipo_produto">
        <label class="btn btn-outline-primary" for="tipo-produto">Tipo do Produto</label>
      </div>

    </form>
    <button class="btn btn-secondary sys-btn mt-3" type="button" id="button-clear">Limpar Filtro</button>

  </div>

  <div class="container">
    <button class="btn btn-primary sys-btn mt-5" type="button" data-bs-toggle="modal" data-bs-target="#cadastrar-produto">Cadastrar Produto</button>

    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th></th>
            <th>ID</th>
            <th>Nome do produto</th>
            <th>Descrição</th>
            <th>Valor</th>
            <th>Quantidade</th>
            <th>Categoria</th>
            <th>Tipo do produto</th>

            <th>Data de cadastro</th>
          </tr>
        </thead>
        <tbody class="table-products">
          <div class="text-center mt-3" id="loading" style="display:none;">
            <div class="spinner-border" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
          </div>
        </tbody>
      </table>
    </div>
  </div>
</div>


<?php include "./modals/cadastrar_produto.php"; ?>
<?php include "./modals/editar_produto.php"; ?>
