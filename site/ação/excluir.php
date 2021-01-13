<?php 
session_start();

require_once 'db_connect.php';

if(isset($_GET['id'])):
	if(isset($_POST['btn-excluir'])):
		$delete = $_POST['escolha'];
		if($delete == "op2"):
			$_SESSION['msg'] = "Ação cancelada";
			header('Location: ../index.php');
		else:
			$id = mysqli_escape_string($connect, $_GET['id']);
			$sql = "DELETE FROM dados WHERE id = '$id'";

			if(mysqli_query($connect, $sql)):
				$_SESSION['msg'] = "Deletado com sucesso";
				header('Location: ../index.php');
			else:
				$_SESSION['msg'] = "Erro ao deletar";
				header('Location: ../index.php');
			endif;
		endif;
	endif;
endif;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Excluir</title>
</head>
<body>
<h3>Excluir?</h3>
<hr>
	<center>
		<form action="" method="POST">
			Apagar: <input type="radio" name="escolha" value="op1"><br>
			Cancelar: <input type="radio" name="escolha" value="op2"><br>
			<input type="submit" name="btn-excluir">
		</form>
	</center>
</body>
</html>