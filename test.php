<?php
use Modelo\Extrato;
use Modelo\Extrato\interfaces;

require_once $_SERVER['DOCUMENT_ROOT']."/extratos/config.inc.php";

$mapper = new Extrato\MapperMySQL();
echo "<table border='1' cellspacing='0'>";
foreach($mapper->getAll(1, 0, 50, "data ASC") as $extrato){
	echo "<tr>";
	echo "<td>".$extrato->getId()."</td>";
	echo "<td>".nl2br($extrato->getDescricao())."</td>";
	echo "<td>".$extrato->getCusto()."</td>";
	echo "<td>".$extrato->getDateFormated()."</td>";
	echo "<td>".$extrato->getConta()."</td>";
	echo "</tr>";
}
echo "</table>";

$extratoNovo = new Extrato\Extrato();
$extratoNovo->setDescricao("BIG TESTE");
$extratoNovo->setCusto(-30);
$extratoNovo->setConta(1);
//$extratoNovo = $mapper->save($extratoNovo); // uncomment to use


echo "<hr>";

$extratoBd = new Extrato\Extrato(27);
try{
	$extratoBd = $mapper->fill($extratoBd);
	echo "<table border='1'>";
	echo "<tr>";
	echo "<td>".$extratoBd->getId()."</td>";
	echo "<td>".nl2br($extratoBd->getDescricao())."</td>";
	echo "<td>".$extratoBd->getCusto()."</td>";
	echo "<td>".$extratoBd->getDateFormated()."</td>";
	echo "<td>".$extratoBd->getConta()."</td>";
	echo "</tr>";
	echo "</table>";
} catch(Exception $e){
	echo "Registro não encontrado.";
}

echo "<hr>";

$extratoAdeletar = new Extrato\Extrato(27);
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
