<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Alunos</title>
    <style>
        table, th, td{
            border: 2px solid black; 
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Listar Alunos</h1>
    <hr>
    <table>
        <tr><th>Matricula</th><th>Nome</th><th>Email</th></tr>
        <?php

        if(file_exists("alunos.txt")){
        $arqAluno = fopen("alunos.txt","r") or die("erro ao abrir arquivo");

        $cabeçalho = fgets($arqAluno);

        while(!feof($arqAluno)) {
            $linha = fgets($arqAluno);
            $colunaDados = explode(";", $linha);


            echo "<tr><td>" . $colunaDados[0] . "</td>" .
                    "<td>" . $colunaDados[1] . "</td>" .
                    "<td>" . $colunaDados[2] . "</td></tr>";
            }

        fclose($arqAluno);
        $msg = "Deu tudo certo!!!";
        } else {
            $msg = "ERRO: O arquivo não pode ser aberto.";
        } 
        ?>
    </table>
    <hr>
    <p><?php echo $msg ?></p>
<br>
</body>
</html>
