<?php
    header('Content-type: application/json');
    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    $id = $dados["id"];

    $servidor = "localhost";
    $username = "root";
    $senha_bd = "";
    $database = "Beauties"; 
    
    $conn = new mysqli($servidor, $username, $senha_bd, $database);

    $sql = "SELECT nome, email FROM usuarios WHERE id = '$id'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $user = $resultado->fetch_assoc();
        echo json_encode(["status" => "sucesso", "usuario" => $user]);
    } else {
        echo json_encode(["status" => "erro"]);
    }
    $conn->close();
?>