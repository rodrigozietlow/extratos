<?php
namespace Modelo\Extrato\interfaces;
use Modelo\Extrato;

interface iMapper {

	public function save(Extrato\Extrato $extrato);

	public function getById($id);

	public function getAll($tipo, $begin, $limit, $order);

	public function delete($id);
}
?>
