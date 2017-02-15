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
	 */
	 public function save(Extrato\Extrato $extrato){

		if(!$extrato->getId()){ // it's an insert if it does not have an id
			$stmt = $this->conexao->prepare("INSERT INTO extratos (custo, descricao, fonte, conta) VALUES (:custo, :descricao, :fonte, :conta)");
			$resultado = $stmt->execute(array(
				":custo" => $extrato->getCusto(),
				":descricao" => $extrato->getDescricao(),
				":fonte" => $extrato->getFonte(),
				":conta" => $extrato->getConta()
			));

			$extrato->setId($this->conexao->lastInsertId()); // set the new id
			$extrato->setData(date("Y-m-d H:i:s"));
		}

		else{ // update, do query accordingly
			$stmt = $this->conexao->prepare("UPDATE extratos SET custo = :custo, descricao = :descricao, fonte = :fonte, data = :data, conta = :conta WHERE id=:id");
			$resultado = $stmt->execute(array(
				":custo" => $extrato->getCusto(),
				":descricao" => $extrato->getDescricao(),
				":fonte" => $extrato->getFonte(),
				":id" => $extrato->getId(),
				":data" => $extrato->getData(),
				":conta" => $extrato->getConta()
			));

		}

	}

	/**
	 * fill an extrato by its id, from the database
	 * @param Extrato $extrato the extrato to be filled
	 * @return Extrato filled extrato
	 */
	public function getById($id){
		$stmt = $this->conexao->prepare(
			"SELECT *
			FROM extratos
			WHERE id = :id"
		);
		$resultado = $stmt->execute(array(":id" => $id));
		if($stmt->rowCount()){
			$stmt->setFetchMode(\PDO::FETCH_CLASS, __namespace__."\\Extrato");
			$extrato = $stmt->fetch();
		} else {
			throw new \Controle\Common\NotFoundException("Ops, este registro não foi encontrado!");
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
			"SELECT *
			FROM extratos
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
	 * @param int $id the id of the extrato to be deleted
	 * @return bol
	 */
	public function delete($id){
		$stmt = $this->conexao->prepare("DELETE FROM extratos WHERE id = :id");
		$resultado = $stmt->execute(array(":id" => $id));

		return $resultado;
	}


	/**
	 * Load items from given extract
	 * @param  Extrato $extrato
	 */
	public function loadItems(Extrato\Extrato $extrato){
		// to do alterar para getAll do mapper de item
		$stmt = $this->conexao->prepare("SELECT * FROM itens WHERE idExtrato = :idExtrato");
		$stmt->execute(array(":idExtrato" => $extrato->getId()));
		/*
		if($stmt->rowCount()){
		*/
			$extrato->setItens($stmt->fetchAll(\PDO::FETCH_CLASS, "\\Modelo\\Item\\Item"));
		/*
		} else{
			$extrato->setItens(array());
		}
		 */
	}
}

?>
