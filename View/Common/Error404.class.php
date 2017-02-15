<?php
namespace View\Common;

class Error404 {

	public function render(){
		//header(""); TO DO: header 404
		include $_SERVER['DOCUMENT_ROOT']."/extratos/View/Common/HTML/404.php";
	}

}
