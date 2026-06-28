<?php
    header('Content-type: application/json');
    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    $id_usuario = $dados["id_usuario"];
    $nota = $dados["nota"];
    $comentario = $dados["comentario"];

    $servidor = "localhost";
    $username = "root";
    $senha_bd = "";
    $database = "Beauties"; 
    
    $conn = new mysqli($servidor, $username, $senha_bd, $database);

    $sql = "INSERT INTO avaliacoes (id_usuario, nota, comentario) VALUES ('$id_usuario', '$nota', '$comentario')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "sucesso"]);
    } else {
        echo json_encode(["status" => "erro"]);
    }
    $conn->close();
?>