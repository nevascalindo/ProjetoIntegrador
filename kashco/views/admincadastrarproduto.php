<?php
session_start();
require_once '../src/connect.php';

// Verifica se o usuário é administrador
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

// Lógica de processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade_p = $_POST['quantidade_p'];
    $quantidade_m = $_POST['quantidade_m'];
    $quantidade_g = $_POST['quantidade_g'];
    $quantidade_gg = $_POST['quantidade_gg'];

    // Insere o produto no banco de dados
    $stmt = $conn->prepare("INSERT INTO produtos (nome, descricao, preco, quantidade_p, quantidade_m, quantidade_g, quantidade_gg) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddddd", $nome, $descricao, $preco, $quantidade_p, $quantidade_m, $quantidade_g, $quantidade_gg);
    $stmt->execute();
    $produto_id = $stmt->insert_id;
    $stmt->close();

    // Código para o upload e ordenação de imagens pode ser adicionado aqui
    echo "Produto cadastrado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="../../public/assets/css/cadastrarprod.css">
</head>
<body>
    <h2>Cadastrar Novo Produto</h2>
    <form action="admincadastrarproduto.php" method="post" enctype="multipart/form-data">
        <label>Nome:</label>
        <input type="text" name="nome" required>

        <label>Descrição:</label>
        <textarea name="descricao" required></textarea>

        <label>Preço:</label>
        <input type="number" step="0.01" name="preco" required>

        <label>Quantidade P:</label>
        <input type="number" name="quantidade_p" required>

        <label>Quantidade M:</label>
        <input type="number" name="quantidade_m" required>

        <label>Quantidade G:</label>
        <input type="number" name="quantidade_g" required>

        <label>Quantidade GG:</label>
        <input type="number" name="quantidade_gg" required>

        <label>Fotos do Produto:</label>
        <input type="file" name="fotos[]" multiple required>

        <button type="submit">Cadastrar Produto</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
</body>
</html>
