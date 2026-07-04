<?php
    header('Content-Type: application/json; charset=utf-8');

    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    $id_usuario = (int)$dados["id_usuario"];
    $plano = $dados["plano"];

    if ($id_usuario <= 0 || empty($plano)) {
        echo json_encode(["status" => "erro", "mensagem" => "Dados inválidos para assinatura."]);
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

    $sql = "UPDATE usuarios SET plano = '$plano' WHERE id = $id_usuario";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Plano " . $plano . " assinado com sucesso!"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "Erro ao atualizar plano: " . $conn->error]);
    }

    $conn->close();
?>
