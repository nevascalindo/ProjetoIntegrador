<?php

$host = 'localhost';
$usuario = 'senac'; 
$senha = 'senac123'; 
$banco = 'kashco'; 

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

echo "Conexão bem-sucedida";
?>
