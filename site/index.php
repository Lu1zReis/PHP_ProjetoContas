<?php
session_start();

?>

<html>
<head>
<title>Pagamento</title
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
			<tr>
				<td>16/01/2021</td>
				<td>Pagamento do cartão</td>
				<td>1500.50</td>
				<td><a href="">editar</a> - <a href="">excluir</a>
			</tr>
		</tbody>

		<tfoot>
			<tr>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<td><button type="submit" name="btn-adicionar">adicionar</button></td>
				</form>
				<td align="center"> - </td>
				<td align="center"> - </td>
				<td align="center"> - </td>
			</tr>
		</tfoot>
	</table>
</center>
</body>
</html>


