<?php
    header('Content-Type: application/json; charset=utf-8');

    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    $id_usuario = (int)$dados["id_usuario"];
    $id_servico = (int)$dados["id_servico"];
    $data_agendada = $dados["data_agendada"];
    $horario = $dados["horario"];
    $forma_pagamento = $dados["forma_pagamento"];

    if ($id_usuario <= 0 || $id_servico <= 0 || empty($data_agendada) || empty($horario) || empty($forma_pagamento)) {
        echo json_encode(["status" => "erro", "mensagem" => "Todos os campos são obrigatórios."]);
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

    $sql = "INSERT INTO agendamentos (id_usuario, id_servico, data_agendada, horario, forma_pagamento, status) 
            VALUES ($id_usuario, $id_servico, '$data_agendada', '$horario', '$forma_pagamento', 'Confirmado')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Agendamento realizado com sucesso!"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "Erro ao salvar agendamento: " . $conn->error]);
    }

    $conn->close();
?>
