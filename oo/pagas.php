<?php
require_once 'conn/usuario.php';
require_once 'conn/usuarioDao.php';
require_once 'conn/conexão.php';
session_start();
$usu = new conn\Produto();
$usuDao = new conn\ProdutoDao();
$usuDao->read();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Contas pagas</title>
</head>
<body>
<center>
	<h1>Valores pagos</h1>
	<hr>
</center>
<form>
	<table align="center" cellpadding="10px">
		<td>
			Organizar por:
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<select name="exibirUsu">
					<option value="all" selected="selected">All</option>
					<option value="mom">Mom</option>
					<option value="dad">Dad</option>
				</select>
				<button type="submit" name="filtrar">Filtrar</button>
			</form>
		</td>
		<td>|</td>
		<td>
			<?php
			$fuso = new DateTimeZone('Brazil/West');
			$data = new DateTime('now');
			$data->setTimezone($fuso);
			echo "<b>Data: </b>".$data->format('d/m/Y');
			?>
		</td> 
	</table>
	<br><br><br><br>
	<table align="center" cellpadding="15px" cellspacing="10px">
		<tr>
			<td><b>Nome</b></td>
			<td><b>Descrição</b></td>
			<td><b>Prazo</b></td>
			<td><b>Valor</b></td>
		</tr>
		<?php
		foreach ($usuDao->read() as $dado):
			echo $dado['valor'];
		foreach;
		?>
	</table>

</form>
</body>
</html>