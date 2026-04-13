<?php 
$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $num = $_POST["num"];
    $perg = $_POST["perg"];
    $resp = $_POST["resp"];

    if(!file_exists("perguntas.txt")){
        $arqPerg = fopen("perguntas.txt","w") or die("O arquivo não pode ser criado."); 
        fwrite($arqPerg,"numero;pergunta;resposta\n");
        fclose($arqPerg);
    }
       
    $arqPerg = fopen("perguntas.txt","a") or die("O arquivo não pode ser aberto.");
    fwrite($arqPerg, $num . ";" . $perg . ";" . $resp . "\n");
    fclose($arqPerg);
    $msg = "Cadastro de Pergunta Concluido.";
    
   
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Perguntas Discursivas.</title>
</head>
<body>
    <button><a href="main.php">Voltar</a></button>
    <h1>Cadastro de Perguntas discursivas.</h1>
    <form action="CadastroPergDis.php" method="POST">
        <label for="num">Numero: </label>
        <input type="text" name="num" required>
        <label for="perg">Pergunta: </label>
        <input type="text" name="perg" required>
        <label for="resp">Resposta: </label>
        <input type="text" name="resp" required>
        <input type="submit" value="Cadastrar">
    </form>
<?php echo $msg; ?>
</body>
</html>