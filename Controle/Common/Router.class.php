<?php
namespace Controle\Common;
require_once $_SERVER['DOCUMENT_ROOT']."/extratos/config.inc.php";

class Router{

	/**
	 * Constructor of base app router
	 * @param string $url will receive urls and call aproppriate methods from the controllers, catching exceptions as needed
	 */
	public function __construct($url){
		try{
			$parsed = array_values(array_filter(explode("/", $url)));
			if(count($parsed) < 2){
				throw new \ReflectionException();
			}
			$controller = "\\Controle\\".ucwords(strtolower($parsed[0]))."\\Controle"; // namespaces
			$action = strtolower($parsed[1]);
			$params = array();
			if(count($parsed) > 2){
				for($x=2;$x<count($parsed);$x++){
					$params[] = $parsed[$x];
				}
			}

			$reflectionMethod = new \ReflectionMethod($controller, $action);
			if($reflectionMethod->getNumberOfRequiredParameters() > count($params)){
				throw new InvalidParamsException();
			}
			$reflectionMethod->invokeArgs(new $controller, $params);
		} catch(NotFoundException $e){
			echo "Ops, esta página não existe.";
		} catch(InvalidParamsException $e){
			echo "Ops, você está tentando fazer uma operação inválida!";
		} catch(\ReflectionException $e) {
			$controller404 = new \View\Common\Error404();
			$controller404->render();
		}
	}
}
?>
