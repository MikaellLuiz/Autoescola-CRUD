<?php
    include_once '../conexao.php';
    session_start();
    $conexao = new conexao();
    //variaveis para editar o cadastro do carro

    $resultado = (isset($_SESSION['resultadoCarros'])) ? $_SESSION['resultadoCarros'] : $conexao->executar("select * from carros");
    var_dump($resultado);

    
    $acao = (isset($_POST["acao"])) ? $_POST["acao"] : 1;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rota Certa - Carros</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <nav class="nav2">
        <a href="../home.php">Voltar</a>
        <p>Autoescola Rota Certa</p>
    </nav> 
    <h1>Gerenciamento de Carros</h1>     
    <section>
        <form action="../processaCarros.php" method="post" class="carSearch" autocomplete="off">
            <input type="text" name="modelo" id="modelo" placeholder="Modelo">
            <input type="text" name="marca" id="marca" placeholder="Marca">
            <input type="text" name="ano" id="ano" placeholder="Ano">
            <input type="text" name="placa" id="placa" placeholder="Placa">
            <input type="text" name="capacidade" id="capacidade" placeholder="capacidade">
            <input type="hidden" name="acao" value="4">
            <input type="submit" value="Pesquisar">
        </form>        
        <form action="../processaCarros.php" method="post">
            <input type="hidden" name="acao" value="5">
            <input type="submit" value="Remover Pesquisa" id="removerpesquisa">
        </form>
    </section>
    <section class="showCars">    
        <div class="rotulos">
            <table>
                <tr>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Ano</th> 
                    <th>placa</th>
                    <th>Capacidade</th>
                    <th></th>
                    <th></th>
                </tr>
            </table>
        </div>    
        <table class="table">
            <?php
            if (empty($resultado)) {
                echo '<tr><td colspan="6">Não há carros cadastrados.</td></tr>';
            } else {
                foreach($resultado as $v){
            ?>
            <tr>
                <?php
                    echo "<td>" . $v["modelo"] . "</td>";
                    echo "<td>" . $v["marca"] . "</td>";
                    echo "<td>" . $v["ano"] . "</td>";
                    echo "<td>" . $v["placa"] . "</td>";
                    echo "<td>" . $v["capacidade_passageiros"] . "</td>";
                ?>
                <td class="button">
                    <form action="../editCarro.php" method="post">
                        <input type="hidden" name="modelo" value="<?=$v['modelo']?>">
                        <input type="hidden" name="marca" value="<?= $v['marca'] ?>">
                        <input type="hidden" name="ano" value="<?= $v['ano'] ?>">
                        <input type="hidden" name="placa" value="<?= $v['placa'] ?>">
                        <input type="hidden" name="capacidade" value="<?= $v['capacidade_passageiros']?>">
                        <input type="hidden" name="id" value="<?= $v['id'] ?>">
                        <button>Editar</button>
                </form>
                </td>
                <td>
                    <button class="btnRemoverCarro" data-car-id="<?= $v['id'] ?>">Remover</button>
                </td>
            </tr>
            <?php
            }}
            ?>
        </table>
    </section>
    <footer>
        <button id="btnAbrirSobreposicao">Cadastrar Carro</button>
    </footer>
    <div class="sobreposicao" id="sobreposicao">
        <div class="sobreposicaoContainer">
            <form class="cadastrarCarroForm" action="../processaCarros.php" method="post" autocomplete="off">
                <div class="cadastrarCarro">
                    <h1>Cadastrar Carro</h1>
                    <div>
                        <input type="text" name="modelo" id="modelo1" placeholder="Modelo" require>
                        <input type="text" name="marca" id="marca1" placeholder="Marca" require>
                        <input type="text" name="ano" id="ano1" placeholder="ano" require>
                        <input type="text" name="placa" id="placa1" placeholder="placa" require>
                        <input type="text" name="capacidade" id="capacidade1" placeholder="capacidade" require>
                        <input type="hidden" name="id">
                        <input type="hidden" name="acao" value="1">
                    </div>
                </div>
                <div class="sobreposicaoBtns">
                    <input type="submit" value="Cadastrar">
                </div>
            </form>
            <button id="btnFecharSobreposicao">Cancelar</button>
        </div>
    </div>
    <script src="../scripts/alerts.js"></script>
    <script src="../scripts/script.js" ></script>
</body> 
</html>