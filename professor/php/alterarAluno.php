<?php
    require_once('conexao.php');

    $id = $_POST['id'];

    ##sql para selecionar apens um aluno
    $sql = "SELECT * FROM Professor where id= :id";
   
    # junta o sql a conexao do banco
    $retorno = $conexao->prepare($sql);

    ##diz o paramentro e o tipo  do paramentros
    $retorno->bindParam(':id',$id, PDO::PARAM_INT);

    #executa a estrutura no banco
    $retorno->execute();

    #transforma o retorno em array
    $array_retorno=$retorno->fetch();
   
    ##armazena retorno em variaveis
    $nome = $array_retorno['nome'];
    $idade = $array_retorno['idade'];
    $datanascimento = $array_retorno['datanascimento'];
    $endereco = $array_retorno['endereco'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Escolar</title>
    <link rel="stylesheet" href="../style/cad-alt.css">
</head>
<body>

<main>
    <section class="titulo">
        <img class="logo"src="../imgs/logo1.png" alt="Escola">
        <h1>Atualizar Dados</h1>
    </section>

    <section class="form">
        <form action="crud.php" method="post">
            <div class="campo1">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" class="input-dados" style="width: 300px" value="<?php echo $nome ?>">
            </div>
            <div class="campo2">
                <div class="left"> 
                    <label for="idade">Idade:</label>
                    <input type="number" name="idade" class="input-dados" style="width: 80px" value="<?php echo $idade ?>">
                </div>
                <div class="rigth">
                    <label for="dataNascimento">Data de Nascimento:</label>
                    <input type="date" name="datanascimento" class="input-dados" style="width: 175px" value="<?php echo $dataNascimento ?>"  >
                </div>
            </div>
            <div class="campo1">
                <label for="endereco">Endereço:</label>
                <input type="text" name="endereco" class="input-dados" style="width: 300px" value="<?php echo $endereco ?>">
                <input type="hidden" name="id" id="" value="<?php echo $id ?>" >
            </div>
            <div class="campo1">
                <a href="exibir.php">
                    <input type="submit" value="Alterar" class="botoes-acao" name="update">
                </a>
                <?php         
                  echo "<button class='botoes-acao' id='cancelar'><a href='exibir.php'>voltar</a></button>";
                ?>
            </div>
        </form>
    </section>    
</main>
</body>
</html>