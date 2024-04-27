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

                <input type="radio" class="btn-check" name="filtro" id="categoria" autocomplete="off" value="categoria">
                <label class="btn btn-outline-primary" for="categoria">Categoria</label>

                <input type="radio" class="btn-check" name="filtro" id="tipo-produto" autocomplete="off" value="tipo_produto">
                <label class="btn btn-outline-primary" for="tipo-produto">Tipo do Produto</label>

                <input type="radio" class="btn-check" name="filtro" id="quantidade" autocomplete="off" value="quantidade">
                <label class="btn btn-outline-primary" for="quantidade">Quantidade</label>
            </div>

        </form>
        <div class="container-fluid">
    <div class="container mt-5">
        <button class="btn btn-secondary sys-btn mt-3" type="button" id="button-clear">Limpar Filtro</button>
        <div class="container mt-5">
            <button class="btn btn-primary sys-btn" type="button" data-bs-toggle="modal" data-bs-target="#cadastrar-produto">Cadastrar Produto</button>
            <button class="btn btn-danger sys-btn ms-3" type="button" data-bs-toggle="modal" data-bs-target="#categorias">Categorias dos produtos</button>
            <button class="btn btn-secondary sys-btn ms-3" type="button" data-bs-toggle="modal" data-bs-target="#tipos">Tipo dos produtos</button>
        </div>

        <div class="table-responsive mt-3" style="max-height: 600px;">
            <table class="table table-striped table-hover">
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

        <div id="pagination-info" class="text-center mt-3">
            Você está na página <span id="current-page">1</span>
        </div>

        <div id="pagination-buttons" class="d-flex justify-content-between align-items-center mt-3">
            <button id="prev-page" class="btn btn-outline-primary">Anterior</button>
            <button id="next-page" class="btn btn-outline-primary">Próximo</button>
        </div>
    </div>
</div>

    </div>
</div>



<?php include "./modals/cadastrar_produto.php"; ?>
<?php include "./modals/editar_produto.php"; ?>
<?php include "./modals/tipos_modal.php"; ?>
<?php include "./modals/categorias_modal.php"; ?>