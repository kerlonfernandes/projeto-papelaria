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
    users.*, 
    nivel_acesso.*, 
    users.id AS user_id 
FROM 
    users 
LEFT JOIN 
    nivel_acesso 
ON 
    users.id = nivel_acesso.id_user";

switch ($filtro) {
    case 'nome':
        $sql .= " WHERE users.nome LIKE '%$search%'";
        break;
    case 'email':
        $sql .= " WHERE users.email LIKE '%$search%'";
        break;
    case 'telefone':
        $sql .= " WHERE users.telefone LIKE '%$search%'";
        break;
    case 'nivel-acesso':
        $sql .= " WHERE nivel_acesso.acesso LIKE '%$search%'";
        break;
        
    default:
        break;
}

$usuarios = $db->execute_query($sql);

?>


<?php if ($usuarios->affected_rows > 0) : ?>
    <?php foreach ($usuarios->results as $usuario) : ?>
        <tr>
            <td>
                <button class="btn btn-success sys-btn panel-btn">Acessar</button>
                <button class="btn btn-primary sys-btn panel-btn">Editar</button>
                <button class="btn btn-danger sys-btn panel-btn">Deletar</button>
            </td>
            <td><?= $usuario->user_id  ?></td>
            <td><?= $usuario->nome ?></td>
            <td><?= $usuario->email ?></td>
            <td><?= $usuario->telefone ?></td>
            <td><?php
                $a = $usuario->nivel_acesso;
                switch ($a) {
                    case $a == "1":
                        echo "USUÁRIO";
                        break;
                    case $a == "2":
                        echo "EMPRESA";
                        break;
                    case $a == "3":
                        echo "STAFF";
                        break;
                    case $a == "4":
                        echo "ADMINISTRADOR";
                        break;
                    default:
                        echo "USUÁRIO";
                        break;
                }
                ?></td>
            <td><?= date("H:i:s d/m/Y", strtotime($usuario->acessou_em)) ?></td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <td colspan="7" class="text-center">Nenhum resultado encontrado</td>

<?php endif; ?>