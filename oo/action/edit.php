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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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
        <h1 class="principal-adicionar">Editar</h1>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <nav class="botaos">
				<?php
				if($u['usuario'] == "me"):
				?>
               		Me<input type="radio" name="usuario" value="me" checked>
                	Dad<input type="radio" name="usuario" value="dad">
                	Mom<input type="radio" name="usuario" value="mom">
				<?php
				elseif($u['usuario'] == "dad"):
				?>
               		Me<input type="radio" name="usuario" value="me">
                	Dad<input type="radio" name="usuario" value="dad" checked>
                	Mom<input type="radio" name="usuario" value="mom">
				<?php
				else:
				?>
               		Me<input type="radio" name="usuario" value="me">
                	Dad<input type="radio" name="usuario" value="dad">
                	Mom<input type="radio" name="usuario" value="mom" checked>
				<?php
				endif;
				?>
            </nav>
            <section class="secao">
                <div class="principal-formulario">
                    <h2 class="principal-formulario-item">Nome:</h2>
                    <h2 class="principal-formulario-item">Valor:</h2>
                    <h2 class="principal-formulario-item">Data:</h2>
                    <h2 class="principal-formulario-item">Descrição:</h2>
                </div>
                <div class="form">
                        <input type="name" name="nome" value="<?php echo $u['titulo']; ?>">
                        <input type="name" name="valor" value="<?php echo $u['valor']; ?>">
                        <input type="date" name="data" value="<?php echo $u['data']; ?>">
                        <textarea name="descricao" value="<?php echo $u['descricao']; ?>" class="descricao"><?php echo $u['descricao']; ?></textarea>
                </div>
            </section>
            <section class="adicionar">
                <button type="submit" name="btn-editou" class="adicionar-botao">Editar</button>
				<input type="hidden" name="id" value="<?php echo $u['id']; ?>">
            </section>
        </form>
    </main>

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