<?php 
$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    if(!file_exists("cadastro.txt")){
        $arqCad = fopen("cadastro.txt","w") or die("O arquivo não pode ser criado."); 
        fwrite($arqCad,"id;nome;email\n");
        fclose($arqCad);
    }
       
    $arqCad = fopen("cadastro.txt","a") or die("O arquivo não pode ser aberto.");
    fwrite($arqCad, $id . ";" . $nome . ";" . $email . "\n");
    fclose($arqCad);
    $msg = "Cadastro Concluido.";
    
   
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuario.</title>
</head>
<body>
    <button><a href="main.php">Voltar</a></button>
    <h1>Cadastro de Usuarios.</h1>
    <form action="CadastroUser.php" method="POST">
        <label for="id">ID: </label>
        <input type="text" name="id" required>
        <label for="nome">Nome: </label>
        <input type="text" name="nome" required>
        <label for="email">Email: </label>
        <input type="text" name="email" required>
        <input type="submit" value="Cadastrar">
    </form>
<?php echo $msg; ?>
</body>
</html>