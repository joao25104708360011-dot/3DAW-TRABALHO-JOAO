 <?php
$msg = "";
$perg = null;
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo = $_POST["tipo"];
    $num = $_POST["num"];

    if($tipo == 1){
        $nomeArquivo = "perguntas.txt";
    } else {
        $nomeArquivo = "perguntasMulti.txt";
    }

    if(file_exists($nomeArquivo)){
        $arqPerg = fopen($nomeArquivo,"r") or die("O arquivo não pode ser aberto."); 
        
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
            if($perg == null){
                $msg = "Pergunta não encontrada.";
            }
        } else {
            $msg = "Arquivo não encontrado";
        }
}

?>

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
        <label for="num">Digite o tipo da Pergunta:(1 para discursiva/ 2 para multipla) </label>
        <input type="text" name="tipo" required>
        <label for="num">Digite o Numero da Pergunta: </label>
        <input type="text" name="num" required>
        <input type="submit" value="Procurar">
    </form>
    <hr>
<?php if ($perg): ?>
        <h3>Dados da Pergunta: </h3>
        <table>
            <tr>
                <?php 
                if (count($perg) > 3) {
                    echo "<th>Numero</th><th>Pergunta</th><th>Opção 1</th><th>Opção 2</th><th>Opção 3</th><th>Opção Correta</th>";
                } else {
                    echo "<th>Numero</th><th>Pergunta</th><th>Resposta</th>";
                }
                ?>
            </tr>
            <tr>
                <?php
                if (count($perg) > 3) {
                    echo "<tr><td>" . $perg[0] . "</td>" . 
                             "<td>" . $perg[1] . "</td>" .
                             "<td>" . $perg[2] . "</td>" . 
                             "<td>" . $perg[3] . "</td>" . 
                             "<td>" . $perg[4] . "</td>" . 
                             "<td>" . $perg[5] . "</td></tr>";
                } else {
                    echo "<tr><td>" . $perg[0] . "</td>" . 
                             "<td>" . $perg[1] . "</td>" . 
                             "<td>" . $perg[2] . "</td></tr>";
                }
                ?>
            </tr>
        </table>
    <?php endif; ?>
    <hr>
<?php echo $msg; ?>            
</body>
</html>
