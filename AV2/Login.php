<?php
    header('Content-type: application/json');
    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    $email = isset($dados["email"]) ? trim($dados["email"]) : '';
    $senha = isset($dados["senha"]) ? trim($dados["senha"]) : '';

    if (empty($email) || empty($senha)) {
        echo json_encode(["status" => "erro", "mensagem" => "Dados insuficientes para autenticação."]);
        exit;
    }

    $servidor = "localhost";
    $username = "root";
    $senha_bd = ""; 
    $database = "Beauties"; 
    
    $conn = new mysqli($servidor, $username, $senha_bd, $database);

    if($conn->connect_error){
        echo json_encode(["status" => "erro", "mensagem" => "Falha na conexão: " . $conn->connect_error]);
        exit;
    }

    $sql = "SELECT id, nome FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $user = $resultado->fetch_assoc();
        echo json_encode(["status" => "sucesso", "usuario" => $user]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "E-mail ou senha incorretos."]);
    }
    $conn->close();
?>