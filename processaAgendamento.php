<?php
    include_once "conexao.php";

    $conexao = new conexao();

    $idDel = (isset($_GET["id"])) ? $_GET["id"] : null;
    $acaoDel = (isset($_GET["acao"])) ? $_GET["acao"] : null;

    $id = (isset($_POST["id"])) ? $_POST["id"] : null;
    $aluno_id = (isset($_POST["aluno_id"])) ? $_POST["aluno_id"] : null;
    $carro_id = (isset($_POST["carro_id"])) ? $_POST["carro_id"] : null;
    $data_aula = (isset($_POST["data_aula"])) ? $_POST["data_aula"] : null;
    $horario_aula = (isset($_POST["horario_aula"])) ? $_POST["horario_aula"] : null;
    $acao = (isset($_POST["acao"])) ? $_POST["acao"] : null;
    
    //Agendar Aula
    if($acao==1){
        try{
            $sqlCommand = "insert into agendamentos (aluno_id, carro_id, data_aula, horario_aula) values('$aluno_id','$carro_id','$data_aula', '$horario_aula')"; 
            $conexao -> executar($sqlCommand);
            //alerta de sucesso
            echo '<script src="scripts/alerts.js"></script>';
            echo '<script>aulaAgendadaSucesso();</script>';
        }catch(PDOException $e){
            echo $e;
        }
    }
    //Apagar Aula
    if($acaoDel==3){
        $sqlCommand = "delete from agendamentos where id=$idDel";
        $conexao -> executar($sqlCommand);
        header("location: pages/classScheduling.php");
    }

?>

   
