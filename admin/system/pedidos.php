<div class="container-fluid">
    <div class="container mt-5">
    <form id="pesquisar-pedido">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Pesquisar" aria-label="Pesquisar" aria-describedby="button-search">
        <button class="btn btn-outline-primary" type="submit" id="button-search">Pesquisar</button>
    </div>
    <h3>Filtrar por:</h3>

    <div class="btn-group-toggle mb-3" data-toggle="buttons">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="filtro-radio" id="n-pedido" autocomplete="off" value="n_pedido">
            <label class="btn btn-outline-primary" for="n-pedido">N pedido</label>

            <input type="radio" class="btn-check" name="filtro-radio" id="filter-description" autocomplete="off" value="descricao">
            <label class="btn btn-outline-primary" for="filter-description">Usuário</label>

            <input type="radio" class="btn-check" name="filtro-radio" id="filter-value" autocomplete="off" value="valor_produto">
            <label class="btn btn-outline-primary" for="filter-value">Valor</label>

            <input type="radio" class="btn-check" name="filtro-radio" id="filter-quantity" autocomplete="off" value="quantidade">
            <label class="btn btn-outline-primary" for="filter-quantity">Quantidade</label>
        </div>
    </div>

    <div class="btn-group-toggle mb-3" data-toggle="buttons">
        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
            <input type="checkbox" class="btn-check" id="em-aberto" autocomplete="off" value="Em aberto">
            <label class="btn btn-outline-primary" for="em-aberto">Em aberto</label>

            <input type="checkbox" class="btn-check" id="pendentes" autocomplete="off" value="Pendente">
            <label class="btn btn-outline-primary" for="pendentes">Pendente</label>

            <input type="checkbox" class="btn-check" id="finalizados" autocomplete="off" value="Finalizar">
            <label class="btn btn-outline-primary" for="finalizados">Finalizar</label>

            <input type="checkbox" class="btn-check" id="entregar" autocomplete="off" value="A entregar">
            <label class="btn btn-outline-primary" for="entregar">A entregar</label>
            
            <input type="checkbox" class="btn-check" id="cancel" autocomplete="off" value="Cancelado">
            <label class="btn btn-outline-primary" for="cancel">Cancelados</label>
        </div>
    </div>

    <button class="btn btn-secondary sys-btn" type="button" id="button-clear">Limpar Filtro</button>
</form>

    </div>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>ID do pedido</th>
                        <th>N Pedido</th>
                        <th>Usuário</th>
                        <th>Quantidade de itens</th>
                        <th>Valor total</th>
                        <th>Estado do pedido</th>
                        <th>Aguardando reembolso</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <button class="btn btn-success sys-btn">Acessar</button>
                            <button class="btn btn-primary sys-btn">Editar</button>
                            <button class="btn btn-danger sys-btn">Deletar</button>
                        </td>
                        <td>1</td>
                        <td>João</td>
                        <td>jdsaasd@example.com</td>
                        <td><a href="<?= SITE ?>/admin/?route=painel&sys=usuario&id=<?= 1 ?>" style="text-decoration: none;">Nome do usuário</a></td>
                        <td>10</td>
                        <td>1020,00</td>
                        <td>
                            <div class="input-group mb-3">
                                <select class="form-select" id="select" aria-label="Select example">
                                    <option selected>Estado do pedido</option>
                                    <option value="Aberto">Em Aberto</option>
                                    <option value="Pendente">Pendente</option>
                                    <option value="Finalizado">Finalizado</option>
                                    <option value="A entregar">A entregar</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
                            </div>
                        </td>
                        <td>Não</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
