<!doctype html>
<html>
	<head>
		<title>Página inicial</title>
		<?php include "includes/head.php"; ?>
	</head>

	<body>
		<?php include "includes/cabecalho.php"; ?>
		
		<div class="conteudo">
			<div class="container">
				<h2 class="title">Seus extratos</h2>
				<p class="texto margin-top-1">
					Bem-vindo aos seus extratos!<br>
					Aqui você pode gerenciar os seus extratos e controlar as suas compras de forma fácil e agilizada.
				</p>
				<?php
				if(!empty($extrato)){
					?>
					<h2 class="title margin-top-15">Último extrato</h2>
					<div class="well margin-top-1">
						<p class="bold"><?=$extrato->getDateFormated()?></p>
						<p><?=$extrato->getDescricao()?></p>
						<p>Tipo: <?=($extrato->getCusto() < 0) ? "Débito" : "Crédito"?></p>
						<p class="bold">Valor: R$ <?=$extrato->getCustoFormated(true) // absolute val?></p>
					</div>
					<?php
				}
				?>
			</div>
		</div>

		<div class="rodape">
		</div>
	</body>
</html>
