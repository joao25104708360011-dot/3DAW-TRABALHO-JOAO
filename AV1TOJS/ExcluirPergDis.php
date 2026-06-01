<?php
    header('Content-Type: application/json');
    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);
    $id = $dados['numero'];

    $servidor = "localhost";
    $username = "root";
    $senha = "";
    $database = "faeterj3dawmanha";

    $conn = new mysqli($servidor, $username, $senha, $database);

    $sql = "DELETE FROM `PerguntasDiscursivas` WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Registro excluído com sucesso!"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "Erro ao excluir: " . $conn->error]);
    }
    $conn->close();
?>