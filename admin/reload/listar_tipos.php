<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../../classes/Database.inc.php";
require "../../_app/Config.inc.php";

use Midspace\Database;

$db = new Database(MYSQL_CONFIG);

$tipos_produto = $db->execute_query("SELECT * FROM tipo_produto;");

?>
<?php if ($tipos_produto->affected_rows > 0) : ?>
    <?php foreach ($tipos_produto->results as $tipo) : ?>
        <tr>
            <td>
                <button type="button" class="btn btn-danger deletar-tipo sys-btn" data-id="<?= $tipo->id ?>">Deletar</button>
            </td>
            <td><?= $tipo->tipo_produto ?></td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
<?php endif; ?>