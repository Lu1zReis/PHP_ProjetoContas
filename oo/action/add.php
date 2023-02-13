<?php
require_once '../conn/usuario.php';
require_once '../conn/usuarioDao.php';
require_once '../conn/conexão.php';
session_start();
$usu = new conn\Produto();
$usuDao = new conn\ProdutoDao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <header class="cabecalho">
        <a href="../index.php" class="cabecalho-kaka">Kaká</a>
		<nav class="cabecalho-menu">
			<a href="../lista.php" class="cabecalho-menu-item">Lista de Contas</a>
			<a href="../pagas.php" class="cabecalho-menu-item">Contas Pagas</a>
		</nav>
    </header>

    <main class="principal">
        <h1 class="principal-adicionar">Adicionar</h1>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <nav class="botaos">
                Me<input type="radio" name="usuario" value="me">
                Dad<input type="radio" name="usuario" value="dad">
                Mom<input type="radio" name="usuario" value="mom">
            </nav>
            <section class="secao">
                <div class="principal-formulario">
                    <h2 class="principal-formulario-item">Nome:</h2>
                    <h2 class="principal-formulario-item">Valor:</h2>
                    <h2 class="principal-formulario-item">Data:</h2>
                    <h2 class="principal-formulario-item">Descrição:</h2>
                </div>
                <div class="form">
                        <input type="name" name="nome">
                        <input type="name" name="valor">
                        <input type="date" name="data">
                        <textarea name="descricao" class="descricao"></textarea>
                </div>
            </section>
            <section class="adicionar">
                <button type="submit" name="btn-adicionar" class="adicionar-botao">Cadastrar</button>
            </section>
        </form>
    </main>

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
0				}
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