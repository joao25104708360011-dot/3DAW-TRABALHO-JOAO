<?php
    header('Content-type: application/json');
    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    $id = $dados["id"];
    $plano = $dados["plano"];

    $servidor = "localhost";
    $username = "root";
    $senha_bd = "";
    $database = "Beauties"; 
    $conn = new mysqli($servidor, $username, $senha_bd, $database);

    $sql = "UPDATE usuarios SET plano = '$plano' WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Plano atualizado com sucesso!"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => $conn->error]);
    }

    $conn->close();
?>