<?php
namespace Raiz\Controle\Extrato;
require_once $_SERVER['DOCUMENT_ROOT']."/extratos/Modelo/Extrato.modelo.php";

class Controle {

	public function call($function, $params=[]){


		if(method_exists($this, $function)){
			$this->$function($params);
		} else{
			trigger_error("Ops, este método não existe!", E_USER_WARNING);
		}
	}

	public function index($params=[]){
		$Modelo = new Modelo($params['custo'], $params['descricao']);
		echo $Modelo->getCusto();
	}
}


$funcao = (isset($_GET['funcao'])) ? $_GET['funcao'] : "index";
$controle = new Controle;
$controle->call($funcao, ["custo"=>50.12, "descricao" => "Primeiro teste"]);
?>
