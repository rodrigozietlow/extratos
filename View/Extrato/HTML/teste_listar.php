<?php
echo "<table border='1' cellspacing='0'>";
if(!empty($extratos)){
	foreach($extratos as $extrato){
		echo "<tr>";
		echo "<td>".$extrato->getId()."</td>";
		echo "<td>".nl2br($extrato->getDescricao())."</td>";
		echo "<td>".$extrato->getCusto()."</td>";
		echo "<td>".$extrato->getDateFormated()."</td>";
		echo "<td>".$extrato->getConta()."</td>";
		echo "</tr>";
	}
}
else{
	echo "
	<tr>
		<td>
		Ops, nenhum extrato encontrado
		</td>
	</tr>";
}
echo "</table>";
?>
