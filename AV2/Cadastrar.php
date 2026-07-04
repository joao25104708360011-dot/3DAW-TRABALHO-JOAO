<?php
    header('Content-Type: application/json; charset=utf-8');

    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    $nome = $dados["nome"];
    $email = $dados["email"];
    $senha = $dados["senha"];

    if (empty($nome) || empty($email) || empty($senha)) {
        echo json_encode(["status" => "erro", "mensagem" => "Por favor, preencha todos os campos."]);
        exit();
    }

    $servidor = "localhost";
    $username = "root";
    $senha_bd = "";
    $database = "Beauties";

    $conn = new mysqli($servidor, $username, $senha_bd, $database);

    if ($conn->connect_error) {
        echo json_encode(["status" => "erro", "mensagem" => "Erro de conexão com a base de dados."]);
        exit();
    }

    $checkEmail = "SELECT id FROM usuarios WHERE email = '$email'";
    $resultadoCheck = $conn->query($checkEmail);

    if ($resultadoCheck && $resultadoCheck->num_rows > 0) {
        echo json_encode(["status" => "erro", "mensagem" => "Este e-mail já está em uso."]);
    } else {
        $sql = "INSERT INTO usuarios (nome, email, senha, plano) VALUES ('$nome', '$email', '$senha', NULL)";
        
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["status" => "sucesso", "mensagem" => "Cadastro realizado com sucesso! Faça seu login."]);
        } else {
            echo json_encode(["status" => "erro", "mensagem" => "Erro ao registrar: " . $conn->error]);
        }
    }

    $conn->close();
?>