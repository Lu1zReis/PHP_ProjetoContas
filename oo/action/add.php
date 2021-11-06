<?php
require_once '../conn/usuario.php';
require_once '../conn/usuarioDao.php';
require_once '../conn/conexão.php';
session_start();
$usu = new conn\Produto();
$usuDao = new conn\ProdutoDao();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Adicionar</title>
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
					<td><input type="name" name="nome" style="width: 190px; border-color: deeppink;"></td>
				</tr>
				<tr>
					<td><b>Valor:</b></td>
					<td><input type="name" name="valor" style="width: 190px; border-color: deeppink;"></td>
				</tr>
				<tr>
					<td><b>Data:</b></td>
					<td><input type="date" name="data" style="width: 193px; border-color: deeppink;"></td>
				</tr>
				<tr>
					<td><b>Descrição:</b></td>
					<td><textarea name="descricao" style="margin: 1px; width: 192px; height: 143px; border-color: deeppink;" maxlength="250"></textarea></td>
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
			<input type="submit" name="btn-adicionar">
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
if(isset($_POST['btn-adicionar'])){
	class Verifica {
		private $nome;
		private $usuario;
		private $erros = array();

		public function __construct($n, $u) {
			$this->nome = $n;
			$this->usuario = $u;
		}

		public function filtro() {

			if(empty($this->nome)):
				$this->erros[] = "<li>preencha o campo nome</li>";
			endif;
			if(!isset($this->usuario)):
				$this->erros[] = "<li>preencha o campo usuário</li>";
			endif;

			if(!empty($this->erros)):
				foreach ($this->erros as $erro) {
					echo $erro;
				}
			else:
				return true;
			endif;
		}
	}
	if(empty($_POST['usuario'])):
		$_POST['usuario'] = null;
	endif;
	$filtrar = new Verifica($_POST['nome'], $_POST['usuario']);
	if($filtrar->filtro()):
		$usu->setTitulo($_POST['nome']);
		$usu->setDescri($_POST['descricao']);
		$usu->setValor($_POST['valor']);
		$usu->setData($_POST['data']);
		$usu->setPago('n');
		$usu->setUsuario($_POST['usuario']);

		if($usuDao->create($usu) == true):
			$_SESSION['msg'] = "<li>Nova conta adicionada com sucesso</li>";
			header('Location: ../index.php');
		else:
			$_SESSION['msg'] = "<li>Erro ao adicionar a nova conta</li>";
			header('Location: ../index.php');
		endif;
	endif;
}
?>