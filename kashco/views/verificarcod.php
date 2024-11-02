<?php
session_start();
require_once '../src/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo_inserido = $_POST['codigo_verificacao'];
    
    if ($codigo_inserido == $_SESSION['codigo_verificacao']) {
        // Atualiza o usuário para administrador no banco de dados
        $stmt = $conn->prepare("UPDATE usuarios SET is_admin = 1 WHERE id = ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();

        echo "Agora você é administrador!";
        unset($_SESSION['codigo_verificacao']);
    } else {
        echo "Código incorreto. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Verificar Código</title>
</head>
<body>
    <h2>Verificação do Código de Administrador</h2>
    <form action="verificarcod.php" method="post">
        <label for="codigo_verificacao">Código de Verificação:</label>
        <input type="text" id="codigo_verificacao" name="codigo_verificacao" required>
        <button type="submit">Verificar</button>
    </form>
</body>
</html>
