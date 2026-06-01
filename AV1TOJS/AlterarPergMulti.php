<?php
    header('Content-Type: application/json');
    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    $id = $dados["id"];
    $perg = addslashes($dados["pergunta"]);
    $op1 = addslashes($dados["opcao1"]);
    $op2 = addslashes($dados["opcao2"]);
    $op3 = addslashes($dados["opcao3"]);
    $opTrue = $dados["opcaoTrue"];

    $servidor = "localhost";
    $username = "root";
    $senha = "";
    $database = "faeterj3dawmanha";
    $conn = new mysqli($servidor, $username, $senha, $database);

    if ($conn->connect_error) { die(json_encode(["erro" => "Conexao falhou"])); }

    $sql = "UPDATE `PerguntasMultipla` SET pergunta = '$perg', opcao1 = '$op1', opcao2 = '$op2', opcao3 = '$op3', opcaoTrue = '$opTrue' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Alterado com sucesso!"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => $conn->error]);
    }
    $conn->close();
?>