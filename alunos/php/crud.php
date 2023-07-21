<?php

require_once('conexao.php');

// Cadastrar
if (isset($_POST['salvar'])) {
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $dataNascimento = $_POST["dataNascimento"];
    $endereco = $_POST["endereco"];

    // Verificar se os campos não estão vazios 
    if (empty($nome) || empty($idade) || empty($dataNascimento) || empty($endereco)) {
        echo '<script>alert("Por favor, preencha todos os campos!"); window.location.href = "cadastro.php";</script>';
    } 
   
    $dataAtual = new DateTime(); //guarda data atual
    $dataNiver = new DateTime($dataNascimento); //guarda a data de nascimento do form
    $idadeCalculada = $dataNiver->diff($dataAtual)->y; //guarda a diferença entre as duas datas

    //verifica se a data de nascimento e a idade batem
    if ($idade != $idadeCalculada) {
        echo '<script>alert("A idade informada não corresponde à data de nascimento!"); window.location.href = "cadastro.php";</script>';
    }
    //verifica se é maior que 16 anos
    elseif($idade < 16){
        echo '<script>alert("Idade Inválida"); window.location.href = "cadastro.php";</script>';
    }
    else {
        $sql = "INSERT INTO Alunos (nome, idade, dataNascimento, endereco) 
                VALUES (:nome, :idade, :dataNascimento, :endereco)";

        // Preparar a consulta
        $stmt = $conexao->prepare($sql);

        // Vincular parâmetros aos valores
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':dataNascimento', $dataNascimento);
        $stmt->bindParam(':endereco', $endereco);

        // Executar a consulta
        if ($stmt->execute()) {
            echo '<script>alert("Aluno cadastrado com sucesso!"); window.location.href = "exibir.php";</script>';
        } else {
            echo "Ocorreu um erro ao cadastrar o aluno.";
        }
    }
}

if(isset($_POST['update'])){

    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $dataNascimento = $_POST["dataNascimento"];
    $endereco = $_POST["endereco"];
    $id = $_POST["id"];
   
    // Verificar se os campos não estão vazios 
    if (empty($nome) || empty($idade) || empty($dataNascimento) || empty($endereco)) {
        echo '<script>alert("Por favor, preencha todos os campos!"); window.location.href = "cadastro.php";</script>';
    } 
   
    $dataAtual = new DateTime(); //guarda data atual
    $dataNiver = new DateTime($dataNascimento); //guarda a data de nascimento do form
    $idadeCalculada = $dataNiver->diff($dataAtual)->y; //guarda a diferença entre as duas datas

    //verifica se a data de nascimento e a idade batem
    if ($idade != $idadeCalculada) {
        echo '<script>alert("A idade informada não corresponde à data de nascimento!"); window.location.href = "cadastro.php";</script>';
    }
    //verifica se é maior que 16 anos
    elseif($idade < 16){
        echo '<script>alert("Idade Inválida"); window.location.href = "cadastro.php";</script>';
    }
   
   else{
        $sql = "UPDATE  Alunos SET nome= :nome, idade= :idade, dataNascimento= :dataNascimento, endereco= :endereco WHERE id= :id ";
   
        ##junta o codigo sql a conexao do banco
        $stmt = $conexao->prepare($sql);

        ##diz o paramentro e o tipo  do paramentros
        $stmt->bindParam(':id',$id, PDO::PARAM_INT);
        $stmt->bindParam(':nome',$nome, PDO::PARAM_STR);
        $stmt->bindParam(':idade',$idade, PDO::PARAM_INT);
        $stmt->bindParam(':dataNascimento',$dataNascimento, PDO::PARAM_STR);
        $stmt->bindParam(':endereco',$endereco, PDO::PARAM_STR);
        $stmt->execute();
 
        if($stmt->execute())
        {
            echo '<script>alert("Dados alterados com sucesso!"); window.location.href = "exibir.php";</script>';
        }
    }
}        


##Excluir
if(isset($_GET['excluir'])){
    $id = $_GET['id'];
    $sql ="DELETE FROM Alunos WHERE id={$id}";
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    if($stmt->execute())
        {
            echo '<script>alert("Aluno excluido com sucesso!"); window.location.href = "exibir.php";</script>';
        }
    else{
        echo '<script>alert("Erro ao excluir aluno")</script>';
    }

    
}

        
?>

