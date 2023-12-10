<?php
    include_once "conexao.php";

    $conexao = new conexao();

    $idDel = (isset($_GET["id"])) ? $_GET["id"] : null;
    $acaoDel = (isset($_GET["acao"])) ? $_GET["acao"] : null;
    $id = (isset($_POST["id"])) ? $_POST["id"] : null;
    $modelo = (isset($_POST["modelo"])) ? $_POST["modelo"] : null;
    $marca = (isset($_POST["marca"])) ? $_POST["marca"] : null;
    $placa = (isset($_POST["placa"])) ? $_POST["placa"] : null;
    $ano = (isset($_POST["ano"])) ? $_POST["ano"] : null;
    $capacidade = (isset($_POST["capacidade"])) ? $_POST["capacidade"] : null;
    $acao = (isset($_POST["acao"])) ? $_POST["acao"] : null;

    //cadastrar carro
    if($acao==1){
        try{
            $sqlCommand = "insert into carros (marca, modelo, ano, placa, capacidade_passageiros) values('$marca','$modelo','$ano', '$placa', '$capacidade')"; 
            $conexao -> executar($sqlCommand);
            //alerta de sucesso
            echo '<script src="scripts/alerts.js"></script>';
            echo '<script>carroCadastradoSucesso();</script>';
        }catch(PDOException $e){
            echo $e;
        }
    }
    //editar carro
    if($acao==2){
        try{
            $sqlCommand = "update carros set marca='$marca', modelo='$modelo', ano='$ano', placa='$placa', capacidade_passageiros='$capacidade' where id=$id";
            $conexao -> executar($sqlCommand);
            echo '<script src="scripts/alerts.js"></script>';
            echo '<script>carroEditadoSucesso();</script>';
        }catch(PDOException $e){
            echo $e;
        }
    }

    if($acaoDel==3){
        $sqlCommand = "delete from agendamentos where carro_id=$idDel";
        $conexao -> executar($sqlCommand);
        $sqlCommand = "delete from carros where id=$idDel";
        $conexao -> executar($sqlCommand);
        header("location: pages/carManagement.php");
    }
    if($acao==4){
        try {
            include_once '../conexao.php';
            $conexao = new conexao();

            $sqlCommand = "SELECT * FROM carros";
        
            if (!empty($modelo)) {
                $sqlCommand .= " WHERE modelo LIKE '%$modelo%'";
            }
        
            if (!empty($marca)) {
                $sqlCommand .= (empty($modelo)) ? " WHERE" : " AND";
                $sqlCommand .= " marca LIKE '%$marca%'";
            }
        
            if (!empty($ano)) {
                $sqlCommand .= (empty($modelo) && empty($marca)) ? " WHERE" : " AND";
                $sqlCommand .= " ano LIKE '%$ano%'";
            }
        
            if (!empty($placa)) {
                $sqlCommand .= (empty($modelo) && empty($marca) && empty($ano)) ? " WHERE" : " AND";
                $sqlCommand .= " placa LIKE '%$placa%'";
            }
        
            if (!empty($capacidade)) {
                $sqlCommand .= (empty($modelo) && empty($marca) && empty($ano) && empty($placa)) ? " WHERE" : " AND";
                $sqlCommand .= " capacidade_passageiros LIKE '%$capacidade%'";
            }
        
            $stmt = $conexao->getPdo()->prepare($sqlCommand);
            $stmt->execute();
            session_start();
            $_SESSION['resultadoCarros'] = $stmt->fetchAll();

            header("location: pages/carManagement.php");
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }

    }
    if($acao==5){
        session_start();
        $_SESSION['resultado'] = null;
        header("location: pages/carManagement.php");
    }

?>
