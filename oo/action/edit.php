<?php
require_once '../conn/usuario.php';
require_once '../conn/usuarioDao.php';
require_once '../conn/conexão.php';

session_start();

$usu = new conn\Produto();
$usuDao = new conn\ProdutoDao();
if(isset($_POST['usuario'])):
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
	else:
		if(isset($_POST['btn-editar'])):
			$id = $_POST['btn-editar'];
			foreach ($usuDao->read() as $u):
				if($u['id'] == $_POST['btn-editar']):
?>


				<!DOCTYPE html>
				<html>
				<head>
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<title>Editar</title>

					<style rel type="text/css">
						#back {
							background: black;
							margin-right: 27%;
							margin-left: 27%;
							margin-top: 5%;
							padding-top: 20px;
							padding-bottom: 20px;
							border-radius: 10px;
						}
						#inside {
							color: hotpink;
							text-align: center;
							font-family: courier;
						}
						#geral {
							text-align: center;
						}
					</style>

				</head>
				<body>


					<div id="geral">
						<h3>theme</h3>
						<font color="black" bold><b>Black</b></font>
						to the 
						<font color="deeppink">Pink</font>
					</div>
				<hr>
				<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
					<div id="back">
						<div id="inside">
							<table cellspacing="7px" align="center">
								<caption><b>Adicionar conta</b></caption>
								<tr>
									<td><b>Nome:</b></td>
									<td><input type="name" name="nome" style="width: 190px; border-color: deeppink;" value="<?php echo $u['titulo']; ?>"></td>
								</tr>
								<tr>
									<td><b>Valor</b></td>
									<td><input type="name" name="valor" style="width: 190px; border-color: deeppink;" value="<?php echo $u['valor']; ?>"></td>
								</tr>
								<tr>
									<td><b>Prazo:</b></td>
									<td><input type="date" name="data" style="width: 193px; border-color: deeppink;" value="<?php echo $u['data']; ?>"></td>
								</tr>
								<tr>
									<td><b>Descrição:</b></td>
									<td><textarea name="descricao" style="margin: 1px; width: 192px; height: 143px; border-color: deeppink;" maxlength="250"><?php echo $u['descricao']; ?></textarea></td>
								</tr>
								<tr align="left">
									<td>Definido como:<br><?php echo $u['usuario']; ?></td>
									<td><input type="radio" name="usuario" value="<?php echo $u['usuario']; ?>" checked></td>
								</tr>
								<tr align="left">
									<td><br>Mudar:</td>
								</tr>
								<tr align="left">
									<td>Me:</td>
									<td><input type="radio" name="usuario" value="me"></td>
								</tr>
								<tr align="left">
									<td>Mom:</td>
									<td><input type="radio" name="usuario" value="mom"></td>
								</tr>
								<tr align="left">
									<td>Dad:</td>
									<td><input type="radio" name="usuario" value="dad"></td>
								</tr>
							</table>
							<hr>
							<input type="submit" name="btn-editou">
							<input type="hidden" name="id" value="<?php echo $u['id']; ?>">
						</div>
					</div>
				</form>
				<br><br>
				<center>
					<a href="../index.php">Cancelar</a>
				</center>
				<br><br>


				</body>
				</html>


<?php
				endif;
			endforeach;
		endif;	
	endif;
else:
	header('Location: ../index.php');
endif;

if(isset($_POST['btn-editou'])):
	echo $_POST['id'];
		$usu->setTitulo($_POST['nome']);
		$usu->setDescri($_POST['descricao']);
		$usu->setValor($_POST['valor']);
		$usu->setData($_POST['data']);
		$usu->setPago('n');
		$usu->setUsuario($_POST['usuario']);
		$usu->setId($_POST['id']);

		if($usuDao->update($usu) == true):
			$_SESSION['msg'] = "<li>Conta editada com sucesso</li>";
			header('Location: ../index.php');
		else:
			$_SESSION['msg'] = "<li>Erro ao editar a conta</li>";
			header('Location: ../index.php');
		endif;
endif;
?>
