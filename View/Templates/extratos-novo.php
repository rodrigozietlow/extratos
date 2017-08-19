<!doctype html>
<html>
	<head>
		<title>Detalhes do extrato 9</title>
		<link href="../estilos.css" rel="stylesheet">
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
				<!-- DescriÃ§Ã£o e data -->
				<h2 class="title">Incluir novo extrato</h2>

				<div class="form-wrap margin-top-1">
					<input type="text" name="titulo" placeholder="T&iacute;tulo do extrato" class="form form-full">
				</div>

				<div class="form-wrap margin-top-05">
					<input type="text" name="valor-total" placeholder="Valor total da compra" class="form form-half float-left">
					<input type="text" name="data" placeholder="Data da compra" class="form form-half float-right">
					<div class="clear-both"></div>
				</div>

				<div class="form-wrap margin-top-05">
					<textarea name="descricao" rows="5" class="form form-full" placeholder="Adicione uma descrição para este extrato"></textarea>
				</div>
			</div>
		</div>

		<div class="rodape">
		</div>
	</body>
</html>
