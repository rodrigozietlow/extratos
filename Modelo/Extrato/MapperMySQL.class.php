<?php
namespace Modelo\Extrato;
use Modelo\Extrato\interfaces;
use Modelo\Extrato;
require_once $_SERVER['DOCUMENT_ROOT']."/extratos/config.inc.php";
/*
require_once $_SERVER['DOCUMENT_ROOT']."/extratos/Modelo/Extrato.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/extratos/Modelo/DataMappers/iExtratoMapper.class.php";
*/
class MapperMySQL implements interfaces\iMapper{

	private $conexao;

	public function __construct(){
		$this->conexao = new \PDO('mysql:host='.HOST.';dbname='.BANCO, USUARIO, SENHA); // setup the connection to use inside the object
	}

	public function __destruct(){
		$this->conexao = null;
	}


	/**
	 * Saves the actual object into saldo table
	 * @param Extrato $extrato
	 * @return Extrato
	 */
	 public function save(Extrato\Extrato $extrato){

		if(!$extrato->getId()){ // it's an insert if it does not have an id
			$stmt = $this->conexao->prepare("INSERT INTO extratos (custo, descricao, conta) VALUES (:custo, :descricao, :conta)");
			$resultado = $stmt->execute(array(
				":custo" => $extrato->getCusto(),
				":descricao" => $extrato->getDescricao(),
				":conta" => $extrato->getConta()
			));

			$extrato->setId($this->conexao->lastInsertId()); // set the new id
			$extrato->setData(date("Y-m-d H:i:s"));
		}

		else{ // update, do query accordingly
			$stmt = $this->conexao->prepare("UPDATE extratos SET custo = :custo, descricao = :descricao, data = :data, conta = :conta WHERE id=:id");
			$resultado = $stmt->execute(array(
				":custo" => $extrato->getCusto(),
				":descricao" => $extrato->getDescricao(),
				":id" => $extrato->getId(),
				":data" => $extrato->getData(),
				":conta" => $extrato->getConta()
			));

		}

		return $extrato;

	}

	/**
	 * fill an extrato by its id, from the database
	 * @param Extrato $extrato the extrato to be filled
	 * @return Extrato filled extrato
	 */
	public function fill(Extrato\Extrato $extrato){
		$stmt = $this->conexao->prepare("SELECT * FROM extratos WHERE id = :id");
		$resultado = $stmt->execute(array(
			":id" => $extrato->getId()
		));
		if($stmt->rowCount()){
			$stmt->setFetchMode(\PDO::FETCH_CLASS, __namespace__."\\Extrato");
			$extrato = $stmt->fetch();
		} else{
			throw new \Exception("Ops, este registro não foi encontrado!");
		}

		$stmt = null; // limpar

		return $extrato;
	}


	/**
	 * Returns an array with a list of extratos
	 * @param  int $conta account (wallet, credit card, bank account)
	 * @param  int $begin X of LIMIT X, Y
	 * @param  int $limit Y of LIMIT X, Y
	 * @param  string $order order by
	 * @return array        array with extratos from the selected groups
	 */
	public function getAll($conta, $begin, $limit, $order="data DESC"){
		$stmt = $this->conexao->prepare(
			"SELECT e.id, e.data, e.descricao, e.custo, c.nome as conta
			FROM extratos e
			INNER JOIN contas c ON c.id = e.conta
			WHERE conta = :conta
			ORDER BY $order
			LIMIT $begin, $limit"
		);
		$resultado = $stmt->execute(array(":conta" => $conta));
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
	public function delete(Extrato\Extrato $extrato){
		$resultado = true; // lets begin result as true
		if($extrato->getId()){
			$stmt = $this->conexao->prepare("DELETE FROM extratos WHERE id = :id");
			$resultado = $stmt->execute(array(":id" => $extrato->getId()));
		}
		$extrato = null;

		return $resultado;
	}
}

?>
