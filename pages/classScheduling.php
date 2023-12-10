<?php
    include_once '../conexao.php';
    session_start();
    $conexao = new conexao();
    //variaveis para editar o cadastro do carro

    $resultado = $conexao->executar("select * from agendamentos");
    $resultAlunos = $conexao->executar("select * from alunos");
    $resultCarros = $conexao->executar("select * from carros");

    
    $acao = (isset($_POST["acao"])) ? $_POST["acao"] : 1;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rota Certa - Agenda</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <nav class="nav2">
        <a href="../home.php">Voltar</a>
        <p>Autoescola Rota Certa</p>
    </nav>
    <h1>Agendamento de Aulas</h1> 
    <section class="showScheduling">  
    <div class="rotulos">
        <table>
            <tr>
                <th>Aluno</th>
                <th>Modelo</th>
                <th>Placa</th> 
                <th>Data</th>
                <th>Hora</th>
                <th></th>
            </tr>
        </table>
    </div>      
    <table class="table">
        <?php
            // Verifica se há resultados
            if (empty($resultado)) {
                echo '<tr><td colspan="6">Não há aulas marcadas.</td></tr>';
            } else {
                foreach($resultado as $v) {
                    $alunoInfo = $conexao->executar("SELECT * FROM alunos WHERE id = {$v['aluno_id']}");
                    $carroInfo = $conexao->executar("SELECT * FROM carros WHERE id = {$v['carro_id']}");
                    $nomeAluno = $alunoInfo[0]["nome"];
                    $modeloCarro = $carroInfo[0]["modelo"];
                    $placaCarro = $carroInfo[0]["placa"];

                    echo "<tr>";
                    echo "<td>" . $nomeAluno . "</td>";
                    echo "<td>" . $modeloCarro . "</td>";
                    echo "<td>" . $placaCarro . "</td>";
                    echo "<td>" . $v["data_aula"] . "</td>";
                    echo "<td>" . $v["horario_aula"] . "</td>";
                    echo "<td><button class='btnRemoverAula' data-agenda-id='{$v['id']}'>Remover</button></td>";
                    echo "</tr>";
                }
            }
        ?>
    </table>
</section>

    
    <footer>
        <button id="btnAbrirSobreposicao">Agendar Horário</button>
    </footer>
    <div class="sobreposicao" id="sobreposicao">
        <div class="sobreposicaoContainer">
            <form class="agendamento" action="../processaAgendamento.php" method="post" autocomplete="off">
                <div class="agendamentoDiv">
                    <h1>Agendar Horários</h1>
                    <select name="aluno_id" id="aluno_id" required>
                        <option value="">Selecione um aluno</option>
                        <?php
                        foreach ($resultAlunos as $aluno) {
                            echo '<option value="' . $aluno['id'] . '">' . $aluno['nome'] . '</option>';
                        }
                        ?>
                    </select>
                    <select name="carro_id" id="carro_id" required>
                        <option value="">Selecione um carro</option>
                        <?php
                        foreach ($resultCarros as $carro) {
                            echo '<option value="' . $carro['id'] . '">' . $carro['modelo'] . ' - ' . $carro['placa'] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="date" name="data_aula" id="data_aula" placeholder="Data Nascimento" required>
                    <input type="time" name="horario_aula" id="horario_aula" placeholder="Endereco" required>
                    <input type="hidden" name="acao" value="1">
                </div>
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