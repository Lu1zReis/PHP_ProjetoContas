<?php
require_once 'db_connect.php';
if(isset($_POST['btn-criar'])):
	$erros = array();
	$data = mysqli_escape_string($connect, $_POST['data']);
	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$valor = mysqli_escape_string($connect, $_POST['valor']);

	if(empty($nome)):
		$erros[] = "Por favor, adicione um nome";
	endif;
	if(empty($data)):
		$erros[] = "Por favor, adicione uma data";
	endif;
	if(empty($valor)):
		$erros[] = "Por favor, adicione um valor";
	endif;

	if(!empty($erros)):
		foreach($erros as $erro):
			echo "<li>$erro</li>";
		endforeach;
	else:
		$sql = "INSERT INTO dados (data, conta, valor) VALUES ('$data', '$nome', '$valor')";
		if(mysqli_query($connect, $sql)):
			$_SESSION['adicionar'] = "Valor adicionado com sucesso";
			header('Location: ../index.php');
		else:
			$_SESSION['adicionar'] = "Erro ao cadastrar valor";
			header('Location: ../index.php');
		endif;
	endif;

endif;
?>

<html>
<head>
	<title>Adicionar</title>
</head>
<body>
<h1>Adicionar Conta</h1>
<hr>
<center>
	<table>
		<tr>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<td>Prazo: <input type="date" name="data"></td>
		</tr>
		<tr>
				<td>Nome: <input type="text" name="nome"><br></td>
		</tr>
		<tr>
				<td>Valor: <input type="text" name="valor"></td>
		</tr>
		<tr>
				<td><input type="submit" name="btn-criar"></td>
			</form>
		</tr>
	</table>
</center>
<body>
</html>
<?php

?>
