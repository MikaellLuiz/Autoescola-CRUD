<?php
    include_once '../conexao.php';
    session_start();
    $conexao = new conexao();
    //variaveis para editar o cadastro do carro

    $resultado = (isset($_SESSION['resultadoAlunos'])) ? $_SESSION['resultadoAlunos'] : $conexao->executar("select * from alunos");

    
    $acao = (isset($_POST["acao"])) ? $_POST["acao"] : 1;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rota Certa - Cadastros</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <nav class="nav2">
        <a href="../home.php">Voltar</a>
        <p>Autoescola Rota Certa</p>
    </nav>
    <h1>Gerenciamento de Alunos</h1>   
    <section>
        <form action="../processaAlunos.php" method="post" class="registersSearch" autocomplete="off">
            <input type="text" name="nome" id="nome" placeholder="nome">
            <input type="text" name="cpf" id="cpf" placeholder="cpf">
            <input type="text" name="nasc" id="nasc" placeholder="Data de Nascimento">
            <input type="hidden" name="acao" value="4">
            <input type="submit" value="Pesquisar">
        </form> 
        <form action="../processaAlunos.php" method="post">
            <input type="hidden" name="acao" value="5">
            <input type="submit" value="Remover Pesquisa" id="removerpesquisa">
        </form>       
    </section>
    <section class="showRegisters">   
        <div class="rotulos">
            <table class="table">
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Nascimento</th>
                    <th></th> 
                    <th></th> 
                </tr>
            </table>
        </div> 
        <table>
            <?php
            if (empty($resultado)) {
                echo '<tr><td colspan="6">Não há alunos cadastrados.</td></tr>';
            } else {foreach($resultado as $v){
            ?>
            <tr>
                <?php
                    echo "<td>" . $v["nome"] . "</td>";
                    echo "<td>" . $v["cpf"] . "</td>";
                    echo "<td>" . $v["data_nascimento"] . "</td>";
                ?>
                <td class="button">
                    <form action="../editAluno.php" method="post">
                        <input type="hidden" name="id" value="<?=$v['id']?>">
                        <input type="hidden" name="nome" value="<?= $v['nome'] ?>">
                        <input type="hidden" name="cpf" value="<?= $v['cpf'] ?>">
                        <input type="hidden" name="nasc" value="<?= $v['data_nascimento'] ?>">
                        <input type="hidden" name="endereco" value="<?= $v['endereco']?>">
                        <input type="hidden" name="telefone" value="<?= $v['telefone'] ?>">
                        <button>Editar</button>
                </form>
                </td>
                <td>
                    <button class="btnRemoverAluno" data-aluno-id="<?= $v['id'] ?>">Remover</button>
                </td>
            </tr>
            <?php
            }}
            ?>
        </table>
    </section>
    
    <footer>
        <button id="btnAbrirSobreposicao">Cadastrar Aluno</button>
    </footer>
    <div class="sobreposicao" id="sobreposicao">
        <div class="sobreposicaoContainer">
            <form class="registersInclude" action="../processaAlunos.php" method="post">
                <div class="cadastrarAlunoDiv">
                    <h1>Pessoais</h1>
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome1" require>

                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf1" require>

                    <label for="nasc">Data de Nascimento</label>
                    <input type="date" name="nasc" id="nasc1" require>
                </div>
                <div class="cadastrarAlunoDiv">
                    <h1>Endereço e Contato</h1>
                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" id="endereco" require>

                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" id="telefone" require>
                </div>
                    <input type="hidden" name="acao" value="1">
                <div class="sobreposicaoBtns">
                    <input type="submit" value="Cadastrar">
                </div>
            </form>
            <button id="btnFecharSobreposicao">Cancelar</button>
        </div>
    </div>
    <script src="../scripts/script.js"></script>
</body>
</html>
