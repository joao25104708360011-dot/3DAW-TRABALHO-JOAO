<?php
    header('Content-Type: application/json; charset=utf-8');
    error_reporting(0);

    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    $email = $dados["email"];
    $senha = $dados["senha"];

    if (empty($email) || empty($senha)) {
        echo json_encode(["status" => "erro", "mensagem" => "Preencha todos os campos."]);
        exit();
    }

    $servidor = "localhost";
    $username = "root";
    $senha_bd = "";
    $database = "Beauties";

    $conn = new mysqli($servidor, $username, $senha_bd, $database);

    if ($conn->connect_error) {
        echo json_encode(["status" => "erro", "mensagem" => "Falha na conexão com o banco de dados."]);
        exit();
    }

    $sql = "SELECT id, nome FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        
        echo json_encode([
            "status" => "sucesso",
            "id" => $usuario["id"],
            "nome" => $usuario["nome"]
        ]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "E-mail ou senha incorretos."]);
    }

    $conn->close();
?>
