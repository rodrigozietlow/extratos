<?php
namespace Modelo\Extrato;

class Extrato {

	private $id;
	private $custo;
	private $descricao;
	private $fonte;
	private $data;
	private $conta;
	private $itens;

	/**
	 * Constructor of class Extrato
	 * @param int id
	 */
	public function __construct($id=null){
		if($id){
			$this->setId($id);
		}
	}

	/**
	 * Formats the date to DD/MM/YYYY
	 * @return string formated date
	 */
	public function getDateFormated(){
		return date("d/m/Y à\s H:i", strtotime($this->data));
	}

	/**
	 * Formats the custo to 99,99
	 * @return string formated custo
	 */
	public function getCustoFormated($abs = false){
		if($abs){
			$number = abs($this->custo);
		} else{
			$number = $this->custo;
		}
		return number_format($number, 2, ",", "");
	}

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Get the value of Custo
     *
     * @return mixed
     */
    public function getCusto() {
        return $this->custo;
    }

    /**
     * Set the value of Custo
     *
     * @param mixed custo
     */
    public function setCusto($custo) {
        $this->custo = $custo;
    }

    /**
     * Get the value of Descricao
     *
     * @return mixed
     */
    public function getDescricao() {
        return $this->descricao;
    }

    /**
     * Set the value of Descricao
     *
     * @param mixed descricao
     */
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    /**
     * Get the value of Data
     *
     * @return mixed
     */
    public function getData() {
        return $this->data;
    }

    /**
     * Set the value of Data
     *
     * @param mixed data
     */
    public function setData($data) {
        $this->data = $data;
    }


    /**
     * Get the value of Conta
     *
     * @return mixed
     */
    public function getConta() {
        return $this->conta;
    }

    /**
     * Set the value of Conta
     *
     * @param mixed conta
     */
    public function setConta($conta) {
        $this->conta = $conta;
    }


    /**
     * Get the value of Fonte
     *
     * @return mixed
     */
    public function getFonte() {
        return $this->fonte;
    }

    /**
     * Set the value of Fonte
     *
     * @param mixed fonte
     */
    public function setFonte($fonte) {
        $this->fonte = $fonte;
    }


    /**
     * Get the value of Itens
     *
     * @return mixed
     */
    public function getItens() {
        return $this->itens;
    }

    /**
     * Set the value of Itens
     *
     * @param mixed itens
     */
    public function setItens($itens) {
        $this->itens = $itens;
    }

}
?>
