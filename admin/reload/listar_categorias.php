<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../../classes/Database.inc.php";
require "../../_app/Config.inc.php";

use Midspace\Database;

$db = new Database(MYSQL_CONFIG);

$categorias = $db->execute_query("SELECT * FROM categorias;");

?>

<?php if ($categorias->affected_rows > 0) : ?>
    <?php foreach ($categorias->results as $categoria) : ?>
        <tr>
            <td>
                <button type="button" class="btn btn-danger deletar-categoria sys-btn" data-id="<?= $categoria->id ?>">Deletar</button>
            </td>
            <td><?= $categoria->nome ?></td>

        </tr>
    <?php endforeach; ?>
<?php else : ?>
<?php endif; ?>

