<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../../classes/Database.inc.php";
require "../../_app/Config.inc.php";

use Midspace\Database;

$db = new Database(MYSQL_CONFIG);

$tipos_produto = $db->execute_query("SELECT id, tipo_produto FROM tipo_produto;");

?>

<?php if ($tipos_produto->affected_rows > 0) : ?>
    <option value="">Selecione o tipo do produto</option>

    <?php foreach ($tipos_produto->results as $tipo_produto) : ?>
        <option value="<?= $tipo_produto->id ?>"><?= $tipo_produto->tipo_produto ?></option>
    <?php endforeach; ?>
<?php else: ?>
    <option>Sem tipos existentes</option>
<?php endif; ?>