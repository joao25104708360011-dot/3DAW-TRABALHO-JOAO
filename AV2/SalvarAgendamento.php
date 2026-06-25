<?php
    header('Content-type: application/json');
    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    $id_usuario = $dados["id_usuario"];
    $id_servico = $dados["id_servico"];
    $data_agendada = $dados["data_agendada"];
    $horario = $dados["horario"];

    if (!$id_usuario || !$id_servico || !$data_agendada || !$horario) {
        echo json_encode(["status" => "erro", "mensagem" => "Dados insuficientes para atualização."]);
        exit;
    }

    $servidor = "localhost";
    $username = "root";
    $senha = "";
    $database = "Beauties";
    $conn = new mysqli($servidor, $username, $senha, $database);

    if($conn->connect_error){
        echo json_encode(["status" => "erro", "mensagem" => "Falha na conexão com o banco de dados."]);
        exit;
    }

    $sql = "INSERT INTO agendamentos (id_usuario, id_servico, data_agendada, horario) VALUES ('$id_usuario', '$id_servico', '$data_agendada', '$horario')";

    if($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Horário agendado com sucesso!"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => $conn->error]);
    }
    $conn->close();
?>