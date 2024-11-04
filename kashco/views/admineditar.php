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

    header("Location: admin_usuarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
</head>
<body>
    <h2>Editar Usuário</h2>
    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
