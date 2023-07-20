<?php 

require_once('conexao.php');
   
$retorno = $conexao->prepare('SELECT * FROM Alunos');
$retorno->execute();

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Escolar</title>
    <link rel="stylesheet" href="../style/exibir.css">
    <script>
        function confirmarExclusao() {
        return confirm("Tem certeza que deseja excluir este aluno?");
        }
    </script>
</head>
<body>
<aside>
    <figure>
        <img  src="../imgs/logo1.png" alt="logo if" class="img_logo">
    </figure>
    <section class="topicos">
        <p><strong>Alunos</strong></p>
        <p>Matérias</p>
        <p>Professores</p>    
    </section>
</aside>
<main>
   <div class="titulo">
        <h1>Alunos Cadastrados</h1>
   </div> 
    <div class="tabela">
        <table> 
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>Data de Nascimento</th>
                    <th>Endereço</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach($retorno->fetchall() as $value) { ?>
                <tr>
                    <td> <?php echo $value['nome']?>  </td> 
                    <td> <?php echo $value['idade']?> </td> 
                    <td> <?php echo $value['dataNascimento']?> </td> 
                    <td> <?php echo $value['endereco']?> </td> 

                    <td>
                        <form method="POST" action="alterarAluno.php">
                            <input name="id" type="hidden" value="<?php echo $value['id'];?>"/>
                            <button name="alterar" class="botoes-acao" id="alterar" type="submit">Alterar</button>
                        </form>
                    </td> 

                    <td>
                        <form method="GET" action="crud.php">
                            <input name="id" type="hidden" value="<?php echo $value['id'];?>"/>
                            <button name="excluir" class="botoes-acao" id="excluir" type="submit" onclick="return confirmarExclusao();">Excluir</button>
                        </form>
                    </td> 

                </tr>
                    <?php  }  ?> 
                </tr>
            </tbody>
        </table>
    </div>  
    <div class="botoes">
        <form method="POST" action="cadastro.php">
            <button name="excluir" class="botoes-acao"  type="submit">Cadastrar novo aluno</button>
        </form>
    </div>
</main>

</body>
</html> 
