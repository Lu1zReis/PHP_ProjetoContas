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
	</style>
</head>
<body>
<form method="POST" action="<?php $_SERVER['PHP_POST']; ?>">
	<div id="back">
		<div id="inside">
			<table cellspacing="7px" align="center">
				<caption><b>Adicionar conta</b></caption>
				<tr>
					<td><b>Nome:</b></td>
					<td><input type="name" name="nome" style="width: 190px; border-color: deeppink;"></td>
				</tr>
				<tr>
					<td><b>Valor</b></td>
					<td><input type="name" name="valor" style="width: 190px; border-color: deeppink;"></td>
				</tr>
				<tr>
					<td><b>Prazo:</b></td>
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
	
	$nome = $_POST['nome'];
	$usua = $_POST['usuario'];

	$filtrar = new Verifica($nome, $usua);

	if($filtrar->filtro()):
		echo "tudo certo";
	endif;
}
?>