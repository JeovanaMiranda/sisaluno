<?php

require_once('conexao.php');

// Cadastrar
if (isset($_POST['salvar'])) {
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $datanascimento = $_POST["datanascimento"];
    $cpf = $_POST["cpf"];
    $endereco = $_POST["endereco"];

    // Verificar se os campos não estão vazios 
    if (empty($nome) || empty($idade) || empty($datanascimento) || empty($endereco) || empty($cpf)) {
        echo '<script>alert("Por favor, preencha todos os campos!"); window.location.href = "cadastro.php";</script>';
    } 
    //validação de idade
    $dataAtual = new DateTime(); //guarda data atual
    $dataNiver = new DateTime($datanascimento); //guarda a data de nascimento do form
    $idadeCalculada = $dataNiver->diff($dataAtual)->y; //guarda a diferença entre as duas datas

    //verifica se a data de nascimento e a idade batem
    if ($idade != $idadeCalculada) {
        echo '<script>alert("A idade informada não corresponde à data de nascimento!"); window.location.href = "cadastro.php";</script>';
    }
    //verifica se a idade é válida
    elseif($idade < 18 || $idade < 0 || $idade > 120){
        echo '<script>alert("Idade Inválida"); window.location.href = "cadastro.php";</script>';
    }
    else {
        $sql = "INSERT INTO Professor (nome, cpf, idade, datanascimento, endereco) 
                VALUES (:nome,  :cpf, :idade, :datanascimento, :endereco)";

        // Preparar a consulta
        $stmt = $conexao->prepare($sql);

        // Vincular parâmetros aos valores
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':datanascimento', $datanascimento);
        $stmt->bindParam(':endereco', $endereco);

        // Executar a consulta
        if ($stmt->execute()) {
            echo '<script>alert("Professor cadastrado com sucesso!"); window.location.href = "exibir.php";</script>';
        } else {
            echo "Ocorreu um erro ao cadastrar o aluno.";
        }
    }
}

if(isset($_POST['update'])){

    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $datanascimento = $_POST["datanascimento"];
    $cpf = $_POST["cpf"];
    $endereco = $_POST["endereco"];
    $id = $_POST["id"];
   
    // Verificar se os campos não estão vazios 
    if (empty($nome) || empty($idade) || empty($datanascimento) || empty($endereco) || empty($cpf)) {
        echo '<script>alert("Por favor, preencha todos os campos!"); window.location.href = "cadastro.php";</script>';
    } 
   
    $dataAtual = new DateTime(); //guarda data atual
    $dataNiver = new DateTime($datanascimento); //guarda a data de nascimento do form
    $idadeCalculada = $dataNiver->diff($dataAtual)->y; //guarda a diferença entre as duas datas

    //verifica se a data de nascimento e a idade batem
    if ($idade != $idadeCalculada) {
        echo '<script>alert("A idade informada não corresponde à data de nascimento!"); window.location.href = "cadastro.php";</script>';
    }
    //verifica se é maior que 16 anos
    elseif($idade < 18 || $idade < 0 || $idade > 120){
        echo '<script>alert("Idade Inválida"); window.location.href = "cadastro.php";</script>';
    }
   
   else{
        $sql = "UPDATE  Professor SET nome= :nome, idade= :idade, datanascimento= :datanascimento, cpf= :cpf, endereco= :endereco WHERE id= :id ";
   
        ##junta o codigo sql a conexao do banco
        $stmt = $conexao->prepare($sql);

        ##diz o paramentro e o tipo  do paramentros
        $stmt->bindParam(':id',$id, PDO::PARAM_INT);
        $stmt->bindParam(':nome',$nome, PDO::PARAM_STR);
        $stmt->bindParam(':idade',$idade, PDO::PARAM_INT);
        $stmt->bindParam(':datanascimento',$datanascimento, PDO::PARAM_STR);
        $stmt->bindParam(':cpf',$cpf, PDO::PARAM_STR);
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
    $sql ="DELETE FROM Professor WHERE id={$id}";
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    if($stmt->execute())
        {
            echo '<script>alert("Professor excluido com sucesso!"); window.location.href = "exibir.php";</script>';
        }
    else{
        echo '<script>alert("Erro ao excluir Professor")</script>';
    }

    
}

        
?>

