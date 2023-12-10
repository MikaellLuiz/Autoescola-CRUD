<?php
    include_once 'conexao.php';
    $conexao = new conexao();

    $id = (isset($_POST["id"])) ? $_POST["id"] : null;
    $nome = (isset($_POST["nome"])) ? $_POST["nome"] : null;
    $cpf = (isset($_POST["cpf"])) ? $_POST["cpf"] : null;
    $nasc = (isset($_POST["nasc"])) ? $_POST["nasc"] : null;
    $endereco = (isset($_POST["endereco"])) ? $_POST["endereco"] : null;
    $telefone = (isset($_POST["telefone"])) ? $_POST["telefone"] : null;
    $acao = (isset($_POST["acao"])) ? $_POST["acao"] : null;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Carro</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <nav class="nav2">
        <a href="pages/registers.php">Voltar</a>
        <p>Autoescola Rota Certa</p>
    </nav>
    <div class="editarFormContainer">
        <form clas="editarAlunoform" action="processaAlunos.php" method="post" style="display: inline;" autocomplete="off">
            <div class="cadastrarAlunoDiv">
                <h1>Editar Carro</h1>
                    <div>
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" placeholder="nome" value="<?=$nome?>">
                    </div>
                    <div>
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" placeholder="cpf" value="<?=$cpf?>">
                    </div>
                    <div>
                    <label for="nasc">Data de Nascimento</label>
                    <input type="date" name="nasc" placeholder="nasc" value="<?=$nasc?>">
                </div>
            </div>
            <div class="cadastrarAlunoDiv">
                <h1>Endereco e Contto</h1>
                <div>
                    <label for="endereco">Endereco</label>
                    <input type="text" name="endereco" placeholder="endereco" value="<?=$endereco?>">
                    </div>
                    <div>
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" placeholder="telefone" value="<?=$telefone?>">
                </div>
            </div>  
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="hidden" name="acao" value="2">
            <input type="submit" value="Editar" id="editar">
        </form>
    </div>
</body>
</html>