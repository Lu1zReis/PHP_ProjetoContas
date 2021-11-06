<?php
require_once 'conn/usuario.php';
require_once 'conn/usuarioDao.php';
require_once 'conn/conexão.php';

session_start();

$usu = new conn\Produto();
$usuDao = new conn\ProdutoDao();
$usuDao->read();

if(isset($_POST['btn-apagar'])):
	if($usuDao->delete($_POST['btn-apagar'])):
		$_SESSION['msg'] = "<li>Conta deletada com sucesso</li>";
		header('Location: index.php');
	else:
		$_SESSION['msg'] = "<li>Erro ao deletar a conta</li>";
		header('Location: index.php');
	endif;
endif;

if(isset($_POST['btn-mudar'])):
	$id = $_POST['btn-mudar'];
	$usu->setId($id);
	$usu->setPago('n');
	if($usuDao->pagar($usu)):
		$_SESSION['msg'] = "<li>Valor da conta mudada para: não paga, com sucesso</li>";
		header('Location: index.php');
	else:
		$_SESSION['msg'] = "<li>Erro ao mudar o valor da conta para: não paga</li>";
		header('Location: index.php');
	endif;
endif;
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
	<table align="center" cellpadding="15px">
		<td>
			Organizar por:
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<select name="exibirUsu">
					<option value="all" selected="selected">All</option>
					<option value="me">Me</option>
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
	<table align="center" cellpadding="15px" cellspacing="15px" border="3px">
		<tr>
			<td><b>Nome</b></td>
			<td><b>Descrição</b></td>
			<td><b>Data</b></td>
			<td><b>Valor R$</b></td>
			<td><b>Usuário</b></td>
		</tr>
		<?php
		foreach($usuDao->read() as $dado):
			if($dado['pago'] == 's'):
		?>
			<tr>
				<td><?php echo $dado['titulo']; ?></td>
				<td><?php echo $dado['descricao']; ?></td>
				<td>
				<?php
				$data = DateTime::createFromFormat("Y-m-d", $dado['data']);
				echo $data->format("d/m/Y"); 
				?>
				</td>
				<td><?php echo $dado['valor']; ?></td>
				<td><?php echo $dado['usuario']; ?></td>
				<td>
					
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
						<button name="btn-apagar" type="submit" value="<?php echo $dado['id'] ?>">Apagar</button>
						<br><br><hr><br>
						<button name="btn-mudar" type="submit" value="<?php echo $dado['id'] ?>">Mudar</button>
					</form>

				</td>
			</tr>
		<?php
			endif;
		endforeach;
		?>
	</table>

</form>
</body>
</html>