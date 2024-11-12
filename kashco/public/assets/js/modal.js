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