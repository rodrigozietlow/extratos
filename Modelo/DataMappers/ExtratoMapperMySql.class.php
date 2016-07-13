<?php
namespace App\Modelo\Extrato;
require_once $_SERVER['DOCUMENT_ROOT']."/extratos/config.inc.php";
require_once $_SERVER['DOCUMENT_ROOT']."/extratos/Modelo/Extrato.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/extratos/Modelo/DataMappers/iExtratoMapper.class.php";

class ExtratoMapperMySql implements iExtratoMapper{

	private $conexao;

	public function __construct(){
		$this->conexao = new \PDO('mysql:host='.HOST.';dbname='.BANCO, USUARIO, SENHA); // setup the connection to use inside the object
	}

	public function __destruct(){
		$this->conexao = null;
	}


	/**
	 * Saves the actual object into saldo table and update total balance
	 * @return Extrato
	 */
	 public function save(Extrato $extrato){

		if(!$extrato->getId()){ // it's an insert if it does not have an id
			$stmt = $this->conexao->prepare("INSERT INTO extratos (custo, descricao) VALUES (:custo, :descricao)");
			$resultado = $stmt->execute(array(
				":custo" => $extrato->getCusto(),
				":descricao" => $extrato->getDescricao()
			));

			$extrato->setId($this->conexao->lastInsertId()); // set the new id
			$extrato->setData(date("Y-m-d H:i:s"));
		}

		else{ // update, do query accordingly
			$stmt = $this->conexao->prepare("UPDATE extratos SET custo = :custo, descricao = :descricao, data = :data WHERE id=:id");
			$resultado = $stmt->execute(array(
				":custo" => $extrato->getCusto(),
				":descricao" => $extrato->getDescricao(),
				":id" => $extrato->getId(),
				":data" => $extrato->getData()
			));

		}

		/*
		 * Now, lets update the general balance
		 */

		$stmt = $this->conexao->prepare("UPDATE saldo SET saldo = saldo + :custo"); // no where, since it has only 1 row, may change in the future for multiple stuff
		$resultado2 = $stmt->execute(array(
			":custo" => $extrato->getCusto()
		));

		return $extrato;

	}

	/**
	 * fill an extrato by its id, from the database
	 * @param Extrato $extrato the extrato to be filled
	 * @return Extrato fille extrato
	 */
	public function fill(Extrato $extrato){
		$stmt = $this->conexao->prepare("SELECT * FROM extratos WHERE id = :id");
		$resultado = $stmt->execute(array(
			":id" => $extrato->getId()
		));
		if($stmt->rowCount()){
			$stmt->setFetchMode(\PDO::FETCH_CLASS,  __namespace__."\\Extrato");
			$extrato = $stmt->fetch();
		} else{
			throw new \Exception("Ops, este registro não foi encontrado!");
		}

		$stmt = null; // limpar

		return $extrato;
	}


	/**
	 * Returns an array with a list of extratos
	 * @param  int $begin X of LIMIT X, Y
	 * @param  int $limit Y of LIMIT X, Y
	 * @param  string $order order by
	 * @return array        array with extratos from the selected groups
	 */
	public function getAll( $begin, $limit, $order="data DESC"){
		$stmt = $this->conexao->prepare("SELECT id, data, descricao, custo FROM extratos ORDER BY $order LIMIT $begin, $limit");
		$resultado = $stmt->execute();
		if($stmt->rowCount()){
			return $stmt->fetchAll(\PDO::FETCH_CLASS, __namespace__."\\Extrato");
		} else{
			return array();
		}
	}


	/**
	 * Delete extrato from database
	 * @param Extrato $extrato the extrato to be deleted
	 * @return bol
	 */
	public function delete(Extrato $extrato){
		$resultado = true; // lets begin result as true
		if($extrato->getId()){
			$stmt = $this->conexao->prepare("DELETE FROM extratos WHERE id = :id");
			$resultado = $stmt->execute(array(":id" => $extrato->getId()));

			/*
			 * Now, lets update the general balance
			 */

			$stmt = $this->conexao->prepare("UPDATE saldo SET saldo = saldo - :custo"); // no where, since it has only 1 row, may change in the future for multiple stuff
			$resultado = $stmt->execute(array(
				":custo" => $extrato->getCusto()
			));

		}
		$extrato = null;

		return $resultado;
	}
}

?>
