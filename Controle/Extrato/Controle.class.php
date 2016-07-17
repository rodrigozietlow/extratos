<?php
namespace Controle\Extrato;
require_once $_SERVER['DOCUMENT_ROOT']."/extratos/config.inc.php";

class Controle {

	public function listar($conta, $nrPagina){
		$nrRegistros = 5;
		$comecar = ($nrPagina - 1) * $nrRegistros;
		$mapper = new \Modelo\Extrato\MapperMySQL();
		$view = new \View\Extrato\View();
		$extratos = $mapper->getAll($conta, $comecar, $nrRegistros);
		$view->listar($extratos);
	}

}

?>
