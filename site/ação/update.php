<?php
session_start();

require_once 'db_connect.php';

function clear($input){
	global $connect;

	// html
	$var = mysqli_escape_string($connect, $input);

	// xss
	$var = htmlspecialchars($var);

	return $var;
}

if(isset($_POST['btn-editar'])):
	$data = clear($_POST['data']);
	$nome = clear($_POST['nome']);
	$valor = clear($_POST['valor']);

	$id = mysqli_escape_string($connect, $_POST['id']);

	$sql = "UPDATE dados SET data = '$data', conta = '$nome', valor = '$valor' WHERE id = '$id'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['msg'] = "Atualizado com sucesso";
		header('Location: ../index.php');
	else:
		$_SESSION['msg'] = "Erro ao Atualizar".mysqli_connect_error();
		header('Location: ../index.php');
	endif;
endif;
if(isset($_POST['btn-cancelar'])):
		$_SESSION['msg'] = "Ação cancelada";
		header('Location: ../index.php');
endif;	
?>