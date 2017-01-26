<?php
namespace Controle\Extrato;
require_once $_SERVER['DOCUMENT_ROOT']."/extratos/config.inc.php";

class Controle {

	public function lista($conta, $pagina = 1){
		if(!$conta || !$pagina || !is_numeric($conta) || !is_numeric($pagina) || $pagina<1){
			throw new \Controle\Common\InvalidParamsException();
		}
		$nrRegistros = 9;
		$comecar = ($pagina - 1) * $nrRegistros;

		$mapper = new \Modelo\Extrato\MapperMySQL();
		$view = new \View\Extrato\View();

		$extratos = $mapper->getAll($conta, $comecar, $nrRegistros);
		$view->listar($extratos);
	}

	public function index(){
		$mapper = new \Modelo\Extrato\MapperMySQL();
		$view = new \View\Extrato\View();

		$extratoMaisRecente = $mapper->getAll(1, 0, 1)[0];
		$view->index($extratoMaisRecente);
	}
}

?>
