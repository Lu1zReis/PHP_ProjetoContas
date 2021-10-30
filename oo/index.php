<?php
require 'conn/usuario.php';
require 'conn/usuarioDao.php';

$usu = new Produto();
$usuDao = new ProdutoDao();

$usu->setTitulo('teste');
$usu->setDescricao('testeddd');
$usu->setValor(29);

$usuDao->create($usu);

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
						echo "<b>Data: </b>".date('d/m/Y');
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