<div class="container-fluid">
    <div class="container mt-5">
        <form id="pesquisar-pedido">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Pesquisar" aria-label="Pesquisar" aria-describedby="button-search">
                <button class="btn btn-outline-primary" type="submit" id="button-search">Pesquisar</button>
            </div>
            <h3>Filtrar por:</h3>

            <div class="btn-group d-flex flex-wrap" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="filtro" id="em-aberto" autocomplete="off" value="nome-produto">
                <label class="btn btn-outline-primary" for="em-aberto">Nome do Produto</label>

                <input type="radio" class="btn-check" name="filtro" id="descricao" autocomplete="off" value="pendente">
                <label class="btn btn-outline-primary" for="descricao">Descrição</label>

                <input type="radio" class="btn-check" name="filtro" id="prod-val" autocomplete="off" value="valor">
                <label class="btn btn-outline-primary" for="prod-val">Valor</label>

                <input type="radio" class="btn-check" name="filtro" id="qtd" autocomplete="off" value="quantidade">
                <label class="btn btn-outline-primary" for="qtd">Quantidade</label>

                <input type="radio" class="btn-check" name="filtro" id="data-de-cadastro" autocomplete="off" value="data-cadastro">
                <label class="btn btn-outline-primary" for="data-de-cadastro">Data de Cadastro</label>
            </div>
            
        </form>
        <button class="btn btn-secondary sys-btn mt-3" type="button" id="button-clear">Limpar Filtro</button>
    </div>
    <div class="container">
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
                        <th>Data de cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <button class="btn btn-success sys-btn panel-btn">Acessar</button>
                            <button class="btn btn-primary sys-btn panel-btn">Editar</button>
                            <button class="btn btn-danger sys-btn panel-btn">Deletar</button>
                        </td>
                        <td>1</td>
                        <td>Caderno</td>
                        <td>Descrição curta do item</td>
                        <td>24,99</td>
                        <td>100</td>
                        <td>00/00/0000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
