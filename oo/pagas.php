<?php
require_once 'conn/usuario.php';
require_once 'conn/usuarioDao.php';
require_once 'conn/conexão.php';

$usu = new conn\Produto();
$usuDao = new conn\ProdutoDao();

if(!isset($_POST['exibirUsu'])):
	$_POST['exibirUsu'] = "all";
endif;

require_once 'conn/usuario.php';
require_once 'conn/usuarioDao.php';
require_once 'conn/conexão.php';

session_start();

$usu = new conn\Produto();
$usuDao = new conn\ProdutoDao();
$usuDao->read();

if(isset($_POST['btn-apagar'])):
	if($usuDao->delete($_POST['btn-apagar'])):
		$_SESSION['msg'] = "<li>Conta deletada com sucesso</li>";
		header('Location: lista.php');
	else:
		$_SESSION['msg'] = "<li>Erro ao deletar a conta</li>";
		header('Location: lista.php');
	endif;
endif;

if(isset($_POST['btn-mudar'])):
	$id = $_POST['btn-mudar'];
	$usu->setId($id);
	$usu->setPago('n');
	if($usuDao->pagar($usu)):
		$_SESSION['msg'] = "<li>Valor da conta mudada para: não paga, com sucesso</li>";
		header('Location: lista.php');
	else:
		$_SESSION['msg'] = "<li>Erro ao mudar o valor da conta para: não paga</li>";
		header('Location: lista.php');
	endif;
endif;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
    <link rel="stylesheet" type="text/css" href="pagas.css">
</head>
<body>
    <header class="cabecalho">
		<a href="index.php" class="cabecalho-kaka">Kaká</a>
		<nav class="cabecalho-menu">
			<a href="lista.php" class="cabecalho-menu-item">Lista de Contas</a>
            <p class="filtro">
                Filtrar:
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="c">
					<select name="exibirUsu" class="filtrar">
						<option value="all" selected="selected">All</option>
						<option value="me">Me</option>
						<option value="mom">Mom</option>
						<option value="dad">Dad</option>
                        <input type="submit" name="selecionado" class="enviar">
					</select>
				</form> 
            </p> 
		</nav>
	</header>
    <?php
    if(isset($_POST['exibirUsu'])):
        if($_POST['exibirUsu'] == "all"):
    ?>
        <main class="principal">
            <h1 class="principal-lista">Pagas</h1>
            <h2 class="usu">
            Me
            <?php
            $valorTot = 0;
            foreach($usuDao->read() as $v) {
                if($v['pago'] == 's'):
                    if($v['usuario'] == 'me'):
                        $valorTot += $v['valor'];
                    endif;
                endif;
            }
            echo "(".$valorTot." R$)";
            ?>
            </h2>
            <section class="usuario">
                <div class="estatico">
                    <h2 class="estatico-item">Nome</h2>
                    <h2 class="estatico-item">Data</h2>
                    <h2 class="estatico-item">Valor</h2>
                </div>
                <?php
                foreach ($usuDao->read() as $p):
                    if($p['usuario'] == 'me'):
                        if($p['pago'] == 's'):
                ?>
                <div class="sql">
                    <h3 class="sql-item"><?php echo $p['titulo']; ?></h3>
                    <h3 class="sql-item">
                    <?php
                        $data = DateTime::createFromFormat("Y-m-d", $p['data']);
                        echo $data->format("d/m/Y"); 
                    ?>
                    </h3>
                    <h3 class="sql-item"><?php echo $p['valor']; ?></h3>
                </div>
                <p class="descricao"><?php echo $p['descricao']; ?></p>
                <div class="botaos">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <button name="btn-apagar" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Apagar</button>
                        <button  name="btn-mudar" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Mudar</button>
                    </form>
                </div>
                <?php
                        endif;
                    endif;
                endforeach;
                ?>
            </section>
            
            <h2 class="usu">
            Dad
            <?php
            $valorTot = 0;
            foreach($usuDao->read() as $v) {
                if($v['pago'] == 's'):
                    if($v['usuario'] == 'dad'):
                        $valorTot += $v['valor'];
                    endif;
                endif;
            }
            echo "(".$valorTot." R$)";
            ?>
            </h2>
            <section class="usuario">
            <div class="estatico">
                    <h2 class="estatico-item">Nome</h2>
                    <h2 class="estatico-item">Data</h2>
                    <h2 class="estatico-item">Valor</h2>
                </div>
                <?php
                foreach ($usuDao->read() as $p):
                    if($p['usuario'] == 'dad'):
                        if($p['pago'] == 's'):
                ?>
                <div class="sql">
                    <h3 class="sql-item"><?php echo $p['titulo']; ?></h3>
                    <h3 class="sql-item">
                    <?php
                        $data = DateTime::createFromFormat("Y-m-d", $p['data']);
                        echo $data->format("d/m/Y"); 
                    ?>
                    </h3>
                    <h3 class="sql-item"><?php echo $p['valor']; ?></h3>
                </div>
                <p class="descricao"><?php echo $p['descricao']; ?></p>
                <div class="botaos">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <button name="btn-apagar" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Apagar</button>
                        <button  name="btn-mudar" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Mudar</button>
                    </form>
                </div>
                <?php
                        endif;
                    endif;
                endforeach;
                ?>
            </section>

            <h2 class="usu">
            Mom
            <?php
            $valorTot = 0;
            foreach($usuDao->read() as $v) {
                if($v['pago'] == 's'):
                    if($v['usuario'] == 'mom'):
                        $valorTot += $v['valor'];
                    endif;
                endif;
            }
            echo "(".$valorTot." R$)";
            ?>
            </h2>
            <section class="usuario">
                <div class="estatico">
                    <h2 class="estatico-item">Nome</h2>
                    <h2 class="estatico-item">Data</h2>
                    <h2 class="estatico-item">Valor</h2>
                </div>
                <?php
                foreach ($usuDao->read() as $p):
                    if($p['usuario'] == 'mom'):
                        if($p['pago'] == 's'):
                ?>
                <div class="sql">
                    <h3 class="sql-item"><?php echo $p['titulo']; ?></h3>
                    <h3 class="sql-item">
                    <?php
                        $data = DateTime::createFromFormat("Y-m-d", $p['data']);
                        echo $data->format("d/m/Y"); 
                    ?>
                    </h3>
                    <h3 class="sql-item"><?php echo $p['valor']; ?></h3>
                </div>
                <p class="descricao"><?php echo $p['descricao']; ?></p>
                <div class="botaos">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <button name="btn-apagar" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Apagar</button>
                        <button  name="btn-mudar" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Mudar</button>
                    </form>
                </div>
                <?php
                        endif;
                    endif;
                endforeach;
                ?>
            </section>
        </main>
    <?php
        endif;
    endif;
    if($_POST['exibirUsu'] == "me" or $_POST['exibirUsu'] == "mom" or $_POST['exibirUsu'] == "dad"):
    ?>
        <footer class="principal">
            <h1 class="principal-lista">Pagas</h1>

            <?php
            if($_POST['exibirUsu'] == "me"):
            ?>
                <h2 class="usu">
                Me
                <?php
                $valorTot = 0;
                foreach($usuDao->read() as $v) {
                    if($v['pago'] == 's'):
                        if($v['usuario'] == 'me'):
                            $valorTot += $v['valor'];
                        endif;
                    endif;
                }
                echo "(".$valorTot." R$)";
                ?>
                </h2>
                <section class="usuario">
                    <div class="estatico">
                        <h2 class="estatico-item">Nome</h2>
                        <h2 class="estatico-item">Data</h2>
                        <h2 class="estatico-item">Valor</h2>
                    </div>
                    <?php
                    foreach ($usuDao->read() as $p):
                        if($p['usuario'] == 'me'):
                            if($p['pago'] == 's'):
                    ?>
                    <div class="sql">
                        <h3 class="sql-item"><?php echo $p['titulo']; ?></h3>
                        <h3 class="sql-item">
                        <?php
                            $data = DateTime::createFromFormat("Y-m-d", $p['data']);
                            echo $data->format("d/m/Y"); 
                        ?>
                        </h3>
                        <h3 class="sql-item"><?php echo $p['valor']; ?></h3>
                    </div>
                    <p class="descricao"><?php echo $p['descricao']; ?></p>
                    <div class="botaos">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <button name="btn-apagar" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Apagar</button>
                            <button  name="btn-mudar" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Mudar</button>
                        </form>
                    </div>
                    <?php
                            endif;
                        endif;
                    endforeach;
                    ?>
                </section>
            <?php
            elseif($_POST['exibirUsu'] == "dad"):
            ?>
                <h2 class="usu">
                Dad
                <?php
                $valorTot = 0;
                foreach($usuDao->read() as $v) {
                    if($v['pago'] == 's'):
                        if($v['usuario'] == 'dad'):
                            $valorTot += $v['valor'];
                        endif;
                    endif;
                }
                echo "(".$valorTot." R$)";
                ?>
                </h2>
                <section class="usuario">
                <div class="estatico">
                        <h2 class="estatico-item">Nome</h2>
                        <h2 class="estatico-item">Data</h2>
                        <h2 class="estatico-item">Valor</h2>
                    </div>
                    <?php
                    foreach ($usuDao->read() as $p):
                        if($p['usuario'] == 'dad'):
                            if($p['pago'] == 's'):
                    ?>
                    <div class="sql">
                        <h3 class="sql-item"><?php echo $p['titulo']; ?></h3>
                        <h3 class="sql-item">
                        <?php
                            $data = DateTime::createFromFormat("Y-m-d", $p['data']);
                            echo $data->format("d/m/Y"); 
                        ?>
                        </h3>
                        <h3 class="sql-item"><?php echo $p['valor']; ?></h3>
                    </div>
                    <p class="descricao"><?php echo $p['descricao']; ?></p>
                    <div class="botaos">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <button name="btn-apagar" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Apagar</button>
                            <button  name="btn-mudar" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Mudar</button>
                        </form>
                    </div>
                    <?php
                            endif;
                        endif;
                    endforeach;
                    ?>
                </section>
            <?php
            else:
            ?>
                <h2 class="usu">
                Mom
                <?php
                $valorTot = 0;
                foreach($usuDao->read() as $v) {
                    if($v['pago'] == 's'):
                        if($v['usuario'] == 'mom'):
                            $valorTot += $v['valor'];
                        endif;
                    endif;
                }
                echo "(".$valorTot." R$)";
                ?>
                </h2>
                <section class="usuario">
                    <div class="estatico">
                        <h2 class="estatico-item">Nome</h2>
                        <h2 class="estatico-item">Data</h2>
                        <h2 class="estatico-item">Valor</h2>
                    </div>
                    <?php
                    foreach ($usuDao->read() as $p):
                        if($p['usuario'] == 'mom'):
                            if($p['pago'] == 's'):
                    ?>
                    <div class="sql">
                        <h3 class="sql-item"><?php echo $p['titulo']; ?></h3>
                        <h3 class="sql-item">
                        <?php
                            $data = DateTime::createFromFormat("Y-m-d", $p['data']);
                            echo $data->format("d/m/Y"); 
                        ?>
                        </h3>
                        <h3 class="sql-item"><?php echo $p['valor']; ?></h3>
                    </div>
                    <p class="descricao"><?php echo $p['descricao']; ?></p>
                    <div class="botaos">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <button name="btn-apagar" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Apagar</button>
                            <button  name="btn-mudar" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Mudar</button>
                        </form>
                    </div>
                    <?php
                            endif;
                        endif;
                    endforeach;
                    ?>
                </section>
            <?php
            endif;
            ?>
        </footer>
    <?php
    endif;
    ?>
</body>
</html>