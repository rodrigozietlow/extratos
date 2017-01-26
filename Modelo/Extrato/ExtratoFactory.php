<?php
namespace Modelo\Extrato;

class ExtratoFactory {

	public function create($cost, $descricao, $data, $conta, $id){
		$extrato = new Extrato($id);
		$extrato->setCost($cost);
		$extrato->setDescricao($descricao);
		$extrato->setData($data);
		$extrato->setConta($conta);

		return $extrato;
	}

}
?>
