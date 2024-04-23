<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../../classes/Database.inc.php";
require "../../_app/Config.inc.php";

use Midspace\Database;

$db = new Database(MYSQL_CONFIG);

$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
$search = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';

$sql = "
SELECT 
    produtos.*, 
    produtos.id AS id_produto,
    categorias.nome as cat_nome,
    tipo_produto.tipo_produto tipo_nome
FROM 
    produtos 
LEFT JOIN 
    categorias ON categorias.id = produtos.categoria_id 
LEFT JOIN 
    tipo_produto ON tipo_produto.id = produtos.tipo_produto_id

";

switch ($filtro) {
    case 'nome':
        $sql .= " WHERE produtos.nome LIKE '%$search%'";
        break;
    case 'descricao':
        $sql .= " WHERE produtos.descricao LIKE '%$search%'";
        break;
    case 'preco':
        $sql .= " WHERE produtos.preco LIKE '%$search%'";
        break;
    case 'quantidade':
        $sql .= " WHERE produtos.quantidade LIKE '%$search%'";
        break;
    case 'categoria':
        $sql .= " WHERE categorias.nome LIKE '%$search%'";
        break;
    case 'tipo_produto':
        $sql .= " WHERE tipo_produto.tipo_produto LIKE '%$search%'";
        break;
    default:
        break;
}

$produtos = $db->execute_query($sql);


?>
<?php if ($produtos->affected_rows > 0) : ?>
    <?php foreach ($produtos->results as $produto) : ?>
        <tr>
            <td>
                <a class="btn btn-success sys-btn panel-btn" href="<?= SITE ?>/admin/?route=painel&sys=product&id=<?= $produto->id ?>">Acessar</a>

                <button class="btn btn-primary sys-btn panel-btn" data-bs-toggle="modal" data-bs-target="#editar-produto" data-produto-nome="<?= $produto->nome ?>" data-descricao="<?= $produto->descricao ?>" data-quantidade="<?= $produto->quantidade ?>" data-preco="<?= number_format($produto->preco, 2, ',', '.');  ?>" data-preco-anterior="<?= number_format($produto->preco_anterior, 2, ',', '.');  ?>" data-categoria="<?= $produto->cat_nome ?>" data-tipo="<?= $produto->tipo_nome ?>">Editar</button>

                <button class="btn btn-danger sys-btn panel-btn deletar-produto" data-id-produto="<?= $produto->id ?>" data-produto-nome="<?= $produto->nome ?>">Deletar</button>
            </td>
            <td><?= $produto->id_produto ?></td>
            <td><?= $produto->nome ?></td>
            <td><?= $produto->descricao ?></td>
            <td><?= number_format($produto->preco, 2, ',', '.');  ?></td>
            <td><?= $produto->quantidade ?></td>
            <td><?= $produto->cat_nome ?></td>
            <td><?= $produto->tipo_nome ?></td>


            <td><?= date("H:i:s d/m/Y", strtotime($produto->data_cadastro)) ?></td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <td colspan="7" class="text-center">Nenhum resultado encontrado</td>

<?php endif ?>