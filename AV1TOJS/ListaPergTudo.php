<?php
    header('Content-Type: application/json');
    $servidor = "localhost";
    $username = "root";
    $senha = "";
    $database = "faeterj3dawmanha";

    $conn = new mysqli($servidor, $username, $senha, $database);
    if ($conn->connect_error) {
        echo json_encode(["erro" => "Falha na conexão: " . $conn->connect_error]);
        exit;
    }
    
    $tudo = array();
    
    $resDisc = $conn->query("SELECT id, pergunta, resposta AS gabarito, 'Discursiva' as tipo FROM PerguntasDiscursivas");
    while($row = $resDisc->fetch_assoc()) { 
        $tudo[] = $row; 
    }


    $resMult = $conn->query("SELECT id, pergunta, 
            (CASE 
                WHEN opcaoTrue = '1' THEN opcao1 
                WHEN opcaoTrue = '2' THEN opcao2 
                WHEN opcaoTrue = '3' THEN opcao3 
                ELSE 'Erro: Opção inválida' 
            END) AS gabarito, 
            'Multipla' as tipo 
            FROM PerguntasMultipla");
            
    while($row = $resMult->fetch_assoc()) { 
        $tudo[] = $row; 
    }

    echo json_encode($tudo, JSON_UNESCAPED_UNICODE);
?>