<!doctype html>
<html>
	<head>
		<title>Lista de extratos</title>
		<link href="View/estilos.css" rel="stylesheet">
	</head>

	<body>
		<div class="cabecalho">
			<div class="logo1">
				<a href="index.php">Extratos</a>
			</div>
			<div class="menu-item">
				<a href="extratos-lista.php">Lista de extratos</a>
			</div>
			<div class="menu-item">
				<a href="extratos-novo.php">Novo extrato</a>
			</div>
		</div>

		<div class="conteudo">
			<div class="container">
				<h2 class="title">Seus extratos</h2>
				<p class="texto margin-top-1">
					Confira seus extratos mais recentes.<br>
					Clique em um para ver detalhes.
				</p>
				<div class="well-container">
					<?php
					if(!empty($extratos)){
						foreach($extratos as $extrato){
							?>
							<a href="extratos-detalhes.php?id=<?=$extrato->getId();?>" class="well margin-top-1">
								<p class="bold"><?=$extrato->getDateFormated();?> &mdash; R$ <?=$extrato->getCustoFormated();?></p>
								<p><?=$extrato->getDescricao();?></p>
							</a>
							<?php
						}
					}
					else{
						echo "
						<tr class='margin-top-1'>
							<td>
							Ops, nenhum extrato encontrado
							</td>
						</tr>";
					}
					echo "</table>";
					?>
					<div class="clear-both"></div>
				</div>
			</div>
		</div>

		<div class="rodape">
		</div>
	</body>
</html>
