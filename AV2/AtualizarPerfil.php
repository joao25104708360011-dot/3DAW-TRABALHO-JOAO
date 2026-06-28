<?php
    header('Content-Type: application/json; charset=utf-8');
    error_reporting(0);

    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    $id = $dados["id"];
    $nome = $dados["nome"];
    $email = $dados["email"];

    if ($id == 0 || empty($nome) || empty($email)) {
        echo json_encode(["status" => "erro", "mensagem" => "Campos obrigatórios vazios."]);
        exit();
    }

    $servidor = "localhost";
    $username = "root";
    $senha_bd = "";
    $database = "Beauties";

    $conn = new mysqli($servidor, $username, $senha_bd, $database);

    if ($conn->connect_error) {
        echo json_encode(["status" => "erro", "mensagem" => "Falha na conexão com o banco."]);
        exit();
    }

    $sql = "UPDATE usuarios SET nome = '$nome', email = '$email' WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Dados atualizados com sucesso!"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "Erro ao atualizar: " . $conn->error]);
    }

    $conn->close();
?>