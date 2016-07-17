<?php
namespace View\Extrato;
require_once $_SERVER['DOCUMENT_ROOT']."/extratos/config.inc.php";

class View {

	public function listar($extratos){
		include $_SERVER['DOCUMENT_ROOT']."/extratos/View/Extrato/HTML/listar.php";
	}

}

?>
