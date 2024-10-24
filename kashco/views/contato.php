<?php
require_once "./header/header.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="../public/assets/css/contato.css">
    <title>Kash.Co | Sobre</title>
</head>

<body>
    <main>
        <section class="contato">
            <h2>Entre em Contato</h2>
            <p>
                Ficou com dúvidas ou precisa de mais informações? Preencha o formulário abaixo e nossa equipe entrará em contato
                com você o mais breve possível.
            </p>
        </section>
        <br>
        <section class="formulario-contato">
            <form id="contactForm">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" placeholder="Seu nome!" required />

                <label for="mensagem">Mensagem</label>
                <textarea id="mensagem" name="mensagem" rows="5" placeholder="Sua mensagem!" required></textarea>

                <button type="button" onclick="sendMessage()">Enviar Mensagem</button>
            </form>
        </section>

    </main>
    <script>
        function sendMessage() {
            const nome = document.getElementById("nome").value;
            const mensagem = document.getElementById("mensagem").value;

            if (!nome || !mensagem) {
                alert("preencha seu nome e a mensagem antes de enviar.");
                return;
            }

            const option = confirm("Você deseja entrar em contato com o suporte no Whatsapp?");

            if (option) {
                const phoneNumber = "559999999999";
                const whatsappUrl = `https://api.whatsapp.com/send?phone=${47996963851}&text=Nome: ${encodeURIComponent(nome)}%0AMensagem: ${encodeURIComponent(mensagem)}`;
                window.open(whatsappUrl, '_blank');
            } else {
                exit;
            }
        }
    </script>
    <script src="https://unpkg.com/scrollreveal"></script>
</body>

</html>