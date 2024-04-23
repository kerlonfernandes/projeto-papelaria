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
$status = isset($_GET['status']) ? $_GET['status'] : '';

$sql = "
    SELECT 
        pedidos.*,
        users.nome,
        COALESCE(quantidade_itens, 0) AS quantidade_itens,
        COALESCE(total_preco_unitario, 0) AS total_preco_unitario
    FROM 
        pedidos
    LEFT JOIN (
        SELECT 
            id_pedido,
            COUNT(id) AS quantidade_itens,
            SUM(preco_unitario) AS total_preco_unitario
        FROM 
            pedido_produtos
        GROUP BY 
            id_pedido
    ) AS produtos_pedido ON pedidos.id = produtos_pedido.id_pedido
    LEFT JOIN users ON users.id = pedidos.id_usuario
";

switch ($filtro) {
    case 'usuario':
        $sql .= " WHERE users.nome LIKE '%$search%'";
        break;
    case 'n_pedido':
        $sql .= " WHERE pedidos.numero_pedido LIKE '%$search%'";
        break;
    case 'valor':
        $sql .= " WHERE total_preco_unitario LIKE '%$search%'";
        break;
    case 'quantidade':
        $sql .= " WHERE quantidade_itens LIKE '%$search%'";
        break;
    default:
        break;
}
if (!empty($status)) {
    if (!empty($filtro) && !empty($search)) {
        $sql .= " AND ";
    } else {
        $sql .= " WHERE ";
    }
    $sql .= " pedidos.status_pedido = '$status'";
}

$pedidos = $db->execute_query($sql);

?>

<?php if ($pedidos->affected_rows > 0) : ?>
<?php foreach ($pedidos->results as $pedido) : ?>
    
    <tr>
        <td>
            <button class="btn btn-success sys-btn panel-btn">Acessar</button>
            <button class="btn btn-primary sys-btn panel-btn">Editar</button>
            <button class="btn btn-danger sys-btn panel-btn">Deletar</button>
        </td>
        <td><?= $pedido->id ?></td>
        <td><?= $pedido->numero_pedido ?></td>
        <td><a href="<?= SITE ?>/admin/?route=painel&sys=usuario&id=<?= 1 ?>" style="text-decoration: none;"><?= $pedido->nome ?></a></td>
        <td><?= $pedido->quantidade_itens ?></td>
        <td><?= number_format($pedido->total_preco_unitario, 2, ',', '.');  ?></td>
        <td>
            <div class="input-group mb-3">
                <select class="form-select" id="select" aria-label="Select example">
                    <option selected><?= $pedido->status_pedido ?></option>
                    <option value="Aberto">Em Aberto</option>
                    <option value="Pendente">Pendente</option>
                    <option value="Finalizado">Finalizado</option>
                    <option value="A entregar">A entregar</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
            </div>
        </td>
        <td>
            <?php
            echo $pedido->status_pedido == "1" ? "Sim" : ($pedido->status_pedido == 0 ? "Não" : "Reembolsado");
            ?>
        </td>
    </tr>

<?php endforeach; ?>
<?php else: ?>
    <td colspan="8" class="text-center">Nenhum resultado encontrado</td>
<?php endif; ?>