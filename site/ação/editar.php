<?php
session_start();
require_once 'db_connect.php';
if(isset($_GET['id'])):
	$id = $_GET['id'];
	$sql = "SELECT * FROM dados WHERE id = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados = mysqli_fetch_array($resultado);
endif;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Editar dados</title>
</head>
<body>
<h1>Editar</h1>
<hr>
<center>
	<table>
		<form action="update.php" method="POST">
			<input type="hidden" name = "id" value="<?php echo $dados['id'];?>">
			<tr>
				<td>Data: <input type="date" name="data" value="<?php echo $dados['data']; ?>"></td>
			</tr>
			<tr>
				<td>Nome: <input type="text" name="nome" value="<?php echo $dados['conta']; ?>"></td>
			</tr>
			<tr>
				<td>Valor: <input type="text" name="valor" value="<?php echo $dados['valor']; ?>"></td>
			</tr>
			<tr>
				<td><button type="submit" name="btn-editar">Atualizar</button><td>
				<td><button type="submit" name="btn-cancelar">Cancelar</button><td>
			</tr>
		</form>
	</table>
</center>
</body>
</html>