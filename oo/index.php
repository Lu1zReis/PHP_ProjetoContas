<?php
require_once 'conn/usuario.php';
require_once 'conn/usuarioDao.php';
require_once 'conn/conexão.php';
session_start();
$usu = new conn\Produto();
$usuDao = new conn\ProdutoDao();
if(isset($_SESSION['msg'])):
	echo $_SESSION['msg'];
endif;
session_unset();
session_destroy();
$valorTotal = 0;
$usuDao->read();
if(!isset($_POST['exibirUsu'])):
	$_POST['exibirUsu'] = "all";
endif;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Birthday</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="main">
		<table align="center" cellpadding="60px"> 
			<tr>
				<td>
					<?php
						$fuso = new DateTimeZone('Brazil/West');
						$data = new DateTime('now');
						$data->setTimezone($fuso);
						echo $data->format('d/m/Y');
					?>
				</td>
				<td>
					<h2>Todas as contas</h2>
				</td>
				<td>
					Filtrar:
					<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="c">
						<select name="exibirUsu">
							<option value="all" selected="selected">All</option>
							<option value="me">Me</option>
							<option value="mom">Mom</option>
							<option value="dad">Dad</option>
							<input type="submit" name="selecionado">
						</select>
					</form> 
				</td>
			</tr>
		</table>
		<hr>
		<table cellpadding="20px" align="center">
			<tr>
				<td>
					<form action="action/add.php" method="POST">
						<button type="submit" name="adicionar">Adicionar</button>
					</form>
				</td>
				<td>
					|
				</td>
				<td>
					<b>Valor total a pagar:</b> R$
					<?php
					$valorTot = 0;
					foreach($usuDao->read() as $v) {
						if($v['pago'] == 'n'):
							$valorTot += $v['valor'];
						endif;
					}
					echo $valorTot;
					?> 
				</td>
				<td>
					|
				</td>
				<td>
					<form action="pagas.php" method="POST">
						<button type="submit" name="pagos">Ver contas pagas</button>
					</form>
				</td>
			</tr>
		</table>
		<?php
		if(isset($_POST['exibirUsu'])):
			if($_POST['exibirUsu'] == "all"):
		?>
			<div id="me">
				<h3>Me</h3>
			</div>
			<div id="tabela">
				<table align="center" cellpadding="35" cellspacing="35">
					<tr>
						<td><b>Nome</b></td>
						<td><b>Descrição</b></td>
						<td><b>Prazo</b></td>
						<td><b>Valor</b></td>
					</tr>

					<?php
					foreach ($usuDao->read() as $p):
						if($p['usuario'] == 'me'):
							if($p['pago'] == 'n'):
					?>
							<tr>
								<td><?php echo $p['titulo']; ?></td>
								<td><?php echo $p['descricao']; ?></td>
								<td>
									<?php
									$data = DateTime::createFromFormat("Y-m-d", $p['data']);
									echo $data->format("d/m/Y"); 
									?>
								</td>
								<td><?php echo "R$ ".$p['valor']; ?></td>
								<td>
									<form action="action/edit.php" method="POST">
										<button name="btn-editar" type="submit" value="<?php echo $p['id'] ?>">Editar</button>
										<br><hr>
										<button name="btn-pagou" type="submit" value="<?php echo $p['id'] ?>">Pago</button>
										<input type="hidden" name="usuario" value="me">
									</form>
								</td>
							</tr>
					<?php
							endif;
						endif;
					endforeach;
					foreach($usuDao->read() as $v):
						if($v['usuario'] == "me"):
							if($v['pago'] == "n"):
								$h1 += $v['valor']; 
							endif;
						endif;
					endforeach;
					?>
						<tr>
							<td><b>Total:</b></td>
							<td>
							<?php echo "R$ ".$h1;?>
							</td>
						</tr>
				</table>
				<hr>
			</div>
		<?php
			endif;
			if($_POST['exibirUsu'] == "all"):
		?>
			<div id="mom">
				<h3>Mom</h3>
			</div>
			<div id="tabela">
				<table align="center" cellpadding="35" cellspacing="35">
					<tr>
						<td><b>Nome</b></td>
						<td><b>Descrição</b></td>
						<td><b>Prazo</b></td>
						<td><b>Valor</b></td>
					</tr>

					<?php
					foreach ($usuDao->read() as $p):
						if($p['usuario'] == 'mom'):
							if($p['pago'] == 'n'):
					?>
							<tr>
								<td><?php echo $p['titulo']; ?></td>
								<td><?php echo $p['descricao']; ?></td>
								<td>
									<?php
									$data = DateTime::createFromFormat("Y-m-d", $p['data']);
									echo $data->format("d/m/Y"); 
									?>
								</td>
								<td><?php echo "R$ ".$p['valor']; ?></td>
								<td>
									<form action="action/edit.php" method="POST">
										<button name="btn-editar" type="submit" value="<?php echo $p['id'] ?>">Editar</button>
										<br><hr>
										<button name="btn-pagou" type="submit" value="<?php echo $p['id'] ?>">Pago</button>
										<input type="hidden" name="usuario" value="mom">
									</form>
								</td>
							</tr>
					<?php
							endif;
						endif;
					endforeach;
					foreach($usuDao->read() as $v):
						if($v['usuario'] == "mom"):
							if($v['pago'] == "n"):
								$h2 += $v['valor']; 
							endif;
						endif;
					endforeach;
					?>
						<tr>
							<td><b>Total:</b></td>
							<td>
							<?php echo "R$ ".$h2;?>
							</td>
						</tr>
				</table>
				<hr>
			</div>
		<?php
			endif;
			if($_POST['exibirUsu'] == "all"):
		?>
			<div id="dad">
				<h3>Dad</h3>
			</div>
			<div id="tabela">
				<table align="center" cellpadding="35" cellspacing="35">
					<tr>
						<td><b>Nome</b></td>
						<td><b>Descrição</b></td>
						<td><b>Prazo</b></td>
						<td><b>Valor</b></td>
					</tr>

					<?php
					foreach ($usuDao->read() as $p):
						if($p['usuario'] == 'dad'):
							if($p['pago'] == 'n'):
					?>
							<tr>
								<td><?php echo $p['titulo']; ?></td>
								<td><?php echo $p['descricao']; ?></td>
								<td>
									<?php
									$data = DateTime::createFromFormat("Y-m-d", $p['data']);
									echo $data->format("d/m/Y"); 
									?>
								</td>
								<td><?php echo "R$ ".$p['valor']; ?></td>
								<td>
									<form action="action/edit.php" method="POST">
										<button name="btn-editar" type="submit" value="<?php echo $p['id'] ?>">Editar</button>
										<br><hr>
										<button name="btn-pagou" type="submit" value="<?php echo $p['id'] ?>">Pago</button>
										<input type="hidden" name="usuario" value="dad">
									</form>
								</td>
							</tr>
					<?php
							endif;
						endif;
					endforeach;
					foreach($usuDao->read() as $v):
						if($v['usuario'] == "dad"):
							if($v['pago'] == "n"):
								$h3 += $v['valor']; 
							endif;
						endif;
					endforeach;
					?>
						<tr>
							<td><b>Total:</b></td>
							<td>
							<?php echo "R$ ".$h3;?>
							</td>
						</tr>
				</table>
				<hr>
			</div>
		<?php
			endif;

			if($_POST['exibirUsu'] == "me" or $_POST['exibirUsu'] == "mom" or $_POST['exibirUsu'] == "dad"):
		?>
			<div id="<?php echo $_POST['exibirUsu']; ?>">
				<h3><?php echo $_POST['exibirUsu']; ?></h3>
			</div>
			<div id="tabela">
				<table align="center" cellpadding="35" cellspacing="35">
					<tr>
						<td><b>Nome</b></td>
						<td><b>Descrição</b></td>
						<td><b>Prazo</b></td>
						<td><b>Valor</b></td>
					</tr>

					<?php
					foreach ($usuDao->read() as $p):
						if($p['usuario'] == $_POST['exibirUsu']):
							if($p['pago'] == 'n'):
					?>
							<tr>
								<td><?php echo $p['titulo']; ?></td>
								<td><?php echo $p['descricao']; ?></td>
								<td>
									<?php
									$data = DateTime::createFromFormat("Y-m-d", $p['data']);
									echo $data->format("d/m/Y"); 
									?>
								</td>
								<td><?php echo "R$ ".$p['valor']; ?></td>
								<td>
									<form action="action/edit.php" method="POST">
										<button name="btn-editar" type="submit" value="<?php echo $p['id'] ?>">Editar</button>
										<br><hr>
										<button name="btn-pagou" type="submit" value="<?php echo $p['id'] ?>">Pago</button>
										<input type="hidden" name="usuario" value="$_POST['exibirUsu']">
									</form>
								</td>
							</tr>
					<?php
							endif;
						endif;
					endforeach;
					foreach($usuDao->read() as $v):
						if($v['usuario'] == $_POST['exibirUsu']):
							if($v['pago'] == "n"):
								$h += $v['valor']; 
							endif;
						endif;
					endforeach;
					?>
						<tr>
							<td><b>Total:</b></td>
							<td>
							<?php echo "R$ ".$h;?>
							</td>
						</tr>
				</table>
				<hr>
			</div>
		<?php
			endif;
		else:
			echo "<li>Escolha a tabela de usuário que quer que seja exibida (Me, Mom, Dad ou todos)</li>";
		endif;
		?>
	</div>
</body>
</html>