<?php
    $msg = "";
    $aluno = null;
    //$arqCaminho = "alunos.txt";

    if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
        $mat = $_POST["mat"];
    
        if(file_exists("alunox.txt")){
            $arqAlter = fopen("alunos.txt","r") or die("erro ao abrir arquivo");

            $cabeçalho = fgets($arqAlter);

            while(!feof($arqAlter)) {
                $linha = fgets($arqAlter);
                $colunaDados = explode(";", $linha);

                if($colunaDados[0] == $mat){
                    $aluno = $colunaDados;
                    break;
                }
            }
            fclose($arqAlter);
            $msg = "Deu tudo certo!!!";
        } else {
            $msg = "ERRO: Aluno não encontrado.";
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        
        $linhas = file("alunos.txt");
        $novo = "";

        foreach ($linhas as $linha) {
            $dados = explode(";", $linha);
        

            if($dados[0] == $mat){
                $novo = .= "{$mat};{$nome};{$email}\n";
            }
            else {
                $novoConteudo .= $linha; // Mantém a linha original
            }
        }
    file_put_contents($arqCaminho, $novo);
    $msg = "Dados atualizados com sucesso!";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Aluno</title>
    <style>
        table, th, td{
            border: 2px solid black; 
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Alterar Aluno</h1>
    <hr>
    <form action="AlterarAluno.php" method="POST">
        <label for="mat">Digite a Matricula do aluno:</label>
        <input type="text" id="mat" name="mat" required>
        <input type="submit" value="Consultar">
    </form>
    <hr>

    <?php if ($aluno): ?>
        <form action="AlterarAluno.php" method="POST">
        
        <table>
            <tr>
                <th>Matrícula</th>
                <th>Nome</th>
                <th>Email</th>
            </tr>
            <tr>
                <td><?php echo $aluno[0]; ?></td>
                <td><input type="text" name="nome" value="<?php echo $aluno[1]; ?>" required></td>
                <td><input type="text" name="email" value="<?php echo $aluno[2]; ?>" required></td>
            </tr>
        </table>
        <br>
        <input type="submit" name="alterar" value="Alterar">
    </form>
    <?php endif; ?>


            
</form>
</body>
</html>