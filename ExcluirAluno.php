<?php
$msg = "";
$aluno = null;
if($_SERVER['REQUEST_METHOD'] == 'POST' &&  !isset($_POST['excluir'])){
    $mat = $_POST["mat"];
    

    if (file_exists("alunos.txt")){
        $arqAluno = fopen("alunox.txt","r") or die("Arquivo não pode ser aberto.");

        while(!feof($arqAluno)){
            $linha = fgets($arqAluno);
            $colunaDados = explode(";",$linha);
            
            if ($mat == $colunaDados[0]){
                $aluno = $colunaDados;
                break;
            }
        }
        fclose($arqAluno);
    } else { 
        $msg = "Arquivo não pode ser aberto.";
    }
   
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['excluir'])){

    $mat = $_POST["matricula"];
    $arqAlunIn = fopen("alunos.txt", "r") or die("erro ao ebrir o arquivo")
    $arqAlunOut = fopen("alunosAlterado.txt", "w") or die("erro ao ebrir o arquivo")
    

    while(!feof($arqAlunoIn)){
        $linha = fgets($arqAlunIn);
        $colunaDados = explode(";", $linha);

        if($mat != $colunaDados[0]){
           // $linha2 = $mat . ";" . $nome . ";" . $email . "\n" ;
            fwrite($arqAlunOut, $linha);
        }
    }
    $msg = "Aluno excluido com sucesso";
}
?>


<DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Excluir Aluno</title>
    </head>
<body>
    <h1>EXCLUIR ALUNO</h1>
    
    <form action="ExcluirAluno.php" method="POST"></form>
        <label for="mat">Digite a matricula: </label>
        <input type="text" id="mat" name="mat" required>
        <input type="submit" name="buscar" value="buscar">
    </form>


<?php echo $msg; ?>
</body>