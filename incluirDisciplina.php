<?php
$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $sigla = $_POST["sigla"];
    $nome = $_POST["nome"];
    $carga = $_POST["carga"];

    if(!file_exists("Disciplina.txt")){
        $arqDisc = fopen("Disciplina.txt","w") or die("Erro ao criar arquivo.");
        $linha = "sigla;nome;carga\n";
        fwrite($arqDisc,$linha);
    }

    $arqDisc = fopen("Disciplina.txt","a") or die("Arquivo não encontrado.");
    $linha = $sigla .";". $nome .";". $carga . "\n";
    fwrite($arqDisc, $linha);
    fclose($arqDisc);
    $msg = "Disciplina cadastrada com sucesso.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Disciplina</title>
    <style>
        table, th, td{
            border: 2px solid black; 
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Cadastro de Disciplina</h1>
    <hr>
    <form action="incluirDisciplina.php" method="POST">
        <label for="sigla">Sigla:</label>
        <input type="text" name="sigla">
        <label for="nome">Nome:</label>
        <input type="text" name="nome">
        <label for="carga">Carga:</label>
        <input type="text" name="carga">
        <input type="submit" value="Incluir">
    </form>
    <hr>
    <p><?php echo $msg; ?></p>
    <hr>
    <h2>Lista de Disciplinas</h2>

    <table>
        <tr><th>Sigla</th><th>Nome</th><th>Carga</th></tr>
        <?php 

            if(!file_exists("Disciplina.txt")){
                echo "</table>";
                echo "<p>Nenhuma disciplina foi cadastrada ainda.</p>";
            } else {
                $arqDisc = fopen("Disciplina.txt", "r") or die("Arquivo não encontrado."); 
                $cabecalho = fgets($arqDisc);
                
                while(!feof($arqDisc)){
                    $linha = fgets($arqDisc);
                    $coluna = explode(";",$linha);

                    echo "<tr><td>" . $coluna[0] . "</td>" .
                             "<td>" . $coluna[1] . "</td>" .
                             "<td>" . $coluna[2] . "</td></tr>";
                }
                fclose($arqDisc);
                echo "</table>"; 
            }
        
        
        ?>
</body>
</html>