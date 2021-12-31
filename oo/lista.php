<?php
require_once 'conn/usuario.php';
require_once 'conn/usuarioDao.php';
require_once 'conn/conexão.php';

$usu = new conn\Produto();
$usuDao = new conn\ProdutoDao();

if(!isset($_POST['exibirUsu'])):
	$_POST['exibirUsu'] = "all";
endif;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
    <link rel="stylesheet" type="text/css" href="lista.css">
</head>
<body>
    <header class="cabecalho">
		<a href="index.php" class="cabecalho-kaka">Kaká</a>
		<nav class="cabecalho-menu">
			<a href="pagas.php" class="cabecalho-menu-item">Contas Pagas</a>
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
            <h1 class="principal-lista">Lista</h1>
            <h2 class="usu">
            Me
            <?php
            $valorTot = 0;
            foreach($usuDao->read() as $v) {
                if($v['pago'] == 'n'):
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
                        if($p['pago'] == 'n'):
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
                    <form action="action/edit.php" method="POST">
                        <button name="btn-pagou" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Pago</button>
                        <button  name="btn-editar" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Editar</button>
                        <input type="hidden" name="usuario" value="me">
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
                if($v['pago'] == 'n'):
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
                        if($p['pago'] == 'n'):
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
                    <form action="action/edit.php" method="POST">
                        <button name="btn-pagou" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Pago</button>
                        <button  name="btn-editar" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Editar</button>
                        <input type="hidden" name="usuario" value="dad">
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
                if($v['pago'] == 'n'):
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
                        if($p['pago'] == 'n'):
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
                    <form action="action/edit.php" method="POST">
                        <button name="btn-pagou" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Pago</button>
                        <button  name="btn-editar" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Editar</button>
                        <input type="hidden" name="usuario" value="mom">
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
            <h1 class="principal-lista">Lista</h1>

            <?php
            if($_POST['exibirUsu'] == "me"):
            ?>
                <h2 class="usu">
                Me
                <?php
                $valorTot = 0;
                foreach($usuDao->read() as $v) {
                    if($v['pago'] == 'n'):
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
                            if($p['pago'] == 'n'):
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
                        <form action="action/edit.php" method="POST">
                            <button name="btn-pagou" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Pago</button>
                            <button  name="btn-editar" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Editar</button>
                            <input type="hidden" name="usuario" value="me">
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
                    if($v['pago'] == 'n'):
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
                            if($p['pago'] == 'n'):
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
                        <form action="action/edit.php" method="POST">
                            <button name="btn-pagou" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Pago</button>
                            <button  name="btn-editar" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Editar</button>
                            <input type="hidden" name="usuario" value="dad">
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
                    if($v['pago'] == 'n'):
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
                            if($p['pago'] == 'n'):
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
                        <form action="action/edit.php" method="POST">
                            <button name="btn-pagou" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Pago</button>
                            <button  name="btn-editar" type="submit" value="<?php echo $p['id'] ?>" class="botaos-item">Editar</button>
                            <input type="hidden" name="usuario" value="mom">
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