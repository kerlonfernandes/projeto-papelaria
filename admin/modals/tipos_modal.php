<div class="modal fade" id="tipos" tabindex="-1" aria-labelledby="tiposLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tiposLabel">Tipos dos produtos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tipo</th>
                        </tr>
                    </thead>
                    <tbody class="tipos-table">
                   
                    </tbody>
                </table>
                <div class="text-center mt-3" id="loading-tipos" style="display:none;">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <form class="cadastrar-tipo">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Escreva um novo tipo" aria-label="" name="tipo">
                            <button class="btn btn-outline-success" type="submit">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

            </div>
        </div>
    </div>
</div>