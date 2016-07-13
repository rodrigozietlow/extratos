<?php
namespace App\Modelo\Extrato;

class Extrato {

	private $id;
	private $custo;
	private $descricao;
	private $data;

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
		return date("d/m/Y, H:i", strtotime($this->data));
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

}
?>
