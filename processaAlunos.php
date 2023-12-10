<?php
    include_once "conexao.php";

    $conexao = new conexao();

    $idDel = (isset($_GET["id"])) ? $_GET["id"] : null;
    $acaoDel = (isset($_GET["acao"])) ? $_GET["acao"] : null;

    $id = (isset($_POST["id"])) ? $_POST["id"] : null;
    $nome = (isset($_POST["nome"])) ? $_POST["nome"] : null;
    $cpf = (isset($_POST["cpf"])) ? $_POST["cpf"] : null;
    $data_nasc = (isset($_POST["nasc"])) ? $_POST["nasc"] : null;
    $endereco = (isset($_POST["endereco"])) ? $_POST["endereco"] : null;
    $telefone = (isset($_POST["telefone"])) ? $_POST["telefone"] : null;
    $acao = (isset($_POST["acao"])) ? $_POST["acao"] : null;
    
    //Cadastrar Aluno
    if($acao==1){
        try{
            $sqlCommand = "insert into alunos (nome, cpf, data_nascimento, endereco, telefone) values('$nome','$cpf','$data_nasc', '$endereco', '$telefone')"; 
            $conexao -> executar($sqlCommand);
            //alerta de sucesso
            echo '<script src="scripts/alerts.js"></script>';
            echo '<script>alunoCadastradoSucesso();</script>';
        }catch(PDOException $e){
            echo $e;
        }
    }
     //Editar Aluno
     if($acao==2){
        try{
            $sqlCommand = "update alunos set nome='$nome', cpf='$cpf', data_nascimento='$data_nasc', endereco='$endereco', telefone='$telefone' where id=$id";
            $conexao -> executar($sqlCommand);
            echo '<script src="scripts/alerts.js"></script>';
            echo '<script>alunoEditadoSucesso();</script>';
        }catch(PDOException $e){
            echo $e;
        }
    }
    //Apagar Aluno
    if($acaoDel==3){
        $sqlCommand = "delete from agendamentos where aluno_id=$idDel";
        $conexao -> executar($sqlCommand);
        $sqlCommand = "delete from alunos where id=$idDel";
        $conexao -> executar($sqlCommand);
        header("location: pages/registers.php");
    }
    //Pesquisar Aluno
    if ($acao == 4) {
        try {
            include_once '../conexao.php';
            $conexao = new conexao();
    
            $sqlCommand = "SELECT * FROM alunos";
    
            if (!empty($nome)) {
                $sqlCommand .= " WHERE nome LIKE '%$nome%'";
            }
    
            if (!empty($cpf)) {
                $sqlCommand .= (empty($nome)) ? " WHERE" : " AND";
                $sqlCommand .= " cpf LIKE '%$cpf%'";
            }
    
            if (!empty($data_nasc)) {
                $sqlCommand .= (empty($nome) && empty($cpf)) ? " WHERE" : " AND";
                $sqlCommand .= " data_nascimento LIKE '%$data_nasc%'";
            }
    
            if (!empty($endereco)) {
                $sqlCommand .= (empty($nome) && empty($cpf) && empty($data_nasc)) ? " WHERE" : " AND";
                $sqlCommand .= " endereco LIKE '%$endereco%'";
            }
    
            if (!empty($telefone)) {
                $sqlCommand .= (empty($nome) && empty($cpf) && empty($data_nasc) && empty($endereco)) ? " WHERE" : " AND";
                $sqlCommand .= " telefone LIKE '%$telefone%'";
            }
    
            $stmt = $conexao->getPdo()->prepare($sqlCommand);
            $stmt->execute();
            session_start();
            $_SESSION['resultadoAlunos'] = $stmt->fetchAll();
    
            header("location: pages/registers.php");
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
    //Limpar Pesquisa
    if($acao==5){
        session_start();
        $_SESSION['resultado'] = null;
        header("location: pages/registers.php");
    }

?>

   
