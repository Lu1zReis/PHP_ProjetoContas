<?php
require_once '../conn/usuario.php';
require_once '../conn/usuarioDao.php';
require_once '../conn/conexão.php';

session_start();

$usu = new conn\Produto();
$usuDao = new conn\ProdutoDao();

if(isset($_POST['btn-pagou'])):
	$usu->setId($_POST['btn-pagou']);
	$usu->setPago('s');
	if($usuDao->pagar($usu) == true):
		$_SESSION['msg'] = "<li>Valor definido como pago</li>";
		header('Location: ../index.php');
	else:
		$_SESSION['msg'] = "<li>Não foi possivel definir o valor como pago</li>";
		header('Location: ../index.php');
	endif;
endif;
?>
