<?php
require_once 'ação/db_connect.php';
session_start();
if(isset($_SESSION['adicionar'])):
	echo $_SESSION['adicionar']."<br>";
endif;
session_unset();
session_destroy();
?>

<html>
<head>
<title>Pagamento</title>
</head>
<body>

<style>
	thead {color: green}
	tbody {color: blue}
	tfoot {color: red}

	table, th, td{
		border: 1px solid black;
	}
</style>
<?php echo "Data atual: ".date('d/m/Y'); ?>
<center>
	<h1>Contas</h1>
	<table>
		<thead>
			<tr>
				<th>Prazo</th>
				<th>Conta</th>
				<th>Valor</th>
				<th>Opções</th>
			</tr>
		</thead>

		<tbody>
		<?php
			$sql = "SELECT * FROM dados";
			$resultado = mysqli_query($connect, $sql);
			$valor = 0;
			while($dados = mysqli_fetch_array($resultado)):
				$dados['data'] = strtotime($dados['data']);
				$valor = $valor + $dados['valor'];
		?>
			<tr>
				<td><?php echo date('d/m/Y', $dados['data']); ?></td>
				<td><?php echo $dados['conta']; ?></td>
				<td><?php echo $dados['valor']; ?></td>
				<td><a href="">editar</a> - <a href="">excluir</a>
			</tr>
		<?php endwhile; ?>
		</tbody>

		<tfoot>
			<tr>
				<form action="ação/adicionar.php" method="POST">
					<td><button type="submit" name="btn-adicionar">adicionar</button></td>
				</form>
				<td align="center"> Valor total: </td>
				<td align="center"><?php echo $valor; ?></td>
				<td align="center"> - </td>
			</tr>
		</tfoot>
	</table>
</center>
</body>
</html>


