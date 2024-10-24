<?php
require_once "./header/header.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="stylesheet" href="../public/assets/css/index.css">
  <title>Kash.Co | Home</title>
</head>
<body>
<section class="banner">
      <img src="../public/assets/img/images.jpg" alt="Banner" />
      <div class="banner__content">
        <h2>Bem-vindo à KASH COMPANY!</h2>
        <p>Descubra as nossas novidades e ofertas exclusivas.</p>
        <a href="#" class="banner__btn">Veja Mais</a>
      </div>
    </section>
    <section class="products">
      <div class="product">
      <img src="../public/assets/img/produto1.jpg" alt="Produto 1" />
        <h3>Produto 1</h3>
        <p>Descrição do produto 1</p>
        <span>R$ 100,00</span>
        <button>Adicionar ao Carrinho</button>
      </div>
      <div class="product">
      <img src="../public/assets/img/produto1.jpg" alt="Produto 1" />
        <h3>Produto 2</h3>
        <p>Descrição do produto 2</p>
        <span>R$ 200,00</span>
        <button>Adicionar ao Carrinho</button>
      </div>
      <div class="product">
      <img src="../public/assets/img/produto1.jpg" alt="Produto 1" />
        <h3>Produto 3</h3>
        <p>Descrição do produto 3</p>
        <span>R$ 300,00</span>
        <button>Adicionar ao Carrinho</button>
      </div>
    </section>
    <div class="modal" id="size-modal">
      <div class="modal-content">
        <span class="close" id="close-modal">&times;</span>
        <h2>Escolha o Tamanho</h2>
        <br>
        <form id="size-form">
          <label>
            <input type="radio" name="size" value="P" required /> P
          </label>
          <label>
            <input type="radio" name="size" value="M" /> M
          </label>
          <label>
            <input type="radio" name="size" value="G" /> G
          </label>
          <label>
            <input type="radio" name="size" value="GG" /> GG
          </label>
          <br>
          <br>
          <button type="submit">Adicionar ao Carrinho</button>
        </form>
      </div>
    </div>

    <script>
      const modal = document.getElementById("size-modal");
      const closeModal = document.getElementById("close-modal");
    
      // Adiciona evento a todos os botões "Adicionar ao Carrinho"
      document.querySelectorAll('.product button').forEach(button => {
        button.addEventListener('click', function() {
          modal.style.display = 'block'; // Abre o modal
        });
      });
    
      // Fecha o modal ao clicar no "x"
      closeModal.addEventListener('click', function() {
        modal.style.display = 'none';
      });
    
      // Fecha o modal ao clicar fora do conteúdo
      window.addEventListener('click', function(event) {
        if (event.target == modal) {
          modal.style.display = 'none';
        }
      });
    
      // Adiciona evento ao formulário para tratar a escolha do tamanho
      document.getElementById('size-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio do formulário
        const selectedSize = document.querySelector('input[name="size"]:checked').value;
        alert(`Produto adicionado ao carrinho com o tamanho: ${selectedSize}`);
        modal.style.display = 'none'; // Fecha o modal
      });
    </script>
    <script src="https://unpkg.com/scrollreveal"></script>
</body>
</html>
