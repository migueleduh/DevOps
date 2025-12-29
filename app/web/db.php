<?php
// Conexão com valores fixos
$host = 'db';
$db_name = 'inovatech_db';
$user = 'admin';
$password = 'abc123';

// 1. Tenta criar a conexão.
// O '@' na frente impede o PHP de gerar seu próprio warning,
// pois nós vamos tratar o erro manualmente.
$conn = @new mysqli($host, $user, $password, $db_name);

// 2. Esta é a forma correta de verificar se a conexão falhou
if ($conn->connect_error) {
    // Se houver um erro, para o script e exibe a mensagem.
    die("Erro de conexão (do db.php): " . $conn->connect_error);
}

// Se o script chegou até aqui, a conexão foi um sucesso!

?>
