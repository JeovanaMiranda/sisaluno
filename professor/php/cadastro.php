
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
        <img class="logo" src="../imgs/logo1.png" alt="">
        <h1>Cadastrar Professor</h1>
        
    </section>

    <section class="form">
        <form action="crud.php" method="post">
            <div class="campo1">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" class="input-dados" style="width: 300px" >
            </div>
            <div class="campo2">
                <div class="left"> 
                    <label for="idade">Idade:</label>
                    <input type="number" name="idade" style="width: 80px" class="input-dados">
                </div>
                <div class="rigth">
                    <label for="dataNascimento">Data de Nascimento:</label>
                    <input type="date" name="datanascimento"  style="width: 175px" class="input-dados" >
                </div>
            </div>
            <div class="campo1">
                <label for="nome">CPF:</label>
                <input type="text" name="cpf" class="input-dados" style="width: 300px" >
            </div>
            <div class="campo1">
                <label for="endereco">Endereço:</label>
                <input type="text" name="endereco" class="input-dados" style="width: 300px"  >
                <input type="hidden" name="id" id="" value="<?php echo $id ?>" >
            </div>
            <div class="campo1">
               
                    <input type="submit" value="Cadastrar" class="botoes-acao" name="salvar">
                
            </div>
            
        </form>
    </section>    
</main>
</body>
</html>