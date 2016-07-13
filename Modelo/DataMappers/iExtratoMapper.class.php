<?php
namespace App\Modelo\Extrato;

interface iExtratoMapper {

	public function save(Extrato $extrato);

	public function fill(Extrato $extrato);

	public function getAll($begin, $limit, $order);

	public function delete(Extrato $extrato);
}
?>
