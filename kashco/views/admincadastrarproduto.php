<?php
session_start();
require_once '../src/connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade_p = $_POST['quantidade_p'];
    $quantidade_m = $_POST['quantidade_m'];
    $quantidade_g = $_POST['quantidade_g'];
    $quantidade_gg = $_POST['quantidade_gg'];
    
    // Diretório para armazenar fotos
    $uploadDir = '../uploads/';
    $fotos = [];

    // Verifica se a pasta de upload existe, se não, cria ela
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Itera sobre cada arquivo enviado
    foreach ($_FILES['fotos']['tmp_name'] as $key => $tmpName) {
        $fileName = basename($_FILES['fotos']['name'][$key]);
        $filePath = $uploadDir . $fileName;
        
        // Verifica se o arquivo foi movido corretamente
        if (move_uploaded_file($tmpName, $filePath)) {
            $fotos[] = $filePath;  // Armazena o caminho da foto para salvar no banco de dados
        } else {
            echo "Erro ao fazer upload da foto: $fileName<br>";
        }
    }

    // Insere os dados do produto no banco
    $stmt = $conn->prepare("INSERT INTO produtos (nome, descricao, preco, quantidade_p, quantidade_m, quantidade_g, quantidade_gg, fotos) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdiisss", $nome, $descricao, $preco, $quantidade_p, $quantidade_m, $quantidade_g, $quantidade_gg, json_encode($fotos));
    
    if ($stmt->execute()) {
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o produto: " . $stmt->error;
    }
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="../../public/assets/css/cadastrarprod.css">
    <style>
        #preview-container {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        #preview-container div {
            position: relative;
        }

        #preview-container img {
            width: 100px;
            height: auto;
            border: 2px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
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
        <input type="file" name="fotos[]" multiple id="fotos" required>

        <!-- Área de pré-visualização reordenável -->
        <div id="preview-container" class="sortable"></div>

        <button type="submit">Cadastrar Produto</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script>
        // Seleciona o campo de entrada de fotos e a div de visualização
        const fotosInput = document.getElementById('fotos');
        const previewContainer = document.getElementById('preview-container');

        // Função para criar pré-visualizações de imagem
        fotosInput.addEventListener('change', () => {
            previewContainer.innerHTML = ""; // Limpa a pré-visualização anterior
            Array.from(fotosInput.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.margin = '5px';
                    img.draggable = true; // Permite arrastar a imagem
                    img.setAttribute('data-index', index); // Atribui o índice para controle

                    const imgContainer = document.createElement('div');
                    imgContainer.appendChild(img);
                    previewContainer.appendChild(imgContainer);
                };
                reader.readAsDataURL(file);
            });
        });

        // Torna a área de pré-visualização arrastável com Sortable
        Sortable.create(previewContainer, {
            animation: 150,
            onEnd: () => {
                // Atualiza a ordem de `data-index` após o arrastar
                Array.from(previewContainer.children).forEach((imgContainer, newIndex) => {
                    imgContainer.querySelector('img').setAttribute('data-index', newIndex);
                });
            }
        });
    </script>
</body>
</html>
