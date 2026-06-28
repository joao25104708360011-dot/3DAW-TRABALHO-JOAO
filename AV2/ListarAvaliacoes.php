<?php
    header('Content-type: application/json');
    
    $servidor = "localhost";
    $username = "root";
    $senha_bd = "";
    $database = "Beauties"; 
    
    $conn = new mysqli($servidor, $username, $senha_bd, $database);

    $sql = "SELECT a.nota, a.comentario, u.nome FROM avaliacoes a JOIN usuarios u ON a.id_usuario = u.id ORDER BY a.id DESC";
    $resultado = $conn->query($sql);

    $lista = [];
    while($linha = $resultado->fetch_assoc()) {
        $lista[] = $linha;
    }

    echo json_encode($lista);
    $conn->close();
?>