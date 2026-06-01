<?php
    header('Content-Type: application/json');
    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    if (!$dados) {
        echo json_encode(["status" => "erro", "mensagem" => "Dados não recebidos."]);
        exit;
    }

    $id = $dados['id'];
    $nome = $dados['nome'];
    $email = $dados['email'];

    $servidor = "localhost";
    $username = "root";
    $senha = "";
    $database = "faeterj3dawmanha";
    $conn = new mysqli($servidor, $username, $senha, $database);

    if ($conn->connect_error) {
        die("Conexao falhou");
    }

    $sql = "INSERT INTO `Usuarios` (id, nome, email) VALUES ($id, '$nome', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Usuário cadastrado com sucesso!"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => $conn->error]);
    }
    $conn->close();
?>