<?php
    header('Content-Type: application/json');

    $idPerg = $_GET["num"];
    $tipo = $_GET["tipo"];

    if (!$idPerg || !$tipo) {
        echo json_encode(["erro" => "Dados insuficientes"]);
        exit;
    }

    $servidor = "localhost";
    $username = "root";
    $senha = "";
    $database = "faeterj3dawmanha";
    $conn = new mysqli($servidor,$username,$senha,$database);

    if ($conn->connect_error) {
        echo json_encode(["erro" => "Falha na conexão"]);
        exit;
    }

    if ($tipo == "1") {
        $tabela = "PerguntasDiscursivas";
    } else {
        $tabela = "PerguntasMultipla";
    }

    $comandoSQL = "SELECT * from `$tabela` where id = $idPerg";

    $resultado = $conn->query($comandoSQL);
    
    if ($resultado && $resultado->num_rows > 0) {
        $dados = $resultado->fetch_assoc();
        
        $dados['tipoOriginal'] = ($tipo == "1") ? "Discursiva" : "Multipla";
        echo json_encode($dados, JSON_UNESCAPED_UNICODE);
    } else {
        
        echo json_encode(["erro" => "Pergunta não encontrada"]);
    }

    $conn->close();
?>