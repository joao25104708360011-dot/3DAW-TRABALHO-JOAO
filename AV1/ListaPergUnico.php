<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Perguntas</title>
</head>
<body>
    <button><a href="main.php">Voltar</a></button>
    <h1>Listagem de Pergunta Unica.</h1>
    <form action="ListaPergUnico.php" method="POST">
        <label for="num">Digite o tipo da Pergunta:(1 para dicursiva/ 2 para multipla) </label>
        <input type="text" name="tipo" required>
        <label for="num">Digite o Numero da Pergunta: </label>
        <input type="text" name="num" required>
        <input type="submit" value="Procurar">
    </form>
    <h2>---Perguntas Discursivas---</h2>

    <table>
        <tr><th>Numero</th><th>Pergunta</th><th>Resposta</th></tr>

        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $tipo = $_POST["tipo"];
                $num = $_POST["num"];

    
                if($tipo == 1){
                    $arqPerg = fopen("perguntasMulti.txt","r") or die("O arquivo não pode ser aberto."); 

                    while(!feof($arqPerg)){
                        $linha = fgets($arqPerg);
                        $coluna = explode(";", $linha);

                        if($coluna[0] == $num){
                            $perg = $coluna;
                            $msg = "Registro encontrado.";
                            break;
                        }
                    }
                    fclose($arqPerg);
                }
                
            }
            if(file_exists("perguntas.txt")){
                $arqPerg = fopen("perguntas.txt","r") or die("O arquivo não pode ser aberto."); 
                $cabecalho = fgets($arqPerg);

                while(!feof($arqPerg)){
                    $linha = fgets($arqPerg);
                    $coluna = explode(";", $linha);

                    echo "<tr><td>" . $coluna[0] . "</td>" . 
                             "<td>" . $coluna[1] . "</td>" . 
                             "<td>" . $coluna[2] . "</td></tr>";
                }
                echo "</table>";
                fclose($arqPerg);
            } else {
                echo "</table>";
                echo "Nenhum Registro Encontrado.";
            }
        ?>
    <h2>---Perguntas de Multipla Escolha---</h2>
    <table>
        <tr><th>Numero</th><th>Pergunta</th><th>Opção 1</th><th>Opção 2</th><th>Opção 3</th><th>Opção Correta</th></tr>
        <?php 
            if(file_exists("perguntasMulti.txt")){
                $arqPergMulti = fopen("perguntasMulti.txt","r") or die("O arquivo não pode ser aberto."); 
                $cabecalhoMulti = fgets($arqPergMulti);

                while(!feof($arqPergMulti)){
                    $linha = fgets($arqPergMulti);
                    $coluna = explode(";", $linha);

                    echo "<tr><td>" . $coluna[0] . "</td>" . 
                             "<td>" . $coluna[1] . "</td>" .
                             "<td>" . $coluna[2] . "</td>" . 
                             "<td>" . $coluna[3] . "</td>" . 
                             "<td>" . $coluna[4] . "</td>" . 
                             "<td>" . $coluna[5] . "</td></tr>";
                }
                fclose($arqPergMulti);
                echo "</table>";
            } else {
                echo "</table>";
                echo "Nenhum Registro Encontrado.";
            }
        ?>
</body>
</html>