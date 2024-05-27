<style>
    .panel-header {
        background-color: #007bff;
        color: white;
        padding: 10px;
    }

    .panel-content {
        padding: 20px;
        height: 100%;
        /* Para ocupar a altura total do pai */
    }

    .user-info {
        margin-bottom: 20px;
    }

    .user-info h3 {
        margin-bottom: 10px;
    }

    .table-responsive {
        margin-top: 20px;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .table th:first-child,
    .table td:first-child {
        width: 5%;
    }

    .table th:last-child,
    .table td:last-child {
        width: 15%;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel card background-color: #EEEEEE;">
                <div class="panel-header">Dados do Usuário</div>
                <div class="panel-content text-start d-flex justify-content-center align-items-center">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-4">
                            <div class="user-info text-center mb-4">
                                <h3>Dados comuns</h3>
                                <p>Nome: Nome do usuario</p>
                                <p>E-mail: usuario@exemplo.com</p>
                                <p>Telefone: (00) 12345-6789</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="user-info text-center mb-4">
                                <h3>Endereço</h3>
                                <p>Avenida aaaaa, n 111, Edificio aaaa</p>
                                <p>cep: 40000-00</p>
                                <p>Endereço: Rua Exemplo, 123</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="user-info text-center mb-4">
                                <h3>Resumo da atividade</h3>
                                <p>Compras feitas: 15</p>
                                <p>Pedidos cancelados: 5</p>
                                <p>Valor total: 1000,00</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <h3 class="text-center mb-3">Produtos Comprados</h3>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome do Produto</th>
                                <th>Descrição</th>
                                <th>Quantidade</th>
                                <th>Preço Unitário</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Produto 1</td>
                                <td>Descrição do Produto 1</td>
                                <td>2</td>
                                <td>$10.00</td>
                                <td>$20.00</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Produto 2</td>
                                <td>Descrição do Produto 2</td>
                                <td>1</td>
                                <td>$15.00</td>
                                <td>$15.00</td>
                            </tr>
                            <!-- Adicione mais linhas conforme necessário -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>