<?php 
$msg = "";
$perg = null;

if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST["excluir"])) {
    $num = $_POST["num"];


    if(file_exists("perguntasMulti.txt")){
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

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["excluir"])) {
    $num = $_POST["numtrue"];
    $perg = $_POST["perg"];
    $op1 = $_POST["op1"];
    $op2 = $_POST["op2"];
    $op3 = $_POST["op3"];
    $optrue = $_POST["optrue"];

    $arqPergIn = fopen("perguntasMulti.txt","r") or die("O arquivo não pode ser aberto."); 
    $arqPergOut = fopen("perguntasMultiAlt.txt","w") or die("O arquivo não pode ser aberto."); 


    while(!feof($arqPergIn)){
        $linha = fgets($arqPergIn);
        $coluna = explode(";", $linha);

        if($coluna[0] != $num){
            fwrite($arqPergOut, $linha);
        } 
    }
    fclose($arqPergIn);
    fclose($arqPergOut);
    rename("perguntasMultiAlt.txt","perguntasMulti.txt");
    $msg = "Registro Excluido com sucesso.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Perguntas de Multipla Escolha.</title>
</head>
<body>
    <button><a href="main.php">Voltar</a></button>
    <h1>Exclusão de Perguntas de Multipla Escolha.</h1>
    <form action="ExcluirPergMulti.php" method="POST">
        <label for="num">Digite o Numero da Pergunta: </label>
        <input type="text" name="num" required>
        <input type="submit" value="Procurar">
    </form>

<?php if($perg): ?>
    <form action="ExcluirPergMulti.php" method="POST">
        <input type="hidden" name="numtrue" value="<?php echo $perg[0]; ?>">
        <table>
            <tr><th>Numero</th><th>Pergunta</th><th>Opção 1</th><th>Opção 2</th><th>Opção 3</th><th>Opção Correta</th></tr>
            
            <tr>
                <td><?php echo $perg[0]; ?></td>
                <td><?php echo $perg[1]; ?></td>
                <td><?php echo $perg[2]; ?></td>
                <td><?php echo $perg[3]; ?></td>
                <td><?php echo $perg[4]; ?></td>
                <td><?php echo $perg[5]; ?></td>
            </tr>
        </table>
        <input type="submit" name="excluir" value="Excluir">
    </form>
<?php endif ?>
<?php echo $msg; ?>
</body>
</html>