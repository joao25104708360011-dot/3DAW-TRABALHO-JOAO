<?php
    $msg = "";
    $aluno = null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
        $mat = $_POST["mat"];
    
        if(file_exists("alunos.txt")){
            $arqConsul = fopen("alunos.txt","r") or die("erro ao abrir arquivo");

            $cabeçalho = fgets($arqConsul);

            while(!feof($arqConsul)) {
                $linha = fgets($arqConsul);
                $colunaDados = explode(";", $linha);

                if($colunaDados[0] == $mat){
                    $aluno = $colunaDados;
                    break;
                }
            }

            fclose($arqConsul);
            $msg = "Deu tudo certo!!!";
        } else {
            $msg = "ERRO: Aluno não encontrado.";
        }
    } 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Aluno</title>
    <style>
        table, th, td{
            border: 2px solid black; 
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Consultar Aluno</h1>
    <hr>
    <form action="ConsultarAluno.php" method="POST">
        <label for="mat">Digite a Matricula do aluno:</label>
        <input type="text" id="mat" name="mat" required>
        <input type="submit" value="Consultar">
    </form>
    <hr>
<p><?php echo $msg; ?></p>
<?php if ($aluno): ?>
    <table>
        <tr>
            <th>Matrícula</th>
            <th>Nome</th>
            <th>Email</th>
        </tr>
        <tr>
            <td><?php echo $aluno[0]; ?></td>
            <td><?php echo $aluno[1]; ?></td>
            <td><?php echo $aluno[2]; ?></td>
        </tr>
    </table>
<?php endif; ?>

<br>
</body>
</html>
