<?php
    header('Content-Type: application/json; charset=utf-8');

    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    $id_usuario = $dados["id_usuario"];

    $servidor = "localhost";
    $username = "root";
    $senha_bd = "";
    $database = "Beauties"; 
    $conn = new mysqli($servidor, $username, $senha_bd, $database);

    if ($conn->connect_error) {
        echo json_encode(["status" => "erro", "mensagem" => "Falha na conexão com o banco de dados."]);
        exit();
    }

    $sql = "SELECT s.nome AS servico, a.data_agendada, a.horario, a.status 
            FROM agendamentos a 
            INNER JOIN servicos s ON a.id_servico = s.id 
            WHERE a.id_usuario = '$id_usuario' 
            ORDER BY a.data_agendada DESC, a.horario DESC";

    $resultado = $conn->query($sql);

    $lista = [];

    if ($resultado && $resultado->num_rows > 0) {
        while($linha = $resultado->fetch_assoc()) {
            $lista[] = $linha;
        }
    }

    echo json_encode($lista, JSON_UNESCAPED_UNICODE);
    $conn->close();
?>