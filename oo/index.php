<?php
require_once 'conn/usuario.php';
require_once 'conn/usuarioDao.php';
require_once 'conn/conexão.php';

$usu = new conn\Produto();
$usuDao = new conn\ProdutoDao();

session_start();
if(isset($_SESSION['msg'])):
	echo $_SESSION['msg'];
endif;
session_unset();
session_destroy();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Contas da Kaká</title>
    <link rel="stylesheet" type="text/css" href="principal.css">
</head>
<body>
	<header class="cabecalho">
		<h1 class="cabecalho-kaka">Kaká</h1>
		<nav class="cabecalho-menu">
			<a href="lista.php" class="cabecalho-menu-item">Lista de Contas</a>
			<a href="pagas.php" class="cabecalho-menu-item">Contas Pagas</a>
		</nav>
	</header>

	<main class="principal">
		<section class="principal-secao">
			<div class="principal-secao-primeira">
				<?php
					$maior;
					$nome = '';
					$data;
					foreach($usuDao->read() as $v) {
						if(empty($maior)):
							if($v['pago'] == 'n'):
								$maior = $v['valor'];
								$nome = $v['titulo'];
								$data = $v['data'];
							endif;
						else:
							if($v['pago'] == 'n'):
								if($v['valor'] > $maior):
									$maior = $v['valor'];
									$nome = $v['titulo'];
									$data = $v['data'];
								endif;
							endif;
						endif;							
					}
				?>
					<h1 class="principal-secao-primeira-titulo">Conta mais cara</h1>
					<h2 class="principal-secao-primeira-nome"><?php echo $nome; ?></h2>
					<h2 class="principal-secao-primeira-nome"><?php echo $maior;?> R$</h2>
					<h2 class="principal-secao-primeira-nome"><?php echo $data; ?>
					</h2>
				<?php

				?>
			</div>
			<div class="principal-secao-segunda">
				<h1 class="principal-secao-segunda-total">
				<?php 
					$valorTot = 0;
					foreach($usuDao->read() as $v) {
						if($v['pago'] == 'n'):
							$valorTot += $v['valor'];
						endif;
					}
					echo $valorTot." reais";
				?>/
				</h1>
				<h3 class="principal-secao-segunda-pago">
				<?php
					$valorPag = 0;
					foreach($usuDao->read() as $dado):
						if($dado['pago'] == 's'):
							$valorPag += $dado['valor'];
						endif;
					endforeach;
					echo $valorPag." reais";
				?>
				</h3>
				<form action="action/add.php" method="POST">
					<button type="submit" name="adicionar" class="segunda-secao-botao">Adicionar</button>
				</form>
			</div>
		</section>
	</main>

	<footer class="rodape">
		<center>
			<h1 class="rodape-autor">!By Lulu!</h1>
		</center>
	</footer>
</body>
</html>