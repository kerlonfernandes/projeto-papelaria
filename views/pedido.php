<?php

use Midspace\Database;
use HelpersClass\SupAid;

require "./classes/Database.inc.php";
// require "./classes/Helpers.inc.php";

$helpers = new SupAid();
$db = new Database(MYSQL_CONFIG);



$estados = $db->execute_query("SELECT sigla FROM estados");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Endereço</title>
    <?php



    require_once "./inc/assets.inc.php";
    require_once "./inc/css_files.inc.php";


    ?>

    <?php
    require_once "./components/header_minimal.php";

    if (isset($route[0]) && isset($route[1])) {
        if ($route[0] == "checkout" && !empty($route[1])) {
            include "./templates/checkout.php";
        }
    }
    if (isset($route[0]) && !isset($route[1])) {
        include "./templates/cadastra_endereco.php";
        
    } 




    ?>


    <?php require_once "./inc/js_files.inc.php"; ?>
    </body>

</html>