<?php
    header('Content-Type: application/json');
    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    if (!$dados) {
        echo json_encode(["status" => "erro", "mensagem" => "Dados não recebidos corretamente."]);        
        exit;
    }

    $num = $dados['numero'];
    $perg = addslashes($dados['pergunta']);
    $resp = addslashes($dados['resposta']);
    $servidor = "localhost";
    $username = "root";
    $senha = "";
    $database = "faeterj3dawmanha";
    $conn = new mysqli($servidor, $username, $senha, $database);

    if ($conn->connect_error) {
        echo json_encode(["status" => "erro", "mensagem" => "Conexão falhou: " . $conn->connect_error]);    
        exit;    
    }

    $sql = "INSERT INTO `PerguntasDiscursivas` (id, pergunta, resposta) VALUES ($num, '$perg', '$resp')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Cadastrado com sucesso!"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => $conn->error]);    }
    $conn->close();
?>