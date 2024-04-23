<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../../classes/Database.inc.php";
require "../../_app/Config.inc.php";
use Midspace\Database;

$db = new Database(MYSQL_CONFIG);
$res = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imagem = $_FILES["imagem"];
    $image_name = $_POST['image_name'];
    print_r($image_name);
    print_r($imagem);
}   