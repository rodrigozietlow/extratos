<?php
namespace View\Common;

class Error404 {

	public function render(){
		include $_SERVER['DOCUMENT_ROOT']."/extratos/View/Common/HTML/404.php";
	}

}
