<?php

isset($_GET['id']) ?  : $helpers->redirect(SITE . "/admin/?route=painel&sys=products");

$prod_id = $helpers->decodeURL($_GET['id']);

$produto = $db->execute_query("SELECT produtos.*, categorias.nome AS categoria, tipo_produto.tipo_produto AS tipo FROM produtos LEFT JOIN categorias ON categorias.id = produtos.categoria_id LEFT JOIN tipo_produto ON tipo_produto.id = produtos.tipo_produto_id WHERE produtos.id = :id", [
    ":id" => $prod_id
]);

if ($produto->affected_rows < 1) {
    echo '
    <a type="button" class="btn sys-btn panel-btn m-4" style="width: 248px;" href="' . SITE . '/admin/?route=painel&sys=products">Voltar</a>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2 m-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div class="text-center">
      Produto não encontrado!
    </div>
  </div>';
    return;
}

$prod = $produto->results[0];

$categorias = $db->execute_query("SELECT nome, id FROM categorias ");
$cat = $categorias->results;

$tipos = $db->execute_query("SELECT tipo_produto, id FROM tipo_produto");
$tip = $tipos->results;
$imagens_array = [];

if ($prod->imagens !== null) {
    if (strpos($prod->imagens, ',') !== false) {
        $imagens_array = explode(',', $prod->imagens);
    } else {
        $imagens_array[] = $prod->imagens;
    }
}

$imagens_array = array_map('trim', $imagens_array);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="modal fade" id="uploadImagemModal" tabindex="-1" aria-labelledby="uploadImagemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadImagemModalLabel">Imagem Selecionada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="imagemModal" src="" class="img-fluid" alt="Imagem Selecionada" data-image="">
                <div class="mt-3">
                    <label for="novaImagem" class="form-label">Enviar Nova Imagem:</label>
                    <input type="file" class="form-control" id="novaImagem" name="novaImagem" accept="image/*">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" id="btnSalvarImagem" data-prod-id="<?= $prod_id  ?>">Salvar</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php if (!empty($imagens_array)) : ?>
                        <?php foreach ($imagens_array as $key => $imagem) : ?>
                            <?php
                            $caminho_imagem = "../app/images/$imagem";
                            $imagem_existente = file_exists($caminho_imagem);
                            ?>
                            <div class="carousel-item <?php echo ($key === 0) ? 'active' : ''; ?>">
                                <?php if ($imagem_existente) : ?>
                                    <img src="<?= $caminho_imagem; ?>" class="d-block w-100 imagem-carousel" alt="Imagem <?= $key + 1; ?>" data-bs-toggle="modal" data-bs-target="#uploadImagemModal" data-imagem="<?= $caminho_imagem; ?>" data-img-name="<?= $imagem ?>">
                                <?php else : ?>

                                    <img src="https://via.placeholder.com/600x200?text=Sem Imagem&&fg=black
" class="d-block w-100 imagem-carousel" alt="Placeholder" data-bs-toggle="modal" data-bs-target="#uploadImagemModal">
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            Este produto não contém imagem, portanto, não aparecerá na home inicial do site por questões do sistema.
                        </div>
                    <?php endif; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>


            <div class="row mt-5">
                <div class="col-lg-12">
                    <!-- Formulário -->
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">Produto</h1>
                        </div>
                        <div class="card-body">
                            <form class="editar-produto">
                                <div class="form-group">
                                    <label for="prod-nome">Nome do Produto:</label>
                                    <input type="text" class="form-control" id="prod-nome" name="produto_nome" value="<?= $prod->nome ?>">
                                </div>
                                <div class="form-group">
                                    <label for="prod-descricao">Descrição:</label>
                                    <textarea class="form-control" id="prod-descricao" name="produto_descricao" rows="3"><?= $prod->descricao ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="categorias-produtos">Selecione a categoria do produto</label>
                                    <select class="form-control" id="categorias-produtos" name="categoria_produto">
                                        <option value="<?= $prod->categoria_id ?>"><?= $prod->categoria ?></option>
                                        <?php foreach ($cat as $categoria) : ?>
                                            <option value="<?= $categoria->id ?>"><?= $categoria->nome ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tipo-produto">Selecione o tipo do produto</label>
                                    <select class="form-control" id="tipo-produtos" name="tipo_produto">
                                        <option value="<?= $prod->tipo_produto_id ?>"><?= $prod->tipo ?></option>
                                        <?php foreach ($tip as $tipo) : ?>
                                            <option value="<?= $tipo->id ?>"><?= $tipo->tipo_produto ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="prod-preco">Valor:</label>
                                    <input type="text" class="form-control" id="real" placeholder="0,00" onkeyup="formatarReal(this)" name="preco" min="0" value="<?= number_format($prod->preco, 2, ',', '.'); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="prod-preco-anterior">Valor anterior:</label>
                                    <input type="text" class="form-control" id="prod-preco-anterior" placeholder="0,00" onkeyup="formatarReal(this)" name="preco_anterior" min="0" value="<?= number_format($prod->preco_anterior, 2, ',', '.'); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="prod-quantidade">Quantidade:</label>
                                    <input type="number" class="form-control" id="prod-quantidade" name="produto_quantidade" min="0" value="<?= $prod->quantidade ?>">
                                </div>
                                <div class="d-flex justify-content-end m-3">
                                    <button type="button" class="btn btn-danger sys-btn panel-btn deletar-produto me-3" style="width: 248px;" data-id-produto="<?= $prod_id ?>" data-produto-nome="<?= $prod->nome ?>">Deletar produto</button>
                                    <button type="submit" class="btn btn-primary sys-btn panel-btn" style="width: 248px;" data-id-produto="<?= $_GET['id'] ?>" id="editar-btn">Editar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            $(document).ready(function() {
                $('.imagem-carousel').on('click', function() {
                    var imagemSelecionada = $(this).attr('src');
                    var img_name = $(this).attr("data-img-name");
                    $('#imagemModal').attr('src', imagemSelecionada);
                    $('#imagemModal').attr('data-image', img_name); // Correção aqui

                    $('#uploadImagemModal').modal('show');
                });

                $('#btnSalvarImagem').on('click', function() {
                    $('#uploadImagemModal').modal('hide');
                });
            });
        </script>