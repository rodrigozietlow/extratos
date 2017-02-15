<!doctype html>
<html>
	<head>
		<title>Detalhes do extrato 9</title>
		<?php include "includes/head.php"; ?>
	</head>

	<body>
		<?php include "includes/cabecalho.php"; ?>

		<div class="conteudo">
			<div class="container">
				<!-- Descrição e data -->
				<h2 class="title">Extrato número <?=$extrato->getId()?> &mdash; <span class="bold">R$ <?=$extrato->getCustoFormated(true)?></span></h2>
				<p class="texto margin-top-1 bold">
					<?=$extrato->getDateFormated()?>
				</p>
				<p class="texto margin-top-05">
					<?=nl2br($extrato->getDescricao())?>
				</p>

				<!-- Informações técnicas-->
				<h2 class="title margin-top-05">Informações sobre o extrato</h2>
				<p class="texto margin-top-1">
					Tipo: <?=($extrato->getCusto() < 0) ? "Débito" : "Crédito"?><br>
					Conta: <?= "Not developed yet"/*$extrato->getConta()->getName()*/ ?>
				</p>

				<?php
				$itens = $extrato->getItens();
				if(!empty($itens)){
					$soma = array_sum(array_map(function($item){ return $item->getPreco(); }, $itens));
					$valor_itens_total = number_format($soma, 2, ",", "");
					$valor_frete = abs($extrato->getCusto()) - $soma > 0 ? "R$&nbsp;".number_format(abs($extrato->getCusto()) - $soma, 2, ",", "") : "Grátis";
					?>
					<!-- Itens -->
					<h2 class="title margin-top-05">Itens comprados &mdash; Valor total: R$&nbsp;<?=$valor_itens_total?> (Frete:&nbsp;<?=$valor_frete?>)</h2>
					<div class="well-container">
						<?php
						foreach($itens as $item){
							?>
							<div class="well margin-top-1">
								<p><?=$item->getTitulo()?> <?=$item->getNumero() ? " - ".$item->getNumero() : ""?></p>
								<p class="bold">Valor: R$ <?=number_format($item->getPreco(), 2, ",", "")?></p>
							</div>
							<?php
						}
						?>
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
