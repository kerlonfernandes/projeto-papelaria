

<div class="container-fluid">
    <div class="container mt-5">
        <form id="pesquisar-usuario">

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Pesquisar" aria-label="Pesquisar" aria-describedby="button-search" name="pesquisa">
                <button class="btn btn-outline-primary" type="submit" id="button-search" name="pesquisa">Pesquisar</button>
            </div>
            <h3>Filtrar por:</h3>
            <div class="btn-group mb-3 d-flex flex-wrap" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="filtro" id="filtro-nome" autocomplete="off" value="nome">
                <label class="btn btn-outline-primary mb-2" for="filtro-nome">Nome</label>

                <input type="radio" class="btn-check" name="filtro" id="filtro-email" autocomplete="off" value="email">
                <label class="btn btn-outline-primary mb-2" for="filtro-email">Email</label>

                <input type="radio" class="btn-check" name="filtro" id="filtro-telefone" autocomplete="off" value="telefone">
                <label class="btn btn-outline-primary mb-2" for="filtro-telefone">Telefone</label>

                <input type="radio" class="btn-check" name="filtro" id="filtro-nivel-acesso" autocomplete="off" value="nivel-acesso">
                <label class="btn btn-outline-primary mb-2" for="filtro-nivel-acesso">Nível de Acesso</label>

                <button class="btn btn-secondary sys-btn mb-2" type="button" id="button-clear-users">Limpar Filtro</button>
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
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Nível de acesso</th>
                        <th>Entrou em</th>
                    </tr>
                </thead>
                <tbody class="usuarios-table">


                </tbody>
            </table>
        </div>
    </div>
</div>