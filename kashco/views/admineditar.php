<?php
require_once "./header/header.php"
?>
<?php
session_start();
require_once '../src/connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] !== 1) {
    header("Location: ../views/login.php");
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT nome, email FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nome, $email);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo_nome = $_POST['nome'];
    $novo_email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $novo_nome, $novo_email, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: adminusuarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../public/assets/css/admeditar.css">
    <title>Editar Usuário</title>
</head>
<body>
<div class="form-container">
      <h2>Editar Usuário!</h2>
      <br>
    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome" value="arthur" required>
        <label>Email:</label>
        <input type="email" name="email" value="arthurhenriquerech@gmail.com" required>
        <button type="submit">Salvar</button>
    </form>
    </div>
</body>
</html>
