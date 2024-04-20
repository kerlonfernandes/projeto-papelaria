<?php


session_start();
// $_SESSION['admin'] = "Master";
// $_SESSION['logged_admin'] = true;

require_once  "../core/Core.php";

$inc_files = array_merge(glob("../_app/*.inc.php"), glob("../classes/*.inc.php"));


$_app = new Core();

$_app::_inc($inc_files);


if(!isset($_SESSION['admin']) || !isset($_SESSION['logged_admin'])) {
    require "views/auth.php";
    return;
} else {
    if (isset($_GET["route"])) {
        $route = rtrim($_GET["route"], '/');
        $clean_route = filter_var($route, FILTER_SANITIZE_URL);
        $views_dir = 'views/';
        $filePath = $views_dir . $clean_route . '.php';
        if (file_exists($filePath)) {
            require $filePath;
        } else {
            require "views/painel.php";

        }
    } else {
        require "views/painel.php";
    }
}
?>
