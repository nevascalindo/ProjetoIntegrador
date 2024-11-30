<?php
require_once "./header/header.php";
require_once "../src/connect.php";

// Consultar produtos no banco de dados
$stmt = $conn->prepare("SELECT id, nome, descricao, preco, fotos FROM produtos");
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="../public/assets/css/index.css">
  <title>Kash.Co | Home</title>
</head>
<body>
<section class="banner">
  <img src="../public/assets/img/images.jpg" alt="Banner">
  <div class="banner__content">
    <h2>Bem-vindo à KASH COMPANY!</h2>
    <p>Descubra as nossas novidades e ofertas exclusivas.</p>
    <a href="#" class="banner__btn">Veja Mais</a>
  </div>
</section>
<section class="products">
    <?php while ($produto = $result->fetch_assoc()): ?>
        <?php 
            $fotos = json_decode($produto['fotos'], true); 
        ?>
        <div class="product">
            <?php if (isset($fotos[0])): ?>
                <div class="image-container">
                    <img class="image-front" src="<?= htmlspecialchars(trim($fotos[0])) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" />
                    <?php if (isset($fotos[1])): ?>
                        <img class="image-back" src="<?= htmlspecialchars(trim($fotos[1])) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" />
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <h3><?= htmlspecialchars($produto['nome']) ?></h3>
            <p><?= htmlspecialchars($produto['descricao']) ?></p>
            <span>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></span>
            <button>Adicionar ao Carrinho</button>
        </div>
    <?php endwhile; ?>
</section>

<div class="modal" id="size-modal">
  <div class="modal-content">
    <span class="close" id="close-modal">&times;</span>
    <h2>Escolha o Tamanho</h2>
    <form id="size-form">
      <label><input type="radio" name="size" value="P" required> P</label>
      <label><input type="radio" name="size" value="M"> M</label>
      <label><input type="radio" name="size" value="G"> G</label>
      <label><input type="radio" name="size" value="GG"> GG</label>
      <button type="submit">Adicionar ao Carrinho</button>
    </form>
  </div>
</div>

<script src="https://unpkg.com/scrollreveal"></script>
<script src="../public/assets/js/modal.js"></script>
</body>
</html>
