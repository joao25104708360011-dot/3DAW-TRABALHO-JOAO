<?php
    header('Content-Type: application/json; charset=utf-8');
    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    $id = $dados["id"];
    $perg = addslashes($dados["pergunta"]);
    $resp = addslashes($dados["resposta"]);

    $conn = new mysqli("localhost", "root", "", "faeterj3dawmanha");

    $sql = "UPDATE `PerguntasDiscursivas` SET pergunta = '$perg', resposta = '$resp' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Alteração salva com sucesso!"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => $conn->error]);
    }
    $conn->close();
?>