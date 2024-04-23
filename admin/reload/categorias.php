<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../../classes/Database.inc.php";
require "../../_app/Config.inc.php";

use Midspace\Database;

$db = new Database(MYSQL_CONFIG);

$categorias = $db->execute_query("SELECT id, nome FROM categorias;");

?>

<?php if ($categorias->affected_rows > 0) : ?>
    <option value="">Selecione uma categoria</option>

    <?php foreach ($categorias->results as $categoria) : ?>
        <option value="<?= $categoria->id ?>"><?= $categoria->nome ?></option>
    <?php endforeach; ?>
<?php else : ?>
    <option>Sem categorias existentes</option>
<?php endif; ?>