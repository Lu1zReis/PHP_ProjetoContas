<?php
// conexão com o banco de dados
require_once 'ação/db_connect.php';
// mostrando a data atual
echo "Data atual: ".date('d/m/Y')."<br>";
// restante do trecho de código para mostrar msg na tela para o usuário 
session_start();
if(isset($_SESSION['msg'])):
	echo $_SESSION['msg']."<br>";
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

<center>
	<h1>Contas</h1>
	<hr>
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
		// Pegando os dados do banco de dados:
			$sql = "SELECT * FROM dados";
			$resultado = mysqli_query($connect, $sql); // fazendo a conexão em si
			$valor = 0; // variavel para pegar o valor total no final das contas
			while($dados = mysqli_fetch_array($resultado)):
				$dados['data'] = strtotime($dados['data']); // formatação da data
				$valor = $valor + $dados['valor'];
		?>
			<tr>
				<td><?php echo date('d/m/Y', $dados['data']); ?></td>
				<td><?php echo $dados['conta']; ?></td>
				<td><?php echo $dados['valor']; ?></td>
				<td><a href="ação/editar.php?id=<?php echo $dados['id']; ?>">editar</a> - <a href="ação/excluir.php?id=<?php echo $dados['id'] ?>">excluir</a></td>
			</tr>
		<?php endwhile; // Terminando o looping?>
		</tbody>

		<tfoot>
			<tr>
				<form action="ação/adicionar.php" method="POST">
					<td><button type="submit" name="btn-adicionar">adicionar</button></td>
				</form>
				<td align="center"> Valor total: </td>
				<td align="center"><?php echo $valor; // mostrando o valor total?></td>
				<td align="center"> - </td>
			</tr>
		</tfoot>
	</table>
</center>
</body>
</html>


