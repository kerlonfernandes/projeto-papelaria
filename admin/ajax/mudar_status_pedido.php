<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../../classes/Database.inc.php";
require "../../classes/QueryHelper.inc.php";
require "../../classes/Helpers.inc.php";

require "../../_app/Config.inc.php";
require "../../_app/Functions.inc.php";
use Midspace\Database;
use HelpersClass\SupAid;

$db = new Database(MYSQL_CONFIG);
$Sql = new QueryHelper();
$res = array();
$helpers = new SupAid();

// verify_post_method();
// if (!isset(Post()->id)) return;

$id = $helpers->decodeURL(Post()->id);

$data = $Sql->createUpdateQuery(
    "pedidos", [
        "status_pedido" => ":status"
    ],
    [
        ":status" => Post()->status
    ],
    ["id" => $id]
);

$results = $db->execute_non_query($data->query, $data->placeholders);

if($results->status == "success") {
    echo $helpers::CreateResponse(
        "success",
        "Estado do pedido alterado!",
        "200"
    );
    return;
}
echo $helpers::CreateResponse(
    "error",
    "Erro ao alterar estado do pedido!",
    "200"
);
