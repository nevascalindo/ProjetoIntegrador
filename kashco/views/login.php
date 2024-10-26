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
    <title>Kash.Co | Login</title>
</head>

<body>
    <section class="logindescer">
    <div class="login-container">
        <h2>Login</h2>
        <form action="../src/loginuser.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>

            <button type="submit" class="login-button">Entrar</button>

            <p class="register-text">Ainda não tem uma conta? <a href="cadastro.php" class="register-link">Cadastre-se</a></p>
        </form>
    </div>
    </section>
    <script src="https://unpkg.com/scrollreveal"></script>
</body>

</html>