<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once '../src/connect.php';

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT nome, email FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nome, $email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="../../public/assets/css/perfil.css">
</head>
<body>
    <section class="perfil-container">
        <h2>Bem-vindo, <?php echo htmlspecialchars($nome); ?></h2>
        <div class="perfil-info">
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($nome); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        </div>

        <div class="perfil-opcoes">
            <a href="editar_perfil.php">Editar Perfil</a>
            <a href="endereco.php">Endereço</a>
            <a href="historico_compras.php">Histórico de Compras</a>
            <a href="alterar_senha.php">Alterar Senha</a>
        </div>

        <form action="../src/logout.php" method="post" style="margin-top: 20px;">
            <button type="submit" class="botao-sair">Sair da Conta</button>
        </form>
    </section>
</body>
</html>
