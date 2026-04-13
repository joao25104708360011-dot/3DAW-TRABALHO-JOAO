<?php 
$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $num = $_POST["num"];
    $perg = $_POST["perg"];
    $op1 = $_POST["op1"];
    $op2 = $_POST["op2"];
    $op3 = $_POST["op3"];
    $optrue = $_POST["optrue"];


    if(!file_exists("perguntasMulti.txt")){
        $arqPerg = fopen("perguntasMulti.txt","w") or die("O arquivo não pode ser criado."); 
        fwrite($arqPerg,"numero;pergunta;opção1;opção2;opção3;opçãocorreta\n");
        fclose($arqPerg);
    }
       
    $arqPerg = fopen("perguntasMulti.txt","a") or die("O arquivo não pode ser aberto.");
    fwrite($arqPerg, $num . ";" . $perg . ";" . $op1 . ";" . $op2 . ";" . $op3 . ";" . $optrue . "\n");
    fclose($arqPerg);
    $msg = "Cadastro de Pergunta Concluido.";
    
   
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Perguntas de Multipla Escolha.</title>
</head>
<body>
    <button><a href="main.php">Voltar</a></button>
    <h1>Cadastro de Perguntas de Multipla Escolha.</h1>
    <form action="CadastroPergMulti.php" method="POST">
        <label for="num">Numero: </label>
        <input type="text" name="num" required>
        <br>
        <label for="perg">Pergunta: </label>
        <input type="text" name="perg" required>
        <br>
        <label for="op1">Opção 1: </label>
        <input type="text" name="op1" required>
        <br>
        <label for="op2">Opção 2: </label>
        <input type="text" name="op2" required>
        <br>
        <label for="op3">Opção 3: </label>
        <input type="text" name="op3" required>
        <br>
        <label for="optrue">Opção correta: </label>
        <input type="text" name="optrue" required>
        <br>
        <input type="submit" value="Cadastrar">
    </form>
<?php echo $msg; ?>
</body>
</html>