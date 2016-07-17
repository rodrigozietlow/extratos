<?php
require_once $_SERVER['DOCUMENT_ROOT']."/extratos/config.inc.php";

$url = (!empty($_GET['route']) && $_GET['route']!= "/") ? $_GET['route'] : "extrato/index";
$router = new Controle\Common\Router($url);
?>
