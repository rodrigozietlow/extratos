<?php
require_once $_SERVER['DOCUMENT_ROOT']."/extratos/config.inc.php";

$controle = new Controle\Extrato\Controle();
$controle->listar(1, 3);
?>
