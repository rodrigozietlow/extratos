<?php
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT); // E_STRICT should technically be used too

spl_autoload_extensions('.php,.class.php');
spl_autoload_register();

define("HOST","localhost");
define("USUARIO","root");
define("SENHA","");
define("BANCO","meus_gastos");

define("ABS_VAL", true);
?>
