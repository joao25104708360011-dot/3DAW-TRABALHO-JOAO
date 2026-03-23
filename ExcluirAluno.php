<?php
$msg = "";
$aluno = null;
if($_SERVER['REQUEST_METHOD'] == 'POST' &&  !isset($_POST['excluir'])){
    $mat = $_POST["mat"];
    

    if (file_exists("alunos.txt")){
        $arqAluno = fopen("alunos.txt","r") or die("Arquivo não pode ser aberto.");

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
    $arqAlunIn = fopen("alunos.txt", "r") or die("erro ao ebrir o arquivo");
    $arqAlunOut = fopen("alunosAlterado.txt", "w") or die("erro ao ebrir o arquivo");
    

    while(!feof($arqAlunIn)){
        $linha = fgets($arqAlunIn);
        $colunaDados = explode(";", $linha);

        if($mat != $colunaDados[0]){
           // $linha2 = $mat . ";" . $nome . ";" . $email . "\n" ;
            fwrite($arqAlunOut, $linha);
        }
    }
    fclose($arqAlunIn);
    fclose($arqAlunOut);

    rename("alunosAlterado.txt","alunos.txt");
    $msg = "Aluno excluido com sucesso";
}
?>


<DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Excluir Aluno</title>
        <style>
            table, th, td{
                border: 2px solid black; 
                border-collapse: collapse;
                padding: 5px;
            }
        </style>
    </head>
<body>
    <h1>EXCLUIR ALUNO</h1>
    <hr>
    <form action="ExcluirAluno.php" method="POST">
        <label for="mat">Digite a matricula: </label>
        <input type="text" id="mat" name="mat" required>
        <input type="submit" name="buscar" value="Buscar">
    </form>
    <hr>

<?php echo $msg; ?>
<?php if($aluno):?>
    <form action="ExcluirAluno.php" method="POST">
        <input type="hidden" name="matricula" value="<?php echo $aluno[0]?>">
        <input type="hidden" name="nome" value="<?php echo $aluno[1]?>">
        <input type="hidden" name="email" value="<?php echo $aluno[2]?>">
        <table>
            <tr>
                <th>Matricula</th><th>Nome</th><th>Email</th>
            </tr>
            <tr>
                <td><?php echo $aluno[0]?></td>
                <td><?php echo $aluno[1]?></td>
                <td><?php echo $aluno[2]?></td>
            </tr>
        </table>
        <hr>
        <p>Deseja Realmente Excluir Esse Registro?</p>
        <input type="submit" name="excluir" Value="Excluir">


    </form>

<?php endif?>
</body>