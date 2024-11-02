<?php
session_start();
require_once 'connect.php';
require '../vendor/autoload.php'; // Carregar biblioteca PHPMailer

if (!isset($_SESSION['user_email'])) {
    echo "Erro: E-mail de usuário não encontrado na sessão.";
    exit();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$user_id = $_SESSION['user_id'];

// Gera um código de verificação
$codigo_verificacao = rand(100000, 999999);
$_SESSION['codigo_verificacao'] = $codigo_verificacao;

// Configuração do Mailtrap
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = 'f2e9ff2ad30b76'; // Substitua pelo seu usuário do Mailtrap
    $mail->Password = 'baaa934b5cf5d6'; // Substitua pela sua senha do Mailtrap
    $mail->SMTPSecure = 'tls';
    $mail->Port = 465;

    // Configurações do e-mail
    $mail->setFrom('noreply@kashcompany.com', 'Kash Company');
    $mail->addAddress($_SESSION['user_email']); // Envia para o e-mail do usuário logado
    $mail->Subject = 'Código de verificação para acesso como Administrador';
    $mail->Body = "Seu código de verificação é: $codigo_verificacao";

    $mail->send();
    header("Location: ../views/verificarcod.php"); // Redireciona para a página de verificação
} catch (Exception $e) {
    echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
}
?>
