<?php
require_once 'conn/usuario.php';
require_once 'conn/usuarioDao.php';
require_once 'conn/conexão.php';

$usu = new conn\Produto();
$usuDao = new conn\ProdutoDao();

$valorTotal = 0;
if(isset($_POST['btn-apagar'])):
	$id = $_POST['btn-apagar'];
	$produtoDao->delete($id);
endif;

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Birthday</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="main">
		<table align="center" cellpadding="60px"> 
			<tr>
				<td>
					<?php
						$fuso = new DateTimeZone('Brazil/West');
						$data = new DateTime('now');
						$data->setTimezone($fuso);
						echo $data->format('d/m/Y');
					?>
				</td>
				<td>
					<h2>Todas as contas</h2>
				</td>
				<td>
					Filtrar:
					<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="c">
						<select name="exibirUsu">
							<option value="all">All</option>
							<option value="me">Me</option>
							<option value="mom">Mom</option>
							<option value="dad">Dad</option>
							<input type="submit" name="selecionado">
						</select>
					</form> 
				</td>
			</tr>
		</table>
		<hr>
		<table cellpadding="20px" align="center">
			<tr>
				<td>
					<form action="action/add.php" method="POST">
						<button type="submit" name="adicionar">Adicionar</button>
					</form>
				</td>
				<td>
					|
				</td>
				<td>
					<b>Valor total a pagar:</b> R$
					<?php
					$valorTot = 0;
					foreach($usuDao->read() as $v) {
						$valorTot += $v['valor'];
					}
					echo $valorTot;
					?> 
				</td>
			</tr>
		</table>
		<?php
		if(isset($_POST['exibirUsu'])):
			if($_POST['exibirUsu'] == "me" or $_POST['exibirUsu'] == "all"):
		?>
			<div id="me">
				<h3>Me</h3>
			</div>
			<div id="tabela">
				<table align="center" cellpadding="35" cellspacing="35">
					<tr>
						<td><b>Nome</b></td>
						<td><b>Descrição</b></td>
						<td><b>Prazo</b></td>
						<td><b>Valor</b></td>
					</tr>

					<?php
					$usuDao->read();
					foreach ($usuDao->read() as $p):
						if($p['usuario'] == 'me'):
							if($p['pago'] == 'n'):
					?>
							<tr>
								<td><?php echo $p['titulo']; ?></td>
								<td><?php echo $p['descricao']; ?></td>
								<td>
									<?php
									$data = DateTime::createFromFormat("Y-m-d", $p['data']);
									echo $data->format("d/m/Y"); 
									?>
								</td>
								<td><?php echo "R$ ".$p['valor']; ?></td>
								<td>
									<form action="edit.php" method="POST">
										<button name="btn-editar" type="submit" value="<?php echo $p['id'] ?>">Editar</button>
										<br><hr>
										<button name="btn-pagou" type="submit" value="<?php echo $p['id'] ?>">Pago</button>
										<input type="hidden" name="usuario" value="dad">
									</form>
								</td>
							</tr>
					<?php
							endif;
						endif;
					endforeach;
					?>

				</table>
				<hr>
			</div>
		<?php
		endif;
		if($_POST['exibirUsu'] == "mom" or $_POST['exibirUsu'] == "all"):
		?>
			<div id="mom">
				<h3>Mom</h3>
			</div>
			<div id="tabela">
				<table align="center" cellpadding="35" cellspacing="35">
					<tr>
						<td><b>Nome</b></td>
						<td><b>Descrição</b></td>
						<td><b>Prazo</b></td>
						<td><b>Valor</b></td>
					</tr>
				</table>
				<hr>
			</div>
		<?php
		endif;
		if($_POST['exibirUsu'] == "dad" or $_POST['exibirUsu'] == "all"):
		?>
			<div id="dad">
				<h3>Dad</h3>
			</div>
			<div id="tabela">
				<table align="center" cellpadding="35" cellspacing="35">
					<tr>
						<td><b>Nome</b></td>
						<td><b>Descrição</b></td>
						<td><b>Prazo</b></td>
						<td><b>Valor</b></td>
					</tr>
				</table>
				<hr>
			</div>
		<?php
			endif;
		else:
			echo "<li>Escolha a tabela de usuário que quer que seja exibida (Me, Mom, Dad ou todos)</li>";
		endif;
		?>
	</div>
</body>
</html>