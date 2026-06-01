<?php
    header('Content-Type: application/json; charset=utf-8');
    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    if (!$dados) {
        echo json_encode(["status" => "erro", "mensagem" => "Dados não recebidos."]);
        exit;
    }
    
    $num = $dados['numero'];
    $perg = addslashes($dados['pergunta']);
    $op1 = addslashes($dados['opcao1']);
    $op2 = addslashes($dados['opcao2']);
    $op3 = addslashes($dados['opcao3']);
    $opTrue = $dados['opcaoTrue'];

    $conn = new mysqli("localhost", "root", "", "faeterj3dawmanha");

    if ($conn->connect_error) {
        echo json_encode(["status" => "erro", "mensagem" => "Falha na conexão"]);
        exit;
    }

    $sql = "INSERT INTO `PerguntasMultipla` (id, pergunta, opcao1, opcao2, opcao3, opcaoTrue) VALUES ($num, '$perg', '$op1', '$op2', '$op3', '$opTrue')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Pergunta de Múltipla Escolha cadastrada!"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => $conn->error]);
    }
    $conn->close();
?>