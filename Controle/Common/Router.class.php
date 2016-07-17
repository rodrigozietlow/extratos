<?php
namespace Controle\Common;
require_once $_SERVER['DOCUMENT_ROOT']."/extratos/config.inc.php";

class Router{

	private $arrayUrl = array(
		"errors/404" => array(
			"Controle" => "\\Controle\\Common\\Errors",
			"Action" => "404",
			"extras" => array()
		),
		"extratos/lista" => array(
			"Controle" => "Controle\\Extrato\\Controle",
			"Action" => "Listar",
			"extras" => array(
				"conta" => 1,
				"pagina" => 1
			)
		)
	);
	public function __construct($url){ // vamos receber a url como extratos/lista/conta=1/pagina=1, extratos/detalhes/id=456
		$parsed = array_filter(explode("/", $url));
		$action = $parsed[0]."/".$parsed[1];
		if(count($parsed) > 2){
			for($x=2;$x<count($parsed);$x++){
				$attr = explode("=", $parsed[$x]); // pega a info separada no igual
				$this->arrayUrl[$action]["extras"][$attr[0]] = $attr[1];
			}
		}
		if(in_array($action, array_keys($this->arrayUrl))){
			$flow = $this->arrayUrl[$action];
		} else{
			$flow = $this->arrayUrl["errors/404"];
		}

		$controlador = new $flow["Controle"];
		$controlador->{$flow['Action']}($flow['extras']);
	}
}
?>
