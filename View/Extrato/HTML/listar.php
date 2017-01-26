<!doctype html>
<html>
	<head>
		<title>Lista de extratos</title>
		<?php include "includes/head.php"; ?>
	</head>

	<body>
		<?php include "includes/cabecalho.php"; ?>

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
							<a href="extrato/detalhes/<?=$extrato->getId();?>" class="well margin-top-1">
								<p class="bold"><?=$extrato->getDateFormated();?> &mdash; R$ <?=$extrato->getCustoFormated();?></p>
								<p><?=$extrato->getDescricao();?></p>
							</a>
							<?php
						}
					}
					else{
						?>
						<div class='margin-top-1'>
							Ops, nenhum extrato encontrado
						</div>
						<?php
					}
					?>
					<div class="clear-both"></div>
				</div>
			</div>
		</div>

		<div class="rodape">
		</div>
	</body>
</html>
