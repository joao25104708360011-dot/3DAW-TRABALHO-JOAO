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
<DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Incluir Disciplina</title>
    </head>
<body>
    <form action="incluirDisciplina.php" method="POST">
        <label for="sigla"></label>
        <input type="text" value="sigla" name="sigla">
        <label for="nome"></label>
        <input type="text" value="nome" name="nome">
        <label for="carga"></label>
        <input type="text" value="carga" name="carga">
        <input type="submit" value="Incluir">
    </form>

    <p><?php echo $msg; ?></p>

    <h2>Lista de Disciplina</h2>

    <table>
        <tr><th>Sigla</th><th>Nome</th><th>Carga</th></tr>
        <?php 

            if(!file_exists("Disciplina.txt")){
                echo "</table>";
                echo "<p>Nenhuma disciplina foi cadastrada ainda.</p>";
            } else {
                $arqDisc = fopen("Disciplina.txt") or die("Arquivo não encontrado."); 
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