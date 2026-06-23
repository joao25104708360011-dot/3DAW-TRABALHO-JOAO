<?php
    header('Content-type: application/json');

    $servidor = "localhost";
    $username = "root";
    $senha = "";
    $database = "Beauties";
    $conn = new mysqli($servidor, $username, $senha, $database);

    if($conn->connect_error){
        echo json_encode(["status" => "erro", "mensagem" => "Falha na conexão com o banco de dados."]);
        exit;
    }

    $tudo = array();
    $aux = $conn->query("SELECT * FROM servicos");

    while($row = $aux->fetch_assoc()) { 
        $tudo[] = $row; 
    }

    echo json_encode($tudo, JSON_UNESCAPED_UNICODE);
    $conn->close();
?>