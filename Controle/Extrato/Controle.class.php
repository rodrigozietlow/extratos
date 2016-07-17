<?php
namespace Controle\Extrato;
require_once $_SERVER['DOCUMENT_ROOT']."/extratos/config.inc.php";

class Controle {

	public function listar($params){

		$conta = $params['conta'];
		$pagina = $params['pagina'];

		$nrRegistros = 6;
		$comecar = ($pagina - 1) * $nrRegistros;

		$mapper = new \Modelo\Extrato\MapperMySQL();
		$view = new \View\Extrato\View();

		$extratos = $mapper->getAll($conta, $comecar, $nrRegistros);
		$view->listar($extratos);
	}
}

?>
