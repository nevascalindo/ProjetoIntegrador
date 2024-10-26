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
    <link rel="stylesheet" href="../public/assets/css/login.css">
    <title>Kash.Co | Cadastro</title>
</head>
<body>
    <section class="logindescer">
        <div class="login-container">
            <h2>Cadastre-se</h2>
            <form action="../src/cadastrouser.php" method="POST">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required>

                <label for="confirma_senha">Confirme a Senha:</label>
                <input type="password" name="confirma_senha" id="confirma_senha" required>

                <button type="submit" class="login-button">Cadastrar</button>

                <p class="register-text">Já tem uma conta? <a href="login.php" class="register-link">Entrar</a></p>
            </form>
        </div>
    </section>
    <script>
        function validarSenha() {
            var senha = document.getElementById("senha").value;
            var confirmaSenha = document.getElementById("confirma_senha").value;

            if (senha !== confirmaSenha) {
                alert("As senhas não coincidem.");
                return false;
            }
            return true;
        }
    </script>
    <script src="https://unpkg.com/scrollreveal"></script>
</body>

</html>
