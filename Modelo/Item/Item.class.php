<?php
namespace Modelo\Item;

class Item {

	private $id;
	private $titulo;
	private $numero;
	private $preco;
	private $idExtrato;
	private $idColecao;


	public function __construct($id = null){
		if($id){
			$this->setId($id);
		}
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
     * Get the value of Titulo
     *
     * @return mixed
     */
    public function getTitulo() {
        return $this->titulo;
    }

    /**
     * Set the value of Titulo
     *
     * @param mixed titulo
     */
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    /**
     * Get the value of Numero
     *
     * @return mixed
     */
    public function getNumero() {
        return $this->numero;
    }

    /**
     * Set the value of Numero
     *
     * @param mixed numero
     */
    public function setNumero($numero) {
        $this->numero = $numero;
    }

    /**
     * Get the value of Preco
     *
     * @return mixed
     */
    public function getPreco() {
        return $this->preco;
    }

    /**
     * Set the value of Preco
     *
     * @param mixed preco
     */
    public function setPreco($preco) {
        $this->preco = $preco;
    }

    /**
     * Get the value of Id Extrato
     *
     * @return mixed
     */
    public function getIdExtrato() {
        return $this->idExtrato;
    }

    /**
     * Set the value of Id Extrato
     *
     * @param mixed idExtrato
     */
    public function setIdExtrato($idExtrato) {
        $this->idExtrato = $idExtrato;
    }

    /**
     * Get the value of Id Colecao
     *
     * @return mixed
     */
    public function getIdColecao() {
        return $this->idColecao;
    }

    /**
     * Set the value of Id Colecao
     *
     * @param mixed idColecao
     */
    public function setIdColecao($idColecao) {
        $this->idColecao = $idColecao;
    }

}
?>
