<?php
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT); // E_STRICT should technically be used too
require_once $_SERVER['DOCUMENT_ROOT']."/extratos/Modelo/DataMappers/ExtratoMapperMySql.class.php";

$mapper = new App\Modelo\Extrato\ExtratoMapperMySql();
echo "<table border='1'>";
foreach($mapper->getAll(0, 50, "data ASC") as $extrato){
	echo "<tr>";
	echo "<td>".$extrato->getId()."</td>";
	echo "<td>".nl2br($extrato->getDescricao())."</td>";
	echo "<td>".$extrato->getCusto()."</td>";
	echo "<td>".$extrato->getDateFormated()."</td>";
	echo "</tr>";
}
echo "</table>";

$extratoNovo = new App\Modelo\Extrato\Extrato();
$extratoNovo->setDescricao("Bakuman 4, 5, 6 por depósito Caixa");
$extratoNovo->setCusto(-30);
//$extratoNovo = $mapper->save($extratoNovo); // uncomment to use


echo "<hr>";

$extratoBd = new App\Modelo\Extrato\Extrato(12);
try{
	$extratoBd = $mapper->fill($extratoBd);
	echo "<table border='1'>";
	echo "<tr>";
	echo "<td>".$extratoBd->getId()."</td>";
	echo "<td>".nl2br($extratoBd->getDescricao())."</td>";
	echo "<td>".$extratoBd->getCusto()."</td>";
	echo "<td>".$extratoBd->getDateFormated()."</td>";
	echo "</tr>";
	echo "</table>";
} catch(Exception $e){
	echo "Registro não encontrado.";
}

echo "<hr>";

$extratoAdeletar = new App\Modelo\Extrato\Extrato(12);
try{
	$extratoBd = $mapper->fill($extratoAdeletar);
	if($mapper->delete($extratoBd)){
		echo "Excluído com sucesso";
	} else{
		echo "Ops, algo deu errado, tente novamente.";
	}
} catch(Exception $e){
	echo "Registro não encontrado.";
}
?>
