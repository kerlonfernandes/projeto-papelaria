<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../../classes/Database.inc.php";
require "../../classes/Helpers.inc.php";
require "../../_app/Config.inc.php";

use Midspace\Database;
use HelpersClass\SupAid;

$db = new Database(MYSQL_CONFIG);
$helpers = new SupAid();

// Parâmetros de paginação
$itens_por_pagina = 5;
$pagina_atual = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($pagina_atual - 1) * $itens_por_pagina;

// Filtros de pesquisa
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
$search = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';

// Consulta SQL
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
    WHERE 1 = 1
";

// Aplicar filtros de pesquisa
switch ($filtro) {
    case 'nome':
        $sql .= " AND produtos.nome LIKE '%$search%'";
        break;
    case 'descricao':
        $sql .= " AND produtos.descricao LIKE '%$search%'";
        break;
    case 'preco':
        $sql .= " AND produtos.preco LIKE '%$search%'";
        break;
    case 'quantidade':
        $sql .= " AND produtos.quantidade LIKE '%$search%'";
        break;
    case 'categoria':
        $sql .= " AND categorias.nome LIKE '%$search%'";
        break;
    case 'tipo_produto':
        $sql .= " AND tipo_produto.tipo_produto LIKE '%$search%'";
        break;
    default:
        break;
}

$sql .= " ORDER BY id DESC LIMIT $offset, $itens_por_pagina";
$produtos = $db->execute_query($sql);


?>
<?php if ($produtos->affected_rows > 0) : ?>
    <?php foreach ($produtos->results as $produto) : ?>
        <tr>
            <td>
                <a class="btn btn-primary sys-btn panel-btn" href="<?= SITE ?>/admin/?route=painel&sys=product&id=<?= $helpers->encodeURL( $produto->id ) ?>">Acessar</a>

                <button class="btn btn-success sys-btn panel-btn" data-bs-toggle="modal" data-bs-target="#edita-produto" data-id="<?= $helpers->encodeURL( $produto->id ) ?>" data-produto-nome="<?= $produto->nome ?>" data-descricao="<?= $produto->descricao ?>" data-quantidade="<?= $produto->quantidade ?>" data-preco="<?= number_format($produto->preco, 2, ',', '.');  ?>" data-preco-anterior="<?= number_format($produto->preco_anterior, 2, ',', '.');  ?>" data-categoria="<?= $produto->cat_nome ?>" data-tipo="<?= $produto->tipo_nome ?>">Editar</button>

                <button class="btn btn-danger sys-btn panel-btn deletar-produto" data-id-produto="<?= $produto->id ?>" data-produto-nome="<?= $produto->nome ?>">Deletar</button>
            </td>
            <td><?= $produto->id_produto ?></td>
            <td><?php if(strlen($produto->nome) > 50) {echo substr($produto->nome, 0, 50)."...";} else {echo $produto->nome;}?></td>
            <td><?php if(strlen($produto->descricao) > 50) {echo substr($produto->descricao, 0, 50)."...";} else {echo $produto->descricao;}?></td>
            <td><?= number_format($produto->preco, 2, ',', '.');  ?></td>
            <td><?= $produto->quantidade ?></td>
            <td><?= $produto->cat_nome ?></td>
            <td><?= $produto->tipo_nome ?></td>


            <td><?= date("H:i:s d/m/Y", strtotime($produto->data_cadastro)) ?></td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <td colspan="9" rowspan="5" class="text-center">Nenhum resultado encontrado</td>

<?php endif ?>