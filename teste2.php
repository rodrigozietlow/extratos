<?php
require_once $_SERVER['DOCUMENT_ROOT']."/extratos/config.inc.php";

$url = "extratos/lista/conta=1/pagina=1";
$url = $_GET['route'];
$router = new Controle\Common\Router($url);
?>
