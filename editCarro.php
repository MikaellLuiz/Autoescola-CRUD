<?php
    include_once 'conexao.php';
    $conexao = new conexao();

    $id = (isset($_POST["id"])) ? $_POST["id"] : null;
    $modelo = (isset($_POST["modelo"])) ? $_POST["modelo"] : null;
    $marca = (isset($_POST["marca"])) ? $_POST["marca"] : null;
    $placa = (isset($_POST["placa"])) ? $_POST["placa"] : null;
    $ano = (isset($_POST["ano"])) ? $_POST["ano"] : null;
    $capacidade = (isset($_POST["capacidade"])) ? $_POST["capacidade"] : null;

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
        <a href="pages/carManagement.php">Voltar</a>
        <p>Autoescola Rota Certa</p>
    </nav>
    <div class="editarFormContainer">
        <form clas="editarCarroform" action="processaCarros.php" method="post" style="display: inline;">
            <h1>Editar Carro</h1>
            <div class="cadastrarCarro">
                <div>
                <label for="modelo">Modelo</label>
                <input type="text" name="modelo" placeholder="Modelo" value="<?=$modelo?>">
                </div>
                <div>
                <label for="marca">Marca</label>
                <input type="text" name="marca" placeholder="Marca" value="<?=$marca?>">
                </div>
                <div>
                <label for="ano">Ano</label>
                <input type="text" name="ano" placeholder="ano" value="<?=$ano?>">
                </div>
                <div>
                <label for="placa">Placa</label>
                <input type="text" name="placa" placeholder="placa" value="<?=$placa?>">
                </div>
                <div>
                <label for="capacidade">Capacidade</label>
                <input type="text" name="capacidade" placeholder="capacidade" value="<?=$capacidade?>">
                </div>
                <input type="hidden" name="id" value="<?=$id?>">
                <input type="hidden" name="acao" value="2">
            </div>
            <input type="submit" value="Editar" id="editar">
        </form>
    </div>
    <script src="scripts/script.js"></script>
</body>
</html>