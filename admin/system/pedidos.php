<div class="container-fluid">
    <div class="container mt-5">
        <form id="pesquisar-pedido">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Pesquisar" aria-label="Pesquisar" aria-describedby="button-search" name="pesquisa">
                <button class="btn btn-outline-primary" type="submit" id="button-search">Pesquisar</button>
            </div>
            <h3>Filtrar por:</h3>

            <div class="btn-group mb-3 d-flex flex-wrap" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="filtro" id="n-pedido" autocomplete="off" value="n_pedido">
                <label class="btn btn-outline-primary" for="n-pedido">Nº pedido</label>

                <input type="radio" class="btn-check" name="filtro" id="filter-description" autocomplete="off" value="usuario">
                <label class="btn btn-outline-primary" for="filter-description">Usuário</label>

                <input type="radio" class="btn-check" name="filtro" id="filter-value" autocomplete="off" value="valor">
                <label class="btn btn-outline-primary" for="filter-value">Valor</label>

                <input type="radio" class="btn-check" name="filtro" id="filter-quantity" autocomplete="off" value="quantidade">
                <label class="btn btn-outline-primary" for="filter-quantity">Quantidade</label>
            </div>


            <div class="btn-group mb-3 d-flex flex-wrap" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="status" id="em-aberto" autocomplete="off" value="Em aberto">
                <label class="btn btn-outline-primary" for="em-aberto">Em aberto</label>

                <input type="radio" class="btn-check" name="status" id="pendentes" autocomplete="off" value="Pendente">
                <label class="btn btn-outline-primary" for="pendentes">Pendente</label>

                <input type="radio" class="btn-check" name="status" id="finalizados" autocomplete="off" value="Finalizado">
                <label class="btn btn-outline-primary" for="finalizados">Finalizado</label>

                <input type="radio" class="btn-check" name="status" id="entregar" autocomplete="off" value="A entregar">
                <label class="btn btn-outline-primary" for="entregar">A entregar</label>

                <input type="radio" class="btn-check" name="status" id="cancel" autocomplete="off" value="Cancelado">
                <label class="btn btn-outline-primary" for="cancel">Cancelado</label>
                <button class="btn btn-secondary sys-btn" type="button" id="button-clear">Limpar Filtro</button>
            </div>


        </form>

    </div>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Nº Pedido</th>
                        <th>Usuário</th>
                        <th>Quantidade de itens</th>
                        <th>Valor total</th>
                        <th>Estado do pedido</th>
                        <th>Aguardando reembolso</th>

                    </tr>
                </thead>
                <tbody class="tabela-pedidos">
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