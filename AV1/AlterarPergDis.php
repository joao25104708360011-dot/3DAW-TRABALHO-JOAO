<?php 
$msg = "";
$perg = null;

if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST["alterar"])) {
    $num = $_POST["num"];


    if(file_exists("perguntas.txt")){
        $arqPerg = fopen("perguntas.txt","r") or die("O arquivo não pode ser aberto."); 

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

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["alterar"])) {
    $num = $_POST["numtrue"];
    $perg = $_POST["perg"];
    $resp = $_POST["resp"];

    $arqPergIn = fopen("perguntas.txt","r") or die("O arquivo não pode ser aberto."); 
    $arqPergOut = fopen("perguntasAlt.txt","w") or die("O arquivo não pode ser aberto."); 


    while(!feof($arqPergIn)){
        $linha = fgets($arqPergIn);
        $coluna = explode(";", $linha);

        if($coluna[0] == $num){
            fwrite($arqPergOut, $num . ";" . $perg . ";" . $resp ."\n");
            $msg = "Registro Alterado com sucesso.";
        } else {
            fwrite($arqPergOut, $linha);
        }
    }
    fclose($arqPergIn);
    fclose($arqPergOut);
    rename("perguntasAlt.txt","perguntas.txt");
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Perguntas Discursivas.</title>
</head>
<body>
    <button><a href="main.php">Voltar</a></button>
    <h1>Alteração de Perguntas discursivas.</h1>
    <form action="AlterarPergDis.php" method="POST">
        <label for="num">Digite o Numero da Pergunta: </label>
        <input type="text" name="num" required>
        <input type="submit" value="Procurar">
    </form>

<?php if($perg): ?>
    <form action="AlterarPergDis.php" method="POST">
        <input type="hidden" name="numtrue" value="<?php echo $perg[0]; ?>">
        <table>
            <tr><th>Numero</th><th>Pergunta</th><th>Resposta</th></tr>
            
            <tr>
                <td><?php echo $perg[0]; ?></td>
                <td><input type="text" name="perg" value="<?php echo $perg[1]; ?>"></td>
                <td><input type="text" name="resp" value="<?php echo $perg[2]; ?>"></td>
            </tr>
        </table>
        <input type="submit" name="alterar" value="Alterar">
    </form>
<?php endif ?>
<?php echo $msg; ?>
</body>
</html>