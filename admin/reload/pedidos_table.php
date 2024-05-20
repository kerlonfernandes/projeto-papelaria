<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../../classes/Database.inc.php";
require "../../classes/Helpers.inc.php";

require "../../_app/Config.inc.php";

use Midspace\Database;
use HelpersClass\SupAid;

$helpers = new SupAid();

$db = new Database(MYSQL_CONFIG);

$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
$search = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

$sql = "
SELECT 
    pedidos.*, 
    pedidos.id AS numero_pedido_sistema, 
    COALESCE(SUM(produtos_pedidos.qtd_itens), 0) AS total_qtd_itens,
    users.nome AS cliente,
    pedido.total_pedido
FROM 
    pedidos
LEFT JOIN
    produtos_pedidos ON pedidos.id_pedido = produtos_pedidos.id_pedido
LEFT JOIN 
    users ON users.id = pedidos.id_usuario
LEFT JOIN
    pedido ON pedidos.id_pedido = pedido.id

";

switch ($filtro) {
    case 'usuario':
        $sql .= " HAVING cliente LIKE '%$search%'";
        break;
    case 'n_pedido':
        $sql .= " HAVING numero_pedido_sistema LIKE '%$search%'";
        break;
    case 'valor':
        $sql .= " HAVING total_pedido LIKE '%$search%'";
        break;
    case 'quantidade':
        $sql .= " HAVING total_qtd_itens LIKE '%$search%'";
        break;
    default:
        break;
}

if (!empty($status)) {
    if (!empty($filtro) || !empty($search)) {
        $sql .= " AND ";
    } else {
        $sql .= " WHERE ";
    }
    $sql .= " pedidos.status_pedido = '$status'";
}

$sql .= " GROUP BY 
pedidos.id"; 


$pedidos = $db->execute_query($sql);

?>

<?php if ($pedidos->affected_rows > 0) : ?>
<?php foreach ($pedidos->results as $pedido) : ?>
    
    <tr>
        <td>
            <button class="btn btn-success sys-btn panel-btn">Acessar</button>
            <button class="btn btn-primary sys-btn panel-btn">Editar</button>
            <button class="btn btn-danger sys-btn panel-btn apaga-pedido" data-id="<?= $helpers->encodeURL($pedido->numero_pedido_sistema) ?>">Deletar</button>
        </td>
        <td><?= $pedido->id_pedido ?></td>
        <td><?= $pedido-> numero_pedido_sistema?></td>
        <td><a href="<?= SITE ?>/admin/?route=painel&sys=usuario&id=<?= $helpers->encodeURL($pedido->id_pedido) ?>" style="text-decoration: none;"><?= $pedido->cliente ?></a></td>
        <td><?= $pedido->total_qtd_itens ?></td>
        <td><?= number_format($pedido->total_pedido, 2, ',', '.');  ?></td>
        <td>
            <div class="input-group mb-3">
                <select class="form-select muda-status" id="select" data-id="<?= $helpers->encodeURL($pedido->numero_pedido_sistema) ?>">
                    <option selected><?= $pedido->status_pedido ?></option>
                    <option value="Em Aberto">Em Aberto</option>
                    <option value="Pendente">Pendente</option>
                    <option value="Finalizado">Finalizado</option>
                    <option value="A entregar">A entregar</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
            </div>
        </td>
        <td>
            <?php
            echo $pedido->aguardando_reembolso == "1" ? "Sim" : ($pedido->aguardando_reembolso == 0 ? "Não" : "Reembolsado");
            ?>
        </td>
    </tr>

<?php endforeach; ?>
<?php else: ?>
    <td colspan="8" class="text-center">Nenhum resultado encontrado</td>
<?php endif; ?>